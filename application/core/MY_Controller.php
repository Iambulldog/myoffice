<?php

class MY_Controller extends MX_Controller
{
 
  public $class;
  public $method;
  public $site_config = array();
  public function __construct()
  {
    parent::__construct();

     $this->class = $this->router->fetch_class();
     $this->method = $this->router->fetch_method();

     $this->load->library('users/users_library');
       if($this->class == 'backend'){
              
              $this->users_library->check_login();
       }
       
       
       



  }






}

 ?>
