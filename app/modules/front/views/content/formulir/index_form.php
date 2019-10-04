<nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row" id="navbar">
  <div class="navbar-brand-wrapper d-flex align-items-center justify-content-center" style="width:100%!important">
    <a href="<?=site_url("dashboard")?>" class="back-title"><i class="ti-home"></i></a>
    <h5 class="module-title" style="font-size:20px">
      FORM <?=strtoupper($title)?>
    </h5>
  </div>

</nav>
<!-- partial -->
<div class="container-fluid page-body-wrapper">
    <!-- partial -->
    <div class="main-panel" id="main-panel">
      <div class="content-wrapper">
        <?=$content_view;?>
      </div>
    </div>
  <!-- main-panel ends -->
  </div>
