<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Formulir_model extends CI_Model{

  function get_detail_member()
      {
        $query = $this->db->select("tb_person.id_person,
                                    tb_person.id_register,
                                    tb_person.nik,
                                    tb_person.nama,
                                    tb_person.tempat_lahir,
                                    tb_person.tanggal_lahir,
                                    tb_person.jenis_kelamin,
                                    tb_person.pekerjaan,
                                    tb_person.telepon,
                                    tb_person.email,
                                    tb_person.foto,
                                    tb_person.file_ktp,
                                    tb_person.file_kk,
                                    tb_person.alamat,
                                    tb_person.id_provinsi,
                                    tb_person.id_kabupaten,
                                    tb_person.id_kecamatan,
                                    tb_person.id_kelurahan,
                                    tb_person.is_delete,
                                    tb_person.is_verifikasi,
                                    tb_person.created,
                                    tb_person.modified,
                                    tb_auth.username,
                                    trans_person_rekening.nama_rekening,
                                    trans_person_rekening.no_rekening,
                                    trans_person_rekening.kota_pembukuan,
                                    trans_person_rekening.ref_bank,
                                    ref_bank.inisial_bank")
                          ->from("tb_person")
                          ->join("tb_auth","tb_auth.id_person = tb_person.id_person","left")
                          ->join("trans_person_rekening","trans_person_rekening.id_person = tb_person.id_person","left")
                          ->join("ref_bank","ref_bank.id_bank = trans_person_rekening.ref_bank","left")
                          ->where("tb_person.id_person",sess("id_person"))
                          ->where("tb_person.is_delete","0")
                          ->get()
                          ->row();
          return $query;
      }


      function get_update($table,$data,$where)
    {
      return $this->db->where($where)
                      ->update($table,$data);
    }


}
