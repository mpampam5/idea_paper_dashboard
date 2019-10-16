<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller{

  public function __construct()
  {
    parent::__construct();

    $this->load->library('user_agent');
    $device = strtolower($this->agent->mobile());
    $device_info = array("apple iphone", "android");
    if (in_array($device,$device_info)) {
      if ($this->session->userdata('logins_member')!=true) {
          $this->session->sess_destroy();
          redirect(site_url("mem-panel"));
      }
      $this->load->helper(array("front",'enc_gue'));
      $this->load->library(array("front/template","front/front"));
    }else {
      redirect("welcome","refresh");
    }
  }

  //CEK PASSWORD FORM VALIDATION
  function _cek_password($str)
  {
    if ($row = $this->db->get_where("tb_auth",["id_person"=>sess('id_person')])->row()) {
        $this->load->helper("pass_has");
        if (pass_decrypt($row->token,$str,$row->password)==true) {
          return true;
        }else {
          $this->form_validation->set_message('_cek_password', '* Password Salah');
          return false;
        }
    }else {
      $this->form_validation->set_message('_cek_password', '* Password Salah');
      return false;
    }
  }


  function maintenance()
  {
    $this->template->set_title("MAINTENANCE");
    $this->template->view("maintenance",array());
  }





}
