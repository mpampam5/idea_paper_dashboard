<?php if (balance() >= 2000000): ?>
  <div class="row">
    <div class="col-12">
      <form class="" action="index.html" method="post">
          <div class="form-group">
            <label for="">NIK</label>
            <input type="text" class="form-control" id="" placeholder="">
          </div>

          <div class="form-group">
            <label for="">NAMA</label>
            <input type="text" class="form-control" id="" placeholder="">
          </div>

          <div class="form-group">
            <label for="">EMAIL</label>
            <input type="text" class="form-control" id="" placeholder="">
          </div>

          <div class="form-group">
            <label for="">NO.TELEPON</label>
            <input type="text" class="form-control" id="" placeholder="">
          </div>

          <button type="button" data-dismiss="modal" aria-label="Close" class="btn btn-sm btn-secondary text-white" name="button">Cancel</button>
          <button type="submit" id="submit" class="btn btn-sm btn-primary" name="button">TAMBAHKAN</button>
      </form>
    </div>
  </div>
  <?php else: ?>
    <div class="row">
      <div class="col-lg-12 text-center">
        <p>Biaya Register member baru Rp.200.000. <br>Jumlah saldo anda tidak mencukupi, Silahkan TOP UP saldo anda.<br> Sisa saldo anda Rp. <?=format_rupiah(balance())?></p>
        <button type="button" data-dismiss="modal" aria-label="Close" class="btn btn-sm btn-secondary text-white" name="button">Cancel</button>
      </div>
    </div>
<?php endif; ?>
