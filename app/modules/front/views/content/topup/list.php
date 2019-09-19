<?php foreach ($row as $rows): ?>
  <li>
    <a href="<?=site_url("topup-detail/1")?>">
        <span class="nominal"> Rp.100.000</span>
        <!-- <span class="kode_transaksi">#TU101194001</span> -->
        <span class="bank"> Transfer Ke Bank BCA</span>
        <span class="date"> <i class="fa fa-calendar"></i> 10/11/2019 11:30 #<?=$rows->kode_transaksi?></span>
    </a>
    <span class="status badge badge-pill badge-success"> <i class="fa fa-check"></i> success</span>
  </li>

<?php endforeach; ?>
