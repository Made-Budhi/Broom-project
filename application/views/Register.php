<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link
		href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
		rel="stylesheet"
		integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
		crossorigin="anonymous"
	/>
    <link rel="stylesheet" href="<?= base_url('assets/styles/sidebar.css')?>">
    <title>Register Page</title>
</head>
<body>
	<div class="container row vh-100 m-auto geologica">
		<div class="col-12 col-md-6 m-auto d-none d-md-block">
			<div id="carouselExampleInterval" class="carousel slide" data-bs-ride="carousel">
				<div class="carousel-indicators">
					<button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active border" aria-current="true" aria-label="Slide 1"></button>
					<button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" class=" border" aria-label="Slide 2"></button>
					<button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" class=" border" aria-label="Slide 3"></button>
				</div>

				<div class="carousel-inner h-75">
					<div class="carousel-item active h-100" data-bs-interval="5000">
						<img src="<?= base_url("./assets/images/office.svg") ?>" class="d-block w-75 m-auto mt-5" alt="...">
						<div class="carousel-caption text-body">
							<h5>First slide label</h5>
							<p>Some representative placeholder content for the first slide.</p>
						</div>
					</div>
					<div class="carousel-item h-100" data-bs-interval="5000">
						<img src="<?= base_url("./assets/images/office.svg") ?>" class="d-block w-75 m-auto mt-5" alt="...">
						<div class="carousel-caption text-body">
							<h5>First slide label</h5>
							<p>Some representative placeholder content for the first slide.</p>
						</div>
					</div>
					<div class="carousel-item h-100" data-bs-interval="5000">
						<img src="<?= base_url("./assets/images/office.svg") ?>" class="d-block w-75 m-auto mt-5" alt="...">
						<div class="carousel-caption text-body">
							<h5>First slide label</h5>
							<p>Some representative placeholder content for the first slide.</p>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-12 col-md-6 d-flex flex-column justify-content-start align-items-center gap-5 border-md-start h-75 m-auto">
			<h1>Broom</h1>
			<img src="<?= base_url("./assets/images/office.svg") ?>" class="d-md-none w-50 m-auto" alt="...">
			<div class="d-block w-50">
				<h3>Welcome!</h3>
				<small>Sign Up by entering information below</small>
			</div>

			<?php
			// Shows error login message if there's any.
			// TODO: must create hooks
			$errormsg = $this->session->flashdata('loginerror');
			if (!is_null($errormsg)) {
				?>

				<div>
					<?= $errormsg ?>
				</div>

				<?php
			}
			?>

			<form name="formdaftar" method="post" action="<?php echo base_url('cregister/register'); ?>" class="d-flex flex-column gap-4 w-50">
				<div>
					<label for="email" class="d-block">E-mail</label>
					<input type="text" name="email" id="email" class="w-100 rounded-2 border-1 opacity-10 form-control">
				</div>

				<div>
					<label for="password" class="d-block">Password</label>
					<input type="password" name="password" id="password" class="w-100 rounded-2 border-1 opacity-10 form-control">
				</div>

				<div>
					<label for="nomorinduk" class="d-block">Nomor Induk</label>
					<input type="text" name="id" class="w-100 rounded-2 border-1 opacity-10 form-control">
				</div>

				<div>
					<label for="nama" class="d-block">Nama</label>
					<input type="text" name="name" class="w-100 rounded-2 border-1 opacity-10 form-control">
				</div>
				
				<div>
					<label for="phone" class="d-block">Telp</label>
					<input type="text" name="phone" class="w-100 rounded-2 border-1 opacity-10 form-control">
				</div>

				<input type="submit" value="Sign up" class="btn btn-primary d-block w-100 form-control mt-4">
				<p class="fw-light text-center"> Sudah memiliki akun? <a href="<?= site_url('cviews/loginpage') ?>" class="text-decoration-none text-body fw-normal">Masuk Sekarang</a>
			</form>
		</div>
	</div>
<script>
	function login()
	{
		window.open("<?php echo base_url('cviews/loginpage')?>","_self");
	}
</script>

</body>
</html>
