<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Anggota_model extends CI_Model{

  function fetch_data_json($limit="", $start="")
	{
    $this->db->select("trans_person_sponsor.trans_person_sponsor,
                        trans_person_sponsor.id_person_sponsor,
                        trans_person_sponsor.id_person,
                        trans_person_sponsor.biaya_registrasi,
                        trans_person_sponsor.bonus_sponsor,
                        trans_person_sponsor.keterangan,
                        tb_person.created,
                        tb_person.id_register,
                        tb_person.nama");
		$this->db->from("trans_person_sponsor");
    $this->db->join("tb_person","tb_person.id_person = trans_person_sponsor.id_person");
    $this->db->where("id_person_sponsor",sess('id_person'));
		$this->db->order_by("trans_person_sponsor", "DESC");
		$this->db->limit($limit, $start);
		$query = $this->db->get();
		return $query;
  }


  function get_where($table,$where)
  {
    return $this->db->get_where($table,$where)
                    ->row();
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
