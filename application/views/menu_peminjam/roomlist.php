<?php

$no = 1;

if (!empty($hasil)) {
	foreach ($hasil as $data):
		?>

		<div class="card" style="width: 18rem;">
			<img src="<?php echo base_url('assets/images/ruangan/') . $data->image ?>" class="card-img-top" alt="...">
			<div class="card-body">
				<h5 class="card-title"><?php echo $data->name ?></h5>
				<p class="card-text"><?php echo $data->description ?></p>
				<a href="<?php echo site_url('crooms/view?id=' . $data->id); ?>"
				   class="btn btn-primary">Lihat Detail</a>
			</div>
		</div>

		<?php

		$no++;
	endforeach;
}
?>
