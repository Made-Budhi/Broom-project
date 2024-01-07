<!-- load bootstrap, font-awesome, style, googlefont  -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="<?= base_url('assets/styles/sidebar.css')?>">

<style>
  @import url('https://fonts.googleapis.com/css2?family=Gabarito&family=Geologica&display=swap');
</style>

<h1>Data Reservasi Peminjam</h1>

<br>

<?php
view_data($hasil, 'name', 'purpose', 'reservasi_status', 'reservasi_id');
if($hasil == NULL){
  echo "data kosong";
} else {
?>

<table class="table table-bordered" >

  <thead>
  <th class="text-center" scope="col">No</th>
  <th class="text-center" scope="col">Nama Ruangan</th>
  <th class="text-center" scope="col">Waktu</th>
  <th class="text-center" scope="col">Status</th>
  <th class="text-center" scope="col">Aksi</th>
  </thead>

<?php
$no=1;
foreach ($hasil as $data):
?>
  <tbody>

      <tr>
        <td class="text-center">
          <?php echo $no ?>
        </td>
        <td class="text-center">
          <?php echo $data->name ?>
        </td>
        <td class="text-center">
          <?php echo $data->date_start ?>
        </td>
        <td class="text-center">
          <?php echo $data->reservasi_status ?>
        </td>
        <td class="text-center">
          <a target="_blank" href="<?= site_url('reservation/document/' . $data->reservasi_id) ?>" class="btn btn-primary">Detail dokumen</a>
        </td>
      </tr>

<?php
$no++;
endforeach; 
}
?>

  </tbody>
</table>

