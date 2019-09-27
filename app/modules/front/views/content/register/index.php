<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>DAFTAR</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="<?=base_url()?>_template/front/vendors/ti-icons/css/themify-icons.css">
  <link rel="stylesheet" href="<?=base_url()?>_template/front/vendors/css/vendor.bundle.base.css">
  <!-- endinject -->
  <!-- Plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="<?=base_url()?>_template/front/css/vertical-layout-light/style.css">
  <link rel="stylesheet" href="<?=base_url()?>_template/front/css/vertical-layout-light/custom.css">
  <link rel="stylesheet" href="<?=base_url()?>_template/front/vendors/bootstrap-datepicker/bootstrap-datepicker.min.css">
  <!-- endinject -->
  <link rel="shortcut icon" href="<?=base_url()?>_template/front/images/favicon.png" />

  <style media="screen">
    .page-body-wrapper.full-page-wrapper{
      min-height:100%!important;
    }

    .capt img{
      width: 100%!important;
      height: 50px;
      margin-bottom: 10px;
    }

    .capt table tr td{
      padding-right: 8px;
    }
  </style>
</head>

<body>
  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="content-wrapper d-flex align-items-center auth px-0">
        <div class="row w-100 mx-0">
          <div class="col-lg-4 mx-auto">
            <div class="auth-form-light text-left px-2 px-sm-5">
              <h4 class="mt-4 mb-2 text-center">DAFTAR</h4>

              <div id="alert"></div>
              <!-- <h6 class="font-weight-light">Signing up is easy. It only takes a few steps</h6> -->
              <form class="pt-3" action="<?=$action?>" id="form" autocomplete="on">


                <div class="form-group">
                  <input type="text" class="form-control form-control-sm" id="nik" name="nik" placeholder="NIK (No. Identitas Kependudukan)">
                </div>

                <div class="form-group">
                  <input type="text" class="form-control form-control-sm" id="nama" name="nama" placeholder="Nama Lengkap">
                </div>

                <div class="form-group">
                  <input type="text" class="form-control form-control-sm" id="email" name="email" placeholder="Email">
                </div>

                <div class="form-group">
                  <input type="text" class="form-control form-control-sm" id="telepon" name="telepon" placeholder="Telepon">
                </div>

                <div class="form-group">
                  <input type="text" class="form-control-sm form-control" id="tempat_lahir" name="tempat_lahir" placeholder="Tempat Lahir">
                </div>

                <div class="form-group">
                  <input type="text" class="form-control-sm form-control" data-provide="datepicker" id="tgl_lahir" name="tgl_lahir" placeholder="Tanggal Lahir">
                </div>

                <div class="form-group">
                  <select class="form-control-sm form-control" name="pekerjaan" id="pekerjaan">
                    <option value="">-- Pilih Pekerjaan --</option>
                    <?php foreach ($pekerjaan as $kerja): ?>
                      <option value="<?=$kerja->pekerjaan?>"><?=$kerja->pekerjaan?></option>
                    <?php endforeach; ?>
                  </select>
                </div>

                <div class="form-group">
                  <select class="form-control-sm form-control" name="jk" id="jk">
                    <option value="">-- Pilih Jenis Kelamin--</option>
                    <option value="pria">Pria</option>
                    <option value="wanita">Wanita</option>
                  </select>
                </div>


                    <div class="form-group">
                      <select class="form-control-sm form-control" name="provinsi" id="provinsi" onchange="loadKabupaten()">
                        <option value="">-- Pilih Provinsi --</option>
                        <?php foreach ($provinsi as $prov): ?>
                          <option value="<?=$prov->id?>"><?=$prov->name?></option>
                        <?php endforeach; ?>

                      </select>
                    </div>



                    <div class="form-group">
                      <select class="form-control-sm form-control" name="kabupaten" id="kabupaten" onChange='loadKecamatan()'>
                        <option value="">-- Pilih Kabupaten/Kota --</option>
                      </select>
                    </div>



                    <div class="form-group">
                      <select class="form-control-sm form-control" name="kecamatan" id="kecamatan" onChange='loadKelurahan()'>
                        <option value="">-- Pilih Kecamatan--</option>
                      </select>
                    </div>


                    <div class="form-group">
                      <select class="form-control-sm form-control" name="kelurahan" id="kelurahan">
                        <option value="">-- Pilih Kelurahan/Desa--</option>
                      </select>
                    </div>

                    <div class="form-group">
                      <textarea name="alamat" id="alamat" rows="2" class="form-control-sm form-control" placeholder="Alamat Lengkap"></textarea>
                    </div>

                    <br><br>

                    <div class="form-group">
                      <select  class="form-control-sm form-control" id="bank" name="bank">
                        <option value="">-- pilih BANK --</option>
                        <?php foreach ($bank as $bk): ?>
                          <option value="<?=$bk->id_bank?>"><?=$bk->inisial_bank?></option>
                        <?php endforeach; ?>
                      </select>
                    </div>

                    <div class="form-group">
                      <input type="text" class="form-control-sm form-control" id="no_rek" name="no_rek" placeholder="No. Rekening">
                    </div>

                    <div class="form-group">
                      <input type="text" class="form-control-sm form-control" id="nama_rekening" name="nama_rekening" placeholder="Nama Rekening">
                    </div>

                    <div class="form-group">
                      <input type="text" class="form-control-sm form-control" id="kota_pembukaan_rek" name="kota_pembukaan_rek" placeholder="Kota/Kabupaten pembukaan Rekening">
                    </div>


                    <br><br>

                <div class="form-group">
                  <input type="text" class="form-control-sm form-control" id="username" name="username" placeholder="Username">
                </div>


                <div class="form-group">
                  <input type="password" class="form-control form-control-sm" id="password" name="password" placeholder="Password">
                </div>

                <div class="form-group">
                  <input type="password" class="form-control-sm form-control" id="v_password" name="v_password" placeholder="Konfirmasi Password">
                </div>


                  <div class="capt">
                    <table>
                      <tr>
                        <td style="width: 90%">
                          <div id="captImg">
                            <?php echo $capt_image;?>
                          </div>
                        </td>
                        <td style="width: 10%">
                          <a  class="text-primary refreshCaptcha" ><i class="ti-reload" style="font-size:30px;"></i></a>
                        </td>
                      </tr>
                    </table>
                  </div>

                  <div class="form-group">
                    <input type="text" class="form-control-sm form-control" id="captcha" name="captcha" placeholder="Captcha Key">
                  </div>


                <div class="mt-3">
                  <button type="submit" id="submit" name="button" class="btn btn-block btn-primary btn-lg auth-form-btn">DAFTAR</button>
                </div>
                <div class="text-center mt-4 font-weight-light">
                  Already have an account? <a href="<?=site_url("mem-panel")?>" class="text-primary">Login</a>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
  <!-- plugins:js -->
  <script src="<?=base_url()?>_template/front/vendors/js/vendor.bundle.base.js"></script>
  <script src="<?=base_url()?>_template/front/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>

  <!-- endinject -->
  <!-- Plugin js for this page -->
  <!-- End plugin js for this page -->
  <!-- inject:js -->
  <script src="<?=base_url()?>_template/front/js/off-canvas.js"></script>
  <script src="<?=base_url()?>_template/front/js/hoverable-collapse.js"></script>
  <script src="<?=base_url()?>_template/front/js/template.js"></script>
  <script src="<?=base_url()?>_template/front/js/settings.js"></script>
  <script src="<?=base_url()?>_template/front/js/todolist.js"></script>
  <!-- endinject -->


  <script>
  $(document).ready(function(){
      $('#tgl_lahir').datepicker({
        format: 'dd/mm/yyyy',
        autoclose: true
      });

      $('.refreshCaptcha').on('click', function(e){
        e.preventDefault()
        $("#captcha").val("");
        $.get('<?php echo base_url().'signup-captcha'; ?>', function(data){
            $('#captImg').hide().fadeIn(600).html(data);
        });
    });
  });


  $("#form").submit(function(e){
  e.preventDefault();
  var me = $(this);
  $("#submit").prop('disabled',true).html('<div class="spinner-border spinner-border-sm text-white"></div> Memproses...');
  $.ajax({
        url             : me.attr('action'),
        type            : 'post',
        data            :  new FormData(this),
        contentType     : false,
        cache           : false,
        dataType        : 'JSON',
        processData     :false,
        success:function(json){
          if (json.success==true) {
            if (json.captcha_status==true) {
              $("#form")[0].reset();
              $("#form").find('.text-danger').remove();
              $("html, body").animate({ scrollTop: 0 }, "slow");
              $("#submit").prop('disabled',false)
                          .html('Daftar');
              $('#alert').hide().fadeIn(1000).html(`<div class="row alert-show text-center">
                                                      <div class="col-sm-12">
                                                      <div class="alert alert-success" role="alert">
                                                        `+json.alert+`
                                                      </div>
                                                      </div>
                                                    </div>`);
              $('.form-group').removeClass('.has-error')
                              .removeClass('.has-success');
                $('.alert-show').delay(5000).show(10, function(){
                  $('.alert-show').fadeOut(10000, function(){
                    $('.alert-show').remove();
                    $.get('<?php echo base_url().'signup-captcha'; ?>', function(data){
                        $('#captImg').hide().fadeIn(600).html(data);
                    });
                  });
                })
            }else {
              $.get('<?php echo base_url().'signup-captcha'; ?>', function(data){
                  $('#captImg').hide().fadeIn(600).html(data);
              });
              $("#captcha").val("");
              $("#captcha")
              .closest('.form-group')
              .find('.text-danger').remove();
              $("#captcha").after(json.alert_captcha);
              $("#submit").prop('disabled',false)
                          .html('Daftar');
            }

          }else {
            $("#submit").prop('disabled',false)
                        .html('Daftar');
            $.each(json.alert, function(key, value) {
                var element = $('#' + key);
                $(element)
                .closest('.form-group')
                .find('.text-danger').remove();
                $(element).after(value);
            });
          }
        }
  });
});

  function loadKabupaten()
        {
            var provinsi = $("#provinsi").val();
            if (provinsi!="") {
              $.ajax({
                  type:'GET',
                  url:"<?php echo base_url(); ?>member-register/jsonkabupaten",
                  data:"id=" + provinsi,
                  success: function(html)
                  {
                     $("#kabupaten").html(html);
                  }
              });
            }else {
              $("#kabupaten").html('<option value="">-- Pilih Kabupaten/Kota --</option>');
              $("#kecamatan").html('<option value="">-- Pilih Kecamatan --</option>');
              $("#kelurahan").html('<option value="">-- Pilih Kelurahan/desa --</option>');
            }
        }

        function loadKecamatan()
          {
              var kabupaten = $("#kabupaten").val();
              if (kabupaten!="") {
                $.ajax({
                    type:'GET',
                    url:"<?php echo base_url(); ?>member-register/jsonkecamatan",
                    data:"id=" + kabupaten,
                    success: function(html)
                    {
                        $("#kecamatan").html(html);
                    }
                });
              }else {
                $("#kecamatan").html('<option value="">-- Pilih Kecamatan --</option>');
                $("#kelurahan").html('<option value="">-- Pilih Kelurahan/desa --</option>');
              }

          }

          function loadKelurahan()
          {
              var kecamatan = $("#kecamatan").val();
              if (kecamatan!="") {
                $.ajax({
                    type:'GET',
                    url:"<?php echo base_url(); ?>member-register/jsonkelurahan",
                    data:"id=" + kecamatan,
                    success: function(html)
                    {
                        $("#kelurahan").html(html);
                    }
                });
              }else {
                $("#kelurahan").html('<option value="">-- Pilih Kelurahan/Desa --</option>');
              }
          }
  </script>
</body>
</html>
