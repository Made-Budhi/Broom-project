<h1>Notifikasi</h1>

<div class="d-flex flex-column-reverse">

	<?php
  view_data($notifikasi);
  view_data($message);
  ?>
	
	<?= empty($notifikasi)? '<div><h1>'.$message.'</h1></div>' : ''; ?>
  
  <?php foreach ($notifikasi as $data): ?>
  
  <div class='d-flex align-items-center mt-4 gap-5'>
    <?php switch ($data->type) {
		  
		  case NotificationType::PENGELOLA_DINOTIFIKASI:
			  ?>
        <!-- Icon -->
        <div style="background: #4CAF50; height: 70px; width: 70px; border-radius: 35px" class="d-flex justify-content-center align-items-center">
          <i class="fa-solid fa-check" style="color: #f8f8f8; font-size: 2.5rem"></i>
        </div>

        <div>
          <div class="d-flex"><h4>Reservasi telah disetujui </h4><p class="text-dark-grey"> <?= format_indo($data->reservation_date) ?></p></div>
          <p>Reservasi ruangan <?= $data->ruangan ?> yang diajukan oleh <?= $data->peminjam ?> dari tanggal <?= format_indo($data->date_start) ?>
            hingga <?= format_indo($data->date_end) ?> telah disetujui oleh <?= $data->pimpinan ?></p>
        </div>
			  
			  <?php
			  break;
		  
        case NotificationType::PENGELOLA_MEMBATALKAN:
			  ?>
          <!-- Icon -->
          <div style="background: #F44336; height: 70px; width: 70px; border-radius: 35px" class="d-flex justify-content-center align-items-center">
            <i class="fa-solid fa-xmark" style="color: #f8f8f8; font-size: 2.5rem"></i>
          </div>

          <div>
            <div class="d-flex"><h4>Reservasi telah dibatalkan</h4>
              <p class="text-dark-grey">
                  <?= format_indo($data->reservation_date) ?>
              </p>
            </div>
            
            <p>Reservasi <?= $data->ruangan ?> yang diajukan oleh <?= $data->peminjam ?>
              dari tanggal <?= format_indo($data->date_start) ?>
              hingga <?= format_indo($data->date_end) ?> berhasil dibatalkan.
            </p>
          </div>
			  
			  <?php
			  break;
	  }
    ?>
  </div>
  <?php endforeach ?>
</div>
