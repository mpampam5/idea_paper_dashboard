<?php if (balance() >= config_all("biaya-registrasi")): ?>
  <style media="screen">
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

  <div class="row">
    <div class="col-12">
      <form action="<?=$action?>" id="form" autocomplete="off">
          <div class="form-group">
            <label class="label-title" id="nik">NIK</label>
            <input type="text" class="form-control" name="nik" placeholder="Masukkan NIK">
            <p class="font-form">Masukkan NIK sesuai kartu tanda penduduk (KTP)</p>
          </div>

          <div class="form-group">
            <label class="label-title" id="nama">NAMA</label>
            <input type="text" class="form-control" name="nama" placeholder="Masukkan Nama">
            <p class="font-form">Masukkan Nama sesuai kartu tanda penduduk (KTP)</p>
          </div>

          <div class="form-group">
            <label class="label-title" id="email">E-MAIL</label>
            <input type="text" class="form-control" name="email" placeholder="Masukkan Email">
            <p class="font-form">PENTING! Pastikan alamat E-mail yang anda masukkan adalah E-mail yang Aktif</p>
          </div>

          <div class="form-group">
            <label class="label-title" id="telepon">NO.TELEPON</label>
            <input type="text" class="form-control" name="telepon" placeholder="Masukkan Telepon">
            <p class="font-form">Masukkan No.telepon yang aktif</p>
          </div>

          <div class="form-group">
            <label class="label-title" id="username">USERNAME</label>
            <input type="text" class="form-control" name="username" placeholder="Masukkan Username">
          </div>

          <div class="form-group">
            <label class="label-title" id="password">PASSWORD</label>
            <input type="password" class="form-control" name="password" placeholder="Masukkan Password">
          </div>

          <div class="pt-4 text-center">
            <button type="button" data-dismiss="modal" aria-label="Close" class="btn btn-sm btn-danger text-white" name="button">CANCEL</button>
            <button type="submit" id="submit" class="btn btn-sm btn-primary" name="button">TAMBAHKAN</button>
          </div>
      </form>
    </div>
  </div>

  <script type="text/javascript">
  $("#form").submit(function(e){
  e.preventDefault();
  var me = $(this);
  $("#submit").prop('disabled',true).html('<div class="spinner-border spinner-border-sm text-white"></div> Loading...');
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
              $("#modalGue").modal("hide");
              $('.form-group').removeClass('.has-error')
                              .removeClass('.has');
              $.toast({
                text: json.alert,
                showHideTransition: 'slide',
                icon: 'success',
                loaderBg: '#f96868',
                position: 'bottom-center',
                afterHidden: function () {
                    location.href="<?=site_url('anggota')?>";
                }
              });


          }else {
            $("#submit").prop('disabled',false)
                        .html('TAMBAHKAN');
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

  <?php else: ?>
    <div class="row">
      <div class="col-lg-12 text-center">
        <p style="font-size:12px;">Biaya register member baru Rp.<?=format_rupiah(config_all("biaya-registrasi"))?>. <br>Jumlah saldo anda tidak mencukupi, Silahkan TOP UP saldo anda.<br> Sisa saldo anda Rp.<?=format_rupiah(balance())?></p>
        <button type="button" data-dismiss="modal" aria-label="Close" class="btn btn-sm btn-secondary text-white" name="button">Cancel</button>
      </div>
    </div>
<?php endif; ?>
