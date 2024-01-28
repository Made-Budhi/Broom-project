<h1>Dashboard</h1>
<br>
<h3>Fitur yang bisa kamu coba</h3>

<h4>History Reservasi</h4>

<br>

<div class="card mb-3">
  <div class="row g-0">
    <div class="d-flex justify-content-between align-items-center">
      <div class="card-body">
        <h1 class="card-title">Persetujuan mudah!</h1>
        <h3 class="card-text">Mulai melakukan penyetujuan reservasi gedung hanya dari perangkat elektronik anda!</h3>
        <a class="btn btn-primary btn-lg" href="<?=  site_url('reservation') ?>">Setujui Reservasi</a>
      </div>
      <div class="col-md-0" style="width: 50%">
        <img src="<?= base_url("./assets/images/office.svg") ?>"
             class="card-img-bottom float-right m-auto" alt="...">
      </div>
    </div>
  </div>
</div>

<br>

<h2 class="card-title">History Persetujuan</h2>
<table class="table table-bordered">

  <thead>
  <th class="text-center" scope="col">Tanggal Direservasi</th>
  <th class="text-center" scope="col">Nama</th>
  <th class="text-center" scope="col">Status</th>
  <th class="text-center" scope="col">Aksi</th>
  </thead>

  <tbody>
    <?php
    $no = 1;
    view_data($hasil, 'date_assigned', 'peminjam_name', 'reservasi_status');
    foreach ($hasil as $data):
    ?>
      <tr>
        <td class="text-center">
        	<?php echo format_indo($data->date_assigned); ?>
        </td>
        <td class="text-center">
			<?php echo $data->peminjam_name ?>
		</td>
	  	<td>
			<?php echo $data->reservasi_status ?>
		</td>
        <td class="text-center">
          <a type="button" class="btn btn-sm btn-primary" href="<?= site_url('reservation/document/' . $data->reservasi_id) ?>" target="_blank">Detail</a>
        </td>
      </tr>
    <?php
    $no++;
    endforeach;
    ?>
  </tbody>
</table>
