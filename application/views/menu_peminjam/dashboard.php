<!-- load bootstrap, font-awesome, style  -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="<?= base_url('assets/styles/sidebar.css')?>">

<h1>Dashboard</h1>
<br>
<h3>Fitur yang bisa kamu coba</h3>

<h4>History Reservasi</h4>

<br>

<div class="card mb-3">
  <div class="row g-0">
    <div class="col-md-10 d-flex">
        <div class="card-body">
          <h1 class="card-title">Reservasi gedung sekarang!</h1>
          <h3 class="card-text">Mulai melakukan reservasi hanya dari perangkat elektronik anda !</h3>
          <Button class="btn btn-primary btn-lg">Buat Reservasi</Button>
        </div>
        <div class="col-md-0">
        <img src="" class="card-img-bottom float-right" alt="...">
        </div>
    </div>
  </div>
</div>

<br>

<table class="table table-bordered">

    <thead>
        <th class="text-center" scope="col">Tanggal</th>
        <th class="text-center" scope="col">Ruangan</th>
        <th class="text-center" scope="col">Status</th>
        <th class="text-center" scope="col">Aksi</th>
    </thead>

    <tbody>
      <?php
      $no = 1;
      view_data($hasil, 'reservasi_id', 'date_start', 'date_end', 'name', 'reservasi_status');
      foreach ($hasil as $data):
      ?>
        <tr>
          <td class="text-center"><?php echo $data->date_start;?> <br> <?php echo $data->date_end ?></td>
          <td class="text-center"><?php echo $data->name ?></td>
          <td class="text-center"><?php echo $data->reservasi_status ?></td>
  
          <!-- TODO Detail mengarah ke arah PDF form -->
          <td class="text-center">
			  <a target="_blank" href="<?= site_url('reservation/document/' . $data->reservasi_id) ?>" class="btn btn-primary">Detail dokumen</a>
          </td>
        </tr>
      <?php
      $no++;
      endforeach;
      ?>
    </tbody>
</table>

<script>

</script>
