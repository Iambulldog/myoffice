<?php

/**
 * 
 */
class Backend extends MY_Controller
{
	var $myweb, $user, $dw;
	public function __construct()
	{

		parent::__construct();
		$this->load->helper('url');
		$this->_init();
		$this->load->library('users/users_library');
		$this->load->model('users/users_model');
		$this->load->model('backend_model');

		$this->myweb =  $this->backend_model->get_web();
		$this->myuser =  $this->backend_model->get_user();
		$this->dw =  $this->backend_model->get_list();
	}
	private function _init()
	{
		$this->output->set_template('tem_admin/tem_admin');
	}
	public function index()
	{
		$data['menu'] = 'home';
		$data['web'] = $this->myweb;
		$data['user'] = $this->myuser;
		$data['list_all'] = $this->dw;
		$this->load->view('deposit_withdraw', $data);
	}
	public function profile()
	{
		$data['menu'] = 'profile';
		$this->load->view('profile', $data);
	}
	public function get_log()
	{
		if (isset($_POST['id'])) {
			$q = $this->db
				->select('tb_list_log.*, tb_user.name as name_user, tb_user.web_id as web_id, tb_web.name as web_name,  tb_login.username as admin_name')
				->join('tb_login', 'tb_login.id=tb_list_log.admin_id')
				->join('tb_user', 'tb_user.id=tb_list_log.user_id')
				->join('tb_web', 'tb_web.id=tb_user.web_id')
				->where('tb_list_log.id_list', $_POST['id'])
				->order_by("tb_list_log.time_create_log", "DESC")
				->get('tb_list_log');
			echo json_encode($q->result());
		}
		die;
	}

	public function recycle()
	{
		$data = array(
			'status' => 2
		);

		if ($this->db->where('id', $this->input->post('id'))->update('tb_list', $data)) {
			echo json_encode(true);
		} else {
			echo json_encode(false);
		}

		die();
	}
	public function remove()
	{
		$data = array(
			'status' => 0
		);
		$v = $this->input->post('data');
		$q = $this->db->select('*')->where('id', $v['id'])->get('tb_list')->row();
		if ($this->db->where('id', $v['id'])->update('tb_list', $data)) {

			if ($v['list'] == 1) {

				$w = $this->db->where('id', $v['web_id'])->get('tb_web')->row();
				$data2 = array(
					'credit' => (floatval($w->credit) + floatval($q->total)),
				);
				$this->db->where('id',$v['web_id'])->update('tb_web', $data2);
			}

			echo json_encode(true);
		} else {
			echo json_encode(false);
		}

		die();
	}
	// ========== report  ============

