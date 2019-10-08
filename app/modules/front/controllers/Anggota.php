<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Anggota extends MY_Controller{
  private $perPage = 6;

  public function __construct()
  {
    parent::__construct();
    if (profile("is_complate")=="0" OR profile("is_verifikasi")=="0") {
        redirect("formulir","refresh");
    }
    $this->load->model("Anggota_model","model");
  }

  function index()
  {
    $this->template->set_title("ANGGOTA");
    $data['cek_row'] = $this->model->fetch_data_json();
    $this->template->view("content/anggota/index",$data);
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
  				$output .= '<li>
                          <div class="row">
                            <div class="col-2 icons">
                              <a href="#">
                                <span class="ti-user user-icon"></span>
                              </a>
                            </div>

                            <div class="col-10 content">
                              <a href="#">
                                <span class="title-anggota">'.strtoupper($row->nama).'</span>
                                <span class="mem-reg">#'.strtoupper($row->id_register).'</span>
                                <span class="waktu"><span class="ti-calendar"></span> BERGABUNG '.date("d/m/Y H:i",strtotime($row->created)).'</span>
                                <span class="text-status text-success"><span class="ti-server"></span> BONUS SPONSOR +Rp.'.format_rupiah($row->bonus_sponsor).'</span>
                              </a>
                            </div>
                          </div>
                      </li>
  				           ';
  			}
  		}
  		echo $output;
    }
  }


  function add()
  {
    $this->template->set_title("ANGGOTA");
    $data['action'] = site_url("anggota-add-action");
    $this->template->view("content/anggota/form",$data,false);
  }



  function add_action()
  {
    if ($this->input->is_ajax_request()) {
        $json = array('success'=>false, 'alert'=>array());
        $this->load->library(array("form_validation"));

        $this->form_validation->set_rules("nik","&nbsp;*","trim|xss_clean|min_length[16]|required|numeric|callback__cek_nik");
        $this->form_validation->set_rules("nama","&nbsp;*","trim|xss_clean|htmlspecialchars|required");
        $this->form_validation->set_rules("email","&nbsp;*","trim|xss_clean|htmlspecialchars|required|valid_email|callback__cek_email");
        $this->form_validation->set_rules("telepon","&nbsp;*","trim|xss_clean|required|numeric");
        $this->form_validation->set_rules("username","&nbsp;*","trim|xss_clean|required|htmlspecialchars|alpha_numeric|is_unique[tb_auth.username]",[
          "is_unique" => " * Coba Username yang lain"
        ]);
        $this->form_validation->set_rules("password","&nbsp;*","trim|xss_clean|required|min_length[5]");
        $this->form_validation->set_error_delimiters('<label class="error ml-1 text-danger" style="font-size:9px">','</label>');

        $nik                = $this->input->post("nik",true);
        $nama               = $this->input->post("nama",true);
        $email              = $this->input->post("email",true);
        $telepon            = $this->input->post("telepon",true);
        $username           = $this->input->post("username",true);
        $password           = $this->input->post("password");

        if ($this->form_validation->run()) {
          $this->db->trans_start();
          $insert_member = [  "id_register"   => $this->_kode(),
                              "nik"           => $nik,
                              "nama"          => $nama,
                              "telepon"       => $telepon,
                              "email"         => $email,
                              "is_delete"     => "0",
                              "is_verifikasi" => "0",
                              "is_active"     => "1",
                              "is_complate"   => "0",
                              "created"       => date("Y-m-d H:i:s"),
                          ];
          // insert member
          $this->model->get_insert("tb_person",$insert_member);
          $last_id_member = $this->db->insert_id();


          //tb_auth
          $this->load->helper(array("pass_has","enc_gue"));
          //
          $token = enc_uri(date("dmYhis"));

          $data_akun = [  "id_person"    =>  $last_id_member,
                          "username"     =>  $username,
                          "password"     =>  pass_encrypt($token,$password),
                          "token"        =>  $token,
                          "created"      =>  date("Y-m-d H:i:s")
                        ];
          // insert data auth
          $this->model->get_insert("tb_auth",$data_akun);

          $insert_data_bank = [ "id_person" =>  $last_id_member];
          // insert data bank
          $this->model->get_insert("trans_person_rekening",$insert_data_bank);
          //insert data sponsor
          $komisi_sponsor = (config_all("bonus-sponsor")/100)*config_all("biaya-registrasi");
          $data_sponsor = [ "id_person_sponsor"    =>  sess("id_person"),
                            "id_person"            =>  $last_id_member,
                            "biaya_registrasi"     =>  config_all("biaya-registrasi"),
                            "bonus_sponsor"        =>  $komisi_sponsor,
                            "created"              =>  date("Y-m-d H:i:s")
                          ];

          $this->model->get_insert("trans_person_sponsor",$data_sponsor);


          $data_email = array('id_register' => $insert_member['id_register'],
                              'nik' => $nik,
                              'nama' => $nama,
                              'email' => $email,
                              'telepon' => $telepon,
                              'username' => $username,
                              'password' => $password,
                              );

          $this->_send_email($data_email);


          // Validasi DB trans
          $this->db->trans_complete();
          if ($this->db->trans_status() === FALSE)
              {
                $this->db->trans_rollback();
                $json['success'] = true;
                $json['alert'] = "Gagal menambahkan, terjadi kesalahan";
              }else{
                $this->db->trans_commit();
                // $this->_send_mail($email,$username,$nama,$telepon,$kode_referral,$nik,$paket,$password);
                $json['success'] = true;
                $json['alert'] = "Add member succesfully";
              }



        }else {
          foreach ($_POST as $key => $value)
            {
              $json['alert'][$key] = form_error($key);
            }
        }

      echo json_encode($json);
    }
  }



  function _cek_nik($str)
  {
    $where =  array("nik"=>$str,"is_delete"=>  "0");
    if ($this->model->get_where("tb_person",$where)) {
      $this->form_validation->set_message('_cek_nik', '{field} sudah terdaftar.');
      return false;
    } else {
      return true;
    }
  }

  function _cek_email($str)
  {
    $where =  array("email"=>$str,"is_delete"=>  "0");
    if ($this->model->get_where("tb_person",$where)) {
      $this->form_validation->set_message('_cek_email', '{field} sudah terdaftar.');
      return false;
    } else {
      return true;
    }
  }


  function _kode()
  {
    $q = $this->db->query("SELECT MAX(RIGHT(id_register,4)) AS kd_trans FROM tb_person WHERE DATE(created)=CURDATE()");
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
        return "MEM".date('dmy').$kd;
  }




  function _send_email($data_email)
  {


      $subject  = "Data Member";

      $template = $this->load->view('content/register/template_email',$data_email,TRUE);

      $config['charset']      = 'utf-8';
      $config['protocol']     = "smtp";
      $config['mailtype']     = "html";
      $config['smtp_host']    = "ssl://ideadigitalindonesia.com";//pengaturan smtp
      $config['smtp_port']    = 465;
      $config['smtp_user']    = "ideapaper@ideadigitalindonesia.com"; // isi dengan email kamu
      $config['smtp_pass']    = "@@111111qwerty"; // isi dengan password kamu
      $config['smtp_timeout'] = 4; //4 second
      $config['crlf']         = "\r\n";
      $config['newline']      = "\r\n";

      $this->load->library('email',$config);
      //konfigurasi pengiriman

      $this->email->from($config['smtp_user'],"Idea Paper");
      $this->email->to($data_email['email']);
      $this->email->subject($subject);
      $this->email->message($template);
      if ($this->email->send()) {
        return 1;
      }else {
        return 0;
    }
  }




}
