<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Register_model extends CI_Model{

  function get_provinsi()
  {
    return $this->db->get("wil_provinsi");
  }

  function get_bank()
  {
    return $this->db->get("ref_bank");
  }


}
