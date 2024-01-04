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