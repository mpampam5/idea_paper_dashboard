<div class="trading-info">
  <h5 class="trading-title"><i class="ti-wallet"></i> Investasi Anda</h5>
  <hr style="margin-top: 0;margin-bottom: 1rem;">
  <?php
  $total = $this->db->select("id_trans_person_trading,kode_transaksi,id_person,SUM(jumlah_paper) AS jumlah_paper,SUM(total_harga_paper) AS total_harga_paper,created")
                                        ->from("trans_person_trading")
                                        ->where("id_person",sess('id_person'))
                                        ->get()
                                        ->row();
   ?>
  <table class="table-info-trading">
    <tr>
      <th>Jumlah Paper Anda</th>
      <td> : <?=$total->jumlah_paper?> </td>
    </tr>


    <tr>
      <th>Total Nominal Investasi Anda (Rp)</th>
      <td> : Rp.<?=format_rupiah($total->total_harga_paper)?></td>
    </tr>
  </table>


</div>




  <div class="trading-info mt-3">
    <h5 class="trading-title"><i class="ti-receipt"></i> History Pembelian Paper</h5>
    <hr style="margin-top: 0;margin-bottom: 3px;">

    <?php
    $history_pembelian_paper = $this->db->select("id_trans_person_trading,kode_transaksi,id_person,jumlah_paper,total_harga_paper,created")
                                            ->from("trans_person_trading")
                                            ->where("id_person",sess('id_person'))
                                            ->get();
     ?>

     <?php foreach ($history_pembelian_paper->result() as $h_p): ?>

    <div class="content-history-paper">
      <div class="list-history-paper">
        <span class="text-warning">KODE TRANSAKSI : <?=$h_p->kode_transaksi?></span>
        <span><i class="ti-alarm-clock"></i> <?=date("d/m/Y H:i",strtotime($h_p->created))?></span>
        <span class="total-paper"><i class="ti-file"></i> Jumlah paper : <?=$h_p->jumlah_paper?></span>
        <span><i class="ti-wallet"></i> Total Pembayaran Rp.<?=format_rupiah($h_p->total_harga_paper)?></span>
      </div>

    <?php endforeach; ?>


    </div>

  </div>
