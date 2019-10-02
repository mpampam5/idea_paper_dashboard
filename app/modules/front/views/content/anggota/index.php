<style media="screen">
@-webkit-keyframes placeHolderShimmer {
        0% {
          background-position: -468px 0;
        }
        100% {
          background-position: 468px 0;
        }
      }

      @keyframes placeHolderShimmer {
        0% {
          background-position: -468px 0;
        }
        100% {
          background-position: 468px 0;
        }
      }

      .content-placeholder {
        display: inline-block;
        -webkit-animation-duration: 1s;
        animation-duration: 1s;
        -webkit-animation-fill-mode: forwards;
        animation-fill-mode: forwards;
        -webkit-animation-iteration-count: infinite;
        animation-iteration-count: infinite;
        -webkit-animation-name: placeHolderShimmer;
        animation-name: placeHolderShimmer;
        -webkit-animation-timing-function: linear;
        animation-timing-function: linear;
        background: #f6f7f8;
        background: -webkit-gradient(linear, left top, right top, color-stop(8%, #eeeeee), color-stop(18%, #dddddd), color-stop(33%, #eeeeee));
        background: -webkit-linear-gradient(left, #eeeeee 8%, #dddddd 18%, #eeeeee 33%);
        background: linear-gradient(to right, #eeeeee 8%, #dddddd 18%, #eeeeee 33%);
        -webkit-background-size: 800px 104px;
        background-size: 800px 104px;
        height: inherit;
        position: relative;
      }

</style>

<nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row" id="navbar">
  <div class="navbar-brand-wrapper d-flex align-items-center justify-content-center" >
    <a href="<?=site_url("dashboard")?>" class="back-title"><i class="ti-arrow-left"></i></a>
    <h5 class="module-title" style="font-size:20px">
      ANGGOTA
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
        <!-- <p class="text-info" style="padding:5px;text-align:justify;font-size:12px;"><b>Perhatian!</b> Penambahan member akan mengurangi saldo anda walau pun dalam status proses. harga registrasi member Rp.200.000</p> -->
        <ul class="list-anggota">
          <li>
              <div class="row">
                <div class="col-2 icons">
                  <a href="#">
                    <span class="ti-user user-icon"></span>
                  </a>
                </div>

                <div class="col-10 content">
                  <a href="#">
                    <span class="title-anggota">MUHAMMAD IRFAN IBNU MUHAMMAD IRFAN IBNU</span>
                    <span class="mem-reg">#MEM1011190001&nbsp;<span class="text-status text-success"> TERVERIFIKASI</span></span>
                    <span class="waktu">BERGABUNG 10/11/2019 14:00</span>
                  </a>
                </div>
              </div>
          </li>


          <li>
              <div class="row">
                <div class="col-2 icons">
                  <a href="#">
                    <span class="ti-user user-icon"></span>
                  </a>
                </div>

                <div class="col-10 content">
                  <a href="#">
                    <span class="title-anggota">ANDI FASAYA</span>
                    <span class="mem-reg">#MEM1011190002&nbsp;<span class="text-status text-info"> MENUNGGU VERIFIKASI</span></span>
                    <span class="waktu">BERGABUNG 10/11/2019 14:00</span>
                  </a>
                </div>
              </div>
          </li>
        </ul>
      </div>


      <button type="button" data-href="<?=site_url("anggota-add")?>" id="anggota-add" class="btn-topup btn btn-social-icon btn-primary btn-rounded" ><i class="ti-plus"></i></button>
    </div>
  <!-- main-panel ends -->
  </div>


  <script type="text/javascript">
  $(document).on("click","#anggota-add",function(e){
    e.preventDefault();
    $('.modal-dialog').removeClass('modal-sm')
                    .removeClass('modal-md')
                    .addClass('modal-lg');
    $("#modalTitle").text('Tambah Anggota');
    $('#modalContent').load($(this).attr('data-href'));
    $("#modalGue").modal('show');
  });

  </script>
