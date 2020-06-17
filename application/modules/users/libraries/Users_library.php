<?php
/**
 *
 */
class Users_library
{

	public $CI;
	public $class;
	public $method;


	public function __construct()
	{
		$this->CI =& get_instance();
		$this->class = $this->CI->router->fetch_class();
		$this->method = $this->CI->router->fetch_method();
		$this->CI->load->model('users/users_model');
	}

	public function check_login()
	{ 
		 if($this->_is_logged_in()){
			if($this->class === 'users' && $this->method === 'login'){
			  redirect('backend','refresh');
			}
		  }else{
			if($this->class === 'users' && $this->method === 'login'){
  
			}else{
			  redirect(base_url('users/login'),'refresh');
			}
  
		  }

	}

	public function _is_logged_in()
	{
		
        return (bool) $this->CI->session->userdata('users');
	}


	public function login($username,$password,$remember = FALSE)
	{

		$resp = array();
		if(empty($username) && empty($password)){
			$resp['status'] = 'error';
			$resp['message'] = 'no input your password !!';
			return $resp;
			
		}

		$users = $this->CI->users_model->find_users_by_user($username);

		if($users){

			if($this->hash_password($password,$users->salt) != $users->password){
				$resp['status'] = 'warning';
				$resp['message'] = 'incorrect password !!';
				return $resp;
			}

			// set session

			$this->_set_session($users);

			if($remember){
				$this->_set_session($users);
			}

			// update

			$hasUpdate = $this->CI->users_model->update_last_login($users->id,'LoginPage');

			if($hasUpdate){
				$resp['status'] = 'Success!';
				$resp['message'] = 'login completed !';
				return $resp;
			}else{
				$resp['status'] = 'error';
				$resp['message'] = 'system error !!';
				return $resp;
			}

		}else{
			$resp['status'] = 'warning';
			$resp['message'] = 'password undefind !!';
			return $resp;
		}

	}



	private function _set_session($users)
	{
		$set_session = array(

			'id'=> $users->id,
			'username'=> $users->username,
			'nickname'=> $users->nickname,
			'name'=> $users->name,
			'sername'=> $users->sername,
			'tel'=> $users->tel,
			'last_login'=> $users->last_login,
			'last_ip'=> $users->last_ip,
		);

		$this->CI->session->set_userdata('users' ,$set_session);

	}


// Hash pass

	public function salt()
	{
		$raw_salt_len = 16;
		$buffer = '';

		$bl = strlen($buffer);
		for($i = 0; $i < $raw_salt_len; $i++){
			if($i < $bl){
				$buffer[$i] = $buffer[$i] ^ chr(mt_rand(0,255));
			}else{
				$buffer .= chr(mt_rand(0,255));
			}
		}

		$salt = $buffer;
	
		$base64_digits = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/';
		$bcrypt64_digits ='./ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
		$base64_string = base64_encode($salt);
		$salt = strtr(rtrim($base64_string, '='), $base64_digits, $bcrypt64_digits);

		$salt = substr($salt, 0, 31);
         
		return $salt;

	}

	public function hash_password($password, $salt)
	{
		if(empty($password)){
			return false;
		}

		return sha1($password.$salt);
	}

}
