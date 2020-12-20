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
  <li class="breadcrumb-item"><a href="#">Data Master</a></li>
  <li class="breadcrumb-item active">Kategori Kebutuhan</li>
</ol>

<h1 class="page-header">Kategori Kebutuhan <small>Manajemen Data Kategori Kebutuhan</small></h1>

<div class="row">

  <div class="col-xl-12">

    <div class="panel panel-inverse" data-sortable-id="index-1">
      <div class="panel-heading">
        <h4 class="panel-title">List Data Kategori Kebutuhan</h4>
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
        </div>
        <hr>
        <table id="tbl-kategori-kebutuhan" class="table table-bordered table-striped table-hovered w-100">
          <thead>
            <tr>
              <th width="1%" data-orderable="false">No.</th>
              <th width="1%" data-orderable="false">Icon</th>
              <th>Kategori Kebutuhan</th>
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
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Tambah Data Kategori Kebutuhan</h4>
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
      </div>
      <form id="form-tambah" enctype="multipart/form-data">
        <div class="modal-body">
          <?php echo csrf_field() ?>
          <div class="form-group">
            <label>Kategori Kebutuhan <i class="fa fa-info-circle" title="Contoh: Rumah Tangga."></i></label>
            <input id="i_kategori_kebutuhan" name="kategori_kebutuhan" class="form-control form-control-sm" type="text" required>
          </div>
          <div class="form-group">
            <label>Icon <i class="fa fa-info-circle" title="Contoh: fa fa-box."></i></label>
            <input id="i_icon" name="icon" class="form-control form-control-sm" type="text" required>
            <span style="font-size: 10px">Lihat contoh icon <a href="https://fontawesome.com/icons?d=gallery" target="_blank">di sini</a>.</span>
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
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Edit Data Kategori Kebutuhan</h4>
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
      </div>
      <form id="form-edit" enctype="multipart/form-data">
        <div class="modal-body">
          <?php echo csrf_field() ?>

          <div class="form-group">
            <label>Kategori Kebutuhan <i class="fa fa-info-circle" title="Contoh: Rumah Tangga."></i></label>
            <input id="e_kategori_kebutuhan" name="kategori_kebutuhan" class="form-control form-control-sm" type="text" required>
            <input id="e_id" name="id" class="form-control form-control-sm" type="hidden">
          </div>
          <div class="form-group">
            <label>Icon <i class="fa fa-info-circle" title="Contoh: fa fa-box."></i></label>
            <input id="e_icon" name="icon" class="form-control form-control-sm" type="text" required>
            <span style="font-size: 10px">Lihat contoh icon <a href="https://fontawesome.com/icons?d=gallery" target="_blank">di sini</a>.</span>
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
    const url = `http://${window.location.host}`;
    let html = "";

    const tblkategorikebutuhan = $('#tbl-kategori-kebutuhan').DataTable({
      responsive: true,
      processing: true,
      serverSide: true,
      order: [],
      ajax: {
        url: `${url}/kategori-kebutuhan/list`,
        type: "GET"
      },
      language: {
        emptyTable: `<img src="<?=base_url('assets/img/app/emptydata.svg')?>" width="150"><br><br><b>Data belum tersedia.</b>`
      }
    });

    // * Get Data for Edit
    $("#tbl-kategori-kebutuhan tbody").on("click", ".edit", function() {
      let id = $(this).data('id');

      $("#mdl-edit").modal('show');

      html = "";

      $.ajax({
        type: "GET",
        url: `${url}/kategori-kebutuhan/get-by-id`,
        data: {
          id: id
        },
        dataType: "json",
        success: function(data) {
          $("#e_kategori_kebutuhan").val(data.nama_kategori);
          $("#e_icon").val(data.icon);
          $("#e_id").val(data.kategori_kebutuhan_id);
        }
      });
    });

    //* Delete
    $("#tbl-kategori-kebutuhan tbody").on("click", ".delete", function() {
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
            url: "/kategori-kebutuhan/delete",
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

                tblkategorikebutuhan.ajax.reload();
              } else {
                Swal.fire(
                  'Data Gagal Dihapus!',
                  'Terjadi masalah pada sistem saat data dihapus.',
                  'error'
                )

                tblkategorikebutuhan.ajax.reload();
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
          url: "/kategori-kebutuhan/insert",
          data: formdata,
          processData: false,
          contentType: false,
          dataType: "text",
          success: function(data, textStatus, jqXHR) {
            $("#mdl-tambah").modal('hide');

            if (data) {
              Swal.fire(
                'Data Berhasil Tersimpan!',
                'Data kategori kebutuhan berhasil tersimpan ke dalam sistem.',
                'success'
              )

              tblkategorikebutuhan.ajax.reload();
            } else {
              Swal.fire(
                'Data Gagal Tersimpan!',
                'Terjadi masalah pada sistem saat penginputan data.',
                'error'
              )

              tblkategorikebutuhan.ajax.reload();
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
          url: "/kategori-kebutuhan/edit",
          data: formdata,
          processData: false,
          contentType: false,
          dataType: "text",
          success: function(data, textStatus, jqXHR) {
            $("#mdl-edit").modal('hide');

            if (data) {
              Swal.fire(
                'Data Berhasil Tersimpan!',
                'Data kategori kebutuhan berhasil tersimpan ke dalam sistem.',
                'success'
              )

              tblkategorikebutuhan.ajax.reload();
            } else {
              Swal.fire(
                'Data Gagal Tersimpan!',
                'Terjadi masalah pada sistem saat penginputan data.',
                'error'
              )

              tblkategorikebutuhan.ajax.reload();
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