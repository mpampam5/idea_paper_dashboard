<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Topup extends MY_Controller{

  public function __construct()
  {
    parent::__construct();
    $this->load->model("Topup_model","model");
  }

  function index()
  {
    $this->template->set_title("TOP UP");
    // $data['rekening'] = $this->model->get_rekening()->result();
    $this->template->view("content/topup/index",array());
  }

  function add()
  {
    $this->template->set_title("TOP UP");
    $data['rekening'] = $this->model->get_rekening()->result();
    $this->template->view("content/topup/form",$data,false);
  }


  function detail($id)
  {
    $this->template->set_title("TOP UP");
    $this->template->view("content/topup/detail",array());
  }



}
