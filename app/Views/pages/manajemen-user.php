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
  <li class="breadcrumb-item active"><a href="#">Manajemen User</a></li>
</ol>

<h1 class="page-header">Manajemen User <small>Manajemen Data User</small></h1>

<div class="row">

  <div class="col-xl-12">

    <div class="panel panel-inverse" data-sortable-id="index-1">
      <div class="panel-heading">
        <h4 class="panel-title">List Data User</h4>
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
        <table id="tbl-manajemen-user" class="table table-bordered table-striped table-hovered w-100">
          <thead>
            <tr>
              <th width="1%" data-orderable="false">No.</th>
              <th>Nama Dinas</th>
              <th>Alamat Dinas</th>
              <th>Nomor Telepon</th>
              <th>E-mail</th>
              <th>Hak Akses</th>
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
        <h4 class="modal-title">Tambah Data User</h4>
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
      </div>
      <form id="form-tambah" enctype="multipart/form-data">
        <div class="modal-body">
          <?php echo csrf_field() ?>
          <div class="form-group">
            <label>Nama Dinas <i class="fa fa-info-circle" title="Contoh: Rumah Dinas Bupati."></i></label>
            <input id="i_nama_dinas" name="nama_dinas" class="form-control form-control-sm" type="text" required>
          </div>
          <div class="form-group">
            <label>Alamat Dinas <i class="fa fa-info-circle" title="Contoh: Jl. Ganda Negara No.11A, Nagri Kidul, Kec. Purwakarta, Kabupaten Purwakarta, Jawa Barat 41111."></i></label>
            <textarea name="alamat_dinas" id="i_alamat_dinas" cols="30" rows="10" class="form-control form-control-sm"></textarea>
          </div>
          <div class="form-group">
            <label>Nomor Telepon <i class="fa fa-info-circle" title="Contoh: (0264) 206654."></i></label>
            <input id="i_nomor_telepon" name="nomor_telepon" class="form-control form-control-sm" type="text" required>
          </div>
          <div class="form-group">
            <label>E-mail <i class="fa fa-info-circle" title="Contoh: example@domain.com."></i></label>
            <input id="i_email" name="email" class="form-control form-control-sm" type="email" required>
          </div>
          <div class="form-group">
            <label>Password <i class="fa fa-info-circle" title="Contoh: *****."></i></label>
            <input id="i_password" name="password" class="form-control form-control-sm" type="password" required>
          </div>
          <div class="form-group">
            <label>Hak Akses <i class="fa fa-info-circle" title="Contoh: Rumah Dinas Bupati."></i></label>
            <select name="role_id" id="i_role_id" class="form-control form-control-sm">
              <?php foreach ($role as $role_list) {?>
                <option value="<?php echo $role_list['role_id'] ?>"><?php echo $role_list['role'] ?></option>
              <?php }?>
            </select>
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
        <h4 class="modal-title">Edit Data User</h4>
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
      </div>
      <form id="form-edit" enctype="multipart/form-data">
        <div class="modal-body">
          <?php echo csrf_field() ?>
          <div class="form-group">
            <label>Nama Dinas <i class="fa fa-info-circle" title="Contoh: Rumah Dinas Bupati."></i></label>
            <input id="e_nama_dinas" name="nama_dinas" class="form-control form-control-sm" type="text" required>
            <input id="e_id" name="id" class="form-control form-control-sm" type="hidden">
          </div>
          <div class="form-group">
            <label>Alamat Dinas <i class="fa fa-info-circle" title="Contoh: Jl. Ganda Negara No.11A, Nagri Kidul, Kec. Purwakarta, Kabupaten Purwakarta, Jawa Barat 41111."></i></label>
            <textarea name="alamat_dinas" id="e_alamat_dinas" cols="30" rows="10" class="form-control form-control-sm"></textarea>
          </div>
          <div class="form-group">
            <label>Nomor Telepon <i class="fa fa-info-circle" title="Contoh: (0264) 206654."></i></label>
            <input id="e_nomor_telepon" name="nomor_telepon" class="form-control form-control-sm" type="text" required>
          </div>
          <div class="form-group">
            <label>E-mail <i class="fa fa-info-circle" title="Contoh: example@domain.com."></i></label>
            <input id="e_email" name="email" class="form-control form-control-sm" type="email" required>
          </div>
          <div class="form-group">
            <label>Hak Akses <i class="fa fa-info-circle" title="Contoh: Rumah Dinas Bupati."></i></label>
            <select name="role_id" id="e_role_id" class="form-control form-control-sm">
              <?php foreach ($role as $role_list) {?>
                <option value="<?php echo $role_list['role_id'] ?>"><?php echo $role_list['role'] ?></option>
              <?php }?>
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
    const url = `http://${window.location.host}`;
    let html = "";

    const tblmanajemenuser = $('#tbl-manajemen-user').DataTable({
      responsive: true,
      processing: true,
      serverSide: true,
      order: [],
      ajax: {
        url: `${url}/manajemen-user/list`,
        type: "GET"
      },
      language: {
        emptyTable: `<img src="<?=base_url('assets/img/app/emptydata.svg')?>" width="150"><br><br><b>Data belum tersedia.</b>`
      }
    });

    // * Get Data for Edit
    $("#tbl-manajemen-user tbody").on("click", ".edit", function() {
      let id = $(this).data('id');

      $("#mdl-edit").modal('show');

      html = "";

      $.ajax({
        type: "GET",
        url: `${url}/manajemen-user/get-by-id`,
        data: {
          id: id
        },
        dataType: "json",
        success: function(data) {
          $("#e_nama_dinas").val(data.nama_dinas);
          $("#e_alamat_dinas").text(data.alamat_dinas);
          $("#e_nomor_telepon").val(data.nomor_telepon);
          $("#e_email").val(data.email);
          $("#e_role_id").val(data.role_id);
          $("#e_id").val(data.user_id);
        }
      });
    });

    //* Delete
    $("#tbl-manajemen-user tbody").on("click", ".delete", function() {
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
            url: "/manajemen-user/delete",
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

                tblmanajemenuser.ajax.reload();
              } else {
                Swal.fire(
                  'Data Gagal Dihapus!',
                  'Terjadi masalah pada sistem saat data dihapus.',
                  'error'
                )

                tblmanajemenuser.ajax.reload();
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
          url: "/manajemen-user/insert",
          data: formdata,
          processData: false,
          contentType: false,
          dataType: "text",
          success: function(data, textStatus, jqXHR) {
            $("#mdl-tambah").modal('hide');

            if (data) {
              Swal.fire(
                'Data Berhasil Tersimpan!',
                'Data user berhasil tersimpan ke dalam sistem.',
                'success'
              )

              tblmanajemenuser.ajax.reload();
            } else {
              Swal.fire(
                'Data Gagal Tersimpan!',
                'Terjadi masalah pada sistem saat penginputan data.',
                'error'
              )

              tblmanajemenuser.ajax.reload();
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
          url: "/manajemen-user/edit",
          data: formdata,
          processData: false,
          contentType: false,
          dataType: "text",
          success: function(data, textStatus, jqXHR) {
            $("#mdl-edit").modal('hide');

            if (data) {
              Swal.fire(
                'Data Berhasil Tersimpan!',
                'Data user berhasil tersimpan ke dalam sistem.',
                'success'
              )

              tblmanajemenuser.ajax.reload();
            } else {
              Swal.fire(
                'Data Gagal Tersimpan!',
                'Terjadi masalah pada sistem saat penginputan data.',
                'error'
              )

              tblmanajemenuser.ajax.reload();
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