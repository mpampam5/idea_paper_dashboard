<div class="row">
  <div class="col-12">
    <form class="" action="index.html" method="post">
      <div class="form-group">
        <input type="text" class="form-control" name="nominal" id="nominal" placeholder="Nominal">
      </div>

      <div class="form-group">
        <select class="form-control" id="" name="">
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
