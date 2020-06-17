<?php
class Api_model extends CI_Model{

    public $table;
    public function __construct()
    {
        parent::__construct();
        $this->table = "site_config";
    }
    public function find_api_key($domain)
    {
        if(!empty($domain)){
            $result = $this->db->where('domain',$domain)->get($this->table);
            return $result->row();
        }else{
            return false;
        }
        
    }

}