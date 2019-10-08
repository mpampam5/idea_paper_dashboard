<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Withdraw extends MY_Controller{

   private $perPage = 6;

  public function __construct()
  {
    parent::__construct();
    if (profile("is_complate")=="0" OR profile("is_verifikasi")=="0") {
        redirect("formulir","refresh");
    }
    $this->load->model("Withdraw_model","model");
  }

  function index()
  {
    $this->template->set_title("WITHDRAW");
    $data['cek_row'] = $this->model->fetch_data_json();
    $this->template->view("content/withdraw/index",$data);
  }


  function json()
  {
    if ($this->input->is_ajax_request()) {
      $output = '';
  		$data = $this->model->fetch_data_json($this->input->post('limit'), $this->input->post('start'));
  		if($data->num_rows() > 0)
  		{
  			foreach($data->result() as $row)
  			{
          if ($row->status == "success") {
            $status = "badge-success";
          }elseif ($row->status == "proses") {
            $status = "badge-primary";
          }

  				$output .= '<li class="list-withdraw">
                          <a href="'.site_url("withdraw-detail/".enc_uri($row->id_trans_withdraw)."/".$row->kode_transaksi).'">
                              <span class="nominal">Rp. '.format_rupiah($row->nominal).'</span>
                              <span class="date"> <i class="ti-calendar"></i> '.date('d/m/Y H:i',strtotime($row->created)).' <b>#'.$row->kode_transaksi.'</b></span>
                          </a>
                          <span class="status badge badge-pill '.$status.'">'.$row->status.'</span>
                        </li>
  				           ';
  			}
  		}
  		echo $output;
    }
  }


  function add(){
    $this->template->set_title("WITHDRAW");
    $data['action'] = site_url("withdraw-add-action");
    $this->template->view("content/withdraw/form",$data,false);
  }


  function add_action()
  {
    if ($this->input->is_ajax_request()) {
      $this->load->library("form_validation");
      $json = array('success'=>false, 'alert'=>array());
      $this->form_validation->set_rules("nominal","Nominal","trim|xss_clean|required|numeric|callback__cek_nominal");
      $this->form_validation->set_error_delimiters('<label class="error mt-2 text-danger" style="font-size:12px">','</label>');

      if ($this->form_validation->run()) {


          $data = array("id_person" => sess('id_person'),
                        "kode_transaksi" => $this->_kode(),
                        "nominal" => $this->input->post("nominal",true),
                        "created" =>  date("Y-m-d H:i:s"),
                      );
        $this->model->get_insert("trans_person_withdraw",$data);
        $last_id = $this->db->insert_id();
        $json['url'] = site_url("withdraw-detail/".enc_uri($last_id)."/".$data['kode_transaksi']);
        $json['alert'] = "Withdraw successful";
        $json['success'] =  true;
      }else {
        foreach ($_POST as $key => $value)
          {
            $json['alert'][$key] = form_error($key);
          }
      }

      echo json_encode($json);
    }
  }

  function detail($id,$kd_trans){
    if ($row = $this->model->get_detail(dec_uri($id),$kd_trans)) {
        $this->template->set_title("WITHDRAW");
        $data['row'] = $row;
        $this->template->view("content/withdraw/detail",$data);
    }
  }




  function konfirmasi($id,$kode_transaksi)
  {
    if ($this->input->is_ajax_request()) {
          $keterangan = "keterangan = is delete from user  | user_approved =".sess('id_person').",".profile("nama")." | waktu = ".date('Y-m-d h:i:s');
          if ($this->model->get_update('trans_person_withdraw',['status'=>"delete","keterangan"=>$keterangan],["id_trans_withdraw"=>dec_uri($id),"kode_transaksi"=>$kode_transaksi])) {
              $json['success'] = "success";
              $json['alert']   = 'success';
          }else {
            $json['success'] = "error";
            $json['alert']   = 'gagal';
          }


      echo json_encode($json);
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


    function _cek_nominal($str)
    {
      if ($str <= balance()) {
        if ($str < config_all("min-withdraw")) {
            if (config_all("min-withdraw")!=0) {
              $this->form_validation->set_message('_cek_nominal', 'Minimal Withdraw Rp.'.format_rupiah(config_all('min-withdraw')));
              return false;
            }else {
              return true;
            }
          }elseif ($str > config_all("max-withdraw")) {
            if (config_all("max-withdraw")!=0) {
              $this->form_validation->set_message('_cek_nominal', 'Maximal Withdraw Rp.'.format_rupiah(config_all('max-withdraw')));
              return false;
            }else {
              return true;
            }
          }else {
            return true;
          }
      }else {
        $this->form_validation->set_message('_cek_nominal', 'Saldo anda tidak mencukupi, Sisa saldo <b class="text-info">Rp.'.format_rupiah(balance()).'</b>');
        return false;
      }

    }

}
