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
        $data['action'] = site_url("trading/act-form");
        $this->template->view("content/trading/form_paper",$data,false);
    }
  }

  function act_form()
  {
    if ($this->input->is_ajax_request()) {
      $this->load->library("form_validation");
      $json = array('success'=>false, 'alert'=>array());
      $this->form_validation->set_rules("jumlah_paper","&nbsp;*","trim|xss_clean|required|numeric|callback__cek_paper");
      $this->form_validation->set_rules("password","&nbsp;*","trim|xss_clean|required|callback__cek_password");
      $this->form_validation->set_error_delimiters('<label class="error  ml-1 text-danger" style="font-size:9px">','</label>');


    if ($this->form_validation->run()) {

      $masa_kontrak = get_info_trading("masa_kontrak");
      $waktu_mulai =  date('Y-m-d', strtotime("+1 month", strtotime(date('Y-m-d'))));
      $masa_aktif = date('Y-m-d', strtotime("+$masa_kontrak month", strtotime($waktu_mulai)));
      $insert = array('id_trading' => 1,
                      'kode_transaksi'=> $this->_kode(),
                      'id_person' => sess('id_person'),
                      'jumlah_paper' => $this->input->post('jumlah_paper'),
                      'total_harga_paper' => (get_info_trading("harga_paper")*$this->input->post('jumlah_paper')),
                      'status_kontrak' => "belum",
                      'waktu_mulai'=>$waktu_mulai,
                      'masa_aktif' => $masa_aktif,
                      'created' => date('Y-m-d H:i:s')
                      );

      $this->model->get_insert("trans_person_trading",$insert);

      $json['success'] = true;
      $json['alert'] = "successfully";
      }else {
        foreach ($_POST as $key => $value)
          {
            $json['alert'][$key] = form_error($key);
          }
      }

      echo json_encode($json);
    }
  }



  function json_profit()
  {
    $this->load->library('Datatables');
    header('Content-Type: application/json');
    echo $this->model->json_profit();
  }


  function json_dividen()
  {
    $this->load->library('Datatables');
    header('Content-Type: application/json');
    echo $this->model->json_dividen();
  }


    function _cek_paper($str)
    {
      $sisa_paper = get_info_trading("jumlah_paper")-total_paper_terpakai();
      $total_harga_pembelian_paper = (get_info_trading("harga_paper")*$str);

      if ($str > $sisa_paper) {
          $this->form_validation->set_message('_cek_paper', ' * Jumlah paper tersedia '.$sisa_paper);
          return false;
      }else {
        if ($total_harga_pembelian_paper > balance()) {
          $this->form_validation->set_message('_cek_paper', ' * Saldo anda tidak mencukupi');
          return false;
        }else {
          return true;
        }
      }
    }

    function _kode()
    {
      $q = $this->db->query("SELECT MAX(RIGHT(kode_transaksi,4)) AS kd_trans FROM trans_person_trading WHERE DATE(created)=CURDATE()");
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
          return "TD".date('dmy').$kd;
    }




}