	public function report()
	{
		$date = date('Y-m-d');

		$oth = 0;
		$type = 0;
		$s_web = 0;
		$s_user = 0;

		if (isset($_POST['oth'])) {
			$oth = $_POST['oth'];
			if ($_POST['oth'] != '-') {
				switch ($_POST['oth']) {
					case '0': //วันนี้
						$begin = $date." 11:00";
						$end = date('Y-m-d 10:59', strtotime($date . "+1 days"));
						break;
					case '-1': //เมื่อวาน						
						$date1 = str_replace('-', '/', $date);
						$newd = date('Y-m-d H:i', strtotime($date1 . "-1 days"));
						$begin = $newd;
						$end = $newd;
						break;

					case '7': //7 วันก่อน
						$date1 = str_replace('-', '/', $date);
						$newd = date('Y-m-d H:i', strtotime($date1 . "-7 days"));
						$begin = $newd;
						$end = date('Y-m-d 10:59', strtotime($date . "+1 days"));
						break;

					case '1': //1 เดือน
						$date1 = str_replace('-', '/', $date);
						$newd = date('Y-m-d H:i', strtotime($date1 . "-30 days"));
						$begin = $newd;
						$end = date('Y-m-d 10:59', strtotime($date . "+1 days"));
						break;

					case '3': //3 เดือน
						$date1 = str_replace('-', '/', $date);
						$newd = date('Y-m-d H:i', strtotime($date1 . "-90 days"));
						$begin = $newd;
						$end = date('Y-m-d 10:59', strtotime($date . "+1 days"));
						break;

					case '6': //6 เดือน
						$date1 = str_replace('-', '/', $date);
						$newd = date('Y-m-d H:i', strtotime($date1 . "-180 days"));
						$begin = $newd;
						$end = date('Y-m-d 10:59', strtotime($date . "+1 days"));
						break;

					default:
						$begin = $date." 11:00";
						$end = date('Y-m-d 10:59', strtotime($date . "+1 days"));
						break;
				}
			} else {
				$oth = $_POST['oth'];
				if (isset($_POST['datebegin']) && isset($_POST['dateend'])) {
					$begin = (explode("T", $_POST['datebegin']));
					$begin = $begin[0] . " " . $begin[1];

					$end = (explode("T", $_POST['dateend']));
					$end = $end[0] . " " . $end[1];
				} else {
					$begin = $date." 11:00";
					$end = date('Y-m-d 10:59', strtotime($date . "+1 days"));
				}
			}
		} else {
			if (isset($_POST['datebegin']) && isset($_POST['dateend'])) {
				$begin = (explode("T", $_POST['datebegin']));
				$begin = $begin[0] . " " . $begin[1];

				$end = (explode("T", $_POST['dateend']));
				$end = $end[0] . " " . $end[1];
			} else {
				$begin = $date." 11:00";
				$end = date('Y-m-d 10:59', strtotime($date . "+1 days"));
			}
		}
		if (isset($_POST['type'])) {
			$type = $_POST['type'];
		}
		if (isset($_POST['s_web'])) {
			$s_web = $_POST['s_web'];
		}
		if (isset($_POST['s_user'])) {
			$s_user = $_POST['s_user'];

		}
		$q = $this->db
			->select('tb_list.*, tb_user.name as name_user, tb_user.web_id as web_id, tb_web.name as web_name,  tb_login.username as admin_name')
			->join('tb_login', 'tb_login.id=tb_list.admin_id')
			->join('tb_user', 'tb_user.id=tb_list.user_id')
			->join('tb_web', 'tb_web.id=tb_user.web_id')
			->where_in("tb_list.status", ['1', '2'])
			->where("tb_list.time_create BETWEEN '$begin :00'  AND '$end:00'  ");
		if ($type != 0) {
			$this->db->where("tb_list.list", $type);
		}
		if ($s_web != 0) {
			$this->db->where("tb_user.web_id", $s_web);
		} 
		if ($s_user != 0) {
				$this->db->where("tb_user.id", $s_user);
		}


		$q = $this->db->order_by("tb_list.time_create", "DESC")
			->get('tb_list');


		$data['menu'] = 'report';
		$data['web'] = $this->myweb;
		$data['user'] = $this->myuser;
		$data['list_all'] = $q->result();
		$data['begin'] = $begin;
		$data['end'] = $end;
		$data['oth'] = $oth;
		$data['type'] = $type;
		$data['s_web'] = $s_web;
		$data['s_user'] = $s_user;
		// die;
		$this->load->view('report', $data);
	}
	// ========== report2  ============

