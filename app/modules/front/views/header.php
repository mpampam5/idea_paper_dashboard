<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title><?=ucfirst($title)?></title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="<?=base_url()?>_template/front/vendors/ti-icons/css/themify-icons.css">
  <link rel="stylesheet" href="<?=base_url()?>_template/front/vendors/font-awesome/css/font-awesome.min.css" />
  <link rel="stylesheet" href="<?=base_url()?>_template/front/vendors/css/vendor.bundle.base.css">

  <link rel="stylesheet" href="<?=base_url()?>_template/front/vendors/owl-carousel-2/owl.carousel.min.css">
  <link rel="stylesheet" href="<?=base_url()?>_template/front/vendors/owl-carousel-2/owl.theme.default.min.css">
  <!-- endinject -->
  <!-- Plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="<?=base_url()?>_template/front/css/vertical-layout-light/style.css">
  <link rel="stylesheet" href="<?=base_url()?>_template/front/css/vertical-layout-light/custom.css">
  <!-- endinject -->
  <link rel="shortcut icon" href="<?=base_url()?>_template/front/images/favicon.png" />



  <script src="<?=base_url()?>_template/front/vendors/js/vendor.bundle.base.js"></script>
</head>
<body>
  <div class="container-scroller">
    <!-- partial:partials/_navbar.html -->
    <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
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
          <div class="col-lg-12">
            <div class="border-bottom text-center pb-4 mt-4">
              <img src="<?=base_url()?>_template/front/images/faces/face12.jpg" alt="profile" class="img-lg rounded-circle mb-3">
              <div class="mb-3">
                <h4>David Grey. H</h4>
                <h5>Rp.100.000</h5>
              </div>
              <!-- <p class="w-75 mx-auto mb-3">Bureau Oberhaeuser is a design bureau focused on Information- and Interface Design. </p> -->
              <div class="d-flex justify-content-center">
                <button class="btn btn-success btn-sm mr-1">Deposit</button>
                <button class="btn btn-success btn-sm">Withdraw</button>
              </div>
            </div>
            <!-- <button class="btn btn-primary btn-block mb-2">Preview</button> -->
          </div>
        </div>

        <ul class="nav">
          <li class="nav-item">
            <a class="nav-link" href="index.html">
              <i class="ti-home menu-icon"></i>
              <span class="menu-title">Dashboard</span>
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="pages/widgets/widgets.html">
              <i class="fa fa-cogs menu-icon"></i>
              <span class="menu-title">Pengaturan</span>
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="pages/widgets/widgets.html">
              <i class="fa fa-sign-in menu-icon"></i>
              <span class="menu-title">Logout</span>
            </a>
          </li>

        </ul>
      </nav>




      <!-- partial -->
      <div class="main-panel">
