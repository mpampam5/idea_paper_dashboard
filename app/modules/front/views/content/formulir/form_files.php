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
    <li class="breadcrumb-item"><a href="#">Data Personal</a></li>
    <li class="breadcrumb-item"><a href="#">Data Rekening</a></li>
    <li class="breadcrumb-item"><a href="#">Data File</a></li>
  </ol>
</nav>

<p class="text-center" style="font-size:12px;">Silahkan lengkapi data anda.</p>

<div class="p-3">
  <form  action="<?=$action?>" id="form" enctype="multipart/form-data">
    <div class="row">

      <div class="col-sm-12">
        <div class="form-group">
          <label class="label-title" id="foto_personal">FOTO PERSONAL</label>
          <input type="file" name="foto_personal" class="file-upload-default" accept="image/JPEG">
          <div class="input-group col-xs-12">
            <input type="text" name="foto_personal" class="form-control file-upload-info" readonly placeholder="Upload Image">
            <span class="input-group-append">
              <button class="file-upload-browse btn btn-primary" type="button">Browse</button>
            </span>
          </div>
          <p class="font-form">Foto Wajah harus jelas (Format jpg)</p>
        </div>
      </div>

      <div class="col-sm-12">
        <div class="form-group">
          <label class="label-title" id="file_ktp">FILE KTP</label>
          <input type="file" name="file_ktp" class="file-upload-default" accept="image/JPEG">
          <div class="input-group col-xs-12">
            <input type="text" name="file_ktp" class="form-control file-upload-info" readonly placeholder="Upload Image">
            <span class="input-group-append">
              <button class="file-upload-browse btn btn-primary" type="button">Browse</button>
            </span>
          </div>
          <p class="font-form">Foto KTP harus jelas (Format jpg)</p>
        </div>
      </div>

      <div class="col-sm-12">
        <div class="form-group">
          <label class="label-title"  id="file_kk">FILE KK</label>
          <input type="file" name="file_kk" class="file-upload-default" accept="image/JPEG">
          <div class="input-group col-xs-12">
            <input type="text" name="file_kk" class="form-control file-upload-info" readonly placeholder="Upload Image">
            <span class="input-group-append">
              <button class="file-upload-browse btn btn-primary" type="button">Browse</button>
            </span>
          </div>
          <p class="font-form">Foto KK harus jelas (Format jpg)</p>
        </div>
      </div>


  <div class="mt-5">
      <a href="<?=site_url("dashboard")?>" class="btn btn-sm btn-secondary text-white"><i class="ti-home"></i></a>
      <button type="submit" id="submit" class="btn btn-sm btn-primary" name="button"><i class="ti-check-box"></i> Simpan & Lanjutkan</button>
  </div>

    </div>

  </form>
</div>


<script type="text/javascript">
(function($) {
  'use strict';
  $(function() {
    $('.file-upload-browse').on('click', function() {
      var file = $(this).parent().parent().parent().find('.file-upload-default');
      file.trigger('click');
    });
    $('.file-upload-default').on('change', function() {
      $(this).parent().find('.form-control').val($(this).val().replace(/C:\\fakepath\\/i, ''));
    });
  });
})(jQuery);


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
