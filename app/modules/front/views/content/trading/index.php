<nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row" id="navbar">
  <div class="navbar-brand-wrapper d-flex align-items-center justify-content-center" >
    <a href="<?=site_url("dashboard")?>" class="back-title"><i class="ti-arrow-left"></i></a>
    <h5 class="module-title" style="font-size:20px">
      TRADING
    </h5>
  </div>
  <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">


    <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" id="reload-list" type="button">
      <span class="ti-reload"></span>
    </button>

  </div>

</nav>


<div class="container-fluid page-body-wrapper">

    <div class="main-panel" id="main-panel">
      <div class="content-wrapper">
        <?=$content_view?>
      </div>
    </div>
  <!-- main-panel ends -->

  </div>

  <div class="menu-trading">
    <a href="<?=site_url("trading/info")?>" class="<?=$this->uri->segment(2)=="info"?'active':''?>"><i class="ti-bar-chart"></i> INFO</a>
    <a href="<?=site_url("trading/history")?>" class="<?=$this->uri->segment(2)=="history"?'active':''?>"><i class="ti-receipt"></i> History</a>
  </div>




  <script type="text/javascript">
  $(document).on("click","#beli_paper",function(e){
    e.preventDefault();
    $('.modal-dialog').removeClass('modal-sm')
                    .removeClass('modal-md')
                    .addClass('modal-lg');
    $("#modalTitle").text('Beli Paper');
    $('#modalContent').load($(this).attr('href'));
    $("#modalGue").modal('show');
  });

  $(document).on("click","#reload-list",function(e){
    location.reload();
  });
  
  </script>
