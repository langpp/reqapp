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
  <li class="breadcrumb-item active">Permintaan Masuk</li>
</ol>

<h1 class="page-header">Permintaan Masuk <small>List Data Permintaan Masuk</small></h1>

<div class="row">

  <div class="col-xl-12">

    <div class="panel panel-inverse" data-sortable-id="index-1">
      <div class="panel-heading">
        <h4 class="panel-title">List Permintaan Masuk</h4>
        <div class="panel-heading-btn">
          <a href="#" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
          <a href="#" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-redo"></i></a>
          <a href="#" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
        </div>
      </div>
      <div class="alert alert-info fade show">
        <span class="close" data-dismiss="alert">×</span>
        <i class="fa fa-info-circle pull-left m-r-10 m-t-3"></i>
        <p class="m-0">Silakan gunakan button di kolom <strong>Action</strong> untuk melihat detail data dan mengupdate data.</p>
      </div>
      <div class="panel-body">
        <table id="tbl-permintaan-masuk" class="table table-bordered table-striped table-hovered w-100">
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

<div class="modal fade" id="mdl-edit">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Edit Status Permintaan Masuk</h4>
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
      </div>
      <form id="form-edit" enctype="multipart/form-data">
        <div class="modal-body">
          <?php echo csrf_field() ?>
          <div class="form-group">
            <label>Order ID</label>
            <input id="e_id" name="order_id" class="form-control form-control-sm" type="text" readonly required>
            <input id="id" name="id" class="form-control form-control-sm" type="hidden" readonly required>
          </div>
          <div class="form-group">
            <label>Tanggal Order</label>
            <input id="e_tanggal" name="tanggal" class="form-control form-control-sm" type="text" readonly>
          </div>
          <div class="form-group">
            <label>Nama User</label>
            <input id="e_user" name="nama" class="form-control form-control-sm" type="text" readonly>
          </div>
          <div class="form-group">
            <label>Status</label>
            <select name="status" id="e_status" class="form-control" required>
              <option value="">-Pilih-</option>
              <option value="2">Permintaan Diproses</option>
              <option value="4">Permintaan Ditolak</option>
            </select>
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

<?=$this->endSection()?>

<?=$this->section('script')?>
<script src="<?=base_url('assets/plugins/datatables.net/js/jquery.dataTables.min.js')?>"></script>
<script src="<?=base_url('assets/plugins/datatables.net-bs4/js/dataTables.bootstrap4.min.js')?>"></script>
<script src="<?=base_url('assets/plugins/datatables.net-responsive/js/dataTables.responsive.min.js')?>"></script>
<script src="<?=base_url('assets/plugins/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js')?>"></script>

<script>
  $(function() {
    const url = `https://${window.location.host}`;
    let html = "";

    const datatable = $('#tbl-permintaan-masuk').DataTable({
      responsive: true,
      processing: true,
      serverSide: true,
      order: [],
      ajax: {
        url: `${url}/permintaan-masuk/list`,
        type: "GET"
      },
      language: {
        emptyTable: `<img src="<?=base_url('assets/img/app/emptydata.svg')?>" width="150"><br><br><b>Data belum tersedia.</b>`
      }
    });

    // * Get Data for Edit
    $("#tbl-permintaan-masuk tbody").on("click", ".edit", function() {
      let id = $(this).data('id');

      $("#mdl-edit").modal('show');

      html = "";

      $.ajax({
        type: "GET",
        url: `${url}/permintaan-masuk/get-by-id`,
        data: {
          id: id
        },
        dataType: "json",
        success: function(data) {
          $("#e_user").val(data.nama_dinas);
          $("#e_id").val(data.order_id);
          $("#id").val(data.transaksi_id);
          $("#e_tanggal").val(data.created_at);
        }
      });
    });

    // * Edit
    $("#btn-simpan-edit").on("click", function(e) {
      e.preventDefault();

      if ($("#form-edit")[0].reportValidity()) {
        let formdata = new FormData($("#form-edit")[0]);

        $.ajax({
          type: "POST",
          url: "/permintaan-masuk/edit",
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

              datatable.ajax.reload();
            } else {
              Swal.fire(
                'Data Gagal Tersimpan!',
                'Terjadi masalah pada sistem saat penginputan data.',
                'error'
              )

              datatable.ajax.reload();
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