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
</style>
<?=$this->endSection()?>

<?=$this->section('content')?>
<ol class="breadcrumb float-xl-right">
  <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
  <li class="breadcrumb-item active">Report</li>
</ol>

<h1 class="page-header">Laporan <small>Manajemen Data Kebutuhan</small></h1>
<div class="row">
  <div class="col-xl-6 col-md-6">
    <div class="widget widget-stats bg-blue">
      <div class="stats-icon"><i class="fa fa-download"></i></div>
      <div class="stats-info">
        <h4>Download</h4>
        <p>Laporan Kebutuhan</p>
      </div>
      <div class="stats-link">
        <a href="/report/kebutuhan">Download Disini <i class="fa fa-arrow-alt-circle-right"></i></a>
      </div>
    </div>
  </div>

  <div class="col-xl-6 col-md-6">
    <div class="widget widget-stats bg-red">
      <div class="stats-icon"><i class="fa fa-download"></i></div>
      <div class="stats-info">
        <h4>Download</h4>
        <p>Laporan History Kebutuhan</p>
      </div>
      <div class="stats-link">
        <a href="/report/kebutuhanhistory">Download Disini <i class="fa fa-arrow-alt-circle-right"></i></a>
      </div>
    </div>
  </div>

  <div class="col-xl-6 col-md-6">
    <div class="widget widget-stats bg-info">
      <div class="stats-icon"><i class="fa fa-download"></i></div>
      <div class="stats-info">
        <h4>Download</h4>
        <p>Laporan Transaksi</p>
      </div>
      <div class="stats-link">
        <a href="/report/transaksi"modal">Download Disini <i class="fa fa-arrow-alt-circle-right"></i></a>
      </div>
    </div>
  </div>

  <div class="col-xl-6 col-md-6">
    <div class="widget widget-stats bg-orange">
      <div class="stats-icon"><i class="fa fa-download"></i></div>
      <div class="stats-info">
        <h4>Download</h4>
        <p>Template Upload</p>
      </div>
      <div class="stats-link">
        <a href="/report/exceltemplate">Download Disini <i class="fa fa-arrow-alt-circle-right"></i></a>
      </div>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-lg-12">
    <div class="panel panel-inverse" data-sortable-id="index-5">
      <div class="panel-heading">
        <h4 class="panel-title">Penjelasan</h4>
        <div class="panel-heading-btn">
          <a href="#" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
          <a href="#" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-redo"></i></a>
          <a href="#" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
          <a href="#" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
        </div>
      </div>
      <div class="panel-body">
        <div class="height-sm" data-scrollbar="true">
          <ul class="media-list media-list-with-divider media-messaging">
            <li class="media media-sm">
              <div class="media-body">
                <h5 class="media-heading">Download Laporan Kebutuhan</h5>
                <p>Laporan kebutuhan adalah simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum</p>
              </div>
            </li>
            <li class="media media-sm">
              <div class="media-body">
                <h5 class="media-heading">Download Laporan Transaksi</h5>
                <p>Laporan Transaksi adalah simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum</p>
              </div>
            </li>
            <li class="media media-sm">
              <div class="media-body">
                <h5 class="media-heading">Download Template Upload</h5>
                <p>Template Upload adalah simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum</p>
              </div>
            </li>
          </div>
        </div>
      </div>
      <?=$this->endSection()?>

      <?=$this->section('script')?>
      <script src="<?=base_url('assets/plugins/datatables.net/js/jquery.dataTables.min.js')?>"></script>
      <script src="<?=base_url('assets/plugins/datatables.net-bs4/js/dataTables.bootstrap4.min.js')?>"></script>
      <script src="<?=base_url('assets/plugins/datatables.net-responsive/js/dataTables.responsive.min.js')?>"></script>
      <script src="<?=base_url('assets/plugins/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js')?>"></script>

      <?=$this->endSection()?>