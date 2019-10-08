<style media="screen">
.form-group label.label-title {
  font-size: 0.875rem;
  line-height: 1.4rem;
  vertical-align: top;
  margin-bottom: 1px;
  font-weight: 600;
}


.form-group label.error {
  margin-bottom: 0;
}

</style>

<nav aria-label="breadcrumb">
  <ol class="breadcrumb breadcrumb-custom bg-inverse-idea">
    <li class="breadcrumb-item"><a href="#">Data Personal</a></li>
  </ol>
</nav>

<p class="text-center" style="font-size:12px;">Silahkan lengkapi data anda.</p>

<div class="p-3">
  <form class="" action="<?=$action?>" id="form">
  <div class="row">
  <div class="col-sm-6">
    <div class="form-group">
      <label class="label-title"  id="nik">NIK</label>
      <input type="text" class="form-control" name="nik" value="<?=$row->nik?>">
    </div>
  </div>

  <input type="hidden" class="form-control" name="nik_lama" placeholder="nik" value="<?=$row->nik?>">

  <div class="col-sm-6">
    <div class="form-group">
      <label class="label-title" id="nama">Nama Lengkap</label>
      <input type="text" class="form-control"  name="nama" value="<?=$row->nama?>">
    </div>
  </div>

  <div class="col-sm-6">
    <div class="form-group">
      <label class="label-title" id="telepon">No.Telepon</label>
      <input type="text" class="form-control"  name="telepon" value="<?=$row->telepon?>">
    </div>
  </div>

  <div class="col-sm-6">
    <div class="form-group">
      <label class="label-title" id="email">Email</label>
      <input type="text" class="form-control"  name="email" value="<?=$row->email?>">
    </div>
  </div>

  <input type="hidden" class="form-control"  name="email_lama" value="<?=$row->email?>">

  <div class="col-sm-6">
    <div class="form-group">
      <label class="label-title" id="pekerjaan">Pekerjaan</label>
      <select class="form-control" style="color:#495057"  name="pekerjaan">
          <option value=""> -- pilih pekerjaan --</option>
          <?php foreach ($pekerjaan->result() as $kerja): ?>
            <option <?=($row->pekerjaan==$kerja->pekerjaan?"selected":"")?> value="<?=$kerja->pekerjaan?>"><?=$kerja->pekerjaan?></option>
          <?php endforeach; ?>
        </select>
    </div>
  </div>

  <div class="col-sm-6">
    <div class="form-group">
      <label class="label-title" id="jenis_kelamin">Jenis Kelamin</label>
      <select class="form-control" name="jenis_kelamin"  style="color:#535353">
        <option value="">-- pilih jenis kelamin --</option>
        <option <?=$row->jenis_kelamin == "pria" ? "selected":""?> value="pria">PRIA</option>
        <option <?=$row->jenis_kelamin == "wanita" ? "selected":""?> value="wanita">WANITA</option>
      </select>
    </div>
  </div>

  <div class="col-sm-6">
    <div class="form-group">
      <label class="label-title" id="tempat_lahir">Tempat Lahir</label>
      <input type="text" class="form-control"  name="tempat_lahir" value="<?=$row->tempat_lahir?>">
    </div>
  </div>

  <?php
  if ($row->tanggal_lahir!="") {
    $explode = explode("-",$row->tanggal_lahir);
  }else {
    $explode = explode("-","9999-99-99");
  }
   ?>

  <div class="col-sm-6">
    <div class="form-group">
      <label class="label-title" id="tanggal_lahir">Tanggal Lahir</label>
      <div class="row">
        <div class="col-4">
          <select  class="form-control form-control-sm" style="color:#495057" name="tgl">
            <option value="">--tgl--</option>
            <?php
              for ($i=1; $i <= 31 ; $i++) {
                $tgl = str_replace("0","",$explode[2])==$i ? "selected":"";
                echo '<option '.$tgl.'  value="'.$i.'">'.$i.'</option>';
              }
            ?>
          </select>
        </div>


        <div class="col-4">
          <select  class="form-control form-control-sm" style="color:#495057" name="bln">
            <option value="">--bln--</option>
            <option <?=$explode[1]=="01" ? "selected":"";?> value="01">Januari</option>
            <option <?=$explode[1]=="02" ? "selected":"";?> value="02">Februari</option>
            <option <?=$explode[1]=="03" ? "selected":"";?> value="03">Maret</option>
            <option <?=$explode[1]=="04" ? "selected":"";?> value="04">April</option>
            <option <?=$explode[1]=="05" ? "selected":"";?> value="05">Mei</option>
            <option <?=$explode[1]=="06" ? "selected":"";?> value="06">Juni</option>
            <option <?=$explode[1]=="07" ? "selected":"";?> value="07">Juli</option>
            <option <?=$explode[1]=="08" ? "selected":"";?> value="08">Agustus</option>
            <option <?=$explode[1]=="09" ? "selected":"";?> value="09">September</option>
            <option <?=$explode[1]=="10" ? "selected":"";?> value="10">Oktober</option>
            <option <?=$explode[1]=="11" ? "selected":"";?> value="11">November</option>
            <option <?=$explode[1]=="12" ? "selected":"";?> value="12">Desember</option>
          </select>
        </div>


        <div class="col-4">
          <select  class="form-control form-control-sm" style="color:#495057" name="thn">
            <option value="">--thn--</option>
            <?php
              for ($i=1950; $i <= date("Y") ; $i++) {
                $tahun = $explode[0]==$i ? "selected":"";
                echo '<option '.$tahun.' value="'.$i.'">'.$i.'</option>';
              }
            ?>
          </select>
        </div>


      </div>



    </div>

    <div class="form-group mb-0">
      <div id="tgl"></div>
    </div>

    <div class="form-group mb-0">
      <div id="bln"></div>
    </div>

    <div class="form-group mb-0">
      <div id="thn"></div>
    </div>
  </div>

  <div class="col-sm-12 mt-4">&nbsp;</div>


  <div class="col-sm-6">
    <div class="form-group">
      <label class="label-title" id="provinsi">Provinsi</label>
      <select class="form-control form-control-sm" style="color:#495057" id="get_provinsi" name="provinsi" onchange="loadKabupaten()">
          <option value="">-- pilih provinsi --</option>
          <?php foreach ($provinsi->result() as $prov): ?>
            <option <?=($row->id_provinsi==$prov->id?"selected":"")?> value="<?=$prov->id?>"><?=$prov->name?></option>
          <?php endforeach; ?>
        </select>
    </div>
  </div>

  <div class="col-sm-6">
    <div class="form-group">
      <label class="label-title" id="kabupaten">Kabupaten/Kota</label>
      <select class="form-control kabupaten form-control-sm" style="color:#495057" id="get_kabupaten" name="kabupaten" onChange='loadKecamatan()'>
        <option value="">-- pilih kabupaten/kota --</option>
        <?=tampilkan_wilayah("wil_kabupaten",["province_id"=>$row->id_provinsi],$row->id_kabupaten)?>
      </select>
    </div>
  </div>

  <div class="col-sm-6">
    <div class="form-group">
      <label class="label-title" id="kecamatan">Kecamatan</label>
      <select class="form-control form-control-sm kecamatan" style="color:#495057" id="get_kecamatan" name="kecamatan" onChange='loadKelurahan()'>
          <option value="">-- pilih kecamatan --</option>
          <?=tampilkan_wilayah("wil_kecamatan",["regency_id"=>$row->id_kabupaten],$row->id_kecamatan)?>
        </select>
    </div>
  </div>

  <div class="col-sm-6">
    <div class="form-group">
      <label class="label-title" id="kelurahan">Kelurahan</label>
      <select class="form-control form-control-sm kelurahan" style="color:#495057" id="get_kelurahan" name="kelurahan">
          <option value="">-- pilih kelurahan --</option>
          <?=tampilkan_wilayah("wil_kelurahan",["district_id"=>$row->id_kecamatan],$row->id_kelurahan)?>
        </select>
    </div>
  </div>

  <div class="col-sm-12">
    <div class="form-group">
      <label class="label-title" id="alamat">Keterangan Alamat</label>
      <textarea class="form-control" name="alamat" rows="3" cols="80"><?=$row->alamat?></textarea>
    </div>
  </div>

  </div>




  <a href="<?=site_url("dashboard")?>" class="btn btn-sm btn-secondary text-white"><i class="ti-home"></i></a>
  <button type="submit" id="submit" class="btn btn-sm btn-primary" name="button"><i class="ti-check-box"></i> Simpan & Lanjutkan</button>

  </form>
