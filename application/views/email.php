<html lang="en">
<head>
  <title>Halaman Login</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>

<div class="container row vh-100 m-auto geologica">
	<div class="col-12 col-md-6 m-auto d-none d-md-block">
		<img src="<?= base_url("./assets/images/forgotpass.svg") ?>" class="d-md-block d-none w-75 m-auto" alt="...">
	</div>

	<div class="col-12 col-md-6 d-flex flex-column justify-content-start align-items-center gap-5 border-md-start h-75 m-auto">
		<h1>Broom</h1>
		<img src="<?= base_url("./assets/images/forgotpass.svg") ?>" class="d-md-none d-block w-50 m-auto" alt="...">
		<div class="d-block w-75">
			<h3>Lupa Password</h3>
			<small>Silahkan lengkapi informasi dibawah ini</small>
		</div>
		<form name="*" method="post" action="<?php echo base_url('cforgot/forgot'); ?>" class="w-75 d-flex flex-column gap-5">
			<div class="mb-3 mt-3">
				<label>Alamat Email</label>
				<input type="email" class="form-control" name="email">
				<small><strong>Tip : </strong>Pastikan alamat email anda benar</small>
			</div>
		 
			<div class="gap-2 d-flex flex-column">
				<button type="submit" class="btn btn-primary d-block w-100">Dapatkan Kode</button>
				<a href="#" class="text-body text-decoration-none text-center d-block">Tidak memiliki akses ke email? <strong>Dapatkan bantuan</strong></a>
			</div>
		</form>
	</div>
	

</div>
</body>
</html>
