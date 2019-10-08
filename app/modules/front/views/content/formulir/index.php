<nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row" id="navbar" style="transition: top 0.9s;">
  <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
    <h5 class="logo-title">IDEA PAPER</h5>
  </div>
    <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">

      <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
        <span class="ti-layout-grid2"></span>
      </button>

      <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
        <span class="ti-user"></span>
      </button>

    </div>

</nav>
<!-- partial -->
<div class="container-fluid page-body-wrapper">


  <!-- partial -->
  <!-- partial:partials/_sidebar.html -->
  <nav class="sidebar sidebar-offcanvas" id="sidebar">

    <div class="profile">
      <div class="col-lg-12 cover">
        <div class="text-center pb-4 pt-4">
          <img src="<?=base_url()?>_template/front/images/faces/face12.jpg" alt="profile" class="profile-image img-lg rounded-circle mb-3">
          <div class="mb-3">
            <h4 class="profile-name"><?=strtoupper(profile('nama'))?></h4>
            <h5 class="profile-id">ID.REG : <?=profile('id_register')?></h5>
            <h5 class="profile-balance">Rp.<?=format_rupiah(balance());?></h5>
          </div>
          <!-- <p class="w-75 mx-auto mb-3">Bureau Oberhaeuser is a design bureau focused on Information- and Interface Design. </p> -->
          <div class="d-flex justify-content-center">
            <a href="<?=site_url("topup")?>" class="btn btn-outline-primary btn-sm mr-1">TOP UP</a>
            <a href="<?=site_url("withdraw")?>" class="btn btn-outline-primary btn-sm">WITHDRAW</a>
          </div>
        </div>
        <!-- <button class="btn btn-primary btn-block mb-2">Preview</button> -->
      </div>
    </div>

    <ul class="nav">

      <li class="nav-item">
        <a class="nav-link" href="pages/widgets/widgets.html">
          <i class="fa fa-cogs menu-icon"></i>
          <span class="menu-title">Pengaturan</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="pages/widgets/widgets.html">
          <i class="fa fa-refresh menu-icon"></i>
          <span class="menu-title">History Transaksi</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="<?=site_url('logout')?>">
          <i class="fa fa-sign-in menu-icon"></i>
          <span class="menu-title">Logout</span>
        </a>
      </li>

    </ul>
  </nav>




  <!-- partial -->
  <div class="main-panel" id="main-panel">

        <div class="">
          <div class="owl-carousel owl-theme full-width">
            <div class="item">
              <img src="<?=base_url()?>_template/front/images/carousel/banner_12.jpg" alt="image"/>
            </div>
            <div class="item">
              <img src="<?=base_url()?>_template/front/images/carousel/banner_2.jpg" alt="image"/>
            </div>
            <div class="item">
              <img src="<?=base_url()?>_template/front/images/carousel/banner_1.jpg" alt="image"/>
            </div>
          </div>
        </div>

          <!-- <div class="toolbar-profile">
            <span class="badge badge-danger"> Hi, Muhammad Irfan Ibnu</span>
            <span class="badge badge-danger"> Rp. 100.000</span>
          </div> -->
          <div class="row">
            <div class="col-md-12 grid-margin mt-2 mb-2">

									<div class="d-sm-flex flex-row flex-wrap text-left text-sm-left align-items-center border-bottom pb-2 pl-2">
										<!-- <img src="../../../../images/faces/face11.jpg" class="img-lg rounded" alt="profile image"> -->
										<div class="ml-sm-3 ml-md-0 ml-xl-3 mt-2 mt-sm-0 mt-md-2 mt-xl-0">
											<h6 class="mb-0"><?=strtoupper(profile('nama'))?></h6>
											<p class="text-muted mb-1">ID.REG : <?=profile('id_register')?></p>
											<p class="mb-0 text-primary font-weight-bold">Saldo Rp.<?=format_rupiah(balance())?></p>
										</div>

                    <div class="top-up">
                      <a href="<?=site_url("topup")?>" id="topup" class="btn btn-outline-primary btn-sm" >TOP UP</a>
                    </div>
									</div>


						</div>
          </div>


          <div class="row">
            <div class="col-md-12 grid-margin mt-3 mb-2 text-center">
              <?php if (profile("is_complate")=="1"): ?>
                <p class="mb-5" style="font-size:12px;padding:10px;">
                  Data anda sedang dalam proses <i class="text-success">verifikasi</i>.<br>
                  Silahkan hubungi admin jika terjadi masalah.
                </p>

                <a href="<?=site_url("dashboard")?>" class="btn btn-outline-primary btn-sm"> <i class="ti-home"></i> Dashboard</a>
                <?php else: ?>
                  <p class="mb-5" style="font-size:12px;padding:10px;">
                    Maaf Fitur ini belum bisa anda gunakan. Silahkan lengkapi data anda terlebih dahulu.<br>
                  </p>

                  <a href="<?=site_url("dashboard")?>" class="btn btn-outline-primary btn-sm"> <i class="ti-home"></i> Dashboard</a>
                  <a href="<?=site_url("formulir/form/personal")?>" class="btn btn-outline-primary btn-sm"> <i class="ti-file"></i> Lengkapi Data</a>
              <?php endif; ?>

            </div>
          </div>






</div>
<!-- main-panel ends -->
</div>
<!-- page-body-wrapper ends -->
