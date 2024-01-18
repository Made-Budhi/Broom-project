<!-- load bootstrap, font-awesome, style  -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
	  integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
	  crossorigin="anonymous" referrerpolicy="no-referrer"/>
<link rel="stylesheet" href="<?= base_url('assets/styles/sidebar.css') ?>">

<h1>Dashboard</h1>
<br>
<h3>Fitur yang bisa kamu coba</h3>



<br>

<div class="card mb-3">
	<div class="row g-0">
		<div class="d-flex justify-content-between">
			<div class="card-body d-flex flex-column justify-content-between p-5 gap-5">
				<div>
					<h1 class="card-title">Reservasi gedung sekarang!</h1> <br>
					<h3 class="card-text">Mulai melakukan reservasi hanya dari perangkat elektronik anda !</h3>
				</div>

				<a href="<?= site_url('creservasi') ?>" class="btn btn-primary btn-lg rounded-pill w-50">Buat Reservasi</a>
			</div>
			<div class="">
				<img src="<?= base_url("./assets/images/office.svg") ?>" class="d-block w-75 m-auto mt-5" alt="...">
			</div>
		</div>
	</div>
</div>

<br>

<h4>History Reservasi</h4>
<table class="table table-bordered">

	<thead>
		<th class="text-center" scope="col">No</th>
		<th class="text-center" scope="col">Tanggal Mulai</th>
		<th class="text-center" scope="col">Tanggal Selesai</th>
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
			<td class="text-center"><?php echo $no ?></td>
			<td class="text-center"><?php echo format_indo($data->date_start) . ", " . format_waktu($data->time_start) ?>
			<td class="text-center"><?php echo format_indo($data->date_end) . ", " . format_waktu($data->time_end) ?>
			<td class="text-center"><?php echo $data->name ?></td>
			<td class="text-center"><?php echo $data->reservasi_status ?></td>

			<td class="text-center">
				<a target="_blank" href="<?= site_url('reservation/document/' . $data->reservasi_id) ?>"
				   class="btn btn-primary">Detail dokumen</a>
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
