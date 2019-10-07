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

      .font-form{
        margin-top: 3px;
        font-size: 9px;
        display: block;
        line-height: 10px;
      }

      .form-group {
        margin-bottom: 0.5rem;
      }

      .form-group label.label-title {
        font-size: 0.775rem;
        line-height: 1.4rem;
        vertical-align: top;
        margin-bottom: 1px;
        font-weight: 600;
    }


    .form-group label.error {
      margin-bottom: 1px;
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
                  <label class="label-title" id="nik">NIK</label>
                  <input type="text" class="form-control form-control-sm" name="nik" placeholder="NIK (No. Identitas Kependudukan)">
                  <p class="font-form">Masukkan NIK sesuai kartu tanda penduduk (KTP)</p>
                </div>

                <div class="form-group">
                  <label class="label-title" id="nama">Nama Lengkap</label>
                  <input type="text" class="form-control form-control-sm" name="nama" placeholder="Nama Lengkap">
                  <p class="font-form">Masukkan Nama sesuai kartu tanda penduduk (KTP)</p>
                </div>

                <div class="form-group">
                  <label class="label-title" id="email">Email</label>
                  <input type="text" class="form-control form-control-sm" name="email" placeholder="Email">
                  <p class="font-form">PENTING! Pastikan alamat E-mail yang anda masukkan adalah E-mail yang Aktif</p>
                </div>

                <div class="form-group">
                  <label class="label-title" id="telepon">Telepon</label>
                  <input type="text" class="form-control form-control-sm" name="telepon" placeholder="Telepon">
                  <p class="font-form">PENTING! Pastikan Telepon yang anda masukkan adalah Nomor yang Aktif</p>
                </div>



                <br><br>

                <div class="form-group">
                  <label class="label-title" id="username">Username</label>
                  <input type="text" class="form-control-sm form-control" name="username" placeholder="Username">
                </div>


                <div class="form-group">
                  <label class="label-title"  id="password">Password</label>
                  <input type="password" class="form-control form-control-sm" name="password" placeholder="Password">
                </div>

                <div class="form-group">
                  <label class="label-title" id="v_password">Konfirmasi Password</label>
                  <input type="password" class="form-control-sm form-control" name="v_password" placeholder="Konfirmasi Password">
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

  </script>
</body>
</html>
