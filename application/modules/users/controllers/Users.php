<?php
/**
 *
 */
class Users extends MY_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->helper('url');
    $this->load->library('users_library');
    $this->load->model('users_model');

  }


  public function index()
  {
    $this->load->view('login');
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

        $users = $this->users_library->login(
              $username,
              $password,
              $remember
            );
        

            if($users['status']=='Success!'){
              header('Location:'.base_url('backend'));
            }else if($users['status']=='warning'){
              $this->session->set_flashdata('status', $users['status']);
              $this->session->set_flashdata('message', $users['message']);
              header('Location:'.base_url('users/login'));

            }else{
              $this->session->set_flashdata('status', $users['status']);
              $this->session->set_flashdata('message', $users['message']);
              header('Location:'.base_url('users/login'));

            }

      } else{
             $this->load->view('login');
      }


  }
  public function check_login()
  {


    $result = $this->users_model->can_login($this->input->post('username'), $this->input->post('password'));
    if($result == '')
    {
      $this->users_model->update_last_login($_SESSION['id'], $_SESSION['type']);
      redirect('backend');
    }
    else
    {
      $this->session->set_flashdata('message',$result);
      redirect('users/login');
    }
  


  }
  public function logout()
  {
    $data = $this->session->all_userdata();
    foreach($data as $row => $rows_value)
    {
      $this->session->unset_userdata($row);
    }
    redirect('users/login');
  }



}
