<nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row" id="navbar">
  <div class="navbar-brand-wrapper d-flex align-items-center justify-content-center" style="width:100%!important">
    <a href="<?=site_url("withdraw")?>" class="back-title"><i class="ti-arrow-left"></i></a>
    <h5 class="module-title" style="font-size:20px">
      WITHDRAW #<?=$row->kode_transaksi?>
    </h5>
  </div>

</nav>
<!-- partial -->
<div class="container-fluid page-body-wrapper">
    <!-- partial -->
    <div class="main-panel" id="main-panel">
      <div class="content-wrapper">
        <table class="detail-topup">
          <tr>
            <td>Kode Transaksi</td>
            <td>: <b>#<?=$row->kode_transaksi?></b></td>
          </tr>

          <tr>
            <td>Waktu</td>
            <td>: <?=date('d/m/Y H:i', strtotime($row->created))?></td>
          </tr>

          <tr>
            <td>Jumlah</td>
            <td>: Rp.<?=format_rupiah($row->nominal)?></td>
          </tr>


          <tr>
            <?php
            if ($row->status == "success") {
              $status = "text-success";
            }elseif ($row->status == "proses") {
              $status = "text-primary";
            }
             ?>
            <td>Status</td>
            <td>: <span class="<?=$status?>"> <?=strtoupper($row->status)?></span></td>
          </tr>

        </table>

        <div class="pembayaran">

          <?php if ($row->status == "proses"): ?>
            Permintaan anda sedang di proses.
          <?php endif; ?>

          <?php if ($row->status == "success"): ?>
            Permintaan anda telah di proses dan dana withdraw telah di transfer ke rekening anda.
          <?php endif; ?>

        </div>

        <?php if ($row->status == "proses"): ?>
        <div class="tombol-detail-topup mt-4 text-center">
            <a href="<?=site_url("withdraw-konfirmasi/".enc_uri($row->id_trans_withdraw)."/".$row->kode_transaksi)?>" id="konfirmasi" data-header="Yakin ingin membatalkan?" class="btn-cancel-topup btn btn-sm btn-danger"> Batalkan</a>
        </div>
        <?php endif; ?>


      </div>
    </div>
  <!-- main-panel ends -->
  </div>

<?php if ($row->status == "proses"): ?>
  <script type="text/javascript">
    $(document).on("click","#konfirmasi",function(e){
      e.preventDefault();
      $('.modal-dialog').removeClass('modal-lg')
                        .removeClass('modal-md')
                        .addClass('modal-sm');
      $("#modalTitle").text('Please Confirm');
      $('#modalContent').html(`<p class="mb-4 text-center">`+$(this).attr('data-header')+`</p>
                              <div class="text-center">
                                <button type='button' class='btn btn-secondary text-white btn-sm' data-dismiss='modal'>Batal</button>
                                <button type='button' class='btn btn-primary btn-sm' id='ya-konfirmasi' data-id=`+$(this).attr('alt')+`  data-url=`+$(this).attr('href')+`>Ya, saya ingin membatalkan</button>
                              </div>
                            `);
      $("#modalGue").modal('show');
    });

    $(document).on('click','#ya-konfirmasi',function(e){
        $(this).prop('disabled',true)
                .text('Processing...');
        $.ajax({
                url:$(this).data('url'),
                type:'post',
                cache:false,
                dataType:'json',
                success:function(json){
                  $('#modalGue').modal('hide');
                  $.toast({
                    text: json.alert,
                    showHideTransition: 'slide',
                    icon: json.success,
                    loaderBg: '#f96868',
                    position: 'bottom-center',
                    afterHidden: function () {
                      window.location.href='<?=site_url("withdraw")?>';
                    }
                  });


                }
              });
      });

  </script>
<?php endif; ?>
