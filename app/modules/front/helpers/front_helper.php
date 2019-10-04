<?php defined('BASEPATH') OR exit('No direct script access allowed');

if ( ! function_exists('sess'))
{
  function sess($str)
  {
     $ci=& get_instance();
    return $ci->session->userdata($str);
  }
}

if ( ! function_exists('config_all'))
{
  function config_all($field)
  {
     $ci=& get_instance();
     $query = $ci->db->where("config",$field)
                     ->get("config_all")
                     ->row();
     return $query->value;
  }
}

if ( ! function_exists('profile'))
{
  function profile($field)
  {
     $ci=& get_instance();
     $query = $ci->db->get_where("tb_person",['id_person'=>$ci->session->userdata('id_person')]);
     if ($query->num_rows()> 0) {
       return $query->row()->$field;
     }else {
       return "Error Helper";
     }
  }
}


if ( ! function_exists('format_rupiah'))
{
  function format_rupiah($int)
  {
    return number_format($int, 0, ',', '.');
  }
}

if ( ! function_exists('masa_berlaku'))
{
  function masa_berlaku($date)
  {
    $awal  = strtotime($date); //waktu awal
    $akhir = strtotime(date("Y-m-d H:i:s")); //waktu akhir
    $diff  = $awal-$akhir;
    $jam   = floor($diff / (60 * 60));
    if ($jam > 0) {
      return true;
    }else {
      return false;
    }
  }
}

// menampilkan wilayah berdasarkan table dan id
function tampilkan_wilayah($table,$where,$selected)
{
  $ci=get_instance();
  $str="";
  $query = $ci->db->get_where($table,$where);
  if ($query->num_rows() > 0) {
      foreach ($query->result() as $row) {
        $str .= '<option value="'.$row->id.'"';
        $str .= (($row->id==$selected) ? " selected >":">");
        $str .= $row->name." </option>";
      }
  }else {
    $str .= "Gagal memuat table $table";
  }

return $str;

}


function balance()
{

  $topup = _cek_topup();
  $withdraw = _cek_withdraw();
  $biaya_sponsor = _cek_biaya_sponsor();
  $komisi_sponsor = _cek_komisi_sponsor();
  $total = $topup + $komisi_sponsor - $withdraw - $biaya_sponsor;
  return $total;
}

function _cek_topup()
{
  $ci=& get_instance();
  $qry = $ci->db->select("id_trans_person_deposit,
                                id_person,
                                SUM(nominal) AS nominal,
                                status")
                      ->from("trans_person_deposit")
                      ->where("id_person",sess('id_person'))
                      ->where("status","success")
                      ->get()
                      ->row();
  return $qry->nominal;
}

function _cek_withdraw()
{
  $ci=& get_instance();
  $qry = $ci->db->select("id_trans_withdraw,
                          id_person,
                          SUM(nominal) AS nominal,
                          status")
                      ->from("trans_person_withdraw")
                      ->where("id_person",sess('id_person'))
                      ->where("status","success")
                      ->get()
                      ->row();
  return $qry->nominal;
}

function _cek_biaya_sponsor()
{
  $ci=& get_instance();
  $qry = $ci->db->select("trans_person_sponsor,
                          id_person_sponsor,
                          SUM(biaya_registrasi) AS biaya_registrasi")
                      ->from("trans_person_sponsor")
                      ->where("id_person_sponsor",sess('id_person'))
                      ->get()
                      ->row();
  return $qry->biaya_registrasi;
}


function _cek_komisi_sponsor()
{
  $ci=& get_instance();
  $qry = $ci->db->select("trans_person_sponsor,
                          id_person_sponsor,
                          SUM(bonus_sponsor) AS bonus_sponsor")
                      ->from("trans_person_sponsor")
                      ->where("id_person_sponsor",sess('id_person'))
                      ->get()
                      ->row();
  return $qry->bonus_sponsor;
}
