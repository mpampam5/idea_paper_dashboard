<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Register extends CI_Controller{


  public function __construct()
  {
    parent::__construct();
    $this->load->model("register_model","model");
    $this->load->helper(array("captcha"));
  }

  function _rules()
  {
    $this->form_validation->set_rules("nik","&nbsp;*","trim|xss_clean|min_length[16]|required|numeric|callback__cek_nik");

    $this->form_validation->set_rules("nama","&nbsp;*","trim|xss_clean|htmlspecialchars|required");
    $this->form_validation->set_rules("email","&nbsp;*","trim|xss_clean|htmlspecialchars|required|valid_email|callback__cek_email");
    $this->form_validation->set_rules("telepon","&nbsp;*","trim|xss_clean|required|numeric");
    $this->form_validation->set_rules("username","&nbsp;*","trim|xss_clean|required|htmlspecialchars|alpha_numeric|is_unique[tb_auth.username]",[
      "is_unique" => "Coba Username yang lain"
    ]);
    $this->form_validation->set_rules("password","&nbsp;*","trim|xss_clean|required|min_length[5]");
    $this->form_validation->set_rules("v_password","&nbsp;*","trim|xss_clean|required|matches[password]");

    $this->form_validation->set_rules("captcha","Captcha","trim|xss_clean|required");
    $this->form_validation->set_error_delimiters('<label class="error  ml-1 text-danger" style="font-size:9px">','</label>');
  }


function index()
{
  $data["action"]  = site_url("signup/action");
  $data['capt_image'] = $this->create_captcha();
  $data["provinsi"] = $this->model->get_provinsi()->result();
  $data["bank"]   = $this->model->get_bank()->result();
  $data["pekerjaan"]   = $this->model->get_pekerjaan()->result();
  $this->load->view("content/register/index",$data);
}

function create_captcha()
{
  $vals = array(
        'img_path'      => './_template//captcha/',
        'img_url'       => base_url("_template/captcha/"),
        'img_width'     => '200',
        'img_height'    => 50,
        'expiration'    => 7200,
        'word_length'   => 5,
        'font_size'     => 16,

        // White background and border, black text and red grid
        'colors'        => array(
                'background' => array(32, 32, 32),
                'border' => array(255, 255, 255),
                'text' => array(255, 161, 0),
                'grid' => array(0, 133, 255)
        )
);

$capt = create_captcha($vals);
$image = $capt["image"];
$this->session->unset_userdata('captcha_word');
$this->session->set_userdata("captcha_word",$capt["word"]);
return $image;
}


function refresh_captcha()
{
  $vals = array(
        'img_path'      => './_template//captcha/',
        'img_url'       => base_url("_template/captcha/"),
        'img_width'     => '200',
        'img_height'    => 50,
        'expiration'    => 7200,
        'word_length'   => 5,
        'font_size'     => 16,

        // White background and border, black text and red grid
        'colors'        => array(
                'background' => array(32, 32, 32),
                'border' => array(255, 255, 255),
                'text' => array(255, 161, 0),
                'grid' => array(0, 133, 255)
        )
);

  $capt = create_captcha($vals);
  $image = $capt["image"];
  $this->session->unset_userdata('captcha_word');
  $this->session->set_userdata("captcha_word",$capt["word"]);
  echo $image;
}



function action()
  {
    if ($this->input->is_ajax_request()) {
        $json = array('success'=>false, 'alert'=>array(),'captcha_status'=>false,'alert_captcha'=>array());
        $this->load->library(array("form_validation"));

        $nik                = $this->input->post("nik",true);
        $nama               = $this->input->post("nama",true);
        $email              = $this->input->post("email",true);
        $telepon            = $this->input->post("telepon",true);
        $username           = strtolower($this->input->post("username",true));
        $password           = $this->input->post("v_password",true);
        //
        //
        // $this->form_validation->set_rules("nik","Nik/No.KTP","trim|xss_clean|required|min_length[16]|max_length[16]|numeric|callback__cek_nik[".$tgl_lahir."]|is_unique[tb_member.nik]",[
        //   "is_unique" => "Nik/No.KTP sudah terdaftar"
        // ]);

        $this->_rules();
        if ($this->form_validation->run()) {

          $json['success'] = true;
          if ($this->input->post("captcha",true) == $this->session->userdata("captcha_word")) {
            $insert_member = [  "id_register" => $this->_kode(),
                                "nik"           => $nik,
                                "nama"          => $nama,
                                "telepon"       => $telepon,
                                "email"         => $email,
                                "is_delete" => "0",
                                "is_verifikasi" => "0",
                                "is_complate" => "0",
                                "created"       => date("Y-m-d H:i:s"),
                            ];
          // insert member
          $this->model->get_insert("tb_person",$insert_member);
          //
          $last_id_member = $this->db->insert_id();
          //
          $insert_data_bank = [ "id_person" =>  $last_id_member];
          // insert data bank
          $this->model->get_insert("trans_person_rekening",$insert_data_bank);
          //
          $this->load->helper(array("pass_has","enc_gue"));
          //
          $token = enc_uri(date("dmYhis"));

          $data_akun = [  "id_person"  =>  $last_id_member,
                          "username"     =>  $username,
                          "password"     =>  pass_encrypt($token,$password),
                          "token"        =>  $token,
                          "created"      =>  date("Y-m-d H:i:s")
                        ];
          // insert data auth
          $this->model->get_insert("tb_auth",$data_akun);


            $data_email = array('id_register' => $insert_member['id_register'],
                                'nik' => $nik,
                                'nama' => $nama,
                                'email' => $email,
                                'telepon' => $telepon,
                                'username' => $username,
                                'password' => $password,
                                );

            // $this->_send_email($data_email);
            // matikan fungsi send mail
            $json['captcha_status'] = true;
            $json['alert'] = "pendaftaran sukses";
          }else {
            $json['alert_captcha'] = '<label class="error mt-1 text-danger" style="font-size:12px"> Kode Captcha tidak valid</label>';
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

  function kabupaten(){
        $propinsiID = $_GET['id'];
        $kabupaten   = $this->db->get_where('wil_kabupaten',array('province_id'=>$propinsiID));
        echo '<option value="">-- Pilih Kabupaten/Kota --</option>';
        foreach ($kabupaten->result() as $k)
        {
            echo "<option value='$k->id'>$k->name</option>";
        }
    }


    function kecamatan(){
       $kabupatenID = $_GET['id'];
       $kecamatan   = $this->db->get_where('wil_kecamatan',array('regency_id'=>$kabupatenID));
       echo '<option value="">-- Pilih Kecamatan --</option>';
       foreach ($kecamatan->result() as $k)
       {
           echo "<option value='$k->id'>$k->name</option>";
       }
   }

   function kelurahan(){
        $kecamatanID  = $_GET['id'];
        $desa         = $this->db->get_where('wil_kelurahan',array('district_id'=>$kecamatanID));
        echo '<option value="">-- Pilih Kelurahan/Desa --</option>';
        foreach ($desa->result() as $d)
        {
            echo "<option value='$d->id'>$d->name</option>";
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
    $config['smtp_user']    = "no-reply@ideadigitalindonesia.com"; // isi dengan email kamu
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


function cek_temp()
{

  $data_email = array('id_register' => "MEM09348920",
                      'nik' => "1234567890342432",
                      'nama' => "muhammad irfan ibnu",
                      'email' => "irmhaa381@gmail.com",
                      'telepon' => "0432423423",
                      'username' => "mpampam8888",
                      'password' => "2wsx.lo9",
                      );
  // $this->load->view('content/register/template_emails',$data_email);
  $this->_send_email($data_email);
}


}
