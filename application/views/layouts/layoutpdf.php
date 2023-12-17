<?php

$path = base_url() . 'assets/images/logo-pnb.png';
$type = pathinfo($path, PATHINFO_EXTENSION);
$content = file_get_contents($path);
$logo_pnb = 'data:image/' . $type . ';base64,' . base64_encode($content);

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>Preview PDF</title>

	<style>
		html, body,

		@page {
			margin-left: 30px;
			margin-right: 30px;
		}

		header {
			margin-top: -30px !important;
		}

		.header {
			text-align: center;
			line-height: 3px;
		}


		.header-table td {
			border: 1px solid green;
		}

		hr {
			height: 1px;
			background-color: black;
		}

		.tab {
			text-indent: 2em;
		}

		.text-small {
			font-size: 14px;
		}
	</style>
</head>
<body>
<header>
	<?php
	if (empty($data['pilihan-logo-pnb'])) {

		if (!empty($data['left-logo'])) {
			$path = base_url() . 'assets/images/left_logo/' . $data['left-logo'];
			$type = pathinfo($path, PATHINFO_EXTENSION);
			$content = file_get_contents($path);
			$left_logo = 'data:image/' . $type . ';base64,' . base64_encode($content);

			?>

			<img style="position: absolute; margin-top: 25px; margin-left: -20px; width: 100px;"
				 src="<?php echo $left_logo ?>" alt="">

			<?php
		}
	} else {

		?>

		<img style="position: absolute; margin-top: 25px; margin-left: -20px; width: 100px;"
			 src="<?php echo $logo_pnb ?>" alt="">

		<?php

	}
	?>
	<div class="header">
		<p style="font-size: 20px;">KEMENTRIAN PENDIDIKAN, KEBUDAYAAN,</p>
		<p style="font-size: 20px;">RISET, DAN TEKNOLOGI</p>
		<p style="font-size: 18px; font-weight: bold;">POLITEKNIK NEGERI BALI</p>
		<?php

		if (!empty($data)) {
			if ($data['pilihan-organisasi']) {
				echo "<p>KELUARGA BESAR MAHASISWA</p>";
				echo "<p style='font-weight: bold;'>" . $data['nama-organisasi'] . "</p>";
			}
		}

		?>
		<p class="text-small">Jalan Kampus Bukit Jimbaran, Kuta Selatan, Kabupaten Badung, Bali - 80364</p>
		<p class="text-small">Telp. (0361) 701981 (hunting) Fax. 701128</p>
		<p class="text-small">Laman: www.pnb.ac.id, Email: poltek@pnb.ac.id</p>
	</div>

	<?php
	if (!empty($data['right-logo'])) {

		$path = base_url() . 'assets/images/right_logo/' . $data['right-logo'];
		$type = pathinfo($path, PATHINFO_EXTENSION);
		$content = file_get_contents($path);
		$right_logo = 'data:image/' . $type . ';base64,' . base64_encode($content);

		?>
		<img style="position: absolute; right: 0; top: 0;  width: 100px;"
			 src="<?php echo $right_logo ?>" alt="logo organisasi">
		<?php
	}
	?>
</header>
<hr>
<main style="margin: 0;">
	<table>
		<tr>
			<td style="width: 100px;">Nomor</td>
			<td style="width: 430px;">: <?php echo $data['nomor-dokumen'] ?></td>
			<td><?php echo format_indo($data['tanggal-pengajuan']) ?></td>
		</tr>

		<tr>
			<td>Lampiran</td>
			<td>: <?php echo $data['lampiran'] ?></td>
		</tr>

		<tr>
			<td>Perihal</td>
			<td>:
				<bold><?php echo $data['perihal'] ?></bold>
			</td>
		</tr>
	</table>

	<br><br>

	<p>Yth. Koordinator Bagian Adminitrasi Umum dan Keuangan</p>
	<p class="tab">Politeknik Negeri Bali</p>
	<p class="tab">Di Bukit Jimbaran</p>

	<br>

	<p>Dengan Hormat,</p>
	<p>Sehubung dengan diadakan kegiatan <?php echo $data['kegiatan'] ?> yang diselenggarakan
		oleh <?php echo $data['penyelenggara'] ?>.
		Maka dengan ini kami selaku panitia pelaksana memohon izin untuk meminjam dan menggunakan
		Ruangan <?php echo $data['nama-ruangan'] ?>
		pada:</p>

	<table class="tab">
		<tr>
			<td style="width:175px;">Hari / Tanggal</td>
			<td style="width:400px;">
				: <?php echo format_indo($data['tanggal-mulai']) . ' - ' . format_indo($data['tanggal-selesai']) ?></td>
		</tr>

		<tr>
			<?php
			$jammulai = str_replace(':', '.', $data['jam-mulai']);
			$jamselesai = str_replace(':', '.', $data['jam-selesai']);
			?>
			<td>Waktu</td>
			<td>: <?php echo $jammulai . ' - ' . $jamselesai ?></td>
		</tr>
	</table>

	<br><br>

	<p>Atas perhatian dan kerja samanya, kami sampaikan terima kasih.</p>

	<br><br>

	<table>
		<tr>
			<td style="width:450px;">Mengetahui</td>
			<td>Panitia Pelaksana</td>
		</tr>
		<tr>
			<td style="width:450px;"><?php echo $data['jabatan-pimpinan'] ?>,</td>
			<td>Ketua,</td>
		</tr>

		<?php

		// Encode ttd-ketua-panitia image into base64
		$path = base_url() . 'assets/images/signature_peminjam/' . $data['ttd-ketua-panitia'];
		$type = pathinfo($path, PATHINFO_EXTENSION);
		$content = file_get_contents($path);
		$signature = 'data:image/' . $type . ';base64,' . base64_encode($content);

		if ($data['status'] == 'disetujui') {
			$path = base_url() . 'assets/images/signature_pimpinan/' . $data['ttd-pimpinan'];
			$type = pathinfo($path, PATHINFO_EXTENSION);
			$content = file_get_contents($path);
			$agreementsignature = 'data:image/' . $type . ';base64,' . base64_encode($content);
		}

		?>

		<tr>
			<td><?php echo $data['status'] == 'disetujui' ? $agreementsignature : '' ?></td>
			<td><img style="width: 150px" src="<?php echo $signature ?>" alt=""></td>
		</tr>

		<tr>
			<td><?php echo $data['nama-pimpinan'] ?></td>
			<td><?php echo $data['nama-ketua-panitia'] ?></td>
		</tr>

		<tr>
			<td>NIP. <?php echo $data['id-pimpinan'] ?></td>
			<td><?php echo strlen($data['id-ketua-panitia']) > 10 ? 'NIP.' : 'NIM.' ?><?php echo $data['id-ketua-panitia'] ?></td>
		</tr>
	</table>

	<br><br><br>


	<?php
	if (!($data['tembusan']) == '') {

		$tembusan = explode(',', $data['tembusan']);

		echo '<p>Tembusan:</p>';
		echo '<ol>';

		foreach ($tembusan as $item) {
			?>

			<li><?php echo $item ?></li>

			<?php
		}

		echo '</ol>';
	}
	?>


</main>
</body>
</html>
