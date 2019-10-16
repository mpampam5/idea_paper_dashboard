<form class="" action="<?=$action?>" id="form">

  <ul style="font-size:11px;">
    <li>Saldo Anda Rp.<?=format_rupiah(balance())?></li>
    <li>Harga satuan paper Rp.<?=format_rupiah(get_info_trading("harga_paper"))?></li>
    <li>Stok Paper tersedia <?=get_info_trading("jumlah_paper")-total_paper_terpakai()?></li>
  </ul>
  <div class="form-group">
    <label id="jumlah_paper">Jumlah Paper</label>
    <input type="text" class="form-control form-control-sm" name="jumlah_paper" placeholder="Jumlah Paper">
  </div>


  <div class="form-group">
    <label id="password">Password</label>
    <input type="password" class="form-control form-control-sm" name="password" placeholder="Masukkan password Anda">
  </div>


  <button type="button" data-dismiss="modal" aria-label="Close" class="btn btn-sm btn-secondary text-white" name="button"><i class="ti-na"></i> Cancel</button>
  <button type="submit" name="button" id="submit" class="btn btn-primary btn-sm"><i class="ti-files"></i> Beli Paper</button>

</form>



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
                  location.href="<?=site_url("trading/history")?>";
              }
            });


        }else {
          $("#submit").prop('disabled',false)
                      .html('<i class="ti-files"></i> Beli Paper');
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
