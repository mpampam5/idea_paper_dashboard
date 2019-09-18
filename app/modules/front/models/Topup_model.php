<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Topup_model extends CI_Model{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
  }

  function get_rekening()
  {
    $query = $this->db->select("config_rekening.id_rekening,
                                config_rekening.id_bank,
                                ref_bank.inisial_bank")
                      ->from("config_rekening")
                      ->join("ref_bank","ref_bank.id_bank = config_rekening.id_bank")
                      ->get();
    return $query;
  }

}
