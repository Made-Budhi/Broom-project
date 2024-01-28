	<!-- load bootstrap, font-awesome, style, googlefont  -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="<?= base_url('assets/styles/sidebar.css')?>">
    
      <!-- Bootstrap JS and Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
	
	<style>
		@import url('https://fonts.googleapis.com/css2?family=Gabarito&family=Geologica&display=swap');
	</style>

<?php
view_data($hasil);
$newData = $hasil[0];
foreach ($hasil as $data):
?>

<div class="card mb-3 w-90 mx-auto">
  <h1 class="w-100 mx-auto card-header text-center border-0">Detail</h1>
  <div class="row g-0">
    <div class="col-md-8">
      <div class="card-body d-flex gap-5 justify-content-between align-items-center">

        <div class="col-md-0">
          <img src="<?= base_url('assets/images/ruangan/' . $data->image) ?>" class="img-fluid rounded-start" alt="...">
        </div>

        <div>
          <p class="card-text">NIM/NIP : <?php echo $data->peminjam_id ?></p>
          <p class="card-text">Nama Ruangan : <?php echo $data->name ?></p>
          <p class="card-text">No.Telp : <?php echo $data->phone ?></p>
          <p class="card-text">Tujuan Penggunaan : <?php echo $data->purpose ?></p>
          <p class="card-text">Tanggal Mulai : <?php echo format_indo($data->date_start) ?> <?php echo $data->time_start ?> </p>
          <p class="card-text">Tanggal Selesai : <?php echo format_indo($data->date_end) ?> <?php echo $data->time_end ?> </p>
        </div>

        <div>

        </div>

    </div>
    <!-- TODO preview pdf tapi apa yang harus diambil dari data? -->
    <a target="_blank" href="<?= site_url('reservation/document/' . $data->reservasi_id) ?>" class="btn btn-primary">lihat dokumen</a>
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
      Buat Keputusan
    </button>
  </div>
</div>

<!-- Modal -->
<div class="modal" id="exampleModal" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" style="text-align: center; margin: 0 auto;">Buat Keputusan</h5>
      </div>
      <div class="modal-body ">
          <p class="text-center">Buat keputusan untuk persetujuan reservasi gedung.</p>
        <div class="d-flex justify-content-center gap-5">
          <button id="terima" type="button" class="btn btn-primary">Terima</button>
          <a type="button" href="<?= site_url('reservation/decision/' . $data->reservasi_id) ?>/deny" class="btn btn-danger">Tolak</a>

        </div>
      </div>
    </div>
  </div>
</div>


<?php
	 	endforeach;
?>

<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#collision-notification" id="collision-btn" hidden>
	Launch Collision Notification Modal
</button>

<!-- Collision Notification Modal -->
<div class="modal fade" id="collision-notification" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
		<div class="modal-content">
			<div class="modal-header">
				<h1 class="modal-title fs-5" id="exampleModalLabel"><i class="fa-solid fa-circle-exclamation text-danger"></i>
				Konfirmasi persetujuan!</h1>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<p>Berikut daftar reservasi yang konflik: </p>
				<ol id="collision-list">
					<!-- Lists of reservation's conflicts here -->
				</ol>
				<p>Dengan menekan tombol konfirmasi, anda akan menyetujui reservasi nomor <strong><?= $newData->document_number ?></strong>
					dan akan secara otomatis menolak reservasi lain dalam daftar.</p>
			</div>
			<div class="modal-footer">
				<button type="button" id="close-conflict" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
				<a id="confirm" href="<?= site_url('reservation/decision/' . $newData->reservasi_id) ?>/accept" class="btn btn-primary">Konfirmasi</a>
			</div>
		</div>
	</div>
</div>

<script>
	$(document).ready(function () {
		let ruangan 	= "<?= $newData->ruangan_id ?>"
		let dateStart	= "<?= $newData->date_start ?>"
		let dateEnd		= "<?= $newData->date_end ?>"
		let timeStart	= "<?= $newData->time_start ?>"
		let timeEnd		= "<?= $newData->time_end ?>"

		$('#exampleModal').on('shown.bs.modal', function () {
			$('#terima').click(function () {
				console.log('lol')

				$.post("<?= site_url('creservasi/get_reservation_collide') ?>", {
					ruangan: ruangan,
					dateStart: dateStart,
					dateEnd: dateEnd,
					timeStart: timeStart,
					timeEnd: timeEnd
				},
				function (response) {
					let data = JSON.parse(response)

					if (! data.isNull) {
						$('#collision-list').empty()
						$.each(data, function (index, value) {
							$('#collision-list').append('<li>No. dokumen ' + value.document_number + ', dengan kegiatan ' + value.event + '</li>')
						})

						$('#collision-btn').click()
					} else {
						$('#confirm').click()
					}
				})

			})
		})

	})
</script>
