<nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row" id="navbar">
  <div class="navbar-brand-wrapper d-flex align-items-center justify-content-center" style="width:100%!important">
    <a href="<?=site_url("dashboard")?>" class="back-title"><i class="fa fa-arrow-left"></i></a>
    <h5 class="module-title" style="font-size:20px">
      TOP UP
    </h5>
  </div>

</nav>
<!-- partial -->
<div class="container-fluid page-body-wrapper">
    <!-- partial -->
    <div class="main-panel" id="main-panel">
      <div class="content-wrapper">
        <ul class="list-topup">
          <li>
            <a href="<?=site_url("topup-detail/1")?>">
                <span class="nominal"> Rp.100.000</span>
                <!-- <span class="kode_transaksi">#TU101194001</span> -->
                <span class="bank"> Transfer Ke Bank BCA</span>
                <span class="date"> <i class="fa fa-calendar"></i> 10/11/2019 11:30 #TU101194001</span>
            </a>
            <span class="status badge badge-pill badge-success"> <i class="fa fa-check"></i> success</span>
          </li>

          <li>
            <a href="<?=site_url("topup-detail/1")?>">
                <span class="nominal"> Rp.100.000</span>
                <span class="bank"> Transfer Ke Bank BCA</span>
                <span class="date"> <i class="fa fa-calendar"></i> 10/11/2019 11:30 #TU101194422</span>
            </a>
            <span class="status badge badge-pill badge-warning text-white"> <i class="fa fa-check"></i> pending</span>
          </li>

          <li>
            <a href="<?=site_url("topup-detail/1")?>">
                <span class="nominal"> Rp.100.000</span>
                <span class="bank"> Transfer Ke Bank BCA</span>
                <span class="date"> <i class="fa fa-calendar"></i> 10/11/2019 11:30 #TU10119443</span>
            </a>
            <span class="status badge badge-pill badge-danger"> <i class="fa fa-check"></i> cancel</span>
          </li>

          <li>
            <a href="<?=site_url("topup-detail/1")?>">
                <span class="nominal"> Rp.100.000</span>
                <span class="bank"> Transfer Ke Bank BCA</span>
                <span class="date"> <i class="fa fa-calendar"></i> 10/11/2019 11:30 #TU101194234</span>
            </a>
            <span class="status badge badge-pill badge-success"> <i class="fa fa-check"></i> success</span>
          </li>

          <li>
            <a href="<?=site_url("topup-detail/1")?>">
                <span class="nominal"> Rp.100.000</span>
                <span class="bank"> Transfer Ke Bank BCA</span>
                <span class="date"> <i class="fa fa-calendar"></i> 10/11/2019 11:30 #TU101194321</span>
            </a>
            <span class="status badge badge-pill badge-success"> <i class="fa fa-check"></i> success</span>
          </li>

          <li>
            <a href="<?=site_url("topup-detail/1")?>">
                <span class="nominal"> Rp.100.000</span>
                <span class="bank"> Transfer Ke Bank BCA</span>
                <span class="date"> <i class="fa fa-calendar"></i> 10/11/2019 11:30 #TU101194011</span>
            </a>
            <span class="status badge badge-pill badge-success"> <i class="fa fa-check"></i> success</span>
          </li>

          <li>
            <a href="<?=site_url("topup-detail/1")?>">
                <span class="nominal"> Rp.100.000</span>
                <span class="bank"> Transfer Ke Bank BCA</span>
                <span class="date"> <i class="fa fa-calendar"></i> 10/11/2019 11:30 #TU101194002</span>
            </a>
            <span class="status badge badge-pill badge-success"> <i class="fa fa-check"></i> success</span>
          </li>




        </ul>
      </div>


      <button type="button" data-href="<?=site_url("topup-add")?>" id="topup-add" class="btn-topup btn btn-social-icon btn-primary btn-rounded" ><i class="ti-plus"></i></button>
    </div>
  <!-- main-panel ends -->
  </div>



<script type="text/javascript">

// $( window ).on( "load", function(e) {
//   e.preventDefault();
//   $('.modal-dialog').removeClass('modal-sm')
//                   .removeClass('modal-md')
//                   .addClass('modal-lg');
//   $("#modalTitle").text('TOP UP');
//   $('#modalContent').load($("<?=site_url("topup-detail/1")?>topup-add").attr('data-href'));
//   $("<?=site_url("topup-detail/1")?>modalGue").modal('show');
//     });


$(document).on("click","#topup-add",function(e){
  e.preventDefault();
  $('.modal-dialog').removeClass('modal-sm')
                  .removeClass('modal-md')
                  .addClass('modal-lg');
  $("#modalTitle").text('TOP UP');
  $('#modalContent').load($(this).attr('data-href'));
  $("#modalGue").modal('show');
});
</script>
