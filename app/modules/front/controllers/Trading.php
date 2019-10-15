<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Trading extends MY_Controller{

   private $perPage = 6;

  public function __construct()
  {
    parent::__construct();
    if (profile("is_complate")=="0" OR profile("is_verifikasi")=="0") {
        redirect("formulir","refresh");
    }
    $this->load->model("Trading_model","model");
  }

  function get($title="")
  {
    $link_uri = array('info','history');
    if (in_array($title,$link_uri)) {
      $this->template->set_title("TRADING");
      if ($title=="info") {
        $query['row'] = $this->model->get_info_trading();
      }elseif ($title="history") {
        $query['row'] = "";
      }
      $data['content_view'] = $this->load->view("content/trading/content_$title",$query,true);
      $this->template->view("content/trading/index",$data);
    }else {
      echo "";
    }
  }

  function form_beli()
  {
    if ($this->input->is_ajax_request()) {
        $this->template->view("content/trading/form_paper",array(),false);
    }
  }

    function _kode()
    {
      $q = $this->db->query("SELECT MAX(RIGHT(kode_transaksi,4)) AS kd_trans FROM trans_person_withdraw WHERE DATE(created)=CURDATE()");
          $kd = "";
          if($q->num_rows()>0){
              foreach($q->result() as $k){
                  $tmp = ((int)$k->kd_trans)+1;
                  $kd = sprintf("%04s", $tmp);
              }
          }else{
              $kd = "0001";
          }
          date_default_timezone_set('Asia/Makassar');
          return "WD".date('dmy').$kd;
    }




}
