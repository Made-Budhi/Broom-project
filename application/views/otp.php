<html lang="en">
<head>
  <title>Halaman Verif OTP</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>

<div class="container mt-3">

  <?php div_alert_error('otp_invalid'); ?>
  <form name="*" method="post" action="<?php echo base_url('login/auth/otp'); ?>">
    <div class="mb-3 mt-3">
      <label>OTP</label>
      <input type="password" class="form-control" name="token">
    </div>
   
    <button type="submit" class="btn btn-primary" >Verif</button>
  </form>
</div>
</body>
</html>