<!DOCTYPE html>
<html lang="id">

<head>
	<meta charset="utf-8" />
	<title>Selamat Datang di REQAPP</title>
	<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
	<meta content="" name="description" />
	<meta content="" name="author" />

	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="preload" as="style" />
  <link href="<?php echo base_url('assets/css/default/app.min.css') ?>" rel="preload" as="style" />

	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
  <link href="<?php echo base_url('assets/css/default/app.min.css') ?>" rel="stylesheet" />
</head>

<body class="pace-top">
	<div id="page-loader" class="fade show">
		<span class="spinner"></span>
	</div>

  <div id="page-container" class="fade">
		<div class="login login-with-news-feed">
			<div class="news-feed">
				<div class="news-image" style="background-image: url(../assets/img/login-bg/simpeg-login.jpg)"></div>
			</div>
			<div class="right-content">
				<div class="login-header">
					<div class="brand">
						<span class="logo"></span> Aplikasi <b>REQAPP</b>
						<small>Aplikasi Manajemen Permintaan Kebutuhan Dinas</small>
					</div>
				</div>
				<div class="login-content">
					<?php if (session()->getFlashdata('msg')): ?>
						<div class="alert alert-danger"><?php echo session()->getFlashdata('msg') ?></div>
					<?php endif;?>
					<form action="<?php echo base_url('auth/auth-check') ?>" method="POST" class="margin-bottom-0">
						<?php echo csrf_field() ?>
						<div class="form-group m-b-15">
							<input type="text" class="form-control form-control-lg" placeholder="E-mail" name="email" required />
						</div>
						<div class="form-group m-b-15">
							<input type="password" class="form-control form-control-lg" placeholder="Password" name="password" required />
						</div>
						<div class="login-buttons">
							<button type="submit" class="btn btn-success btn-block btn-lg">Masuk</button>
						</div>
						<hr />
						<p class="text-center text-grey-darker mb-0">
							&copy; ReqApp by PT Abbauf Mulia Konsultan Teknologi.<br>All Right Reserved 2020
						</p>
					</form>
				</div>
			</div>
		</div>
  </div>

  <script src="<?php echo base_url('assets/js/app.min.js') ?>"></script>
  <script src="<?php echo base_url('assets/js/theme/default.min.js') ?>"></script>
</body>
</html>