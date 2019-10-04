
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    $this->load->helper('pass_has');
  }


function index()
  {
    if ($this->session->userdata('logins_member')==1) {
        redirect(site_url("front/dashboard"),"refresh");
    }else {
      $data['action'] = site_url("sign-in-action");
      $this->load->view("content/login/index",$data);
    }
  }


  function action()
  {
    if ($this->input->is_ajax_request()) {
      $json = array('success' => false,
                    "valid"=>false,
                    'url'=>"",
                    'alert'=>array()
                  );
      $this->load->library("form_validation");
      $this->form_validation->set_rules("username","Username","trim|xss_clean|required");
      $this->form_validation->set_rules("password","Password","trim|required");
      $this->form_validation->set_error_delimiters('<label class="error mt-2 text-danger" style="font-weight:400;font-size:14px">','</label>');


      if ($this->form_validation->run()) {
          $json["success"] = true;

          $username = $this->input->post("username");
          $password =  $this->input->post("password");

          $where = array("username" => $username,
                          "is_delete" => '0',
                          "is_active" => '1');

          $query = $this->db->select("tb_auth.id_auth,
                                      tb_auth.id_person,
                                      tb_auth.username,
                                      tb_auth.password,
                                      tb_auth.token,
                                      tb_person.is_delete,
                                      tb_person.is_verifikasi")
                            ->from("tb_auth")
                            ->join("tb_person","tb_person.id_person = tb_auth.id_person")
                            ->where($where)
                            ->get();

          if ($query->num_rows() == 1) {
              $row =  $query->row();

              $pwd =  $row->password;
              $token =  $row->token;

              if (pass_decrypt($token,$password,$pwd)===true) {
                $session = array('logins_member' => true,
                                 'id_person' => $row->id_person
                                );
                $this->session->set_userdata($session);

                $json['valid'] = true;
                $json['url'] = site_url("dashboard");

              }else {
                $json['alert'] = "Username Atau Password Salah";
              }
          }else {
            $json['alert'] = "Username Atau Password Salah";
          }

      }else {
        foreach ($_POST as $key => $value) {
          $json['alert'][$key] = form_error($key);
        }
      }

      echo json_encode($json);
    }


    //
    // echo json_encode($json);
  }



  function logout()
    {
      $this->session->sess_destroy();
      redirect(site_url("mem-panel"),'refresh');
    }


}
