
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends MY_Controller{

  public function __construct()
  {
    parent::__construct();
    // if (profile("is_verifikasi")=="0") {
    //     redirect("front/formulir","refresh");
    // }
  }

  function index()
  {

      $this->template->set_title("Dashboard");
      $this->template->view("content/dashboard/index",array());
    // echo strtolower($device);
  }



}
