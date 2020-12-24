<?=$this->extend('default_layout')?>

<?=$this->section('style')?>
<link href="<?=base_url('assets/plugins/datatables.net-bs4/css/dataTables.bootstrap4.min.css')?>" rel="preload" as="style">
<link href="<?=base_url('assets/plugins/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css')?>" rel="preload" as="style">

<link href="<?=base_url('assets/plugins/datatables.net-bs4/css/dataTables.bootstrap4.min.css')?>" rel="stylesheet">
<link href="<?=base_url('assets/plugins/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css')?>" rel="stylesheet">

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
<?=$this->endSection()?>

<?=$this->section('content')?>
<ol class="breadcrumb float-xl-right">
  <li class="breadcrumb-item"><a href="#">Data Permintaan</a></li>
  <li class="breadcrumb-item"><?=$judul?></li>
  <li class="breadcrumb-item active">Detail</li>
</ol>

<h1 class="page-header"><?=$judul?> <small>Detail Data <?=$judul?></small></h1>

<div class="row">

  <div class="col-xl-12">

    <div class="panel panel-inverse" data-sortable-id="index-1">
      <div class="panel-heading">
        <h4 class="panel-title">Detail <?=$judul?></h4>
        <div class="panel-heading-btn">
          <a href="#" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
          <a href="#" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-redo"></i></a>
          <a href="#" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
        </div>
      </div>
      <div class="panel-body">
        <table class="table table-bordered table-striped table-hovered w-100">
          <tbody>
            <tr>
              <td width="30%">Order ID</td>
              <td><?=$permintaan[0]->order_id?></td>
            </tr>
            <tr>
              <td width="30%">Tanggal Pesan</td>
              <td><?=strftime("%d %B %Y %H:%M", strtotime($permintaan[0]->created_at));?></td>
            </tr>
            <tr>
              <td width="30%">Nama User</td>
              <td><?=$permintaan[0]->nama_dinas?></td>
            </tr>
          </tbody>
        </table>
        <table id="tbl-permintaan" class="table table-bordered table-striped table-hovered w-100">
          <thead>
            <tr>
              <th width="1%" data-orderable="false">No.</th>
              <th width="20%" data-orderable="false">Nama Kebutuhan</th>
              <th width="20%">Jumlah</th>
            </tr>
          </thead>
          <tbody>
            <?php
$no = 1;
foreach ($permintaan as $data) {
    ?>
              <tr>
                <td><?=$no?></td>
                <td><?=$data->nama_kebutuhan?></td>
                <td><?=$data->jumlah_transaksi?></td>
              </tr>
            <?php
$no++;
}
?>
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

<script>
  $(function() {
    // const url = `https://${window.location.host}`;
    // let html = "";

    // const datatable = $('#tbl-permintaan-selesai').DataTable({
    //   responsive: true,
    //   processing: true,
    //   serverSide: true,
    //   order: [],
    //   ajax: {
    //     url: `${url}/permintaan-selesai/list`,
    //     type: "GET"
    //   },
    //   language: {
    //     emptyTable: `<img src="<?=base_url('assets/img/app/emptydata.svg')?>" width="150"><br><br><b>Data belum tersedia.</b>`
    //   }
    // });


  });
</script>
<?=$this->endSection()?>