<h1>Ruangan</h1>

<div>
	<!-- Button trigger modal -->
	<button type="button" class="btn btn-primary mb-4" data-bs-toggle="modal" data-bs-target="#exampleModal">
		Tambah Ruangan
	</button>

	<!-- Modal -->
	<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Ruangan</h1>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>

				<?= form_open_multipart('rooms/add', 'id="form-reservasi"') ?>
				<div class="modal-body">
					<div class="mb-3">
						<label for="inputRoomName" class="form-label">Nama</label>
						<input type="text" class="form-control" id="inputRoomName"
							   aria-describedby="emailHelp" name="name"
							   placeholder="Nama gedung/ruangan">
					</div>

					<div class="mb-3">
						<label class="form-label" for="inputRoomStatus">Status</label>
						<select class="form-select" id="inputRoomStatus"
								name="status">
							<option value="" selected>Pilihan</option>
							<option value="1">Tersedia</option>
							<option value="0">Tidak Tersedia</option>
						</select>
					</div>

					<div class="mb-3">
						<label class="form-label" for="inputRoomImage">Gambar</label>
						<input type="file" class="form-control" id="inputRoomImage"
							   name="image">
					</div>

					<div class="mb-3">
						<label for="inputRoomDescription" class="form-label">Deskripsi</label>
						<textarea placeholder="Deskripsi ruangan/gedung yang disewakan"
								  class="form-control" id="inputRoomDescription"
								  name="description"></textarea>
					</div>
				</div>

				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-primary">Save changes</button>
				</div>
				<?= form_close() ?>
			</div>
		</div>
	</div>

  <!-- Search bar with dropdown -->
  <div class="input-group mb-3 dropdown-content">
    <span class="input-group-text" id="basic-addon1">
      <i class="fa-solid fa-magnifying-glass"></i>
    </span>
    <input id="inputSearch" type="search" placeholder="Ruangan"
           aria-label="SearchRuangan" aria-describedby="basic-addon1"
           onkeyup="showResult('room_name')" autocomplete="off" autocapitalize="off"
           class="form-control dropdown-toggle" data-bs-toggle="dropdown"
           data-bs-auto-close="outside">
    <ul id="livesearch" class="dropdown-menu col-11">
      <li id="head-result" class="d-flex container">
        <div class="col">Nama</div>
        <li class="dropdown-divider">
      </li>
      <li><div class="dropdown-item disabled">No Suggestion</div></li>
    </ul>
    
    <ul id="default-result-dropdown" hidden>
      <li class="d-flex container">
        <div class="col">Nama</div>
        <li class="dropdown-divider">
      </li>
      
      <li>
        <div class="dropdown-item disabled">No Suggestion</div>
      </li>
    </ul>
  </div>

	<?php
	view_data($hasil);
	$no = 1;
	foreach ($hasil as $data): ?>

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
				   class="btn btn-primary btn-md w-75">Lihat Detail</a>
			</div>

		</div>
  
  <?php
  $no++;
	endforeach;
	?>
</div>

<script src="<?= base_url('js/livesearch/search.js') ?>"></script>
