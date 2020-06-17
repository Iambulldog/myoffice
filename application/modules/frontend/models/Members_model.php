<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');
date_default_timezone_set('Asia/Bangkok'); 

class Members_model extends CI_Model
{

	public function __construct()
	{
		parent::__construct();


	}


	public function find_users_by_user($username)
	{
		$q = $this->db->where('username',$username)->get('tb_members');
		return $q->row();
	}

	public function update_last_login($id,$logtype)
	{
		$data = array(
			'last_login' => date('Y-m-d H:i:s'),
			'last_ip' => $this->input->ip_address()
		);
		$this->db->where('id',$id);
		return $this->db->update('tb_members', $data);
	}
	public function can_login($username, $password)
	{
		$this->db->where('username', $username);
		$query = $this->db->get('tb_members');
		if($query->num_rows() > 0)
		{
			foreach($query->result() as $row)
			{
				if($row->username == $username)
				{
					$password = $this->users_library->hash_password($password,$row->salt);
					$store_password = $row->password;
					//die();
					if($password == $store_password)
					{
						$this->session->set_userdata('id', $row->id);
						$this->session->set_userdata('username', $row->username);
						$this->session->set_userdata('nickname', $row->nickname);
						$this->session->set_userdata('name', $row->name);
						$this->session->set_userdata('sername', $row->sername);
						$this->session->set_userdata('tel', $row->tel);
						$this->session->set_userdata('parent', $row->parent);
						$this->session->set_userdata('type', $row->type);
						$this->session->set_userdata('created_by', $row->created_by);
						$this->session->set_userdata('created_at', $row->created_at);
					}
					else
					{

						return 'รหัสผ่านไม่ถูกต้อง';
					}
				}
				else
				{
					return 'ชื่อผู้ใช้ไม่ถูกต้อง';
				}
			}
		}
		else
		{
			return 'Wrong username or password';
		}
	}
	
}