	public function report2()
	{
		$date = date('Y-m-d');

		$oth = 0;

		$s_web = 0;

		if (isset($_POST['oth'])) {
			$oth = $_POST['oth'];
			if ($_POST['oth'] != '-') {
				switch ($_POST['oth']) {
					case '0': //วันนี้
						$begin = $date." 11:00";
						$end = date('Y-m-d 10:59', strtotime($date . "+1 days"));
						break;
					case '-1': //เมื่อวาน						
						$date1 = str_replace('-', '/', $date);
						$newd = date('Y-m-d H:i', strtotime($date1 . "-1 days"));
						$begin = $newd;
						$end = $newd;
						break;

					case '7': //7 วันก่อน
						$date1 = str_replace('-', '/', $date);
						$newd = date('Y-m-d H:i', strtotime($date1 . "-7 days"));
						$begin = $newd;
						$end = date('Y-m-d 10:59', strtotime($date . "+1 days"));
						break;

					case '1': //1 เดือน
						$date1 = str_replace('-', '/', $date);
						$newd = date('Y-m-d H:i', strtotime($date1 . "-30 days"));
						$begin = $newd;
						$end = date('Y-m-d 10:59', strtotime($date . "+1 days"));
						break;

					case '3': //3 เดือน
						$date1 = str_replace('-', '/', $date);
						$newd = date('Y-m-d H:i', strtotime($date1 . "-90 days"));
						$begin = $newd;
						$end = date('Y-m-d 10:59', strtotime($date . "+1 days"));
						break;

					case '6': //6 เดือน
						$date1 = str_replace('-', '/', $date);
						$newd = date('Y-m-d H:i', strtotime($date1 . "-180 days"));
						$begin = $newd;
						$end = date('Y-m-d 10:59', strtotime($date . "+1 days"));
						break;

					default:
						$begin = $date." 11:00";
						$end = date('Y-m-d 10:59', strtotime($date . "+1 days"));
						break;
				}
			} else {
				$oth = $_POST['oth'];
				if (isset($_POST['datebegin']) && isset($_POST['dateend'])) {
					$begin = (explode("T", $_POST['datebegin']));
					$begin = $begin[0] . " " . $begin[1];

					$end = (explode("T", $_POST['dateend']));
					$end = $end[0] . " " . $end[1];
				} else {
					$begin = $date." 11:00";
					$end = date('Y-m-d 10:59', strtotime($date . "+1 days"));
				}
			}
		} else {
			if (isset($_POST['datebegin']) && isset($_POST['dateend'])) {
				$begin = (explode("T", $_POST['datebegin']));
				$begin = $begin[0] . " " . $begin[1];

				$end = (explode("T", $_POST['dateend']));
				$end = $end[0] . " " . $end[1];
			} else {
				$begin = $date." 11:00";
				$end = date('Y-m-d 10:59', strtotime($date . "+1 days"));
			}
		}
		if (isset($_POST['type'])) {
			$type = $_POST['type'];
		}
		if (isset($_POST['s_web'])) {
			$s_web = $_POST['s_web'];
		}

		$mydata = [];

		// die;
		if ($s_web == 0) {
			$i = 0;

			foreach ($this->myweb as $key => $value) {
				$mydata[$i] =	array(
					'id_web' => $value->id,
					'web_name' => $value->name,
				);
				$total_deposit = $this->db
					->select('sum(tb_list.total) as total ,tb_web.id as webid')
					->join('tb_login', 'tb_login.id=tb_list.admin_id')
					->join('tb_user', 'tb_user.id=tb_list.user_id')
					->join('tb_web', 'tb_web.id=tb_user.web_id')
					->where_in("tb_list.status", ['1', '2'])
					->where("tb_list.time_create BETWEEN '$begin:00'  AND '$end:00'  ")
					->where("tb_web.id", $value->id)->where("tb_list.list", 1)->get('tb_list')->result();
				$total_withdraw = $this->db
					->select('sum(tb_list.total) as total ,tb_web.id as webid')
					->join('tb_login', 'tb_login.id=tb_list.admin_id')
					->join('tb_user', 'tb_user.id=tb_list.user_id')
					->join('tb_web', 'tb_web.id=tb_user.web_id')
					->where_in("tb_list.status", ['1', '2'])
					->where("tb_list.time_create BETWEEN '$begin :00'  AND '$end:00'  ")
					->where("tb_web.id", $value->id)->where("tb_list.list", 2)->get('tb_list')->result();
				$total_bonus = $this->db
					->select('sum(tb_list.bonus) as total ,tb_web.id as webid')
					->join('tb_login', 'tb_login.id=tb_list.admin_id')
					->join('tb_user', 'tb_user.id=tb_list.user_id')
					->join('tb_web', 'tb_web.id=tb_user.web_id')
					->where_in("tb_list.status", ['1', '2'])
					->where("tb_list.time_create BETWEEN '$begin :00'  AND '$end:00'  ")
					->where("tb_web.id", $value->id)->get('tb_list')->result();
				foreach ($total_deposit as $k => $v) {
					if ($value->id == $v->webid) {
						$mydata[$i]['total_deposit'] = $v->total;
					}
				}
				foreach ($total_withdraw as $k => $v) {
					if ($value->id == $v->webid) {
						$mydata[$i]['total_withdraw'] = $v->total;
					}
				}
				foreach ($total_bonus as $k => $v) {
					if ($value->id == $v->webid) {
						$mydata[$i]['total_bonus'] = $v->total;
					}
				}



				$i++;
			}
		} else {
			$i = 0;
			$total_deposit = $this->db
				->select('sum(tb_list.total) as total ,tb_web.id as webid , tb_web.name as webname')
				->join('tb_login', 'tb_login.id=tb_list.admin_id')
				->join('tb_user', 'tb_user.id=tb_list.user_id')
				->join('tb_web', 'tb_web.id=tb_user.web_id')
				->where_in("tb_list.status", ['1', '2'])
				->where("tb_list.time_create BETWEEN '$begin :00'  AND '$end:00'  ")
				->where("tb_web.id", $s_web)->where("tb_list.list", 1)->get('tb_list')->result();
			$total_withdraw = $this->db
				->select('sum(tb_list.total) as total ,tb_web.id as webid')
				->join('tb_login', 'tb_login.id=tb_list.admin_id')
				->join('tb_user', 'tb_user.id=tb_list.user_id')
				->join('tb_web', 'tb_web.id=tb_user.web_id')
				->where_in("tb_list.status", ['1', '2'])
				->where("tb_list.time_create BETWEEN '$begin :00'  AND '$end:00'  ")
				->where("tb_web.id", $s_web)->where("tb_list.list", 2)->get('tb_list')->result();
			$total_bonus = $this->db
				->select('sum(tb_list.bonus) as total ,tb_web.id as webid')
				->join('tb_login', 'tb_login.id=tb_list.admin_id')
				->join('tb_user', 'tb_user.id=tb_list.user_id')
				->join('tb_web', 'tb_web.id=tb_user.web_id')
				->where_in("tb_list.status", ['1', '2'])
				->where("tb_list.time_create BETWEEN '$begin :00'  AND '$end:00'  ")
				->where("tb_web.id", $s_web)->get('tb_list')->result();
			foreach ($total_deposit as $k => $v) {
				$mydata[$i]['id_web'] = $v->webid;
				$mydata[$i]['web_name'] = $v->webname;
			}
			foreach ($total_deposit as $k => $v) {
				if ($s_web == $v->webid) {
					$mydata[$i]['total_deposit'] = $v->total;
				}
			}
			foreach ($total_withdraw as $k => $v) {
				if ($s_web == $v->webid) {
					$mydata[$i]['total_withdraw'] = $v->total;
				}
			}
			foreach ($total_bonus as $k => $v) {
				if ($s_web == $v->webid) {
					$mydata[$i]['total_bonus'] = $v->total;
				}
			}
		}


		$data['menu'] = 'report2';
		$data['web'] = $this->myweb;
		$data['list_all'] = $mydata;
		$data['begin'] = $begin;
		$data['end'] = $end;
		$data['oth'] = $oth;
		$data['s_web'] = $s_web;


		$this->load->view('report2', $data);
	}
	// ========== deposit withdraw ============
	public function deposit_withdraw()
	{
		$data['menu'] = 'deposit_withdraw';
		$data['web'] = $this->myweb;
		$data['user'] = $this->myuser;
		$data['list_all'] = $this->dw;

		$this->load->view('deposit_withdraw', $data);
	}
	public function addlist()
	{
		if (isset($_POST)) {
			if (isset($_POST['bonus'])) {
				$b = $this->input->post('bonus');
			} else {
				$b = 0;
			}
			if (isset($_POST['slip'])) {
				$d_s = (explode("T", $this->input->post('slip')));

				$s = $d_s[0] . " " . $d_s[1];
			} else {
				$s = '0000-00-00 00:00:00';
			}
			$data = array(
				'list' => $this->input->post('s_list'),
				// '' => $this->input->post('s_web'),
				'user_id' => $this->input->post('s_user'),
				'total' => $this->input->post('total'),
				'bonus' => $b,
				'slip' => $s,
				'admin_id' => $_SESSION['users']['id'],

			);

			echo '<script>alert("' . $this->backend_model->save_list($data, $this->input->post('s_web')) . '");</script>';

			redirect(base_url('backend/deposit_withdraw'), 'refresh');
		}
	}
	public function editlist()
	{
		if (isset($_POST)) {
			if (isset($_POST['bonus'])) {
				$b = $this->input->post('bonus');
			} else {
				$b = 0;
			}
			if (isset($_POST['slip'])) {
				$d_s = (explode("T", $this->input->post('slip')));

				$s = $d_s[0] . " " . $d_s[1];
			} else {
				$s = '0000-00-00 00:00:00';
			}
			$data = array(
				'list' => $this->input->post('s_list'),
				'user_id' => $this->input->post('s_user'),
				'total' => $this->input->post('total'),
				'bonus' => $b,
				'slip' => $s,
				'status' => 2,
			);

			echo '<script>alert("' . $this->backend_model->edit_list($this->input->post('id'), $data, $this->input->post('s_web')) . '");</script>';

			redirect(base_url('backend/deposit_withdraw'), 'refresh');
		}
	}
	// ========== admin  ============
	public function admin()
	{
		$data['menu'] = 'admin';
		$data['admin'] = $this->backend_model->get_admin();;

		$this->load->view('admin', $data);
	}
	public function add_admin()
	{
		$salt = $this->users_library->salt();
		$pass = $this->users_library->hash_password($this->input->post('password'), $salt);
		$data = array(
			'username' => $this->input->post('username'),
			'nickname' => $this->input->post('nickname'),
			'password' => $pass,
			'salt' => $salt,
			'name' => $this->input->post('name'),
			'sername' => $this->input->post('sername'),
			'tel' => '',
			'last_login' => date('Y-m-d H:i:s'),
			'last_ip' => $this->input->ip_address()
		);
		$q = $this->db->insert('tb_login', $data);
		if ($q) {
			echo '<script>alert("เพิ่มแอดมินเรียบร้อย");</script>';

			redirect(base_url('backend/admin'), 'refresh');
		} else {
			echo '<script>alert("ผิดพลาด");</script>';

			redirect(base_url('backend/admin'), 'refresh');
		}
	}
	// ==========  user ============
	public function user()
	{
		$data['menu'] = 'user';
		$data['web'] = $this->myweb;
		$data['user'] = $this->myuser;
		$this->load->view('user', $data);
	}
	public function adduser()
	{
		if (isset($_POST)) {
			$data = array(
				'name' => $this->input->post('nameuser'),
				'web_id' => $this->input->post('s_web'),
			);

			echo '<script>alert("' . $this->backend_model->save_user($data) . '");</script>';
			redirect(base_url('backend/user'), 'refresh');
		}
	}
	public function edituser()
	{
		if (isset($_POST)) {
			$data = array(
				'name' => $this->input->post('nameuser'),
				'web_id' => $this->input->post('s_web'),
			);

			echo '<script>alert("' . $this->backend_model->edit_user($this->input->post('id'), $data) . '");</script>';
			redirect(base_url('backend/user'), 'refresh');
		}
	}
	// ==========  web ============
	public function web()
	{
		$data['menu'] = 'web';
		$data['web'] = $this->myweb;
		$this->load->view('web', $data);
	}

