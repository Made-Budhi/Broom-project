<!-- load bootstrap, font-awesome, style, googlefont  -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="<?= base_url('assets/styles/sidebar.css')?>">

<style>
  @import url('https://fonts.googleapis.com/css2?family=Gabarito&family=Geologica&display=swap');
</style>

<h1>Data Peminjam</h1>

<?php
view_data($hasil, 'name', 'id', 'phone');
$no=1;
foreach ($hasil as $data):
?>

<div class="card mb-3 w-90 mx-auto" style="justify-content-center">
  <div class="row g-0">
    <div class="col-md-4">
      <img src="..." class="img-fluid rounded-start" alt="...">
    </div>
    <div class="col-md-8">
        <div class="card-body d-flex justify-content-between align-items-center">
          <div>
            <h4> NIM : <?php echo $data->id ?></h4>
            <p class="card-text">Nama : <?php echo $data->name ?></p>
            <p class="card-text">Telp : <?php echo $data->phone ?></p>
          </div>
          <a href="<?= site_url('Cpengelola/jejak/' . $data->id) ?>" class="btn btn-primary">Daftar Reservasi</a>
        </div>
    </div>
  </div>
</div>

<?php
$no++;
endforeach;
?>