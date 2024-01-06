<h1>Reservasi</h1>

<?php

?>

<table class="table table-bordered">

	<thead>
	<th class="text-center" scope="col">Peminjam</th>
	<th class="text-center" scope="col">Ruangan</th>
	<th class="text-center" scope="col">Tanggal</th>
	<th class="text-center" scope="col">Pengajuan</th>
	<th class="text-center" scope="col">Status</th>
	<th class="text-center" scope="col">Aksi</th>
	</thead>

	<tbody>
	<?php
	$no = 1;
  view_data($reservation);
  ?>
  
	<?php
  if (empty($reservation))
    echo "<h3>Tidak Ada Reservasi</h3>";
  ?>
		
  
		<?php foreach ($reservation as $data): ?>
			<tr>
				<td class="text-center"><?php echo $data->peminjam ?></td>
				<td class="text-center"><?php echo $data->ruangan ?></td>
				<td class="text-center"><?php echo format_indo($data->date_start) ?> - <?php echo format_indo($data->date_end) ?></td>
				<td class="text-center"><?php echo $data->pimpinan ?></td>
				<td class="text-center"><?php echo $data->reservasi_status ?></td>

				<!-- Action -->
				<td class="text-center">
					<a target="_blank" href="<?= site_url('reservation/document/' . $data->reservasi_id) ?>" class="btn btn-primary">Lihat Dokumen</a>

					<!-- Button trigger modal-->
					<button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="<?= $data->reservasi_id ?>">
						Batalkan Reservasi
					</button>
				</td>
			</tr>
    <?php endforeach ?>
	</tbody>
</table>

<!--MODAL-->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h1 class="modal-title fs-5" id="exampleModalLabel">Konfirmasi Pembatalan</h1>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<form action="<?= site_url('reservation/cancel') ?>" method="post">
					<input type="text" name="reservasi_id" class="form-control" id="reservasi_id" hidden>

					<div class="mb-3">
						<label for="message" class="col-form-label">Pesan:</label>
						<textarea name="message" rows="5" class="form-control" id="message"></textarea>
					</div>

					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
						<button type="submit" class="btn btn-danger">Batalkan Reservasi</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

<script>
	const exampleModal = document.getElementById('exampleModal')
	if (exampleModal) {
		exampleModal.addEventListener('show.bs.modal', event => {
			// Button that triggered the modal
			const button = event.relatedTarget
			// Extract info from data-bs-* attributes
			const id = button.getAttribute('data-bs-whatever')
			// Update the modal's content.
			const modalBodyInput = exampleModal.querySelector('#reservasi_id')
			// Set reservation id into #reservasi_id input
			modalBodyInput.value = id
		})
	}
</script>
