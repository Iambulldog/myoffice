<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');




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
		if ($q) {
			return true;
		} else {
			return false;
		}
	}
	// ===============  list all  =================

	public function get_list()
	{
		$q = $this->db
			->select('tb_list.*, tb_user.name as name_user, tb_user.web_id as web_id, tb_web.name as web_name,  tb_login.name as admin_name')
			->join('tb_login', 'tb_login.id=tb_list.admin_id')
			->join('tb_user', 'tb_user.id=tb_list.user_id')
			->join('tb_web', 'tb_web.id=tb_user.web_id')
			->order_by("tb_list.time_create", "DESC")
			->get('tb_list');
		return $q->result();
	}
	public function save_list($data, $id_web)
	{
		$date = date('Y-m-d');
		$newd = date('Y-m-d', strtotime($date . "-181 days"));
		$this->db->where('time_create < ', $newd)->delete('tb_list');
		$q = $this->db->insert('tb_list', $data);
		$this->update_credit($id = 0, $data, $id_web, $s = 1);
		if ($q) {
			return ('บันทึกสำเร็จ');
		} else {
			return ('ไม่สามารถบันทึก ได้');
		}
	}
	public function update_credit($id, $data, $id_web, $s)
	{
		switch ($s) {
			case 1: //'add'
				if ($data['list'] == 1) {
					$w = $this->db->where('id', $id_web)->get('tb_web')->row();
					$data2 = array(
						'credit' => (floatval($w->credit) - floatval($data['total']) - floatval($data['bonus'])),
					);
					$this->db->where('id', $id_web)->update('tb_web', $data2);
				}
				break;
			case 2: //'edit'
				$q = $this->db->select('*')->where('id', $id)->get('tb_list')->row();

				$old_idweb = $this->db->select('*,tb_web.id As id ,tb_web.credit As o_credit ')
					->join('tb_user', 'tb_web.id=tb_user.web_id', 'left')
					->where("tb_user.id", $q->user_id)
					->get('tb_web')->row();

				$w = $this->db->where('id', $id_web)->get('tb_web')->row();

				if ($data['user_id'] != $q->user_id) { // เปลี่ยนเว็บ
					if($data['list'] == $q->list){
						if ($data['list'] == 1) {
							$d = array(
								'credit' => $old_idweb->o_credit - $q->total - $q->bonus,
							);
							$this->db->where('id', $old_idweb->id)->update('tb_web', $d);
	
							 $c = (floatval($w->credit) + floatval($data['total']));
							 $c2 = (floatval($data['bonus']));
	
							$data2 = array(
								'credit' => floatval($c + $c2),
							);
						} elseif ($data['list'] == 2) {
							$data2 = array(
								'credit' => (floatval($w->credit)),
							);
						}
					}else{	
						if ($data['list'] == 1) {
								$data2 = array(
								'credit' => (floatval($w->credit) + floatval($data['total'])),
							);
							
						} elseif ($data['list'] == 2) {
							echo "l2";
						
							$d = array(
								'credit' => (floatval($w->credit) + floatval($data['total']) + floatval($data['bonus'])),
							);
							$data2 = array(
								'credit' => floatval($w->credit)  + floatval($data['bonus']),
							);
							$this->db->where('id', $old_idweb->id)->update('tb_web', $d);
							
						}
					}
					

				} else {
					if($data['list'] == $q->list){
						
						if ($data['list'] == 1) {
							$n_total = 0;
							if (floatval($data['total']) > floatval($q->total)) {
								$n_total = floatval($data['total']) - floatval($q->total);
								$c = (floatval($w->credit) + floatval($data['total']) );
							
							} elseif (floatval($data['total']) < floatval($q->total)){
								$n_total =  floatval($q->total) - floatval($data['total']);
								$c = (floatval($w->credit) + floatval($n_total));
							
							}else{
								$c = (floatval($w->credit) - floatval($data['total']));

							}
							if (floatval($data['bonus']) > floatval($q->bonus)) {
								$n_bonus = floatval($data['bonus']) - floatval($q->bonus);
								$c2 = (floatval($n_bonus));
							} else if (floatval($data['bonus']) < floatval($q->bonus)){
								$n_bonus =  floatval($q->bonus) - floatval($data['bonus']);
								$c2 = (floatval($n_bonus));
							}else{
								$c2 = (floatval($data['bonus']));
							
							}
	
							$data2 = array(
								'credit' => floatval($c + $c2),
							);
						} elseif ($data['list'] == 2) {
							$data2 = array(
								'credit' => (floatval($w->credit) + floatval($q->total) + floatval($q->bonus)),
							);
						}
					}else{
						
						if ($data['list'] == 1) {
							$n_total = 0;
							if (floatval($data['total']) > floatval($q->total)) {
								$n_total = floatval($data['total']) - floatval($q->total);
								$c = (floatval($w->credit) - floatval($data['total']) );
							
							} elseif (floatval($data['total']) < floatval($q->total)){
								$n_total =  floatval($q->total) - floatval($data['total']);
								$c = (floatval($w->credit) + floatval($n_total));
								
							}else{
								$c = (floatval($w->credit) + floatval($data['total']));
							
							}
							if (floatval($data['bonus']) >= floatval($q->bonus)) {
								$n_bonus = floatval($data['bonus']) - floatval($q->bonus);
								$c2 = (floatval($n_bonus));
							} elseif (floatval($data['bonus']) < floatval($q->bonus)){
								$n_bonus =  floatval($q->bonus) - floatval($data['bonus']);
								$c2 = (floatval($n_bonus));
							}else{
								$c2 = (floatval($data['bonus']));
							
							}
	
							$data2 = array(
								'credit' => floatval($c + $c2),
							);
						} elseif ($data['list'] == 2) {
							
							$data2 = array(
								'credit' => (floatval($w->credit) + floatval($q->total) + floatval($q->bonus)),
							);
						}
					}
					
				}

				$this->db->where('id', $id_web)->update('tb_web', $data2);


				break;
			case 3: //'delete'
				break;
			case 4: //'reduce'
				break;
		}
	}
	public function edit_list($id, $data, $id_web)
	{


		$q = $this->db->select('*')->where('id', $id)->get('tb_list')->row();
		// เปลี่ยนแค่ สลิปไม่ต้องอัปเครดิต
		if ($q->list == $data['list'] &&  $q->total == $data['total'] && $q->user_id == $data['user_id'] && $q->bonus == $data['bonus']) {
		} else {
			$this->update_credit($id, $data, $id_web, $s = 2);
		}


		// 1 ก๊อปของเดิม tb_list มาเซฟ tb_log  
		// stdClass Object ( [id] => 1 [user_id] => 2 [list] => 2 [total] => 100.00 [bonus] => 0.00 [admin_id] => 1 [time_create] => 2020-06-15 09:32:34 [status] => 2 )
		$data_log = array(
			'id_list' => $q->id,
			'user_id' => $q->user_id,
			'list' => $q->list,
			'total' => $q->total,
			'bonus' => $q->bonus,
			'slip' => $q->slip,
			'admin_id' => $q->admin_id,
			'time_create' => $q->time_create
		);

		// 2 อัฟเดท tb_list 
		$date = date('Y-m-d');
		$newd = date('Y-m-d', strtotime($date . "-181 days"));
		$this->db->where('time_create < ', $newd)->delete('tb_list_log');
		if ($this->db->insert('tb_list_log', $data_log)) {
			if ($this->db->where('id', $id)->update('tb_list', $data)) {
				return ('บันทึกสำเร็จ');
			} else {
				return ('ไม่สามารถบันทึกได้');
			}
		} else {
			return ('ไม่สามารถบันทึกได้');
		}
	}
	// ===============  user  =================
	public function get_user()
	{
		$q = $this->db
			->select('tb_user.*,tb_web.name as web_name ,tb_web.id as web_id')
			->join('tb_web', 'tb_web.id=tb_user.web_id')
			->order_by('tb_user.name', 'ASC')
			->get('tb_user');
		return $q->result();
	}
	public function save_user($data)
	{
		$ch = $this->db
			->select('*')
			->where('name', $data['name'])
			->where('web_id', $data['web_id'])
			->get('tb_user')->result();

		if (!$ch) {
			$q = $this->db->insert('tb_user', $data);
			if ($q) {
				return ('บันทึก ' . $data['name'] . ' สำเร็จ');
			} else {
				return ('ไม่สามารถบันทึก ' . $data['name'] . ' ได้');
			}
		} else {
			return ('มีรายการ ' . $data['name'] . ' ในระบบแล้ว');
		}
	}
	// ===============  web  =================
	public function save_web($data)
	{
		$ch = $this->db
			->select('*')
			->where('name', $data['name'])
			->get('tb_web')->result();
		if (!$ch) {
			$q = $this->db->insert('tb_web', $data);

			if ($q) {
				$last_id = $this->db->insert_id();
				$this->save_logweb($last_id, $data['credit']);
				return ('บันทึก ' . $data['name'] . ' สำเร็จ');
			} else {
				return ('ไม่สามารถบันทึก ' . $data['name'] . ' ได้');
			}
		} else {
			return ('มีรายการ ' . $data['name'] . ' ในระบบแล้ว');
		}
	}
	public function edit_web($id_web, $data, $c)
	{

		$q = $this->db->where('id', $id_web)->update('tb_web', $data);
		if ($q) {
			$this->save_logweb($id_web, $c);
			return ('บันทึก ' . $data['name'] . ' สำเร็จ');
		} else {
			return ('ไม่สามารถบันทึก ' . $data['name'] . ' ได้');
		}
	}
	public function save_logweb($ip, $c)
	{
		$data = array(
			'id_web' => $ip,
			'credit' => $c,
			'ip' => $this->input->ip_address()
		);
		$q = $this->db->insert('tb_web_log', $data);
	}
	public function edit_user($id, $data)
	{

		$q = $this->db->where('id', $id)->update('tb_user', $data);
		if ($q) {
			return ('บันทึก ' . $data['name'] . ' สำเร็จ');
		} else {
			return ('ไม่สามารถบันทึก ' . $data['name'] . ' ได้');
		}
	}
	public function get_web()
	{
		$q = $this->db
			->select('*')
			->get('tb_web');
		return $q->result();
	}
	// ===============  user  =================
	public function get_admin()
	{
		$q = $this->db
			->select('*')
			->get('tb_login');
		return $q->result();
	}
}
