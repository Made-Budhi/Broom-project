	<!-- load bootstrap, font-awesome, style, googlefont  -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="<?= base_url('assets/styles/sidebar.css')?>">
    
      <!-- Bootstrap JS and Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
	
	<style>
		@import url('https://fonts.googleapis.com/css2?family=Gabarito&family=Geologica&display=swap');
	</style>

<?php
view_data($hasil);
foreach ($hasil as $data):
?>

<div class="card mb-3 w-90 mx-auto" style="justify-content-center">
  <h1 class="w-100 mx-auto card-header text-center border-0">Detail</h1>
  <div class="row g-0">
    <div class="col-md-8">
      <div class="card-body d-flex gap-5 justify-content-between align-items-center">
        
        <div class="col-md-0">
          <img src="<?= base_url('assets/images/ruangan/' . $data->image) ?>" class="img-fluid rounded-start" alt="...">
        </div>
          
        <div>
          <p class="card-text">NIM/NIP : <?php echo $data->peminjam_id ?></p>
          <p class="card-text">Nama Ruangan : <?php echo $data->name ?></p>
          <p class="card-text">No.Telp : <?php echo $data->phone ?></p>
          <p class="card-text">Tujuan Penggunaan : <?php echo $data->purpose ?></p>
          <p class="card-text">Tanggal Mulai : <?php echo format_indo($data->date_start) ?> <?php echo $data->time_start ?> </p>
          <p class="card-text">Tanggal Selesai : <?php echo format_indo($data->date_end) ?> <?php echo $data->time_end ?> </p>
        </div>
          
        <div>
        
        </div>
        
    </div>
    <!-- TODO preview pdf tapi apa yang harus diambil dari data? -->
    <a target="_blank" href="<?= site_url('reservation/document/' . $data->reservasi_id) ?>" class="btn btn-primary">lihat dokumen</a>
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
      Buat Keputusan
    </button>
  </div>
</div>

<!-- Modal -->
<div class="modal" id="exampleModal" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" style="text-align: center; margin: 0 auto;">Buat Keputusan</h5>
      </div>
      <div class="modal-body ">
          <p class="text-center">Buat keputusan untuk persetujuan reservasi gedung.</p>
        <div class="d-flex justify-content-center gap-5">
          <a type="button" href="<?= site_url('reservation/decision/' . $data->reservasi_id) ?>/accept" class="btn btn-primary">Terima</a>
          <a type="button" href="<?= site_url('reservation/decision/' . $data->reservasi_id) ?>/deny" class="btn btn-danger">Tolak</a>
        </div>
      </div>
    </div>
  </div>
</div>


<?php
	 	endforeach;
?>
