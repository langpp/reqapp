<?=$this->extend('default_layout')?>

<?=$this->section('style')?>
<link href="<?=base_url('assets/plugins/datatables.net-bs4/css/dataTables.bootstrap4.min.css')?>" rel="preload" as="style">
<link href="<?=base_url('assets/plugins/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css')?>" rel="preload" as="style">

<link href="<?=base_url('assets/plugins/datatables.net-bs4/css/dataTables.bootstrap4.min.css')?>" rel="stylesheet">
<link href="<?=base_url('assets/plugins/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css')?>" rel="stylesheet">

<style>
  .nav.nav-tabs .nav-item .nav-link.active, .nav.nav-tabs .nav-item .nav-link:focus, .nav.nav-tabs .nav-item .nav-link:hover {
    border-bottom: 2px solid #1ad1ff;
  }

  .modal {
    overflow-y: auto !important;
  }

  .input-file-container {
    position: relative;
    width: 100%;
  }

  .js .input-file-trigger {
    display: block;
    padding: 45px 5px;
    background: #fff;
    color: rgb(0, 135, 247);
    font-size: 1.2em;
    transition: all .4s;
    width: 100%;
    cursor: pointer;
    border-radius: 5px;
    border: 2px dashed rgb(0, 135, 247) !important;
    text-align: center;
    height: 125px;
  }

  .js .input-file {
    position: absolute;
    top: 0; left: 0;
    width: 100%;
    opacity: 0;
    padding: 14px 0;
    cursor: pointer;
    height: 125px;
  }

  .file-return {
    margin: 0;
  }

  .file-return:not(:empty) {
    margin: 1em 0;
  }

  .js .file-return {
    font-style: italic;
    font-size: .9em;
    font-weight: bold;
  }

  .js .file-return:not(:empty):before {
    content: "";
    font-style: normal;
    font-weight: normal;
  }
</style>
<?=$this->endSection()?>

<?=$this->section('content')?>
<ol class="breadcrumb float-xl-right">
  <li class="breadcrumb-item"><a href="#">Data Master</a></li>
  <li class="breadcrumb-item active">Daftar Kebutuhan</li>
</ol>

<h1 class="page-header">Daftar Kebutuhan <small>Manajemen Data Kebutuhan</small></h1>

