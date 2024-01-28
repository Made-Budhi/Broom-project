<html lang="en">
<head>
  <title>Halaman Login</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
  <link rel="stylesheet" href="<?= base_url('assets/styles/sidebar.css')?>">
  <style>
		@import url('https://fonts.googleapis.com/css2?family=Gabarito&family=Geologica&display=swap');
	</style>
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
			<h3>Ganti Password</h3>
			<small>Silahkan lengkapi informasi dibawah ini</small>
		</div>
		<form name="*" method="post" action="<?= site_url('login/change_password'); ?>" class="w-75 d-flex flex-column gap-5">

      <div class="d-flex flex-column gap-3">
				<div class="mt-3">
					<label>Password Baru</label>
					<input type="password" class="form-control" name="password">
				</div>
				<div class="">
					<label>Konfirmasi Password</label>
					<input type="password" class="form-control" name="password_confirmation">
				</div>
			</div>
		 
			<div class="gap-2 d-flex flex-column">
				<button type="submit" class="btn btn-primary d-block w-100" id="submitBtn">Ubah Password</button>
			</div>
		</form>
	</div>
	

</div>

<script>
	const submitBtn = document.querySelector("#submitBtn");
	const inputs = document.querySelectorAll("input");

	submitBtn.disabled = true;
	inputs.forEach((input, key) => {
		input.addEventListener("keyup", (e) => {
			if(inputs[0].value == inputs[1].value) {
				submitBtn.disabled = false;
			}
			else {
				submitBtn.disabled = true;
			}
		});
	});
	
	
</script>
<script src="<?= base_url('js/settings/init.js'); ?>"></script>

</body>
</html>


<div class="container mt-3">

  <form name="*" method="post" action="<?= site_url('login/change_password'); ?>">
    <div class="mb-3 mt-3">
      <label>New Pass</label>
      <input type="text" class="form-control" name="password">
    </div>
   
    <button type="submit" class="btn btn-primary">Confirm</button>
   
  </form>
</div>
</body>
</html>
