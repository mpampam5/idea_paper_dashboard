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
          <?php if ($cek_row->num_rows() > 0): ?>
            <div id="list-anggota"></div>
            <div id="load_data_message"></div>
            <?php else: ?>
              <p class="text-center" style="margin-top:50%;font-style:italic"> Data belum ada</p>
          <?php endif; ?>
        </ul>
      </div>


      <button type="button" data-href="<?=site_url("anggota-add")?>" id="anggota-add" class="btn-topup btn btn-social-icon btn-primary btn-rounded" ><i class="ti-plus"></i></button>
    </div>
  <!-- main-panel ends -->
  </div>


  <script type="text/javascript">
  $(document).ready(function(){

    var limit = 10;
    var start = 0;
    var action = 'inactive';

    function lazzy_loader(limit)
      {
        var output = '';
        for(var count=0; count<6; count++)
        {
          output += `<li>
                          <div class="row">
                            <div class="col-2 icons">
                              <a href="#">
                                <span style="width:60px!important;margin:2px;height:98%;" class="content-placeholder">&nbsp;</span>
                              </a>
                            </div>

                            <div class="col-10 content">
                              <a href="#">
                              <span class="title-anggota content-placeholder" style="width:98%;margin:2px;">&nbsp;</span>
                              <span class="mem-reg content-placeholder" style="width:98%;margin:2px;">&nbsp;</span>
                              <span class="waktu content-placeholder" style="width:98%;margin:2px;">&nbsp;</span>
                              <span class="text-status content-placeholder" style="width:98%;margin:2px;">&nbsp;</span>
                              </a>
                            </div>
                          </div>
                      </li>`;
        }
        $('#load_data_message').html(output);
      }


      lazzy_loader(limit);

      function load_data(limit, start)
      {
        $.ajax({
          url:"<?php echo base_url(); ?>anggota-json",
          method:"POST",
          data:{limit:limit, start:start},
          cache: false,
          success:function(data)
          {
            if(data == '')
            {
              $('#load_data_message').html('');
              action = 'active';
            }
            else
            {
              $('#list-anggota').append(data);
              $('#load_data_message').html("");
              action = 'inactive';
            }
          }
        })
      }

      if(action == 'inactive')
      {
        action = 'active';
        load_data(limit, start);
      }

      $(window).scroll(function(){
        if($(window).scrollTop() + $(window).height() > $("#list-anggota").height() && action == 'inactive')
        {
          lazzy_loader(limit);
          action = 'active';
          start = start + limit;
          setTimeout(function(){
            load_data(limit, start);
          }, 1000);
        }
      });

      $(document).on("click","#reload-list",function(e){
        location.href="<?=site_url("anggota")?>";
        // $('#list-topup').html("");
        // lazzy_loader(limit = 10);
        // action = 'active';
        // start = start;
        // setTimeout(function(){
        //   load_data(limit = 10, start = 0);
        // }, 1000);
      });


  });

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
