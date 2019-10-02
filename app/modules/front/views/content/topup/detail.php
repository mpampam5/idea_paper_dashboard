<nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row" id="navbar">
  <div class="navbar-brand-wrapper d-flex align-items-center justify-content-center" style="width:100%!important">
    <a href="<?=site_url("topup")?>" class="back-title"><i class="ti-arrow-left"></i></a>
    <h5 class="module-title" style="font-size:20px">
      TOP UP #<?=$row->kode_transaksi?>
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
            <td>Metode Pembayaran</td>
            <td>: <?=$row->inisial_bank?></td>
          </tr>

          <tr>
            <?php
            if ($row->status == "pending") {
              $status = "text-warning";
            }elseif ($row->status == "success") {
              $status = "text-success";
            }elseif ($row->status == "proses") {
              $status = "text-primary";
            }elseif ($row->status == "cancel") {
              $status = "text-danger";
            }elseif ($row->status == "expire") {
              $status = "text-dark";
            }
             ?>
            <td>Status</td>
            <td>: <span class="<?=$status?>"> <?=strtoupper($row->status)?></span></td>
          </tr>

        </table>

        <div class="pembayaran">

          <p>Melakukan Pembayaran Ke : </p>
          <hr>
          <table class="detail-pembayaran">
            <tr>
              <td>No.Rekening</td>
              <td>: <?=$row->no_rekening?></td>
            </tr>

            <tr>
              <td>Nama Rekening</td>
              <td>: <?=strtoupper($row->nama_rekening)?></td>
            </tr>

            <tr>
              <td>Bank</td>
              <td>: <?=$row->inisial_bank?></td>
            </tr>

          </table>

          <hr>
          <?php if ($row->status == "pending"): ?>
                <ul>
                  <li>Silahkan Transfer Sebesar <b>Rp.<?=format_rupiah($row->nominal)?></b></li>
                  <li>Untuk mempermudah proses verifikasi, silahkan transfer sesuai nominal di atas.</li>
                  <li>Pembayaran Berlaku Sampai <?=date("d/m/Y H:i",strtotime($row->time_expire))?>.</li>
                </ul>
          <?php endif; ?>

          <?php if ($row->status=="expire"): ?>
            Masa berlaku pembayaran telah berakhir. Pembayaran berlaku sampai batas <?=date("d/m/Y H:i",strtotime($row->time_expire))?>
          <?php endif; ?>

          <?php if ($row->status == "proses"): ?>
            Transaksi anda sedang di proses.
          <?php endif; ?>

          <?php if ($row->status == "success"): ?>
            Transaksi sukses.
          <?php endif; ?>

          <?php if ($row->status == "cancel"): ?>
            Anda telah membatalkan transaksi.
          <?php endif; ?>

        </div>

        <?php if ($row->status == "pending"): ?>
          <p style="font-size:11px" class="text-center mt-2">Silahkan menekan tombol konfirmasi setelah melakukan pembayaran, untuk segera di proses.</p>
            <div class="tombol-detail-topup mt-4 text-center">
              <a href="<?=site_url("topup-konfirmasi/".enc_uri($row->id_trans_person_deposit)."/delete")?>" id="konfirmasi" data-header="Yakin ingin menghapus?" data-button="Hapus" class="btn-cancel-topup btn btn-sm btn-danger"> Hapus</a>
              <a href="<?=site_url("topup-konfirmasi/".enc_uri($row->id_trans_person_deposit)."/cancel")?>" data-header="Yakin ingin membatalkan transaksi?" id="konfirmasi" data-button="batalkan" class="btn-cancel-topup btn btn-sm btn-warning text-white"> Batalkan</a>
              <a href="<?=site_url("topup-konfirmasi/".enc_uri($row->id_trans_person_deposit)."/proses")?>" id="konfirmasi" data-header="Sudah Melakukan Pembayaran?" data-button="konfirmasi" class="btn-cancel-topup btn btn-sm btn-primary"> Konfirmasi</a>
            </div>
        <?php endif; ?>

        <?php if ($row->status=="expire" || $row->status=="cancel"): ?>
          <div class="tombol-detail-topup mt-4 text-center">
            <a href="<?=site_url("topup-konfirmasi/".enc_uri($row->id_trans_person_deposit)."/delete")?>" id="konfirmasi" data-header="Yakin ingin menghapus?" data-button="Hapus" class="btn-cancel-topup btn btn-sm btn-danger"> Hapus</a>
          </div>
        <?php endif; ?>

      </div>
    </div>
  <!-- main-panel ends -->
  </div>


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
                                <button type='button' class='btn btn-primary btn-sm' id='ya-konfirmasi' data-id=`+$(this).attr('alt')+`  data-url=`+$(this).attr('href')+`>`+$(this).attr('data-button')+`</button>
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
                      if (json.status!="delete") {
                        location.reload();
                      }else {
                        window.location.href='<?=site_url("topup")?>';
                      }
                    }
                  });


                }
              });
      });

  </script>
