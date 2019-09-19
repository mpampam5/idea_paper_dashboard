<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Topup extends MY_Controller{
  private $perPage = 6;

  public function __construct()
  {
    parent::__construct();
    $this->load->model("Topup_model","model");
  }

  function index()
  {
      $this->template->set_title("TOP UP");
      $this->template->view("content/topup/index",array());
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
          if ($row->status == "pending") {
            $status = "badge-warning text-white";
          }elseif ($row->status == "success") {
            $status = "badge-success";
          }elseif ($row->status == "proses") {
            $status = "badge-primary";
          }elseif ($row->status == "cancel") {
            $status = "badge-danger";
          }

  				$output .= '<li>
                        <a href="'.site_url("topup-detail/$row->id_trans_person_deposit/$row->kode_transaksi").'">
                            <span class="nominal"> Rp. '.format_rupiah($row->nominal).'</span>
                            <span class="bank"> Transfer Ke Bank '.$row->inisial_bank.'</span>
                            <span class="date"> <i class="fa fa-calendar"></i> '.date('d/m/Y H:i',strtotime($row->created)).' #'.$row->kode_transaksi.'</span>
                        </a>
                        <span class="status badge badge-pill '.$status.'">'.$row->status.'</span>
                      </li>
  				           ';
  			}
  		}
  		echo $output;
    }
  }

  function add()
  {
    $this->template->set_title("TOP UP");
    $data['action'] = site_url("topup-add-action");
    $data['rekening'] = $this->model->get_rekening()->result();
    $this->template->view("content/topup/form",$data,false);
  }

  function add_action()
  {
    if ($this->input->is_ajax_request()) {
      $this->load->library("form_validation");
      $json = array('success'=>false, 'alert'=>array());
      $this->form_validation->set_rules("nominal","Nominal","trim|xss_clean|required|numeric");
      $this->form_validation->set_rules("metode_pembayaran","Metode Pembayaran","trim|xss_clean|required|numeric",[
        "required"=>"Pilih metode pembayaran"
      ]);
      $this->form_validation->set_error_delimiters('<label class="error mt-2 text-danger">','</label>');

      if ($this->form_validation->run()) {
        $created = date("Y-m-d h:i:s");// pendefinisian tanggal awal
        $time_expire = date('Y-m-d h:i:s', strtotime('+1 days', strtotime($created))); //operasi penjumlahan tanggal sebanyak 6 hari

          $data = array("id_person" => sess('id_person'),
                        "kode_transaksi" => $this->_kode(),
                        "nominal" => $this->input->post("nominal",true),
                        "metode_pembayaran" =>$this->input->post("metode_pembayaran",true),
                        "created" => $created,
                        "time_expire" => $time_expire
                      );
        $this->model->get_insert("trans_person_deposit",$data);
        $last_id = $this->db->insert_id();
        $json['url'] = site_url("topup-detail/$last_id");
        $json['alert'] = "add new data successful";
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


  function detail($id)
  {
    $this->template->set_title("TOP UP");
    $this->template->view("content/topup/detail",array());
  }


  function _kode()
  {
    $q = $this->db->query("SELECT MAX(RIGHT(kode_transaksi,4)) AS kd_trans FROM trans_person_deposit WHERE DATE(created)=CURDATE()");
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
        return "DP".date('dmy').$kd;
  }



}
