<div class="row">
  <div class="col-12">
    <form class="" action="<?=$action?>" id="form" autocomplete="off">
      <!-- <span style="font-size:12px">Untuk mempermudah proses transaksi, silahkan masukkan 3 angka unik di belakang nominal. contoh XXX.123</span> -->
      <ul style="font-size:12px">
        <?php if (config_all("min-topup")!=0): ?>
          <li>Min - Top up : <b>Rp. <?=format_rupiah(config_all("min-topup"))?></b></li>
        <?php endif; ?>
        <?php if (config_all("max-topup")!=0): ?>
          <li>Max - Top up : <b>Rp. <?=format_rupiah(config_all("max-topup"))?></b></li>
        <?php endif; ?>
      </ul>
      <div class="form-group">
        <input type="text" class="form-control" name="nominal" id="nominal" placeholder="Nominal">
      </div>

      <div class="form-group">
        <select class="form-control" id="metode_pembayaran" name="metode_pembayaran">
          <option value="">-- Metode Pembayaran --</option>
          <?php foreach ($rekening as $rekening): ?>
            <option value="<?=$rekening->id_rekening?>"><?=$rekening->inisial_bank?></option>
          <?php endforeach; ?>
        </select>
      </div>



      <button type="button" data-dismiss="modal" aria-label="Close" class="btn btn-sm btn-secondary text-white" name="button">Cancel</button>
      <button type="submit" id="submit" class="btn btn-sm btn-primary" name="button">TOP UP</button>
    </form>
  </div>
</div>


<script type="text/javascript">
$("#form").submit(function(e){
e.preventDefault();
var me = $(this);
$("#submit").prop('disabled',true).html('<div class="spinner-border spinner-border-sm text-white"></div> Processing...');
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
                  location.href=json.url;
              }
            });


        }else {
          $("#submit").prop('disabled',false)
                      .html('TOP UP');
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
