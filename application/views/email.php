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

  <form name="*" method="post" action="<?php echo base_url('cforgot/forgot'); ?>">
    <div class="mb-3 mt-3">
      <label>Email</label>
      <input type="email" class="form-control" name="email">
    </div>
   
    <button type="submit" class="btn btn-primary">Send</button>
  </form>
</div>
</body>
</html>