</div>


<script type="text/javascript">




$("#form").submit(function(e){
  e.preventDefault();
  var me = $(this);
  $("#submit").prop('disabled',true).html('<div class="spinner-border spinner-border-sm text-white"></div> Memproses...');

  $.ajax({
        url             : me.attr('action'),
        type            : 'post',
        data            :  new FormData(this),
        contentType     : false,
        cache           : false,
        dataType        : 'JSON',
        processData     :false,
        success:function(json){
          if (json.success==true) {
              $("#modalGue").modal('hide');
              $('.form-group').removeClass('.has-error')
                              .removeClass('.has');
              $.toast({
                text: json.alert,
                showHideTransition: 'slide',
                icon: 'success',
                loaderBg: '#f96868',
                position: 'top-center',
                afterHidden: function () {
                    window.location.href=json.url;
                }
              });


          }else {
            $("#submit").prop('disabled',false)
                        .html('<i class="ti-check-box"></i> Simpan & Lanjutkan');
            $.each(json.alert, function(key, value) {
              var element = $('#' + key);
              $(element)
              .closest('.form-group')
              .find('.text-danger').remove();
              $(element).after(value);
            });
          }
        }
  });
});


function loadKabupaten()
          {
              var provinsi = $("#get_provinsi").val();
              if (provinsi!="") {
                $.ajax({
                    type:'GET',
                    url:"<?php echo base_url(); ?>front/formulir/kabupaten",
                    data:"id=" + provinsi,
                    success: function(html)
                    {
                       $("#get_kabupaten").html(html);
                       $("#get_kecamatan").html('<option value="">-- Pilih Kecamatan --</option>');
                       $("#get_kelurahan").html('<option value="">-- Pilih Kelurahan/desa --</option>');
                    }
                });
              }else {
                $("#get_kabupaten").html('<option value="">-- Pilih Kabupaten/Kota --</option>');
                $("#get_kecamatan").html('<option value="">-- Pilih Kecamatan --</option>');
                $("#get_kelurahan").html('<option value="">-- Pilih Kelurahan/desa --</option>');
              }
          }

          function loadKecamatan()
            {
                var kabupaten = $("#get_kabupaten").val();
                if (kabupaten!="") {
                  $.ajax({
                      type:'GET',
                      url:"<?php echo base_url(); ?>front/formulir/kecamatan",
                      data:"id=" + kabupaten,
                      success: function(html)
                      {
                          $("#get_kecamatan").html(html);
                          $("#get_kelurahan").html('<option value="">-- Pilih Kelurahan/desa --</option>');
                      }
                  });
                }else {
                  $("#get_kecamatan").html('<option value="">-- Pilih Kecamatan --</option>');
                  $("#get_kelurahan").html('<option value="">-- Pilih Kelurahan/desa --</option>');
                }

            }

            function loadKelurahan()
            {
                var kecamatan = $("#get_kecamatan").val();
                if (kecamatan!="") {
                  $.ajax({
                      type:'GET',
                      url:"<?php echo base_url(); ?>front/formulir/kelurahan",
                      data:"id=" + kecamatan,
                      success: function(html)
                      {
                          $("#get_kelurahan").html(html);
                      }
                  });
                }else {
                  $("#get_kelurahan").html('<option value="">-- Pilih Kelurahan/Desa --</option>');
                }
            }
</script>
