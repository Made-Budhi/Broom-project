	<!-- load bootstrap, font-awesome, style, googlefont  -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="<?= base_url('assets/styles/sidebar.css')?>">
	
	<style>
		@import url('https://fonts.googleapis.com/css2?family=Gabarito&family=Geologica&display=swap');
	</style>

<?php
    view_data($hasil);
		foreach ($hasil as $data):
?>

<div class="card mb-3 w-90 mx-auto" style="justify-content-center">
  <h1 class="w-100 mx-auto card-header text-center bg-white border-0">Detail</h1>
  <div class="row g-0">
    <div class="col-md-8">
      <div class="card-body d-flex justify-content-between align-items-center">
        
        <div class="col-md-0">
          <img src="..." class="img-fluid rounded-start" alt="...">
        </div>
          
        <div>
          <p class="card-text">NIM/NIP : <?php echo $data->peminjam_id ?></p>
          <p class="card-text">Nama Ruangan : <?php echo $data->name ?></p>
          <p class="card-text">No.Telp : <?php echo $data->phone ?></p>
          <p class="card-text">Tujuan Penggunaan : <?php echo $data->purpose ?></p>
          <p class="card-text">Date Start : <?php echo $data->date_start?> <?php echo $data->time_start?> <br>
                                            <?php echo $data->date_end?> <?php echo $data->time_end?> </p>
        </div>
          
        <div>
        
        </div>
        
    </div>
    <!-- TODO preview pdf tapi apa yang harus diambil dari data? -->
    <a target="_blank" href="<?= site_url('Cpimpinan/lihatPDF/' . $data->reservasi_id) ?>" class="btn btn-primary">lihat dokumen</a>
    <a href="<?= site_url('Cpimpinan/keputusan/' . $data->reservasi_id) ?>/1" class="btn btn-primary">Terima</a>
    <a href="<?= site_url('Cpimpinan/keputusan/' . $data->reservasi_id) ?>/2" class="btn btn-primary">Tolak</a>
  </div>
</div>

<?php
	 	endforeach;
?>