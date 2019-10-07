<style media="screen">
.form-group label.label-title {
  font-size: 0.875rem;
  line-height: 1.4rem;
  vertical-align: top;
  margin-bottom: 1px;
  font-weight: 600;
}


.form-group label.error {
  margin-bottom: 0;
}

.font-form{
  margin-top: 3px;
  font-size: 9px;
  display: block;
  line-height: 10px;
}

</style>


<nav aria-label="breadcrumb">
  <ol class="breadcrumb breadcrumb-custom bg-inverse-idea">
    <li class="breadcrumb-item"><a href="#">Personal</a></li>
    <li class="breadcrumb-item"><a href="#">Rekening</a></li>
    <li class="breadcrumb-item"><a href="#">Account</a></li>
  </ol>
</nav>

<p class="text-center" style="font-size:12px;">Silahkan lengkapi data anda.</p>

<div class="p-3">
  <form class="" action="<?=$action?>" id="form">
  <div class="row">
  <div class="col-sm-6">
    <div class="form-group">
      <label class="label-title"  id="username">Username</label>
      <input type="text" class="form-control" readonly value="<?=$row->username?>">
    </div>
  </div>


  <div class="col-sm-6">
    <div class="form-group">
      <label class="label-title" id="password">Password</label>
      <input type="password" class="form-control"  name="password" placeholder="*****">
      <p class="font-form">Silahkan Kosongkan jika tak ingin mengubah password</p>
    </div>
  </div>


  <div class="col-sm-6">
    <div class="form-group">
      <label class="label-title" id="v_password">Konfirmasi password</label>
      <input type="password" class="form-control"  name="v_password" placeholder="*****">
    </div>
  </div>


</div>




  <a href="<?=site_url("dashboard")?>" class="btn btn-sm btn-secondary text-white"><i class="ti-home"></i></a>
  <button type="submit" id="submit" class="btn btn-sm btn-primary" name="button"><i class="ti-check-box"></i> Simpan & Lanjutkan</button>

  </form>
</div>


<script type="text/javascript">




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
              $("#modalGue").modal('hide');
              $('.form-group').removeClass('.has-error')
                              .removeClass('.has');
              $.toast({
                text: json.alert,
                showHideTransition: 'slide',
                icon: 'success',
                loaderBg: '#f96868',
                position: 'bottom-right',
                afterHidden: function () {
                    window.location.href=json.url;
                }
              });


          }else {
            $("#submit").prop('disabled',false)
                        .html('<i class="ti-check-box"></i> Simpan & Lanjutkan');
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
