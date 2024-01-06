<?php
view_data($hasil, 'gambar', 'nama', 'deskripsi', 'gedung');
$no = 1;
foreach ($hasil as $data):
	?>
  <div class="card" style="width: 18rem;">
    <img src="<?php
	echo $data->gambar ?>" class="card-img-top" alt="...">
    <div class="card-body">
      <h5 class="card-title"><?php
		  echo $data->nama ?></h5>
      <p class="card-text"><?php
		  echo $data->deskripsi ?></p>
      <a href="<?php
         echo site_url('crooms/view?gedung=' . $data->gedung); ?>"
         class="btn btn-primary">Lihat Detail</a>
    </div>
  </div>
	<?php
	$no++;
endforeach;
?>
