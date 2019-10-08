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
    <div class="row">
  <form class="" action="<?=$action?>" id="form">

      <div class="col-sm-12">
        <div id="data-info"></div>
              <div class="form-group">
                <label class="label-title" id="foto_personal">FOTO PERSONAL</label>
                <input type="file" name="foto_personal" id="upload-foto" class="file-upload-default" accept="image/JPEG">
                <div class="input-group col-xs-12">
                  <input type="text" name="foto_personal" id="image-foto" class="form-control file-upload-info" value="<?=$row->foto?>" readonly placeholder="Upload Image">
                  <span class="input-group-append">
                    <button class="file-upload-browse btn btn-primary" id="btn-upload-foto" type="button">Upload</button>
                  </span>
                </div>
                <?php if ($row->foto!=""): ?>
                    <p class="font-form">Upload success</p>
                  <?php else: ?>
                    <p class="font-form">Foto Wajah harus jelas (Format jpg & max size 1mb)</p>
                <?php endif; ?>
              </div>
      </div>


      <div class="col-sm-12">
        <div id="data-info"></div>
              <div class="form-group">
                <label class="label-title" id="foto_ktp">FILE KTP</label>
                <input type="file" name="foto_ktp" id="upload-ktp" class="file-upload-default" accept="image/JPEG">
                <div class="input-group col-xs-12">
                  <input type="text" name="foto_ktp" id="image-ktp" class="form-control file-upload-info" value="<?=$row->file_ktp?>" readonly placeholder="Upload Image">
                  <span class="input-group-append">
                    <button class="file-upload-browse btn btn-primary" id="btn-upload-ktp" type="button">Upload</button>
                  </span>
                </div>
                <?php if ($row->file_ktp!=""): ?>
                  <p class="font-form">Upload success</p>
                  <?php else: ?>
                    <p class="font-form">File KTP harus jelas (Format jpg & max size 1mb)</p>
                <?php endif; ?>
              </div>
      </div>


      <div class="col-sm-12">
        <div id="data-info"></div>
              <div class="form-group">
                <label class="label-title" id="foto_kk">FILE KTP</label>
                <input type="file" name="foto_kk" id="upload-kk" class="file-upload-default" accept="image/JPEG">
                <div class="input-group col-xs-12">
                  <input type="text" name="foto_kk" id="image-kk" class="form-control file-upload-info" value="<?=$row->file_kk?>" readonly placeholder="Upload Image">
                  <span class="input-group-append">
                    <button class="file-upload-browse btn btn-primary" id="btn-upload-kk" type="button">Upload</button>
                  </span>
                </div>
                <?php if ($row->file_kk!=""): ?>
                  <p class="font-form">Upload success</p>
                  <?php else: ?>
                    <p class="font-form">File KK harus jelas (Format jpg & max size 1mb)</p>
                <?php endif; ?>
              </div>
      </div>



  <div class="col-sm-12 mt-5">
      <a href="<?=site_url("front/formulir/form/rekening")?>" class="btn btn-sm btn-secondary text-white"><i class="ti-angle-double-left"></i> Sebelumnya</a>
      <button type="submit" id="submit" class="btn btn-sm btn-primary" name="button"><i class="ti-check-box"></i> Simpan & Lanjutkan</button>
  </div>

  </form>

    </div>


</div>


