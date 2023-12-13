<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport"
		  content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Login Page</title>
</head>
<body>
	<h1>LOGIN PAGE</h1>

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

	<form action="<?= site_url('clogin/loginauth') ?>" method="post">
		<label for="email">Enter E-mail</label>
		<input type="text" name="email" id="email">

		<br>

		<label for="password">Enter Password</label>
		<input type="password" name="password" id="password">

		<input type="submit" value="Login">
	</form>

	<button type="button" onClick="login()">Daftar</button>

	<a href="<?= site_url('cviews/email') ?>">Lupa Password?</a>

	<script>
		function login()
		{
			window.open("<?= site_url('cviews/register')?>","_self");
		}
	</script>

</body>
</html>
