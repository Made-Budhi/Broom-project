<?php
view_data($hasil);
$no = 1;
foreach ($hasil as $data):
	?>

	<div class="row border border-light p-3 mb-3 bg-body rounded">

		<div class="col-6" style="width: 40%; overflow: hidden;">
			<img src="<?= base_url('assets/images/ruangan/' . $data->image) ?>" class="w-100 v-100"
				 style="object-fit: cover; display: block" alt="">
		</div>

		<div class="col-6 overflow-auto d-flex flex-column justify-content-between">

			<div class="d-flex flex-column justify-content-between">
				<div>
					<h1><?= $data->name ?></h1>
					<p class="text-lg-start" style=""><?= $data->description ?></p>
				</div>
				<p class="fs-5 fw-bold"><?php if ($data->status == 1) {
						echo "<i class='fa-solid fa-circle-check text-primary'></i> Tersedia";
					} else {
						echo "<i class='fa-solid fa-circle-xmark text-danger'></i> Tidak Tersedia";
					} ?></p>
			</div>

			<a href="<?= site_url('rooms/detailrooms?id=' . $data->id); ?>"
			   class="btn btn-primary btn-md w-75" <?= $data->status == 1 ? '' : 'disabled' ?>>Lihat Detail</a>
		</div>

	</div>
	<?php
	$no++;
endforeach;
?>
