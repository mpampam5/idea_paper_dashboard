<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Topup_model extends CI_Model{


  function fetch_data_json($limit="", $start="")
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
    $this->db->where("status !=","delete");
		$this->db->order_by("id_trans_person_deposit", "DESC");
		$this->db->limit($limit, $start);
		$query = $this->db->get();
		return $query;
	}

  function get_detail($id,$kode_transaksi)
    {

      $qry = $this->db->get_where("trans_person_deposit",[
                                                          "id_trans_person_deposit"=>dec_uri($id),
                                                          "kode_transaksi"=>$kode_transaksi,
                                                          "id_person"=>sess('id_person'),
                                                        ])->row();
      if ($row = $qry) {
        if ($row->status=="pending") {
            if (masa_berlaku($row->time_expire) == false) {
                $this->model->get_update("trans_person_deposit",['status'=>"expire"],['id_trans_person_deposit'=>$id]);
            }
        }
      }


      $query = $this->db->select("trans_person_deposit.id_trans_person_deposit,
                                  trans_person_deposit.kode_transaksi,
                                  trans_person_deposit.id_person,
                                  trans_person_deposit.metode_pembayaran,
                                  trans_person_deposit.nominal,
                                  trans_person_deposit.`status`,
                                  trans_person_deposit.created,
                                  trans_person_deposit.time_expire,
                                  config_rekening.nama_rekening,
                                  config_rekening.no_rekening,
                                  ref_bank.inisial_bank")
                        ->from("trans_person_deposit")
                        ->join("config_rekening","config_rekening.id_rekening = trans_person_deposit.metode_pembayaran")
                        ->join("ref_bank","ref_bank.id_bank = config_rekening.id_bank")
                        ->where("trans_person_deposit.id_trans_person_deposit",dec_uri($id))
                        ->where("trans_person_deposit.kode_transaksi",$kode_transaksi)
                        ->where("trans_person_deposit.id_person",sess('id_person'))
                        ->get();
        $rows =  $query->row();



        return $rows;
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
