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
    $this->form_validation->set_rules("nik","NIK","trim|xss_clean|required|numeric|is_unique[tb_person.nik]",[
      "is_unique" => "NIK sudah terdaftar"
    ]);

    $this->form_validation->set_rules("nama","Nama","trim|xss_clean|htmlspecialchars|required");
    $this->form_validation->set_rules("email","Email","trim|xss_clean|htmlspecialchars|required|valid_email");
    $this->form_validation->set_rules("telepon","Telepon","trim|xss_clean|required|numeric");

    $this->form_validation->set_rules("tempat_lahir","Tempat Lahir","trim|htmlspecialchars|xss_clean|required");
    $this->form_validation->set_rules("tgl_lahir","Tanggal Lahir","trim|htmlspecialchars|xss_clean|required");
    $this->form_validation->set_rules("jk","Jenis Kelamin","trim|xss_clean|htmlspecialchars|required");
    $this->form_validation->set_rules("provinsi","Provinsi","trim|xss_clean|htmlspecialchars|required");
    $this->form_validation->set_rules("kabupaten","Kabupaten/Kota","trim|xss_clean|htmlspecialchars|required");
    $this->form_validation->set_rules("kecamatan","Kecamatan","trim|xss_clean|htmlspecialchars|required");
    $this->form_validation->set_rules("kelurahan","Kelurahan/Desa","trim|xss_clean|htmlspecialchars|required");
    $this->form_validation->set_rules("alamat","Alamat Lengkap","trim|xss_clean|htmlspecialchars|required");
    $this->form_validation->set_rules("bank","Jenis Bank","trim|xss_clean|required");
    $this->form_validation->set_rules("no_rek","NO.rekening","trim|xss_clean|required|numeric");
    $this->form_validation->set_rules("nama_rekening","Nama Rekening","trim|xss_clean|htmlspecialchars|required");
    $this->form_validation->set_rules("kota_pembukaan_rek","Kota/Kabupaten Pembukaan Rekening","trim|xss_clean|htmlspecialchars|required");
    $this->form_validation->set_rules("username","Username","trim|xss_clean|required|htmlspecialchars|alpha_dash|is_unique[tb_auth.username]",[
      "is_unique" => "Coba Username yang lain"
    ]);
    $this->form_validation->set_rules("password","Password","trim|xss_clean|required|min_length[5]");
    $this->form_validation->set_rules("v_password","Konfirmasi Password","trim|xss_clean|required|matches[password]");

    $this->form_validation->set_rules("captcha","Captcha","trim|xss_clean|required|callback__cek_captcha");
    $this->form_validation->set_error_delimiters('<label class="error mt-1 text-danger" style="font-size:12px">','</label>');
  }


function index()
{
  $data["action"]  = site_url("signup/action");
  $data['capt_image'] = $this->create_captcha();
  $data["provinsi"] = $this->model->get_provinsi()->result();
  $data["bank"]   = $this->model->get_bank()->result();
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
        $json = array('success'=>false, 'alert'=>array());
        $this->load->library(array("form_validation"));

        // $kode_referral      = $this->input->post("kode_referal",true);
        // $nik                = $this->input->post("nik",true);
        // $nama               = $this->input->post("nama",true);
        // $email              = $this->input->post("email",true);
        // $telepon            = $this->input->post("telepon",true);
        // $tempat_lahir       = $this->input->post("tempat_lahir",true);
        // $tgl_lahir          = $this->input->post("tgl_lahir",true);
        // $jk                 = $this->input->post("jk",true);
        // $provinsi           = $this->input->post("provinsi",true);
        // $kabupaten          = $this->input->post("kabupaten",true);
        // $kecamatan          = $this->input->post("kecamatan",true);
        // $kelurahan          = $this->input->post("kelurahan",true);
        // $alamat             = $this->input->post("alamat",true);
        // $paket              = $this->input->post("paket",true);
        // $bank               = $this->input->post("bank",true);
        // $no_rek             = $this->input->post("no_rek",true);
        // $nama_rekening      = $this->input->post("nama_rekening",true);
        // $kota_pembukaan_rek = $this->input->post("kota_pembukaan_rek",true);
        // $username           = strtolower($this->input->post("username",true));
        // $password           = $this->input->post("password",true);
        //
        //
        // $this->form_validation->set_rules("nik","Nik/No.KTP","trim|xss_clean|required|min_length[16]|max_length[16]|numeric|callback__cek_nik[".$tgl_lahir."]|is_unique[tb_member.nik]",[
        //   "is_unique" => "Nik/No.KTP sudah terdaftar"
        // ]);

        $this->_rules();
        if ($this->form_validation->run()) {

          //
          //   $insert_member = [  "kode_referral" => "ref_$username",
          //                       "referral_from" => $kode_referral ,
          //                       "kode_register" => "MEM".date('dmYhis'),
          //                       "nik"           => $nik,
          //                       "nama"          => $nama,
          //                       "telepon"       => $telepon,
          //                       "email"         => $email,
          //                       "jk"            => $jk,
          //                       "tempat_lahir"  => $tempat_lahir,
          //                       "tgl_lahir"     => date("Y-m-d",strtotime($tgl_lahir)),
          //                       "provinsi"      => $provinsi,
          //                       "kabupaten"     => $kabupaten,
          //                       "kecamatan"     => $kecamatan,
          //                       "kelurahan"     => $kelurahan,
          //                       "alamat"        => $alamat,
          //                       "paket"         => $paket,
          //                       "is_verifikasi" => "0",
          //                       "created"       => date("Y-m-d h:i:s"),
          //                   ];
          // // insert member
          // $this->model->get_insert("tb_member",$insert_member);
          //
          // $last_id_member = $this->db->insert_id();
          //
          // $insert_data_bank = [ "id_member"                =>  $last_id_member,
          //                       "id_bank"                  =>  $bank,
          //                       "no_rekening"              =>  $no_rek,
          //                       "nama_rekening"            =>  $nama_rekening,
          //                       "kota_pembukaan_rekening"  =>  $kota_pembukaan_rek
          //                     ];
          // // insert data bank
          // $this->model->get_insert("trans_member_rek",$insert_data_bank);
          //
          // $this->load->helper("pass_hash");
          //
          // $data_akun = [  "id_personal"  =>  $last_id_member,
          //                 "username"     =>  $username,
          //                 "password"     =>  pass_encrypt(date("dmYhis"),$password),
          //                 "token"        =>  date("dmYhis"),
          //                 "level"        =>  "member",
          //                 "created"      =>  date("Y-m-d h:i:s")
          //               ];
          // // insert data auth
          // $this->model->get_insert("tb_auth",$data_akun);

          $json['alert'] = "Berhasil melakukan registrasi. Selanjutnya menunggu tahap verifikasi dari mitra anda";
          $json['success'] = true;
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


    function _cek_captcha($str)
    {
      if ($str == $this->session->userdata("captcha_word")) {
      return true;
    }else {
      $this->form_validation->set_message('_cek_captcha', 'Captcha key tidak valid');
      return false;
    }
    }


}
