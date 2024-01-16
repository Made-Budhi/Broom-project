<?php
view_data($hasil);
$no = 1;
foreach ($hasil as $data):
	?>
  
  <div class="row border border-secondary p-3 mb-5 bg-body rounded">
    
    <div class="col-6 text-center" style="height: 20rem; width: 40%; overflow: hidden;">
      <img src="<?= base_url('assets/images/ruangan/' . $data->image) ?>" class="rounded  img-fluid" alt="">
    </div>

    <div class="col-6 overflow-auto">
      <h5><?= $data->name ?></h5>  
      <p><?= $data->description ?></p>
      <p><?php if($data->status==1){
        echo "Tersedia";
        } else {
          echo "Tidak Tersedia";
        } ?></p>
      <a href="<?= site_url('rooms/detailrooms?id=' . $data->id); ?>"
          class="btn btn-primary">Lihat Detail</a>
    </div>
    
  </div>
	<?php
	$no++;
endforeach;
?>
