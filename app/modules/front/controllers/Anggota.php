<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Anggota extends MY_Controller{
  private $perPage = 6;

  public function __construct()
  {
    parent::__construct();
    $this->load->model("Topup_model","model");
  }

  function index()
  {
    $this->template->set_title("ANGGOTA");
    $data['cek_row'] = $this->model->fetch_data_json();
    $this->template->view("content/anggota/index",array());
  }


  function add()
  {
    $this->template->set_title("ANGGOTA");
    $data['action'] = site_url("anggota-add-action");
    $data['rekening'] = $this->model->get_rekening()->result();
    $this->template->view("content/anggota/form",$data,false);
  }

}
