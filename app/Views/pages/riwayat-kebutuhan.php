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
  <li class="breadcrumb-item active">Riwayat Kebutuhan</li>
</ol>

<h1 class="page-header">Riwayat Kebutuhan <small>Manajemen Data Kebutuhan</small></h1>

<div class="row">

  <div class="col-xl-12">

    <div class="panel panel-inverse" data-sortable-id="index-1">
      <div class="panel-heading">
        <h4 class="panel-title">List Data Riwayat Kebutuhan</h4>
        <div class="panel-heading-btn">
          <a href="#" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
          <a href="#" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-redo"></i></a>
          <a href="#" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
        </div>
      </div>
      <div class="panel-body">
        <hr>
        <table id="tbl-daftar-kebutuhan" class="table table-bordered table-striped table-hovered w-100">
          <thead>
            <tr>
              <th width="1%" data-orderable="false">No.</th>
              <th>Nama Kebutuhan</th>
              <th>Deskripsi</th>
              <th>Jenis Kebutuhan</th>
              <th>Stok</th>
              <th>Satuan</th>
              <th>Harga</th>
            </tr>
          </thead>
          <tbody>

          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<?=$this->endSection()?>

<?=$this->section('script')?>
<script src="<?=base_url('assets/plugins/datatables.net/js/jquery.dataTables.min.js')?>"></script>
<script src="<?=base_url('assets/plugins/datatables.net-bs4/js/dataTables.bootstrap4.min.js')?>"></script>
<script src="<?=base_url('assets/plugins/datatables.net-responsive/js/dataTables.responsive.min.js')?>"></script>
<script src="<?=base_url('assets/plugins/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js')?>"></script>

<script type="text/javascript">
  $(document).ready(function(){
    const url = `http://${window.location.host}`;
    let html = "";

    const tbldaftarkebutuhan = $('#tbl-daftar-kebutuhan').DataTable({
      responsive: true,
      processing: true,
      serverSide: true,
      order: [],
      ajax: {
        url: `${url}/daftar-kebutuhan/list-riwayat`,
        type: "GET"
      },
      language: {
        emptyTable: `<img src="<?=base_url('assets/img/app/emptydata.svg')?>" width="150"><br><br><b>Data belum tersedia.</b>`
      }
    });
  });
</script>
<?=$this->endSection()?>