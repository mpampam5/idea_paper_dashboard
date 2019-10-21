<?php
$total = $this->db->select("id_trans_person_trading,kode_transaksi,id_person,SUM(jumlah_paper) AS jumlah_paper,SUM(total_harga_paper) AS total_harga_paper,created")
                                      ->from("trans_person_trading")
                                      ->where("id_person",sess('id_person'))
                                      ->where("status_kontrak","belum")
                                      ->get()
                                      ->row();
 ?>

<?php if ($total->total_harga_paper!=""): ?>
  <div class="trading-info">
    <h5 class="trading-title"><i class="ti-wallet"></i> Investasi Anda</h5>
    <hr style="margin-top: 0;margin-bottom: 1rem;">
    <table class="table-info-trading">
      <tr>
        <th>Jumlah Paper Aktif</th>
        <td> : <?=$total->jumlah_paper=="" ? "0":$total->jumlah_paper?> </td>
      </tr>


      <tr>
        <th>Total Nominal Investasi Anda (Rp)</th>
        <td> : Rp.<?=format_rupiah($total->total_harga_paper)?></td>
      </tr>
    </table>


  </div>


  <?php
  $history_pembelian_paper = $this->db->select("id_trans_person_trading,kode_transaksi,id_person,jumlah_paper,total_harga_paper,created,masa_aktif,waktu_mulai,status_kontrak")
                                          ->from("trans_person_trading")
                                          ->where("id_person",sess('id_person'))
                                          ->order_by("created","desc")
                                          ->get();
   ?>

   <?php if ($history_pembelian_paper->num_rows() > 0): ?>
    <div class="trading-info mt-3">
      <h5 class="trading-title"><i class="ti-receipt"></i> History Pembelian Paper</h5>
      <hr style="margin-top: 0;margin-bottom: 3px;">



       <?php foreach ($history_pembelian_paper->result() as $h_p): ?>

      <div class="content-history-paper">
        <div class="list-history-paper">
          <span class="text-warning">KODE TRANSAKSI : <?=$h_p->kode_transaksi?></span>
          <span><i class="ti-alarm-clock"></i> <?=date("d/m/Y H:i",strtotime($h_p->created))?></span>
          <span class="total-paper"><i class="ti-files"></i> Jumlah paper : <?=$h_p->jumlah_paper?></span>
          <span><i class="ti-wallet"></i> Total Pembayaran Rp.<?=format_rupiah($h_p->total_harga_paper)?></span>
          <?php if ($h_p->status_kontrak=="selesai"): ?>
            <span class="mt-1 text-danger" style="font-size:9px!important;"><i class="fa fa-circle"></i> TIDAK AKTIF&nbsp;|&nbsp;KONTRAK TELAH SELESAI PADA TANGGAL <?=date("d/m/Y",strtotime($h_p->masa_aktif))?></span>
            <?php else: ?>
              <?php if (masa_berlaku_paper($h_p->waktu_mulai) > 0): ?>
                <span class="mt-1 text-danger" style="font-size:9px!important;"><i class="fa fa-circle"></i> BELUM AKTIF&nbsp;|&nbsp;BERLAKU SAMPAI <?=date("d/m/Y",strtotime($h_p->masa_aktif))?></span>
                <?php else: ?>
                <span class="mt-1 text-success" style="font-size:9px!important;"><i class="fa fa-circle"></i> AKTIF&nbsp;|&nbsp;BERLAKU SAMPAI <?=date("d/m/Y",strtotime($h_p->masa_aktif))?></span>
              <?php endif; ?>
          <?php endif; ?>

        </div>

      <?php endforeach; ?>


      </div>

    </div>
   <?php endif; ?>
<?php else: ?>
  <p class="mt-4 text-center" style="font-size:9px!important;">Anda belum berinvestasi</p>
  <p class="text-center">
    <a href="<?=site_url("trading/beli")?>" class="badge badge-primary" id="beli_paper"><i class="ti-files"></i> BELI PAPER</a>
  </p>
<?php endif; ?>
