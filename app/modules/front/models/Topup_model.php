<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Topup_model extends CI_Model{


  function fetch_data_json($limit, $start)
	{

		$this->db->select("trans_person_deposit.id_trans_person_deposit AS id_trans_person_deposit,
                        trans_person_deposit.kode_transaksi AS kode_transaksi,
                        trans_person_deposit.id_person AS id_person,
                        trans_person_deposit.metode_pembayaran AS metode_pembayaran,
                        trans_person_deposit.nominal AS nominal,
                        trans_person_deposit.`status` AS status,
                        trans_person_deposit.created AS created,
                        ref_bank.inisial_bank AS inisial_bank");
		$this->db->from("trans_person_deposit");
    $this->db->join("config_rekening","config_rekening.id_rekening = trans_person_deposit.metode_pembayaran");
    $this->db->join("ref_bank","ref_bank.id_bank = config_rekening.id_bank");
    $this->db->where("id_person",sess('id_person'));
		$this->db->order_by("id_trans_person_deposit", "DESC");
		$this->db->limit($limit, $start);
		$query = $this->db->get();
		return $query;
	}

  // get_detail($id,$kode_transaksi)
  // {
  //
  // }

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

  function get_insert($table,$data)
  {
    return $this->db->insert($table,$data);
  }

}
