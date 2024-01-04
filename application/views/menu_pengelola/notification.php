<h1>Notifikasi</h1>

<div class="d-flex flex-column-reverse">

	<?php

	if (!empty($hasil['notifikasi'])) {
		foreach ($hasil['notifikasi'] as $data) {

			echo "<div class='d-flex align-items-center mt-4 gap-5'>";

			switch ($data->type) {

				case 301:
				?>

				<div>
					<p>Reservasi ruangan <?= $data->ruangan ?> yang diajukan oleh <?= $data->peminjam ?> dari tanggal <?= format_indo($data->date_start) ?>
						hingga <?= format_indo($data->date_end) ?> telah disetujui oleh <?= $data->pimpinan ?></p>
				</div>

				<?php
				break;

				case 302:
				?>

				<div>
					<p>Reservasi <?= $data->ruangan ?> yang diajukan oleh <?= $data->peminjam ?> dari tanggal <?= format_indo($data->date_start) ?>
						hingga <?= format_indo($data->date_end) ?> berhasil dibatalkan.</p>
				</div>

				<?php
				break;
			}

			echo "</div>";

		}
	} else {

		?>

		<div>
			<h1><?= !empty($hasil['message']) ? $hasil['message'] : '' ?></h1>
		</div>

		<?php

	}

	?>

</div>
