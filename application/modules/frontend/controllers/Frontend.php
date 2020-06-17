<?php

/**
* 
*/
class Frontend extends MY_Controller
{

	public function __construct()
	{

		parent::__construct();		
		$this->load->helper('url');
		$this->_init();
		$this->load->library('members_library');
		$this->load->model('members_model');
		 
	}
	private function _init()
	{		
		$this->output->set_template('tem_frontend/tem_frontend');
	}

	public function index()
	{
		$data = array(
			'menu' => 0,
			'tb'=> $this->tb()
		);
		
		$this->load->view('frontend',$data);
		
	}
	public function login()
	{
  
	  $this->load->library('form_validation');
  
	  $this->form_validation->set_rules('username','Username','required');
	  $this->form_validation->set_rules('password','Password','required');
	  if ($this->form_validation->run() === TRUE) {
  
		  $username = $this->input->post('username');
		  $password = $this->input->post('password');
		  $remember = (bool)$this->input->post('remember');
  
		  $users = $this->members_library->login(
				$username,
				$password,
				$remember
			  );
		  
  
			  if($users['status']=='Success!'){
				$this->session->set_flashdata('status', $users['status']);
				$this->session->set_flashdata('message', $users['message']);
				header('Location:'.base_url('frontend/'));
			  }else if($users['status']=='warning'){
				$this->session->set_flashdata('status', $users['status']);
				$this->session->set_flashdata('message', $users['message']);
				header('Location:'.base_url('frontend/'));
  
			  }else{
				$this->session->set_flashdata('status', $users['status']);
				$this->session->set_flashdata('message', $users['message']);
				header('Location:'.base_url('frontend/'));
  
			  }
  
		} else{
			   $this->load->view('frontend');
		}
  
  
	}

	public function logout()
	{
	  $data = $this->session->all_userdata();
	  foreach($data as $row => $rows_value)
	  {
		$this->session->unset_userdata($row);
	  }
	  header('Location:'.base_url('frontend/'));
	}
  

	public function page1()
	{
		$this->load->view('page1');
	}


	public function tb () {
		$url = "http://www.soccersuck.com";
	   $curl = curl_init();
	   curl_setopt_array($curl, array(
	   CURLOPT_URL => $url,
	   CURLOPT_RETURNTRANSFER => true,
	   CURLOPT_ENCODING => "UTF-8",
	   CURLOPT_MAXREDIRS => 10,
	   CURLOPT_TIMEOUT => 30,
	   CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	   CURLOPT_CUSTOMREQUEST => "GET",
	   CURLOPT_HTTPHEADER => array(
		   'Content-type: text/html; charset=UTF-8',
		   ),
	   ));
		$page = curl_exec($curl);
   
	  // table class="score_tb"
   
	   preg_match('#<table class="score_tb"[^>]*>(.+?)</table>#is', $page, $matches );
   
	   foreach ($matches as &$match) {
		   $match = $match;
	   }
		return $matches[0];
   }

	


}

