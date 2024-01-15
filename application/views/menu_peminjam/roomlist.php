<?php
view_data($hasil);
$no = 1;
foreach ($hasil as $data):
	?>
  <div class="card" style="width: 18rem;">
    <img src="<?= $data->image ?>" class="card-img-top" alt="...">
    <div class="card-body">
      <h5 class="card-title">
		  <?= $data->name ?>
      </h5>

      <p class="card-text">
		  <?= $data->description ?>
      </p>

      <a href="<?= site_url('rooms/detailrooms?id=' . $data->id); ?>"
         class="btn btn-primary">Lihat Detail</a>
    </div>
  </div>
	<?php
	$no++;
endforeach;
?>
