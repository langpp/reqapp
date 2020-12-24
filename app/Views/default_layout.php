<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="utf-8" />
  <title>REQAPP | Dashboard</title>
  <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
  <meta content="" name="description" />
  <meta content="" name="author" />
  <link rel="icon" href="<?php echo base_url('assets/img/logo/logo.png') ?>" type="image/x-icon">

  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="dns-prefetch" />
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="preconnect" crossorigin />

  <link href="<?php echo base_url('assets/css/default/app.min.css') ?>" rel="preload" as="style" />
  <link href="<?php echo base_url('assets/css/default/app.min.css') ?>" rel="stylesheet" />

  <?php echo $this->renderSection('style') ?>
</head>

<body>

  <div id="page-loader" class="fade show">
    <span class="spinner"></span>
  </div>

  <div id="page-container" class="fade page-sidebar-fixed page-header-fixed">

    <div id="header" class="header navbar-default">

      <div class="navbar-header">
        <a href="<?php echo base_url('/') ?>" class="navbar-brand"><img src="<?php echo base_url('assets/img/logo/logo.png') ?>" style="width: 20px"> &nbsp;&nbsp; Aplikasi <b>REQAPP</b></a>
        <button type="button" class="navbar-toggle" data-click="sidebar-toggled">
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
      </div>

      <ul class="navbar-nav navbar-right">
        <li class="dropdown navbar-user">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <img src="<?php echo base_url('/assets/img/user/user-13.jpg') ?>" alt="" />
            <span class="d-none d-md-inline">Hai, Abdurrahman</span> <b class="caret"></b>
          </a>
          <div class="dropdown-menu dropdown-menu-right">
            <a href="<?php echo base_url('/logout') ?>" class="dropdown-item">Log Out</a>
          </div>
        </li>
      </ul>

    </div>

    <div id="sidebar" class="sidebar">

      <div data-scrollbar="true" data-height="100%">

        <ul class="nav">
          <li class="nav-profile">
            <a href="#" data-toggle="nav-profile">
              <div class="cover with-shadow"></div>
              <div class="image">
                <img src="<?php echo base_url('/assets/img/user/user-13.jpg') ?>" alt="" />
              </div>
              <div class="info">
                <b class="caret pull-right"></b>Abdurrahman Naufal
                <small>Administrator</small>
              </div>
            </a>
          </li>
        </ul>

        <ul class="nav">
          <li class="nav-header">Navigation</li>
          <li class="active">
            <a href="/">
              <i class="fa fa-th-large"></i>
              <span>Dashboard</span>
            </a>
          </li>
          <li class="has-sub active">
            <a href="#">
              <b class="caret"></b>
              <i class="fa fa-list"></i>
              <span>Data Permintaan</span>
            </a>
            <ul class="sub-menu">
              <li><a href="/permintaan-masuk">Permintaan Masuk</a></li>
              <li><a href="/permintaan-diproses">Permintaan Diproses</a></li>
              <li><a href="/permintaan-selesai">Permintaan Selesai</a></li>
              <li><a href="/permintaan-ditolak">Permintaan Ditolak</a></li>
            </ul>
          </li>
          <li class="has-sub">
            <a href="#">
              <b class="caret"></b>
              <i class="fa fa-box"></i>
              <span>Data Master</span>
            </a>
            <ul class="sub-menu">
              <li><a href="/daftar-kebutuhan">Daftar Kebutuhan</a></li>
              <li><a href="/kategori-kebutuhan">Kategori Kebutuhan</a></li>
              <li><a href="/riwayat-kebutuhan">Riwayat Kebutuhan</a></li>
            </ul>
          </li>
          <li>
            <a href="/manajemen-user">
              <i class="fa fa-users"></i>
              <span>Manajemen User</span>
            </a>
          </li>
          <li>
            <a href="/report">
              <i class="fa fa-file"></i>
              <span>Laporan</span>
            </a>
          </li>
          <li><a href="#" class="sidebar-minify-btn" data-click="sidebar-minify"><i class="fa fa-angle-double-left"></i></a>
          </li>

        </ul>

      </div>

    </div>
    <div class="sidebar-bg"></div>

    <div id="content" class="content">
      Render Page: {elapsed_time}
      <?php echo $this->renderSection('content') ?>
    </div>

    <a href="#" class="btn btn-icon btn-circle btn-success btn-scroll-to-top fade" data-click="scroll-top"><i class="fa fa-angle-up"></i></a>

  </div>

  <script src="<?php echo base_url('assets/js/app.min.js') ?>"></script>
  <script src="<?php echo base_url('assets/js/theme/default.min.js') ?>"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>

  <?php echo $this->renderSection('script') ?>
</body>

</html>