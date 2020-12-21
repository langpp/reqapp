<?= $this->extend('default_layout') ?>

<?= $this->section('style') ?>
<link href="<?= base_url('assets/plugins/datatables.net-bs4/css/dataTables.bootstrap4.min.css') ?>" rel="preload" as="style">
<link href="<?= base_url('assets/plugins/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css') ?>" rel="preload" as="style">

<link href="<?= base_url('assets/plugins/datatables.net-bs4/css/dataTables.bootstrap4.min.css') ?>" rel="stylesheet">
<link href="<?= base_url('assets/plugins/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css') ?>" rel="stylesheet">

<style>
  .nav.nav-tabs .nav-item .nav-link.active,
  .nav.nav-tabs .nav-item .nav-link:focus,
  .nav.nav-tabs .nav-item .nav-link:hover {
    border-bottom: 2px solid #1ad1ff;
  }

  .modal {
    overflow-y: auto !important;
  }
</style>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<ol class="breadcrumb float-xl-right">
  <li class="breadcrumb-item"><a href="#">Data Permintaan</a></li>
  <li class="breadcrumb-item active">Permintaan Ditolak</li>
</ol>

<h1 class="page-header">Permintaan Ditolak <small>List Data Permintaan Ditolak</small></h1>

<div class="row">

  <div class="col-xl-12">

    <div class="panel panel-inverse" data-sortable-id="index-1">
      <div class="panel-heading">
        <h4 class="panel-title">List Permintaan Ditolak</h4>
        <div class="panel-heading-btn">
          <a href="#" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
          <a href="#" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-redo"></i></a>
          <a href="#" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
        </div>
      </div>
      <div class="alert alert-info fade show">
        <span class="close" data-dismiss="alert">×</span>
        <i class="fa fa-info-circle pull-left m-r-10 m-t-3"></i>
        <p class="m-0">Silakan gunakan button di kolom <strong>Action</strong> untuk melihat detail data.</p>
      </div>
      <div class="panel-body">
        <table id="tbl-permintaan-ditolak" class="table table-bordered table-striped table-hovered w-100">
          <thead>
            <tr>
              <th width="1%" data-orderable="false">No.</th>
              <th width="20%" data-orderable="false">Tanggal</th>
              <th width="20%" data-orderable="false">Order ID</th>
              <th>Nama User </th>
              <th width="30%" data-orderable="false">Aksi</th>
            </tr>
          </thead>
          <tbody>

          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('script') ?>
<script src="<?= base_url('assets/plugins/datatables.net/js/jquery.dataTables.min.js') ?>"></script>
<script src="<?= base_url('assets/plugins/datatables.net-bs4/js/dataTables.bootstrap4.min.js') ?>"></script>
<script src="<?= base_url('assets/plugins/datatables.net-responsive/js/dataTables.responsive.min.js') ?>"></script>
<script src="<?= base_url('assets/plugins/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js') ?>"></script>

<script>
  $(function() {
    const url = `http://${window.location.host}`;
    let html = "";

    const datatable = $('#tbl-permintaan-ditolak').DataTable({
      responsive: true,
      processing: true,
      serverSide: true,
      order: [],
      ajax: {
        url: `${url}/permintaan-ditolak/list`,
        type: "GET"
      },
      language: {
        emptyTable: `<img src="<?= base_url('assets/img/app/emptydata.svg') ?>" width="150"><br><br><b>Data belum tersedia.</b>`
      }
    });


  });
</script>
<?= $this->endSection() ?>