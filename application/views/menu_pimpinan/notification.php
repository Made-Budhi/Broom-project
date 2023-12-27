<h1>Notifikasi</h1>

<div class="d-flex flex-column-reverse">

<?php

if (!empty($notifikasi)) {
	foreach ($notifikasi as $data) {

		echo "<div class='d-flex align-items-center mt-4 gap-5'>";

		switch ($data->type) {

			// Pengajuan reservasi berhasil diajukan
			case 201:
			?>
					<!-- Icon -->
					<div style="background: #FFD43B; height: 85px; width: 85px; border-radius: 42.5px" class="d-flex justify-content-center align-items-center">
						<i class="fa-regular fa-hourglass-half" style="color: #f8f8f8; font-size: 2rem"></i>
					</div>

					<div>
						<div class="d-flex"><h4>Permintaan persetujuan </h4><p class="text-dark-grey"> <?= format_indo($data->reservation_date) ?></p></div>
						<p>Permintaan persetujuan mengenai reservasi ruangan <?= $data->name ?> untuk tanggal <?= format_indo($data->date_start)?>
							hingga <?= format_indo($data->date_end) ?> sedang menunggu persetujuan dari <?= $data->position ?>.</p>
					</div>
			<?php
				break;
            
		    }

		echo "</div>";

	}
} else {

	?>

	<div>
		<h1><?= !empty($message) ? $message : '' ?></h1>
	</div>

	<?php

}

?>

</div>
