<link rel="stylesheet" href="<?=base_url()?>_template/front/vendors/datatables.net-bs4/dataTables.bootstrap4.css">
<script src="<?=base_url()?>_template/front/vendors/datatables.net/jquery.dataTables.js"></script>
<script src="<?=base_url()?>_template/front/vendors/datatables.net-bs4/dataTables.bootstrap4.js"></script>
<style media="screen">
  .table-profit{
    width:100%;
  }

  .table-profit tr th{
    border: none;
    font-size: 11px;
    padding: 3px;
  }
  .table-profit tr td{
    font-size: .555rem;
    padding: 3px;
  }

  .pagination .page-item .page-link{
    font-size: .575rem;
  }

  div.dataTables_wrapper div.dataTables_paginate ul.pagination{
    justify-content: center;
    /* width: 100%; */
  }

  .dataTables_wrapper .dataTables_processing {
    background: none;
    border: none;
    /* top: 50%; */
    padding-top: 39px!important;
  }
</style>

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
        <td> : <?=total_paper_terpakai()?></td>
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
        <td> : <?=$row->jumlah_paper-total_paper_terpakai()?> </td>
      </tr>

    </table>

    <div class="info-keterangan-trading">
      <span>Keterangan : </span>
      <p>Dapatkan keuntungan 5-10% / bulan dalam jangka 1 tahun. Dividen dibagikan tiap akhir bulan.</p>
    </div>


    <a href="<?=site_url("trading/beli")?>" class="badge badge-primary mt-4" id="beli_paper"><i class="ti-files"></i> BELI PAPER</a>

  </div>


  <div class="trading-info mt-3 pb-4">
    <h5 class="trading-title"><i class="ti-bar-chart"></i> Profit</h5>
    <hr style="margin-top: 0;margin-bottom: 1rem;">
    <table class="table-profit table-bordered" id="table_profit">
      <thead class="bg-black text-yell">
        <tr>
          <th></th>
          <th>Waktu</th>
          <th>Persentase %</th>
          <th>Nominal (Rp)</th>
        </tr>
      </thead>

    </table>

  </div>


  <div class="trading-info mt-3 pb-4">
    <h5 class="trading-title"><i class="ti-wallet"></i> Dividen</h5>
    <hr style="margin-top: 0;margin-bottom: 1rem;">
    <table class="table-profit table-bordered" id="table_dividen">
      <thead class="bg-black text-yell">
        <tr>
          <th></th>
          <th>Waktu</th>
          <th>Profit</th>
          <th>Paper</th>
          <th>Dividen</th>
        </tr>
      </thead>

    </table>

  </div>


</div>



<script type="text/javascript">


$(document).ready(function() {
    var table_profit = $("#table_profit").dataTable({
        oLanguage: {
            sProcessing: '<div class="spinner-border spinner-border-sm text-warning"></div>'
        },
        "searching": false,
        "bLengthChange": false,
        "info": false,
        "ordering": false,
        processing: true,
        serverSide: true,
        ajax: {"url": "<?=base_url()?>trading/json_profit", "type": "POST"},
        columns: [
            {
              "data": "id_trading_profit",
              "orderable": false,
              "visible":false,
              searchable: false
            },
            {
              "data":"time_add",
              "className" : "text-center",
            },
            {
              "data":"persentasi",
              "className" : "text-center",
              render:function(data,type,row,meta)
               {
                 if (data > 0) {
                   return '<span class="text-success">'+data+'%</span>';
                 }else {
                   return '<span class="text-danger">'+data+'%</span>';
                 }
               },
             },
            {
              "data":"nominal",
              "className" : "text-center",
              render:function(data,type,row,meta)
               {
                 if (data==0) {
                   return '<span class="text-danger">Rp.'+data+'</span>';
                 }else {
                   return '<span class="text-success">Rp.'+data+'</span>';
                 }
               },
            },
        ],
        order: [[0, 'DESC']],
    });



    var table_dividen = $("#table_dividen").dataTable({
        oLanguage: {
            sProcessing: '<div class="spinner-border spinner-border-sm text-warning"></div>'
        },
        "searching": false,
        "bLengthChange": false,
        "info": false,
        "ordering": false,
        processing: true,
        serverSide: true,
        ajax: {"url": "<?=base_url()?>trading/json_dividen", "type": "POST"},
        columns: [
            {
              "data": "id_trading_profit",
              "orderable": false,
              "visible":false,
              searchable: false
            },
            {
              "data":"time_add",
              "className" : "text-center",
            },
            {
              "data":"persentasi",
              "className" : "text-center",
              render:function(data,type,row,meta)
               {
                 if (row.nominal == 0) {
                   return '<span class="text-danger">Rp.'+row.nominal+' ('+data+'%)</span>';
                 }else {
                   return '<span class="text-success">Rp.'+row.nominal+' ('+data+'%)</span>';
                 }
               },
             },
             {
               "data":"jumlah_paper",
               "className" : "text-center",
             },
            {
              "data":"persentase",
              "className" : "text-center",
              render:function(data,type,row,meta)
               {
                 if (row.dividen == 0) {
                   return '<span class="text-danger">Rp.'+row.dividen+' ('+data+'%)</span>';
                 }else {
                   return '<span class="text-success">Rp.'+row.dividen+' ('+data+'%)</span>';
                 }
               },
            },
            {
              "data":"dividen",
              "visible":false
            },
            {
              "data":"nominal",
              "visible":false
            },
        ],
        order: [[0, 'DESC']],
    });
});
</script>
