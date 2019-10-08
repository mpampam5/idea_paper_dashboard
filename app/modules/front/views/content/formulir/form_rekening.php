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

</style>


<nav aria-label="breadcrumb">
  <ol class="breadcrumb breadcrumb-custom bg-inverse-idea">
    <li class="breadcrumb-item"><a href="#">Data Personal</a></li>
    <li class="breadcrumb-item"><a href="#">Data Rekening</a></li>
  </ol>
</nav>

<p class="text-center" style="font-size:12px;">Silahkan lengkapi data anda.</p>

<div class="p-3">
  <form class="" action="<?=$action?>" id="form">
  <div class="row">
  <div class="col-sm-6">
    <div class="form-group">
      <label class="label-title"  id="nama_rekening">Nama Rekening</label>
      <input type="text" class="form-control" name="nama_rekening" value="<?=$row->nama_rekening?>">
    </div>
  </div>


  <div class="col-sm-6">
    <div class="form-group">
      <label class="label-title" id="no_rekening">No.Rekening</label>
      <input type="text" class="form-control"  name="no_rekening" value="<?=$row->no_rekening?>">
    </div>
  </div>

  <div class="col-sm-6">
    <div class="form-group">
      <label class="label-title" id="bank">Bank</label>
      <select class="form-control" name="bank" style="color:#3c3c3c">
        <option value="">-- pilih bank --</option>
        <?php foreach ($bank->result() as $bank): ?>
          <option <?=$row->ref_bank==$bank->id_bank? "selected":""?> value="<?=$bank->id_bank?>"><?=$bank->inisial_bank?></option>
        <?php endforeach; ?>
      </select>
    </div>
  </div>

  <div class="col-sm-6">
    <div class="form-group">
      <label class="label-title" id="kota_pembukuan">Kota. Pembukaan</label>
      <input type="text" class="form-control"  name="kota_pembukuan" value="<?=$row->kota_pembukuan?>">
    </div>
  </div>


  <div class="col-sm-12 mt-5">
    <a href="<?=site_url("front/formulir/form/personal")?>" class="btn btn-sm btn-secondary text-white"><i class="ti-angle-double-left"></i> Sebelumnya</a>
    <button type="submit" id="submit" class="btn btn-sm btn-primary" name="button"><i class="ti-check-box"></i> Simpan & Lanjutkan</button>
  </div>


</div>






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
