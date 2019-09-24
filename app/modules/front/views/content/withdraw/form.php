<div class="row">
  <div class="col-12">
    <form class="" action="<?=$action?>" id="form" autocomplete="off">
      <span style="font-size:12px;text-align:justify">Harap diperhatikan! Agar bisa menerima dana yang di Withdraw, mohon pastikan bahwa Anda memiliki rekening bank yang terdaftar dengan nama anda sendiri sesuai dengan kartu identitas (KTP)</span>
      <ul style="font-size:12px">
        <?php if (config_all("min-withdraw")!=0): ?>
          <li>Min - Withdraw: <b>Rp. <?=format_rupiah(config_all("min-withdraw"))?></b></li>
        <?php endif; ?>
        <?php if (config_all("max-withdraw")!=0): ?>
          <li>Max - Withdraw: <b>Rp. <?=format_rupiah(config_all("max-withdraw"))?></b></li>
        <?php endif; ?>
      </ul>
      <div class="form-group">
        <input type="text" class="form-control" name="nominal" id="nominal" placeholder="Nominal">
      </div>




      <button type="button" data-dismiss="modal" aria-label="Close" class="btn btn-sm btn-secondary text-white" name="button">Cancel</button>
      <button type="submit" id="submit" class="btn btn-sm btn-primary" name="button">WITHDRAW</button>
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
                      .html('WITHDRAW');
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
