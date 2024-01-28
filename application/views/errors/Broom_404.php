<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
	<!-- load bootstrap, font-awesome, style, googlefont  -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="<?= base_url('assets/styles/sidebar.css')?>">
  
	<style>
		@import url('https://fonts.googleapis.com/css2?family=Gabarito&family=Geologica&display=swap');
	</style>

</head>

<body>
	<div class="container vh-100 d-flex">
		<div class="m-auto">
			<div class="d-flex justify-content-center">
				<img src="<?= base_url("assets/svg/error-404.svg") ?>" alt="" width="30%">
			</div>
			<div class="text-center align-items-center d-flex flex-column gap-4">
				<h3>
					Halaman tidak ditemukan !
				</h3>
				<p class="w-50">
					Kami memohon maaf atas ketidaknyamanan yang Anda alami. Saat ini, tampaknya Anda telah mengakses suatu lokasi di situs kami yang tidak dapat ditemukan.
				</p>
				<button class="btn btn-primary fs-5 w-50" onclick="directBack()">
					Kembali 
				</button>
			</div>
		</div>    
	</div>

<script>
	function directBack()
	{
		history.go(-1);
	}
</script>
<script src="<?= base_url('js/settings/init.js'); ?>"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
