<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Formulir extends MY_Controller{

  public function __construct()
  {
    parent::__construct();
    $this->load->model("Formulir_model","model");
    $this->load->library("form_validation");
    $this->load->helper(array("enc_gue"));
  }

  function index()
  {
      $this->template->set_title("FORMULIR");
      $this->template->view("content/formulir/index",array());
  }

  function form($status="")
  {
    $link_uri = array('personal','rekening','account','files');
    if (in_array($status,$link_uri)) {
        $this->template->set_title("$status");
        $row = $this->model->get_detail_member();
        $query["row"] = $row;
        if ($status=="personal") {
          $query['provinsi'] = $this->db->get("wil_provinsi");
          $query['pekerjaan'] = $this->db->get("ref_pekerjaan");
        }elseif ($status=="rekening") {
          $query['bank'] = $this->db->get("ref_bank");
        }
        $query['action'] = site_url("formulir/form_act/$status");
        $data['content_view'] = $this->load->view("content/formulir/form_$status",$query,true);
        $this->template->view("content/formulir/index_form",$data);
    }
  }




  function form_act($link="")
    {
      if ($this->input->is_ajax_request()) {
        $link_uri = array('personal','rekening','account','files');
        if (in_array($link,$link_uri)) {
            $json = array('success'=>false, 'alert'=>array(),"url"=>array());
            if ($link=="personal") {
              $this->_rules_personal();
              $table = "tb_person";
              $data_update = ["nik"           =>  $this->input->post("nik",true),
                              "nama"          =>  $this->input->post("nama",true),
                              "email"         =>  $this->input->post("email",true),
                              "telepon"       =>  $this->input->post("telepon",true),
                              "jenis_kelamin" =>  $this->input->post("jenis_kelamin",true),
                              "tempat_lahir"  =>  $this->input->post("tempat_lahir",true),
                              "tanggal_lahir" =>  date("Y-m-d",strtotime($this->input->post("tanggal_lahir",true))),
                              "pekerjaan"     =>  $this->input->post("pekerjaan",true),
                              "id_provinsi"   =>  $this->input->post("provinsi",true),
                              "id_kabupaten"  =>  $this->input->post("kabupaten",true),
                              "id_kecamatan"  =>  $this->input->post("kecamatan",true),
                              "id_kelurahan"  =>  $this->input->post("kelurahan",true),
                              "alamat"        =>  $this->input->post("alamat",true)
                              ];

            $urls = site_url("front/formulir/form/rekening");



            }elseif ($link=="rekening") {
              $this->_rules_rekening();
              $table = "trans_person_rekening";
              $data_update = ["ref_bank"        =>  $this->input->post("bank",true),
                              "no_rekening"     =>  $this->input->post("no_rekening",true),
                              "nama_rekening"   =>  $this->input->post("nama_rekening",true),
                              "kota_pembukuan"  =>  $this->input->post("kota_pembukuan",true)
                              ];
            $urls = site_url("front/formulir/form/files");


            }elseif ($link=="files") {
              $this->form_validation->set_rules("foto_personal","&nbsp;*","trim|xss_clean|required");
              $this->form_validation->set_rules("foto_ktp","&nbsp;*","trim|xss_clean|required");
              $this->form_validation->set_rules("foto_kk","&nbsp;*","trim|xss_clean|required");
              $this->form_validation->set_error_delimiters('<label class="error ml-1 text-danger" style="font-size:9px">','</label>');
              $table = "tb_person";
              $data_update=["is_complate"=>"1"];
              $urls = site_url("formulir");
            }



            $where = array('id_person' => sess("id_person"));

            if ($this->form_validation->run()) {
              $this->model->get_update($table,$data_update,$where);
              $json['success'] = true;
              $json['alert'] = "Update successfully";
              $json["url"]  = $urls;
            }else {
              foreach ($_POST as $key => $value)
              {
                $json['alert'][$key] = form_error($key);
              }
            }


          echo json_encode($json);
        }
      }
    }



    function do_upload()
      {
        if ($this->input->is_ajax_request()) {
            $json = array('success' =>false , "alert"=> array(), "file_name"=>array());
            $image = "foto_".enc_uri(profile("id_register")).".".pathinfo($_FILES['foto_personal']['name'], PATHINFO_EXTENSION);
            if (!file_exists('./_template/files/'.enc_uri(profile('id_register')))) {
                mkdir('./_template/files/'.enc_uri(profile('id_register')), 0777, true);
            }
            $config['upload_path'] = "./_template/files/".enc_uri(profile('id_register'))."/";
            $config['allowed_types'] = 'jpg';
            $config['overwrite'] = true;
            $config['max_size']  = '1024';
            $config['file_name']  = "$image";


            $this->load->library('upload', $config);

            if (!$this->upload->do_upload('foto_personal')){
                $json['header_alert'] = "error";
                $json['alert'] = "File tidak valid, format file harus jpg & ukuran maksimal 1mb";
            }else {
                $where = array('id_person' => sess("id_person"));
                $this->model->get_update("tb_person",["foto"=>$image],$where);
                $json['header_alert'] = "success";
                $json['file_name'] = $image;
                $json['alert'] = "File upload successfully.";
                $json['success'] = true;
            }

            echo json_encode($json);

      }
    }


    function do_upload_ktp()
      {
        if ($this->input->is_ajax_request()) {
            $json = array('success' =>false , "alert"=> array(), "file_name"=>array());
            $image = "ktp_".enc_uri(profile('id_register')).".".pathinfo($_FILES['foto_ktp']['name'], PATHINFO_EXTENSION);
            if (!file_exists('./_template/files/'.enc_uri(profile('id_register')))) {
                mkdir('./_template/files/'.enc_uri(profile('id_register')), 0777, true);
            }
            $config['upload_path'] = "./_template/files/".enc_uri(profile('id_register'))."/";
            $config['allowed_types'] = 'jpg';
            $config['overwrite'] = true;
            $config['max_size']  = '1024';
            $config['file_name']  = "$image";


            $this->load->library('upload', $config);

            if (!$this->upload->do_upload('foto_ktp')){
                $json['header_alert'] = "error";
                $json['alert'] = "File tidak valid, format file harus jpg & ukuran maksimal 1mb";
            }else {
                $where = array('id_person' => sess("id_person"));
                $this->model->get_update("tb_person",["file_ktp"=>$image],$where);
                $json['header_alert'] = "success";
                $json['file_name'] = $image;
                $json['alert'] = "File upload successfully.";
                $json['success'] = true;
            }

            echo json_encode($json);

      }
    }


    function do_upload_kk()
      {
        if ($this->input->is_ajax_request()) {
            $json = array('success' =>false , "alert"=> array(), "file_name"=>array());
            $image = "kk_".enc_uri(profile('id_register')).".".pathinfo($_FILES['foto_kk']['name'], PATHINFO_EXTENSION);
            if (!file_exists('./_template/files/'.enc_uri(profile('id_register')))) {
                mkdir('./_template/files/'.enc_uri(profile('id_register')), 0777, true);
            }
            $config['upload_path'] = "./_template/files/".enc_uri(profile('id_register'))."/";
            $config['allowed_types'] = 'jpg';
            $config['overwrite'] = true;
            $config['max_size']  = '1024';
            $config['file_name']  = "$image";


            $this->load->library('upload', $config);

            if (!$this->upload->do_upload('foto_kk')){
                $json['header_alert'] = "error";
                $json['alert'] = "File tidak valid, format file harus jpg & ukuran maksimal 1mb";
            }else {
                $where = array('id_person' => sess("id_person"));
                $this->model->get_update("tb_person",["file_kk"=>$image],$where);
                $json['header_alert'] = "success";
                $json['file_name'] = $image;
                $json['alert'] = "File upload successfully.";
                $json['success'] = true;
            }

            echo json_encode($json);

      }
    }






  function _rules_personal()
    {
        $this->form_validation->set_rules("nik","&nbsp;*","trim|xss_clean|required|min_length[16]|max_length[16]|numeric|callback__cek_nik[".$this->input->post("nik_lama",true)."]");
        $this->form_validation->set_rules("nama","&nbsp;*","trim|xss_clean|htmlspecialchars|required");
        $this->form_validation->set_rules("email","&nbsp;*","trim|xss_clean|required|htmlspecialchars|valid_email|callback__cek_email[".$this->input->post("email_lama",true)."]");
        $this->form_validation->set_rules("telepon","&nbsp;*","trim|xss_clean|required|numeric");
        $this->form_validation->set_rules("tempat_lahir","&nbsp;*","trim|xss_clean|htmlspecialchars|required");
        $this->form_validation->set_rules("tgl","&nbsp;* Tanggal","trim|xss_clean|required");
        $this->form_validation->set_rules("bln","&nbsp;* Bulan","trim|xss_clean|required");
        $this->form_validation->set_rules("thn","&nbsp;* Tahun","trim|xss_clean|required");
        $this->form_validation->set_rules("jenis_kelamin","&nbsp;*","trim|xss_clean|htmlspecialchars|required");
        $this->form_validation->set_rules("pekerjaan","&nbsp;*","trim|xss_clean|required");
        $this->form_validation->set_rules("provinsi","&nbsp;*","trim|xss_clean|required");
        $this->form_validation->set_rules("kabupaten","&nbsp;*","trim|xss_clean|required");
        $this->form_validation->set_rules("kecamatan","&nbsp;*","trim|xss_clean|required");
        $this->form_validation->set_rules("kelurahan","&nbsp;*","trim|xss_clean|required");
        $this->form_validation->set_rules("alamat","&nbsp;*","trim|xss_clean|htmlspecialchars|required");
        $this->form_validation->set_error_delimiters('<label class="error ml-1 text-danger" style="font-size:9px">','</label>');
    }

    function _rules_rekening()
    {
      $this->form_validation->set_rules("bank","&nbsp;*","trim|xss_clean|required|numeric");
      $this->form_validation->set_rules("no_rekening","&nbsp;*","trim|xss_clean|required|numeric");
      $this->form_validation->set_rules("nama_rekening","&nbsp;*","trim|xss_clean|htmlspecialchars|required");
      $this->form_validation->set_rules("kota_pembukuan","&nbsp;*","trim|xss_clean|htmlspecialchars|required");
      $this->form_validation->set_error_delimiters('<label class="error ml-1 text-danger" style="font-size:9px">','</label>');
    }



    function _cek_nik($str,$nik_lama)
  {
    $row =  $this->db->get_where("tb_person",["nik !="=>$nik_lama,"nik"=>$str,"is_delete"=>"0"]);
    if ($row->num_rows() > 0) {
      $this->form_validation->set_message('_cek_nik', '* Sudah terpakai member lain');
      return false;
    }else {
      return true;
    }
  }

  function _cek_email($str,$email_lama)
    {
      $row =  $this->db->get_where("tb_person",["email !="=>$email_lama,"email"=>$str,"is_delete"=>"0"]);
      if ($row->num_rows() > 0) {
        $this->form_validation->set_message('_cek_email', '* Sudah terpakai member lain');
        return false;
      }else {
        return true;
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


}