<div class="row">

  <div class="col-xl-12">

    <div class="panel panel-inverse" data-sortable-id="index-1">
      <div class="panel-heading">
        <h4 class="panel-title">List Data Kebutuhan</h4>
        <div class="panel-heading-btn">
          <a href="#" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
          <a href="#" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-redo"></i></a>
          <a href="#" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
        </div>
      </div>
      <div class="alert alert-info fade show">
        <span class="close" data-dismiss="alert">×</span>
        <i class="fa fa-info-circle pull-left m-r-10 m-t-3"></i>
        <p class="m-0">Silakan gunakan button di kolom <strong>Action</strong> untuk melakukan instruksi ubah data dan hapus data.</p>
      </div>
      <div class="panel-body">
        <div class="text-center">
          <a href="#mdl-tambah" class="btn btn-info btn-sm" data-toggle="modal"><i class="fa fa-plus"></i> Tambah Data</a>
          <a href="#mdl-upload" class="btn btn-success btn-sm" data-toggle="modal"><i class="fa fa-file"></i> Upload Data</a>
        </div>
        <hr>
        <table id="tbl-daftar-kebutuhan" class="table table-bordered table-striped table-hovered w-100">
          <thead>
            <tr>
              <th width="1%" data-orderable="false">No.</th>
              <th width="1%" data-orderable="false">Foto</th>
              <th>Nama Kebutuhan</th>
              <th>Deskripsi</th>
              <th>Jenis Kebutuhan</th>
              <th>Stok</th>
              <th>Satuan</th>
              <th width="10%" data-orderable="false">Aksi</th>
            </tr>
          </thead>
          <tbody>

          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="mdl-tambah">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Tambah Data Kebutuhan</h4>
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
      </div>
      <form id="form-tambah" enctype="multipart/form-data">
        <div class="modal-body">
          <?php echo csrf_field() ?>
          <div class="appendfieldset">
            <div class="fieldset1" style="padding: 10px;border: 2px solid #00acac;border-radius: 5px;margin-bottom: 20px;}">
              <div class="form-group">
                <label>Pilih Nama Kebutuhan Dari</label>
                <select name="pilihjenis[]" id="changejenis1" onchange="changejenis('1')" class="form-control form-control-sm">
                  <option value="" hidden="">Silahkan Pilih</option>
                  <option value="1">Buat Baru</option>
                  <option value="2">Sudah Tersedia</option>
                </select>
              </div>
              <div class="insertdata" id="insertdata1">
                <div class="row">
                  <div class="col-lg-6">
                   <div class="form-group" id="buatbaru1">
                    <label>Nama Kebutuhan <i class="fa fa-info-circle" title="Contoh: Kertas A4."></i></label>
                    <input name="nama_kebutuhan_i[]" class="form-control form-control-sm" type="text" placeholder="Masukan Nama Kebutuhan">
                  </div>
                  <div class="form-group" id="yangada1">
                    <label>Nama Kebutuhan</label>
                    <select name="nama_kebutuhan_s[]" id="nama_kebutuhan_s1" class="form-control form-control-sm">
                      <option value="" hidden="">Silahkan Pilih</option>
                      <?php if (!empty($kebutuhan)) {foreach ($kebutuhan as $listkebutuhan) {?>
                        <option value="<?php echo $listkebutuhan['kode_kebutuhan'] ?>, <?php echo $listkebutuhan['nama_kebutuhan'] ?>, <?php echo $listkebutuhan['kebutuhan_id'] ?>"><?php echo $listkebutuhan['nama_kebutuhan'] ?></option>
                      <?php }}?>
                    </select>
                  </div>
                </div>
                <div class="col-lg-6">
                  <div class="form-group">
                    <label>Jenis Kebutuhan <i class="fa fa-info-circle" title="Contoh: ATK."></i></label>
                    <select name="kategori_kebutuhan_id[]" id="i_kategori_kebutuhan_id1" class="form-control" required>
                      <option hidden="" value="">Silahkan Pilih</option>
                      <?php if (!empty($kategori_kebutuhan)) {foreach ($kategori_kebutuhan as $list) {?>
                        <option value="<?php echo $list['kategori_kebutuhan_id'] ?>, <?php echo $list['kode_kategori'] ?>"><?php echo $list['nama_kategori'] ?></option>
                      <?php }}?>
                    </select>
                  </div>
                </div>
                <div class="col-lg-4">
                  <div class="form-group">
                    <label>Satuan <i class="fa fa-info-circle" title="Contoh: Rim."></i></label>
                    <input id="i_satuan1" name="satuan[]" class="form-control form-control-sm" type="text" required>
                  </div>
                </div>
                <div class="col-lg-4">
                  <div class="form-group">
                    <label>Stok <i class="fa fa-info-circle" title="Stok Barang"></i></label>
                    <input id="i_stok1" name="stok[]" class="form-control form-control-sm" type="number" required>
                  </div>
                </div>
                <div class="col-lg-4">
                  <div class="form-group">
                    <label>Status <i class="fa fa-info-circle" title="Status Barang"></i></label>
                    <input id="i_status1" name="status[]" class="form-control form-control-sm" type="text" required>
                  </div>
                </div>
                <div class="col-lg-4">
                  <div class="form-group">
                    <label>Harga Satuan <i class="fa fa-info-circle" title="Harga Dalam Rupiah"></i></label>
                    <input id="i_harga1" name="harga[]" class="form-control form-control-sm" type="text" required>
                  </div>
                </div>
                <div class="col-lg-4">
                  <div class="form-group">
                    <label>Tanggal Input <i class="fa fa-info-circle" title="Tanggal Memasukan Barang"></i></label>
                    <input id="i_tanggal1" name="tanggal[]" class="form-control form-control-sm" type="date" required>
                  </div>
                </div>
                <div class="col-lg-4">
                  <div class="form-group">
                    <label>Foto <i class="fa fa-info-circle" title="Contoh: Foto Kebutuhan."></i></label>
                    <input id="i_foto1" name="foto[]" class="form-control form-control-sm" type="file">
                  </div>
                </div>
                <div class="col-lg-12">
                  <div class="form-group">
                    <label>Deskripsi <i class="fa fa-info-circle" title="Contoh: Deskripsi Kebutuhan."></i></label>
                    <textarea class="form-control" name="deskripsi[]" id="i_deskripsi1" cols="30" rows="10" required></textarea>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="text-center">
          <button type="button" class="btn btn-success m-t-3" onclick="addformkebutuhan()">Add Form</button>
        </div>
      </div>
      <div class="modal-footer">
        <a href="#" class="btn btn-white" data-dismiss="modal">Close</a>
        <button type="button" id="btn-simpan" class="btn btn-success">Simpan</button>
      </div>
    </form>
  </div>
