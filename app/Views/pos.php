<!DOCTYPE html>
<html lang="id">
  <head>
    <meta charset="utf-8" />
    <title>POS ReqApp</title>
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
    <meta content="" name="description" />
    <meta content="" name="author" />
    <link rel="icon" href="<?php echo base_url('assets/img/logo/logo.png') ?>" type="image/x-icon">

    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="dns-prefetch" />
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="preconnect" crossorigin />

    <link href="<?php echo base_url('assets/css/default/app.min.css') ?>" rel="preload" as="style" />
    <link href="<?php echo base_url('assets/css/default/app.min.css') ?>" rel="stylesheet" />
  </head>
  <body class="pace-top">
    <div id="page-loader" class="fade show">
      <span class="spinner"></span>
    </div>
    <div id="page-container" class="page-empty bg-white fade page-content-full-height">
      <div id="content" class="content p-0">
        <div class="pos pos-customer" id="pos-customer">
          <div class="pos-menu">
            <div class="logo">
              <a href="<?php echo base_url('/pos') ?>">
                <div class="logo-img" style="height: 80px;"><img src="<?php echo base_url('assets/img/logo/logo.png') ?>" /></div>
                <div class="logo-text">Purwakarta</div>
              </a>
            </div>
            <div class="nav-container">
              <div data-scrollbar="true" data-height="100%" data-skip-mobile="true">
                <ul class="nav nav-tabs">
                  <li class="nav-item">
                    <a class="nav-link list-kategori active" data-filter="semua" data-id="0">
                    <i class="fa fa-th-large" style="font-size: 20px"></i> Semua
                    </a>
                  </li>
                  <?php foreach ($kategori_kebutuhan as $kategori_list) {?>
                    <li class="nav-item">
                      <a class="nav-link list-kategori" data-filter="<?php echo $kategori_list['nama_kategori'] ?>" data-id="<?php echo $kategori_list['kategori_kebutuhan_id'] ?>">
                      <i class="<?php echo $kategori_list['icon'] ?>" style="font-size: 20px"></i> <?php echo str_replace(" ", "<br>", $kategori_list['nama_kategori']) ?>
                      </a>
                    </li>
                  <?php }?>
                </ul>
              </div>
            </div>
          </div>
          <div class="pos-content">
            <div class="pos-content-container" data-scrollbar="true" data-height="100%" data-skip-mobile="true">
              <div class="product-row">

              </div>
            </div>
          </div>
          <div class="pos-sidebar" id="pos-sidebar">
            <div class="pos-sidebar-header">
              <div class="back-btn">
                <button type="button" data-dismiss-class="pos-mobile-sidebar-toggled" data-target="#pos-customer" class="btn">
                  <svg viewBox="0 0 16 16" class="bi bi-chevron-left" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M11.354 1.646a.5.5 0 0 1 0 .708L5.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0z" />
                  </svg>
                </button>
              </div>
              <div class="icon"><img src="<?php echo base_url('assets/img/logo/logo.png') ?>" /></div>
              <div class="title"><?php echo session()->get('nama_dinas') ?></div>
            </div>
            <div class="pos-sidebar-nav">
              <ul class="nav nav-tabs nav-fill">
                <li class="nav-item">
                  <a class="nav-link active" href="#" data-toggle="tab" data-target="#newOrderTab">Order Baru (<span id="count-order-baru">0</span>)</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="#" data-toggle="tab" data-target="#orderHistoryTab">Order History</a>
                </li>
              </ul>
            </div>
            <div class="pos-sidebar-body tab-content" data-scrollbar="true" data-height="100%">
              <div class="tab-pane fade h-100 show active" id="newOrderTab">
                <div class="pos-table">

                </div>
              </div>
              <div class="tab-pane fade h-100" id="orderHistoryTab">
                <div id="accordion" class="accordion" style="width: 100%">
                    <?php $i = 1;foreach ($transaksi as $transaksi_list) {?>
                    <div class="card bg-light text-black" data-orderid="<?php echo $transaksi_list['order_id'] ?>">
                      <div class="card-header pointer-cursor d-flex align-items-center collapsed" data-toggle="collapse" data-target="#collapse<?php echo $i ?>" aria-expanded="false">
                        <i class="fa fa-circle fa-fw <?php echo $transaksi_list['status'] == 1 ? 'text-blue' : ($transaksi_list['status'] == 2 ? 'text-orange' : ($transaksi_list['status'] == 3 ? 'text-green' : 'text-red')) ?> mr-2 f-s-8"></i> <strong><?php echo $transaksi_list['order_id'] ?> (<?php echo $transaksi_list['status'] == 1 ? 'Pesanan Dibuat' : ($transaksi_list['status'] == 2 ? 'Pesanan Diproses' : ($transaksi_list['status'] == 3 ? 'Pesenan Diterima' : 'Pesanan Ditolak')) ?>)</strong>
                      </div>
                      <div id="collapse<?php echo $i ?>" class="collapse" data-parent="#accordion" style="">
                        <div class="card-body">
                          <p>Tanggal Pesanan: <?php echo $transaksi_list['created_at'] ?></p>
                          <div class="pos-table" style="padding: 0">
                            <p>Mohon Tunggu...</p>
                          </div>
                        </div>
                      </div>
                    </div>
                    <?php $i++;}?>
                  </div>
              </div>
            </div>
            <div class="pos-sidebar-footer">
              <div class="subtotal">
                <div class="text">Tanggal Order</div>
                <div class="price"><input type="date" class="form-control" id="tanggal_order" value="<?php echo date('Y-m-d') ?>"></div>
              </div>
              <div class="btn-row">
                <a href="<?php echo base_url('/logout') ?>" class="btn btn-default"><i class="fa fa-sign-out-alt fa-fw fa-lg"></i> Log Out</a>
                <a class="btn btn-success" id="btn-pesan"><i class="fa fa-check fa-fw fa-lg"></i> Pesan</a>
              </div>
            </div>
          </div>
        </div>
      </div>
      <a href="javascript:;" class="btn btn-icon btn-circle btn-success btn-scroll-to-top fade" data-click="scroll-top"><i class="fa fa-angle-up"></i></a>
    </div>

    <script src="<?php echo base_url('assets/js/app.min.js') ?>"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <script>
      $(function () {
        const url = `https://${window.location.host}`;
        let html = "";

        getKebutuhan(0);

        $(".list-kategori").click(function () {
          $(".list-kategori").removeClass('active');

          $(this).addClass('active');

          getKebutuhan($(this).data('id'));
        });

        $(".product-row").on('click', '.product-container', function () {
          let kebutuhan_id = $(this).data('id');

          getKebutuhantoList(kebutuhan_id);
        });

        $("#newOrderTab").find(".pos-table").on("click", ".plus", function () {
          let div_tmp = $("#newOrderTab").find(".pos-table").find(`.pos-table-row[data-id=${$(this).data('id')}]`).find(".kuantitas");

          div_tmp.val(parseInt(div_tmp.val()) + 1);
          countorderbaru();
        });

        $("#newOrderTab").find(".pos-table").on("click", ".minus", function () {
          let div_tmp = $("#newOrderTab").find(".pos-table").find(`.pos-table-row[data-id=${$(this).data('id')}]`).find(".kuantitas");

          let angk = parseInt(div_tmp.val()) - 1;

          if (angk != 0) {
            div_tmp.val(parseInt(div_tmp.val()) - 1);
            countorderbaru();
          } else {
            $("#newOrderTab").find(".pos-table").find(`.pos-table-row[data-id=${$(this).data('id')}]`).remove();
            countorderbaru();
          }
        });

        $("#btn-pesan").click(function () {
          Swal.fire({
            title: 'Mohon Tunggu...',
            html: 'Mohon tunggu pesanan sedang diproses oleh sistem.',
            didOpen: () => {
              Swal.showLoading();
            }
          });

          let data_id = [];
          let data_jml_transaksi = [];
          let formdata = new FormData();

          $("#newOrderTab").find(".pos-table").find(`.pos-table-row`).each(function () {
            formdata.append('kebutuhan_id[]', $(this).data('id'));
            formdata.append('jumlah_transaksi[]', $(this).find('.kuantitas').val());
          });

          formdata.append('tanggal_order', $("#tanggal_order").val());
          formdata.append('<?php echo csrf_token() ?>', '<?php echo csrf_hash(); ?>');

          $.ajax({
            type: "POST",
            url: "/pos/insert",
            data: formdata,
            processData: false,
            contentType: false,
            dataType: "json",
            success: function (data) {
              Swal.close();
              if (!data.error) {
                $("#newOrderTab").find(".pos-table").empty();
                $("#count-order-baru").text(0);
                Swal.fire(
                  'Kebutuhan Berhasil Dipesan!',
                  'Mohon tunggu pesanan akan segera diproses oleh Sekda.',
                  'success'
                );
                location.reload();
              } else {
                Swal.fire(
                  'Beberapa Kebutuhan Memiliki Stok yang Sudah Habis!',
                  'Silakan Ulangi Pemesanan!.',
                  'error'
                );
                location.reload();
              }
            }
          });
        });

        $('#orderHistoryTab').find('.card').on('show.bs.collapse', function () {
          getDetailTransaksi($(this).data('orderid'), $(this));
        });

        $("#newOrderTab").on("keyup", ".kuantitas", function (evt) {
          validateNumber(evt);

          if ($(this).val() == "" || $(this).val() == 0) {
            $(this).val(1);
          }

          countorderbaru();
        });

        function getKebutuhan(kategori_id) {
          $(".product-row").empty();
          html = "";

          $.ajax({
            type: "GET",
            url: `${url}/daftar-kebutuhan/get-data`,
            data: {
              kategori_id: kategori_id
            },
            dataType: "json",
            success: function (data) {
              $.each(data, function (index, value) {
                let foto = '<?php echo base_url('assets/img/kebutuhan') ?>/'+value.foto;

                html += `<div class="product-container" data-id="${value.kebutuhan_id}" data-type="${value.nama_kategori}">`;

                if (value.stok == 0) {
                  html += `<a class="product not-available">`;
                } else {
                  html += `<a class="product">`;
                }

                html += `<div class="img" style="background-image: url(${foto})"></div>
                  <div class="text">
                    <div class="title">${value.nama_kebutuhan}</div>
                    <div class="desc">${value.deskripsi}</div>
                    <div class="satuan">Satuan: ${value.satuan}</div>
                    <div class="satuan">Stok: ${value.stok}</div>
                  </div>`;

                if (value.stok == 0) {
                  html += `<div class="not-available-text">
                      <div>Stok Habis</div>
                    </div>`;
                }

                html += `</a>
                </div>`;
              });

              $(".product-row").html(html);
            }
          });
        }

        function getKebutuhantoList(kebutuhan_id) {
          $.ajax({
            type: "GET",
            url: `${url}/daftar-kebutuhan/get-by-id`,
            data: {
              id: kebutuhan_id
            },
            dataType: "json",
            success: function (data) {
              let div_tmp_1 = $("#newOrderTab").find(`.pos-table-row[data-id=${kebutuhan_id}]`);

              if (div_tmp_1.is(':visible')) {
                let qty = div_tmp_1.find(".kuantitas").val();
                div_tmp_1.find(".kuantitas").val(parseInt(qty) + 1);
              } else {
                let foto = '<?php echo base_url('assets/img/kebutuhan') ?>/'+data.foto;

                html = `<div class="row pos-table-row" data-id="${data.kebutuhan_id}">
                  <div class="col-9">
                    <div class="pos-product-thumb">
                      <div class="img" style="background-image: url(${foto})"></div>
                      <div class="info">
                        <div class="title">${data.nama_kebutuhan}</div>
                        <div class="single-price"></div>
                        <div class="desc">${data.deskripsi}</div>
                        <div class="input-group qty">
                          <div class="input-group-append">
                            <a class="btn btn-default minus" data-id="${data.kebutuhan_id}"><i class="fa fa-minus"></i></a>
                          </div>
                          <input type="text" class="form-control kuantitas" value="1" />
                          <div class="input-group-prepend">
                            <a class="btn btn-default plus" data-id="${data.kebutuhan_id}"><i class="fa fa-plus"></i></a>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-3 total-price">${data.satuan}</div>
                </div>`;

                $("#newOrderTab").find(".pos-table").append(html);
              }

              countorderbaru();
            }
          });
        }

        function getDetailTransaksi(order_id, div) {
          $.ajax({
            type: "GET",
            url: `${url}/detail-transaksi/detail`,
            data: {
              order_id: order_id
            },
            dataType: "json",
            success: function (data) {
              html = "";

              $.each(data, function (index, value) {
                let foto = '<?php echo base_url('assets/img/kebutuhan') ?>/'+value.foto;

                html += `<div class="row pos-table-row" data-id="${value.kebutuhan_id}">
                  <div class="col-9">
                    <div class="pos-product-thumb">
                      <div class="img" style="background-image: url(${foto})"></div>
                      <div class="info">
                        <div class="title">${value.nama_kebutuhan}</div>
                        <div class="single-price"></div>
                        <div class="desc">${value.deskripsi}</div>
                        <div class="desc">Jumlah: ${value.jumlah_transaksi}</div>
                      </div>
                    </div>
                  </div>
                  <div class="col-3 total-price">${value.satuan}</div>
                </div>`;

                $(div).find('.pos-table').html(html);
              });
            }
          });
        }

        function countorderbaru() {
          let count = 0;

          $("#newOrderTab").find(".kuantitas").each(function () {
            count += parseInt($(this).val());
          });

          $("#count-order-baru").text(count);
        }

        function validateNumber(evt) {
          if (!(evt.keyCode == 8 || evt.keyCode == 46 || (evt.keyCode >= 35 && evt.keyCode <= 40) || (evt.keyCode >= 48 && evt.keyCode <= 57) || (evt.keyCode >= 96 && evt.keyCode <= 105))) {
            evt.preventDefault();
          }
        }
      });
    </script>
  </body>
</html>