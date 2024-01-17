<h1>Notifikasi</h1>

<div class="d-flex flex-column-reverse">
	<?php
	view_data($notifikasi);
	view_data($message);
	?>

	<?= empty($notifikasi)? '
	<div class=" w-100 d-flex flex-column align-items-center gap-5">
	<img src='.base_url("assets/svg/no-notification.svg").' alt="" class="w-50">
		<h1>'.$message.'</h1>
	</div>
	
	' : ''; ?>

	<?php foreach ($notifikasi as $data): ?>
		<div class='d-flex align-items-center mt-4 gap-5'>
			<?php switch ($data->type) {

				// Pengajuan reservasi berhasil diajukan
				case NotificationType::PIMPINAN_DIAJUKAN: ?>
					<!-- Icon -->
					<div style="background: #FFD43B; height: 85px; width: 85px; border-radius: 43px"
						 class="d-flex justify-content-center align-items-center">
						<i class="fa-regular fa-hourglass-half" style="color: #f8f8f8; font-size: 2rem"></i>
					</div>

					<div>
						<div class="d-flex justify-content-between"><h4>Permintaan persetujuan </h4>
							<p class="text-dark-grey"> <?= format_indo($data->reservation_date) ?></p></div>
						<p>Permintaan persetujuan mengenai reservasi ruangan <?= $data->name ?> untuk
							tanggal <?= format_indo($data->date_start) ?>
							hingga <?= format_indo($data->date_end) ?> sedang menunggu persetujuan
							dari <?= $data->position ?>.</p>
					</div>
				<?php break ?>

			<?php } ?>
		</div>
	<?php endforeach ?>
</div>