</div>
</div>

<div class="modal fade" id="mdl-edit">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Edit Data Kebutuhan</h4>
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
      </div>
      <form id="form-edit" enctype="multipart/form-data">
        <div class="modal-body">
          <?php echo csrf_field() ?>
          <div class="form-group">
            <label>Nama Kebutuhan <i class="fa fa-info-circle" title="Contoh: Kertas A4."></i></label>
            <input id="e_nama_kebutuhan" name="nama_kebutuhan" class="form-control form-control-sm" type="text" required>
            <input id="e_id" name="id" class="form-control form-control-sm" type="hidden" required>
          </div>
          <div class="form-group">
            <label>Deskripsi <i class="fa fa-info-circle" title="Contoh: Deskripsi Kebutuhan."></i></label>
            <textarea class="form-control" name="deskripsi" id="e_deskripsi" cols="30" rows="10" required></textarea>
          </div>
          <div class="form-group">
            <label>Jenis Kebutuhan <i class="fa fa-info-circle" title="Contoh: ATK."></i></label>
            <select name="kategori_kebutuhan_id" id="e_kategori_kebutuhan_id" class="form-control" required>
              <?php foreach ($kategori_kebutuhan as $list) {?>
                <option value="<?php echo $list['kategori_kebutuhan_id'] ?>"><?php echo $list['nama_kategori'] ?></option>
              <?php }?>
            </select>
          </div>
          <div class="form-group">
            <label>Satuan <i class="fa fa-info-circle" title="Contoh: Rim."></i></label>
            <input id="e_satuan" name="satuan" class="form-control form-control-sm" type="text">
          </div>
          <div class="form-group">
            <label>Stok <i class="fa fa-info-circle" title="Stok Barang"></i></label>
            <input id="e_stok" name="stok" class="form-control form-control-sm" type="number" readonly="">
          </div>
          <div class="form-group">
            <label>Status <i class="fa fa-info-circle" title="Status Barang"></i></label>
            <input id="e_status" name="status" class="form-control form-control-sm" type="text">
          </div>
          <div class="form-group">
            <label>Tanggal Input <i class="fa fa-info-circle" title="Tanggal Memasukan Barang"></i></label>
            <input id="e_tanggal" name="tanggal" class="form-control form-control-sm" type="date" required>
          </div>
          <div class="form-group">
            <label>Foto <i class="fa fa-info-circle" title="Contoh: Foto Kebutuhan."></i></label>
            <input id="e_foto" name="foto" class="form-control form-control-sm" type="file">
          </div>
        </div>
        <div class="modal-footer">
          <a href="#" class="btn btn-white" data-dismiss="modal">Close</a>
          <button type="button" id="btn-simpan-edit" class="btn btn-success">Simpan</button>
        </div>
      </form>
    </div>
  </div>
</div>

<div class="modal fade" id="mdl-upload">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Upload Data Kebutuhan</h4>
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
      </div>
      <form method="POST" action="/daftar-kebutuhan/upload" enctype="multipart/form-data">
        <div class="modal-body">
          <?php echo csrf_field() ?>
          <p >File : <span class="file-return"></span> </p>
          <div class="wrap-custom-file">
            <div class="input-file-container">
              <input name="filex" class="input-file" type="file" accept=".xlsx, .xls" required="">
              <label class="input-file-trigger">Select a file...</label>
            </div>
            <div class="text-center">
              <a href="/report/exceltemplate" class="btn btn-outline-primary btn-sm"><i class="fa fa-download"></i> Download Template</a>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <a href="#" class="btn btn-white" data-dismiss="modal">Close</a>
          <button type="submit" class="btn btn-success">Upload</button>
        </div>
      </form>
    </div>
  </div>
</div>

<?=$this->endSection()?>

<?=$this->section('script')?>
<script src="<?=base_url('assets/plugins/datatables.net/js/jquery.dataTables.min.js')?>"></script>
<script src="<?=base_url('assets/plugins/datatables.net-bs4/js/dataTables.bootstrap4.min.js')?>"></script>
<script src="<?=base_url('assets/plugins/datatables.net-responsive/js/dataTables.responsive.min.js')?>"></script>
<script src="<?=base_url('assets/plugins/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js')?>"></script>

