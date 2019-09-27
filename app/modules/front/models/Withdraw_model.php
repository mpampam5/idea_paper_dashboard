<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Withdraw_model extends CI_Model{
  function fetch_data_json($limit="", $start="")
	{

		$this->db->select("trans_person_withdraw.id_trans_withdraw,
                        trans_person_withdraw.kode_transaksi,
                        trans_person_withdraw.id_person,
                        trans_person_withdraw.nominal,
                        trans_person_withdraw.status,
                        trans_person_withdraw.created,
                        trans_person_withdraw.time_approved");
		$this->db->from("trans_person_withdraw");
    $this->db->where("id_person",sess('id_person'));
    $this->db->where("status !=","delete");
		$this->db->order_by("id_trans_withdraw", "DESC");
		$this->db->limit($limit, $start);
		$query = $this->db->get();
		return $query;
	}

  function get_detail($id,$kode_transaksi)
    {
      $query = $this->db->select("trans_person_withdraw.id_trans_withdraw,
                                  trans_person_withdraw.kode_transaksi,
                                  trans_person_withdraw.id_person,
                                  trans_person_withdraw.nominal,
                                  trans_person_withdraw.status,
                                  trans_person_withdraw.created")
                        ->from("trans_person_withdraw")
                        ->where("trans_person_withdraw.id_trans_withdraw",$id)
                        ->where("trans_person_withdraw.kode_transaksi",$kode_transaksi)
                        ->where("trans_person_withdraw.id_person",sess('id_person'))
                        ->get();
        $rows =  $query->row();



        return $rows;
    }

  function get_insert($table,$data)
  {
    return $this->db->insert($table,$data);
  }

  function get_update($table,$data,$where)
  {
    return $this->db->where($where)
                    ->update($table,$data);
  }
}
