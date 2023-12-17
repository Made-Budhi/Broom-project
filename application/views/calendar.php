<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="./js/jquery-3.6.0.min.js"></script>
</head>
<body>
<div>
  <form method="post" action="<?php echo site_url('crooms/calendar/'.$gedung)?>">
    <div class="mb-3">
      <label>Input Tanggal</label>
      <input type="date" class="form-control" name="tgl" id="tgl">
    </div>
    
    <input type="submit" value="Submit">
  </form>
</div>
<div class="container" id="jadwal">
  <?php
  if ( ! empty($tabel)) {
    echo $tabel;
  }
  ?>
</body>
</html>