<script>
  function addformkebutuhan(){
    var rand = getRandomInteger(1000000,9999999);
    var html = `<div class="fieldset${rand}" style="padding: 10px;border: 2px solid #00acac;border-radius: 5px;margin-bottom: 20px;}"><button type="button" class="btn btn-danger" style="position: relative;float: right;margin-right: -25px;margin-top: -25px;border-radius: 50%;;border-radius: 50%;" onclick="removeformkebutuhan('${rand}')"><i class="fas fa-times"></i></button><div class="form-group"><label>Pilih Nama Kebutuhan Dari</label><select name="pilihjenis[]" onchange="changejenis('${rand}')" id="changejenis${rand}" class="form-control form-control-sm"><option value="" hidden="">Silahkan Pilih</option><option value="1">Buat Baru</option><option value="2">Sudah Tersedia</option></select></div><div class="insertdata" id="insertdata${rand}"><div class="row"><div class="col-lg-6"><div class="form-group" id="buatbaru${rand}"><label>Nama Kebutuhan <i class="fa fa-info-circle" title="Contoh: Kertas A4."></i></label><input name="nama_kebutuhan_i[]" class="form-control form-control-sm" type="text" placeholder="Masukan Nama Kebutuhan"></div><div class="form-group" id="yangada${rand}"><label>Nama Kebutuhan</label><select name="nama_kebutuhan_s[]" id="nama_kebutuhan_s${rand}" class="form-control form-control-sm"> <option value="" hidden="">Silahkan Pilih</option></select></div></div><div class="col-lg-6"><div class="form-group"><label>Jenis Kebutuhan <i class="fa fa-info-circle" title="Contoh: ATK."></i></label><select name="kategori_kebutuhan_id[]" id="i_kategori_kebutuhan_id${rand}" class="form-control" required><option hidden="" value="">Silahkan Pilih</option></select></div></div><div class="col-lg-4"><div class="form-group"><label>Satuan <i class="fa fa-info-circle" title="Contoh: Rim."></i></label><input id="i_satuan${rand}" name="satuan[]" class="form-control form-control-sm" type="text" required></div></div><div class="col-lg-4"><div class="form-group"><label>Stok <i class="fa fa-info-circle" title="Stok Barang"></i></label><input id="i_stok${rand}" name="stok[]" class="form-control form-control-sm" type="number" required></div></div><div class="col-lg-4"><div class="form-group"><label>Status <i class="fa fa-info-circle" title="Status Barang"></i></label><input id="i_status${rand}" name="status[]" class="form-control form-control-sm" type="text" required></div></div><div class="col-lg-4"><div class="form-group"><label>Harga Satuan <i class="fa fa-info-circle" title="Harga Dalam Rupiah"></i></label><input id="i_harga${rand}" name="harga[]" class="form-control form-control-sm" type="text" required></div></div><div class="col-lg-4"><div class="form-group"><label>Tanggal Input <i class="fa fa-info-circle" title="Tanggal Memasukan Barang"></i></label><input id="i_tanggal${rand}" name="tanggal[]" class="form-control form-control-sm" type="date" required></div></div><div class="col-lg-4"><div class="form-group"><label>Foto <i class="fa fa-info-circle" title="Contoh: Foto Kebutuhan."></i></label><input id="i_foto${rand}" name="foto[]" class="form-control form-control-sm" type="file"></div></div><div class="col-lg-12"><div class="form-group"><label>Deskripsi <i class="fa fa-info-circle" title="Contoh: Deskripsi Kebutuhan."></i></label><textarea class="form-control" name="deskripsi[]" id="i_deskripsi${rand}" cols="30" rows="10" required></textarea></div></div></div></div></div>`;
    $(".appendfieldset").append(html);
    $("#insertdata" + rand).hide();

    ajaxnamakebutuhan(rand);
    ajaxjeniskebutuhan(rand);
  }

  function removeformkebutuhan(uid){
    $(".fieldset"+uid).remove();
  }

  function getRandomInteger(min, max) {
    min = Math.ceil(min);
    max = Math.floor(max);
    return Math.floor(Math.random() * (max - min)) + min;
  }
  function changejenis(arr){
    if ($("#changejenis"+arr).val() !== "") {
      if ($("#changejenis"+arr).val() == "1") {
        $("#buatbaru" + arr).show();
        $("#yangada" + arr).hide();
        $("#insertdata" + arr).show();
      }else{
        $("#buatbaru" + arr).hide();
        $("#yangada" + arr).show();
        $("#insertdata" + arr).show();
      }
    }else{
      $("#insertdata" + arr).hide();
    }
  }

  function ajaxnamakebutuhan(arr){
    var html = "";
    const url = `http://${window.location.host}`;
    $.ajax({
      type: "GET",
      url: `${url}/daftar-kebutuhan/getAllKebutuhan`,
      data: {
      },
      dataType: "json",
      success: function(data) {
        var html = '<option value="" hidden="">Silahkan Pilih</option>';
        console.log(data);
        $.each(data, function(index, val){
          html += `<option value="${val['kode_kebutuhan']}, ${val['nama_kebutuhan']}, ${val['kebutuhan_id']}">${val['nama_kebutuhan']}</option>`;
        });
        $("#nama_kebutuhan_s" + arr).html(html);
      }
    });
  }

  function ajaxjeniskebutuhan(arr){
    var html = "";
    const url = `http://${window.location.host}`;
    $.ajax({
      type: "GET",
      url: `${url}/daftar-kebutuhan/getAllKategori`,
      data: {
      },
      dataType: "json",
      success: function(data) {
        var html = '<option value="" hidden="">Silahkan Pilih</option>';
        console.log(data);
        $.each(data, function(index, val){
          html += `<option value="${val['kategori_kebutuhan_id']}, ${val['kode_kategori']}">${val['nama_kategori']}</option>`;
        });
        $("#i_kategori_kebutuhan_id" + arr).html(html);
      }
    });
  }
  $(function() {
    $(".insertdata").hide();
    document.querySelector("html").classList.add('js');

    $('.input-file-trigger').off('click').on('click', function () {
      if (event.keyCode == 13 || event.keyCode == 32) {
        $(this).prev().focus();
      }
    });

    $('.input-file-trigger').off('click').on('click', function () {
      $(this).prev().focus();
      return false;
    });

    $('.input-file').off('change').on('change', function () {
      if (this.files && this.files[0] && (this.files[0].name.substr((this.files[0].name.lastIndexOf('.')+1)).toLowerCase() == 'xlsx' || this.files[0].name.substr((this.files[0].name.lastIndexOf('.')+1)).toLowerCase() == 'xls' ) )  {
        $(this).parent().parent().prev().html(this.value);
        $(this).next().html(this.value);
      } else {
        $(this).val('');
        toastr.error("Hanya File Excel Yang Diizinkan !", "Error", {"timeOut": "1000","extendedTImeout": "1000"});
        $(this).parent().parent().prev().html('');
        $(this).next().html("Select a file...");
      };
    });
    const url = `http://${window.location.host}`;
    let html = "";

    const tbldaftarkebutuhan = $('#tbl-daftar-kebutuhan').DataTable({
      responsive: true,
      processing: true,
      serverSide: true,
      order: [],
      ajax: {
        url: `${url}/daftar-kebutuhan/list`,
        type: "GET"
      },
      language: {
        emptyTable: `<img src="<?=base_url('assets/img/app/emptydata.svg')?>" width="150"><br><br><b>Data belum tersedia.</b>`
      }
    });

    // * Get Data for Edit
    $("#tbl-daftar-kebutuhan tbody").on("click", ".edit", function() {
      let id = $(this).data('id');

      $("#mdl-edit").modal('show');

      html = "";

      $.ajax({
        type: "GET",
        url: `${url}/daftar-kebutuhan/get-by-id`,
        data: {
          id: id
        },
        dataType: "json",
        success: function(data) {
          $("#e_nama_kebutuhan").val(data.nama_kebutuhan);
          $("#e_deskripsi").text(data.deskripsi);
          $("#e_kategori_kebutuhan_id").val(data.kategori_kebutuhan_id);
          $("#e_id").val(data.kebutuhan_id);
          $("#e_satuan").val(data.satuan);
          $("#e_stok").val(data.stok);
          $("#e_status").val(data.status);
          $("#e_tanggal").val(formatDate(data.created_at));
        }
      });
    });

    function formatDate(date) {
      var d = new Date(date),
      month = '' + (d.getMonth() + 1),
      day = '' + d.getDate(),
      year = d.getFullYear();

      if (month.length < 2) 
        month = '0' + month;
      if (day.length < 2) 
        day = '0' + day;

      return [year, month, day].join('-');
    }

    //* Delete
    $("#tbl-daftar-kebutuhan tbody").on("click", ".delete", function() {
      let id = $(this).data('id');

      Swal.fire({
        title: 'Apakah Anda yakin untuk menghapus data ini?',
        text: "Data yang telah dihapus tidak dapat dikembalikan!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#FF2924',
        cancelButtonColor: '#2B9FC1',
        confirmButtonText: 'Ya',
        cancelButtonText: 'Batal'
      }).then((result) => {
        if (result.value) {
          let formdata = new FormData();
          formdata.append('id', id);
          formdata.append('<?php echo csrf_token() ?>', '<?php echo csrf_hash(); ?>');

          $.ajax({
            type: "POST",
            url: "/daftar-kebutuhan/delete",
            data: formdata,
            processData: false,
            contentType: false,
            dataType: "text",
            success: function(data, textStatus, jqXHR) {
              if (data) {
                Swal.fire(
                  'Berhasil Dihapus!',
                  'Data Anda berhasil terhapus dari sistem.',
                  'success'
                  )

                tbldaftarkebutuhan.ajax.reload();
              } else {
                Swal.fire(
                  'Data Gagal Dihapus!',
                  'Terjadi masalah pada sistem saat data dihapus.',
                  'error'
                  )

                tbldaftarkebutuhan.ajax.reload();
              }
            },
            error: function(data, textStatus, jqXHR) {
              if (jqXHR.status == 500 || jqXHR.status == 0) {
                Swal.fire(
                  'Data Gagal Dihapus!',
                  'Terjadi masalah pada sistem saat data dihapus.',
                  'error'
                  )
              }
            },
          });
        }
      })
    });

    //* Insert
    $("#btn-simpan").on("click", function(e) {
      e.preventDefault();

      if ($("#form-tambah")[0].reportValidity()) {
        let formdata = new FormData($("#form-tambah")[0]);

        $.ajax({
          type: "POST",
          url: "/daftar-kebutuhan/insert",
          data: formdata,
          processData: false,
          contentType: false,
          dataType: "text",
          success: function(data, textStatus, jqXHR) {
            $("#mdl-tambah").modal('hide');

            if (data) {
              Swal.fire(
                'Data Berhasil Tersimpan!',
                'Data daftar kebutuhan berhasil tersimpan ke dalam sistem.',
                'success'
                )

              tbldaftarkebutuhan.ajax.reload();
            } else {
              Swal.fire(
                'Data Gagal Tersimpan!',
                'Terjadi masalah pada sistem saat penginputan data.',
                'error'
                )

              tbldaftarkebutuhan.ajax.reload();
            }
          },
          error: function(data, textStatus, jqXHR) {
            if (jqXHR.status == 500 || jqXHR.status == 0) {
              Swal.fire(
                'Data Gagal Tersimpan!',
                'Terjadi masalah pada sistem saat penginputan data.',
                'error'
                )
            }
          },
        });
      }
    });

    // * Edit
    $("#btn-simpan-edit").on("click", function(e) {
      e.preventDefault();

      if ($("#form-edit")[0].reportValidity()) {
        let formdata = new FormData($("#form-edit")[0]);

        $.ajax({
          type: "POST",
          url: "/daftar-kebutuhan/edit",
          data: formdata,
          processData: false,
          contentType: false,
          dataType: "text",
          success: function(data, textStatus, jqXHR) {
            $("#mdl-edit").modal('hide');

            if (data) {
              Swal.fire(
                'Data Berhasil Tersimpan!',
                'Data daftar kebutuhan berhasil tersimpan ke dalam sistem.',
                'success'
                )

              tbldaftarkebutuhan.ajax.reload();
            } else {
              Swal.fire(
                'Data Gagal Tersimpan!',
                'Terjadi masalah pada sistem saat penginputan data.',
                'error'
                )

              tbldaftarkebutuhan.ajax.reload();
            }
          },
          error: function(data, textStatus, jqXHR) {
            if (jqXHR.status == 500 || jqXHR.status == 0) {
              Swal.fire(
                'Data Gagal Tersimpan!',
                'Terjadi masalah pada sistem saat penginputan data.',
                'error'
                )
            }
          },
        });
      }
    });
  });
</script>
<?=$this->endSection()?>