<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Trading_model extends CI_Model{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
  }

function get_info_trading()
  {
    $query = $this->db->get_where("trading",['id_trading'=>1]);
    return $query->row();
  }


  function get_insert($table,$data)
  {
    return $this->db->insert($table,$data);
  }

}
