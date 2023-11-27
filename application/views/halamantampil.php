<html lang="en">
<head>
  <title>Halaman Login</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>

<div class="container mt-3">
  <h2>Halaman Login</h2>
  
  <form name="*" method="post" action="<?php echo base_url('chalaman/proseslogin'); ?>">
    <div class="mb-3 mt-3">
      <label>Username</label>
      <input type="text" class="form-control" name="Username">
    </div>
    <div class="mb-3">
      <label>Password</label>
      <input type="password" class="form-control" name="Password">
    </div>
    <div class="form-check mb-3">
      <label class="form-check-label">
        <input class="form-check-input" type="checkbox" name="remember"> Pengingat
      </label>
    </div>
    <button type="submit" class="btn btn-primary">Login</button>
    <button type="button" class="btn btn-success" onClick="daftar()">Daftar</button>
    <a href="<?php echo base_url('chalaman/email'); ?>">Forgor?</a>
  </form>
</div>
</body>
</html>