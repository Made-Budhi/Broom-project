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
	<style>
		.otp-fragment::-webkit-inner-spin-button,
		.otp-fragment::-webkit-outer-spin-button {
      -webkit-appearance: none; 
      margin: 0;
    }
		.otp-fragment{
			font-size: 1rem;
			padding: .8rem;
			text-align: center;
			margin:auto;
		}
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
			<h3>Masukan Kode</h3>
			<p>Kami telah mengirim kode ke <strong><?php 
			 $email = $this->session->userdata("email"); 
			 echo substr($email, 0, 3).'****'.substr($email, strpos($email, "@"));
			
			?></strong>. Silahkan cek bagian inbox atau spam.</p>
		</div>
		<form name="*" method="post" action="<?php echo base_url('login/auth/otp'); ?>" class="w-75 d-flex flex-column gap-5">
		<?php div_alert_error('otp_invalid'); ?>
			<input type="number" class="form-control d-none" name="token" id="token">
      <div class="mb-3 mt-3 d-flex gap-4">
					<input type="number" maxlength="1" class="form-control otp-fragment" />
					<input type="number" maxlength="1" class="form-control otp-fragment" />
					<input type="number" maxlength="1" class="form-control otp-fragment" />
					<input type="number" maxlength="1" class="form-control otp-fragment" />
					<input type="number" maxlength="1" class="form-control otp-fragment" />
					<input type="number" maxlength="1" class="form-control otp-fragment" />
			</div>
		 
			<div class="gap-2 d-flex flex-column">
				<button type="submit" class="btn btn-primary d-block w-100">Konfirmasi Kode</button>

			</div>
		</form>
	</div>
	

</div>

<script>
	const inputs = document.querySelectorAll('.otp-fragment');
	const form = document.querySelector('form');
	const tokenInput = document.querySelector('#token');

	inputs.forEach((input, key) => {
		if (key !== 0) {
			input.addEventListener('click', function () {
				inputs[0].focus();
			});
		}
	});

	inputs.forEach((input, key) => {
		input.addEventListener('keyup', function (e) {
			if (input.value != '') {
				input.value = input.value.slice(0, 1)
				if (key === 5) {
					const token = [...inputs].map((input) => input.value).join('');
					tokenInput.value = token;
					form.submit();
				} else {
					inputs[key + 1].focus();
				}
			}
		});
		input.addEventListener('keydown', function (e) {
			if (e.key == "Backspace"){
				inputs[key - 1].focus();
			}
		});
	});
</script>
<script src="<?= base_url('js/settings/init.js'); ?>"></script>

</body>
</html>

