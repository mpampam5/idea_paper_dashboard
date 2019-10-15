<div style="margin-bottom:70px;">
  <div class="trading-info">
    <h5 class="trading-title"><i class="ti-file"></i> Trading info</h5>
    <hr style="margin-top: 0;margin-bottom: 1rem;">

    <table class="table-info-trading">
      <tr>
        <th>Jumlah Paper</th>
        <td> : <?=$row->jumlah_paper?> </td>
      </tr>


      <tr>
        <th>Harga Per Paper (Rp)</th>
        <td> : Rp.<?=format_rupiah($row->harga_paper)?></td>
      </tr>

      <tr>
        <th>Jumlah Paper Terbeli</th>
        <td> : <?php
              $total_paper_terpakai = $this->db->select("id_trans_person_trading,SUM(jumlah_paper) AS jumlah_paper")
                                               ->get("trans_person_trading")
                                               ->row();
          echo "$total_paper_terpakai->jumlah_paper";
          ?></td>
      </tr>

      <tr>
        <td></td>
        <td></td>
      </tr>

      <tr>
        <td></td>
        <td></td>
      </tr>

      <tr>
        <td></td>
        <td></td>
      </tr>

      <tr>
        <th>Jumlah Paper Tersedia</th>
        <td> : <?=$row->jumlah_paper-$total_paper_terpakai->jumlah_paper?> </td>
      </tr>

    </table>

    <div class="info-keterangan-trading">
      <span>Keterangan : </span>
      <p>Dapatkan keuntungan 5-10% / bulan dalam jangka 1 tahun. Dividen dibagikan tiap akhir bulan.</p>
    </div>


    <a href="<?=site_url("trading/beli")?>" class="badge badge-primary mt-4" id="beli_paper"><i class="ti-shopping-cart-full"></i> BELI PAPER</a>

  </div>


  <div class="trading-info mt-3">
    <h5 class="trading-title"><i class="ti-bar-chart"></i> Profit</h5>
    <hr style="margin-top: 0;margin-bottom: 1rem;">


  </div>


  <div class="trading-info mt-3">
    <h5 class="trading-title"><i class="ti-wallet"></i> Dividen</h5>
    <hr style="margin-top: 0;margin-bottom: 1rem;">


  </div>


</div>
