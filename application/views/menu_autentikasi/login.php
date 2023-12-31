<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport"
		  content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link
		href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
		rel="stylesheet"
		integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
		crossorigin="anonymous"
	/>
    <link rel="stylesheet" href="<?= base_url('assets/styles/sidebar.css')?>">
	<title>Login Page</title>
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
				<small>Sign in by entering information below</small>
			</div>
		
      <?php
      // Shows error/information messages if there is.
      // TODO create a div or card board for messages
      view_flashdata("email_verify");
      view_flashdata("loginerror");
      ?>

			<form action="<?= site_url('login/auth') ?>" method="post" class="d-flex flex-column gap-4 w-50">
				<div>
					<label for="email" class="d-block">E-mail</label>
					<input type="text" name="email" id="email" class="w-100 rounded-2 border-1 opacity-10 form-control">
				</div>
				<div>
					<label for="password" class="d-block">Password</label>
					<input type="password" name="password" id="password" class="w-100 rounded-2 border-1 opacity-10 form-control">
				</div>

				<a href="<?= site_url('login/forgot/password') ?>" class="text-end d-block text-decoration-none text-info">Lupa Password?</a>
				<input type="submit" value="Sign in" class="btn btn-primary d-block w-100 form-control mt-4">
				<p class="fw-light text-center"> Tidak memiliki akun? <a href="<?= site_url('register') ?>" class="text-decoration-none text-body fw-normal">Buat akun</a>
			</form>
			
			</p>

		</div>
	</div>

	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
	<script src="<?= base_url('js/settings/init.js'); ?>"></script>
	
</body>
</html>