<script type="text/javascript">
$(function () {
        var fileupload = $("#upload-foto");
        var button = $("#btn-upload-foto");
        button.click(function () {
            fileupload.click();
        });
        fileupload.change(function () {
            var fileName = $(this).val().split('\\')[$(this).val().split('\\').length - 1];
            // $("#data-info").text(fileName);

            var file_data = $('#upload-foto').prop('files')[0];
            var form_data = new FormData();
            $("#image-foto").val(fileName);
            $("#btn-upload-foto").html('<div class="spinner-border spinner-border-sm text-white"></div>');

            form_data.append('foto_personal', file_data);

            $.ajax({
                url: '<?=site_url("front/formulir/do_upload")?>',
                dataType: 'json',
                cache: false,
                contentType: false,
                processData: false,
                data: form_data,
                type: 'post',
                success: function(json){
                  if (json.success==true) {
                    button.html('Upload');
                    $("#image-foto").val(json.file_name);
                    $(".font-form").text("Upload success");
                    $("#foto_personal")
                    .closest('.form-group')
                    .find('.error').remove();
                    $.toast({
                      text: json.alert,
                      showHideTransition: 'slide',
                      icon: json.header_alert,
                      loaderBg: '#f96868',
                      position: 'top-center',
                    });

                  }else {
                    button.html('Upload');
                    $("#image-foto").val("");
                    $(".font-form").text("Foto Wajah harus jelas (Format jpg & max size 1mb)");
                    $("#foto_personal")
                    .closest('.form-group')
                    .find('.error').remove();
                    $.toast({
                      text: json.alert,
                      showHideTransition: 'slide',
                      icon: json.header_alert,
                      loaderBg: '#f96868',
                      position: 'top-center',
                    });
                  }
                }
            });

        });
    });


    $(function () {
            var fileupload = $("#upload-ktp");
            var button = $("#btn-upload-ktp");
            button.click(function () {
                fileupload.click();
            });
            fileupload.change(function () {
                var fileName = $(this).val().split('\\')[$(this).val().split('\\').length - 1];
                // $("#data-info").text(fileName);

                var file_data = $('#upload-ktp').prop('files')[0];
                var form_data = new FormData();
                $("#image-ktp").val(fileName);
                $("#btn-upload-ktp").html('<div class="spinner-border spinner-border-sm text-white"></div>');

                form_data.append('foto_ktp', file_data);

                $.ajax({
                    url: '<?=site_url("front/formulir/do_upload_ktp")?>',
                    dataType: 'json',
                    cache: false,
                    contentType: false,
                    processData: false,
                    data: form_data,
                    type: 'post',
                    success: function(json){
                      if (json.success==true) {
                        button.html('Upload');
                        $("#image-ktp").val(json.file_name);
                        $(".font-form").text("Upload success");
                        $("#foto_ktp")
                        .closest('.form-group')
                        .find('.error').remove();
                        $.toast({
                          text: json.alert,
                          showHideTransition: 'slide',
                          icon: json.header_alert,
                          loaderBg: '#f96868',
                          position: 'top-center',
                        });

                      }else {
                        button.html('Upload');
                        $("#image-ktp").val("");
                        $(".font-form").text("File KK harus jelas (Format jpg & max size 1mb)");
                        $("#foto_ktp")
                        .closest('.form-group')
                        .find('.error').remove();
                        $.toast({
                          text: json.alert,
                          showHideTransition: 'slide',
                          icon: json.header_alert,
                          loaderBg: '#f96868',
                          position: 'top-center',
                        });
                      }
                    }
                });

            });
        });


        $(function () {
                var fileupload = $("#upload-kk");
                var button = $("#btn-upload-kk");
                button.click(function () {
                    fileupload.click();
                });
                fileupload.change(function () {
                    var fileName = $(this).val().split('\\')[$(this).val().split('\\').length - 1];
                    // $("#data-info").text(fileName);

                    var file_data = $('#upload-kk').prop('files')[0];
                    var form_data = new FormData();
                    $("#image-kk").val(fileName);
                    $("#btn-upload-kk").html('<div class="spinner-border spinner-border-sm text-white"></div>');

                    form_data.append('foto_kk', file_data);

                    $.ajax({
                        url: '<?=site_url("front/formulir/do_upload_kk")?>',
                        dataType: 'json',
                        cache: false,
                        contentType: false,
                        processData: false,
                        data: form_data,
                        type: 'post',
                        success: function(json){
                          if (json.success==true) {
                            button.html('Upload');
                            $("#image-kk").val(json.file_name);
                            $(".font-form").text("Upload success");
                            $("#foto_kk")
                            .closest('.form-group')
                            .find('.error').remove();
                            $.toast({
                              text: json.alert,
                              showHideTransition: 'slide',
                              icon: json.header_alert,
                              loaderBg: '#f96868',
                              position: 'top-center',
                            });

                          }else {
                            button.html('Upload');
                            $("#image-kk").val("");
                            $(".font-form").text("File KK harus jelas (Format jpg & max size 1mb)");
                            $("#foto_kk")
                            .closest('.form-group')
                            .find('.error').remove();
                            $.toast({
                              text: json.alert,
                              showHideTransition: 'slide',
                              icon: json.header_alert,
                              loaderBg: '#f96868',
                              position: 'top-center',
                            });
                          }
                        }
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
              $('.form-group').removeClass('.has-error')
                              .removeClass('.has');
              $.toast({
                text: json.alert,
                showHideTransition: 'slide',
                icon: 'success',
                loaderBg: '#f96868',
                position: 'top-center',
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
