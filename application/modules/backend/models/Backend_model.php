<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');




class Backend_model extends CI_Model
{

	public function __construct()
	{
		parent::__construct();
	}


	public function get_user_all()
	{
		$q = $this->db
					->select('*')
					->get('tb_login');
		return $q->result_array();
	}

	public function save_newuser($data)
	{
		$q = $this->db->insert('tb_login', $data);
		if($q){
			return true;
		}else{
			return false;
		}
		
	}
// ===============  list all  =================

public function get_list(){
	$q = $this->db
				->select('tb_list.*, tb_user.name as name_user, tb_user.web_id as web_id, tb_web.name as web_name,  tb_login.name as admin_name')
				->join('tb_login','tb_login.id=tb_list.admin_id')
				->join('tb_user','tb_user.id=tb_list.user_id')
				->join('tb_web','tb_web.id=tb_user.web_id')
				->order_by("tb_list.time_create", "DESC")
				->get('tb_list');
	return $q->result();
}
public function save_list($data){

		$q = $this->db->insert('tb_list', $data);
		if($q){
			return ('บันทึกสำเร็จ');
		}else{
			return ('ไม่สามารถบันทึก ได้');
		}		

}
public function edit_list($id,$data){
	$q = $this->db->select('*')->where('id',$id)->get('tb_list')->row();

	// 1 ก๊อปของเดิม tb_list มาเซฟ tb_log  
	// stdClass Object ( [id] => 1 [user_id] => 2 [list] => 2 [total] => 100.00 [bonus] => 0.00 [admin_id] => 1 [time_create] => 2020-06-15 09:32:34 [status] => 2 )
	$data_log = array(				 
		'id_list' => $q->id ,
		'user_id' => $q->user_id ,
		'list' => $q->list ,
		'total' => $q->total ,
		'bonus' => $q->bonus ,
		'admin_id' => $q->admin_id ,
		'time_create' => $q->time_create 
	);

	// 2 อัฟเดท tb_list 

	if($this->db->insert('tb_list_log', $data_log)){
		if($this->db->where('id',$id)->update('tb_list', $data)){
			return ('บันทึกสำเร็จ');
		}else{
			return ('ไม่สามารถบันทึกได้');
		}	
	}else{
		return ('ไม่สามารถบันทึกได้');
	}		

	

}
// ===============  user  =================
	public function get_user(){
		$q = $this->db
					->select('tb_user.*,tb_web.name as web_name ,tb_web.id as web_id')
					->join('tb_web','tb_web.id=tb_user.web_id')
					->get('tb_user');
		return $q->result();
	}
	public function save_user($data){
		$ch =$this->db
					->select('*')
					->where('name',$data['name'])
					->where('web_id',$data['web_id'])
					->get('tb_user')->result();

		if(!$ch){
			$q = $this->db->insert('tb_user', $data);
			if($q){
				return ('บันทึก '.$data['name'].' สำเร็จ');
			}else{
				return ('ไม่สามารถบันทึก '.$data['name'].' ได้');
			}		
		}else{
			return ('มีรายการ '.$data['name'].' ในระบบแล้ว');
		}

	}
// ===============  web  =================
	public function save_web($data){
		$ch =$this->db
					->select('*')
					->where('name',$data['name'])
					->get('tb_web')->result();
		if(!$ch){
			$q = $this->db->insert('tb_web', $data);
			if($q){
				return ('บันทึก '.$data['name'].' สำเร็จ');
			}else{
				return ('ไม่สามารถบันทึก '.$data['name'].' ได้');
			}		
		}else{
			return ('มีรายการ '.$data['name'].' ในระบบแล้ว');
		}

	
		
	}
	public function get_web(){
		$q = $this->db
					->select('*')
					->get('tb_web');
		return $q->result();
	}
// ===============  user  =================
public function get_admin(){
	$q = $this->db
				->select('*')
				->get('tb_login');
	return $q->result();
}
  

}
