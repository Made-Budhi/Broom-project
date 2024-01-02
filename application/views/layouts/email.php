<!doctype html>
<html lang="en">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>

<?php
view_data($type);
view_data($code);
?>

<?php
// TODO 1 layout for 2 different verification
// TODO need to implement language
switch ($type) {
	case Verification::REGISTER:
		?>
      Ini pesan verifikasi <strong>Email</strong>
      <a class="btn-primary"
         href="<?= site_url('register/auth/email/'.$code) ?>">Klik disini</a>
		<?php
		break;
	case Verification::OTP:
		?>
      Ini pesan verifikasi <strong>OTP</strong> <br>
      Kode: <?= $code ?>
		<?php
		break;
}
?>
</html>