	public function addweb()
	{
		if (isset($_POST)) {
			$data = array(
				'name' => $this->input->post('webname'),
				'credit' => $this->input->post('credit'),
				// 'balance' =>$this->input->post('credit'),

			);

			echo '<script>alert("' . $this->backend_model->save_web($data) . '");</script>';
			redirect(base_url('backend/web'), 'refresh');
		}
	}
	public function editweb()
	{
		if (isset($_POST)) {

			$q = $this->db->select('*')
					->where('id',$this->input->post('id'))
					->get('tb_web')->row();
			
			$data = array(
				'name' => $this->input->post('webname'),
				'credit' => $q->credit + $this->input->post('credit'),

			);

			echo '<script>alert("' . $this->backend_model->edit_web($this->input->post('id'), $data) . '");</script>';
			redirect(base_url('backend/web'), 'refresh');
		}
	}


	public function editpass()
	{
		$password = $this->input->post('old_password');
		$users = $this->users_model->find_users_by_user($_SESSION['users']['username']);

		if ($users) {

			if ($this->users_library->hash_password($password, $users->salt) != $users->password) {
				echo '<script>alert("รหัสผ่านเดิมไม่ถูกต้อง");</script>';
				redirect(base_url('backend/profile'), 'refresh');
			}

			$salt = $this->users_library->salt();
			$newpass = $this->users_library->hash_password($this->input->post('password'), $salt);
			$data = array(
				'password' => $newpass,
				'salt' => $salt,
			);
			if ($this->db->where('id', $_SESSION['users']['id'])->update('tb_login', $data)) {
				echo '<script>alert("เปลี่ยนรหัส สำเร็จ \n กรุณาเข้าสู่ระบบใหม่");</script>';
				redirect(base_url('users/logout'), 'refresh');
			} else {
				echo '<script>alert("ผิดพลาด");</script>';
				redirect(base_url('backend/profile'), 'refresh');
			}
		}
	}


	public function repass()
	{

		
		 $id =$this->input->post('id');
			$password = $this->input->post('pass');
		
		
			$salt = $this->users_library->salt();
			$newpass = $this->users_library->hash_password($password , $salt);
			$data = array(
				'password' => $newpass,
				'salt' => $salt,
			);
			if ($this->db->where('id', $id)->update('tb_login', $data)) {
				echo json_encode(true);
				die;
			} else {
				echo json_encode(false);
				die;
			}

	}


	public function editprofile()
	{

		$data = array(
			'name' => $this->input->post('name'),
			'sername' => $this->input->post('sername'),
			'nickname' => $this->input->post('nickname'),
		);

		if ($this->db->where('id', $_SESSION['users']['id'])->update('tb_login', $data)) {
			$_SESSION['users']['name'] =  $this->input->post('name');
			$_SESSION['users']['sername'] =  $this->input->post('sername');
			$_SESSION['users']['nickname'] =  $this->input->post('nickname');
			echo '<script>alert("สำเร็จ");</script>';
			redirect(base_url('backend/profile'), 'refresh');
		} else {
			echo '<script>alert("ผิดพลาด");</script>';
			redirect(base_url('backend/profile'), 'refresh');
		}
	}
}
