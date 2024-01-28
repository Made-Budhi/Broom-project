<?php
view_data($ruangan);
view_data($reservasi);
?>

<div class="row" id="content">
	<div class="col-6" id="left">
		<div class="" id="image">
			<img class="rounded w-100" src="<?= base_url('assets/images/ruangan/' . $ruangan->image) ?>" alt="<?= $ruangan->name ?>">
		</div>

    <?php if ($this->session->get_userdata()['role'] == AccountRole::PENGELOLA) { ?>
      <div class="d-flex gap-5 mt-3">
        <!-- Button Edit trigger modal -->
        <a type="button" class="btn btn-primary mb-4 flex-grow-1" data-bs-toggle="modal"
           data-bs-target="#edit-room-modal">
          Edit
        </a>

        <!-- Button Delete trigger modal -->
        <a type="button" class="btn btn-danger mb-4 flex-grow-1" data-bs-toggle="modal"
           data-bs-target="#delete-room-modal">
          Hapus
        </a>
    </div>

    <!-- Modal Edit -->
    <div class="modal fade" id="edit-room-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Ruangan</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
			
			<?= form_open_multipart('rooms/change', 'id="form-ruangan"') ?>
          <div class="modal-body">
            <div hidden>
              <label for="inputHidden"></label>
              <input name="id_room" type="number" value="<?= $ruangan->id; ?>" id="inputHidden">
              <input name="img_name" type="text" value="<?= $ruangan->image; ?>" id="inputHidden">
            </div>
            <div class="mb-3">
              <label for="inputRoomName" class="form-label">Nama</label>
              <input type="text" class="form-control" id="inputRoomName"
                     aria-describedby="emailHelp" name="name"
                     placeholder="Nama gedung/ruangan" value="<?= $ruangan->name ?>">
            </div>

            <div class="mb-3">
              <label class="form-label" for="inputRoomStatus">Status</label>
              <select class="form-select" id="inputRoomStatus"
                      name="status">
                <option value="1"
                        <?= !empty($ruangan->status) ? 'selected':'' ?>>
                  Tersedia
                </option>
                <option value="0"
                        <?= empty($ruangan->status) ? 'selected':'' ?>>
                  Tidak Tersedia
                </option>
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
                        name="description"><?= $ruangan->description ?></textarea>
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
    
    <!-- Modal Delete -->
    <div class="modal fade" id="delete-room-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Konfirmasi Penghapusan Ruangan</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          
          <div class="modal-body text-center">
            Apakah yakin menghapus Ruangan <?= $ruangan->name ?> ?
          </div>

          <div class="d-flex justify-content-center gap-5 mb-3">
            <form method="post" action="<?= site_url('rooms/delete') ?>">
              <label hidden>
                <input type="text" name="id" value="<?= $ruangan->id ?>">
              </label>
              <button type="submit" class="btn btn-danger px-3"
                      data-bs-dismiss="modal">Yes</button>
            </form>
          </div>
        </div>
      </div>
    </div>
    <?php } ?>

		<?php if ($this->session->get_userdata()['role'] == AccountRole::PEMINJAM) {?>

			<form action="<?= site_url('creservasi') ?>" method="post" class="mt-5">
				<input type="text" name="pilihan-ruangan" id="" value="<?= $ruangan->id ?>" hidden>
				<button class="btn btn-primary w-100 p-2" type="submit">Ajukan Reservasi</button>
			</form>

		<?php } ?>
	</div>

	<div class="col-6" id="right">
		<!-- Nama Ruangan -->
		<h3><?= $ruangan->name ?></h3>
		<p><?= $ruangan->description ?></p>
		<div id="calendar" class=""></div>
	</div>
</div>

<div class="mt-5">
	<p id="message" hidden></p>
	<table id="list-reservasi" class="table table-bordered" hidden>
		<thead>
		<tr>
			<th>Peminjam</th>
			<th>Tanggal Mulai</th>
			<th>Tanggal Selesai</th>
			<th>Aksi</th>
		</tr>
		</thead>

		<tbody id="list-data"></tbody>
</div>

<script>
	document.addEventListener('DOMContentLoaded', function() {

		const calendarEl = document.getElementById('calendar')
		const eventsData = <?php echo json_encode($reservasi) ?>

		const events = eventsData.map(function(item) {
			return {
				'title': item.event,
				'start': item.date_start + " " + item.time_start,
				'end': item.date_end + " " + item.time_end
			}
		})

		const calendar = new FullCalendar.Calendar(calendarEl, {
			initialView: 'dayGridMonth',
			selectable: true,
			themeSystem: 'Materia',
			handleWindowResize: true,
			locale: 'in',
			// height: 100%,
			headerToolbar: {
				left: 'prev,next today',
				center: 'title',
				right: 'dayGridMonth,listWeek'
			},

			events: events,

			dateClick: function (info) {
				console.log(info.dateStr)

				$.post("<?= site_url('crooms/room_schedule') ?>", {
					date: info.dateStr,
					ruangan: <?= $ruangan->id ?>
				},
				function (response) {
					let data = JSON.parse(response);

					console.log(data)

					let message = $('#message')
					let list = $('#list-reservasi')

					if (data.length === 0) {
						message.html('Tidak ada reservasi')
						list.attr('hidden', true)
						message.removeAttr('hidden')
					} else {
						let html = ""

						$.each(data, function (rowIndex, i) {
							html += "<tr>"

							html += "<td>" + i.name + "</td>"
							html += "<td>" + i.date_start + "</td>"
							html += "<td>" + i.date_end + "</td>"
							html += "<td><a class='btn btn-primary' target='_blank' " +
								"href='https://wa.me/" + i.phone + "'>Kontak</a></td>"

							html += "</tr>"
						})

						$('#list-data').html(html)
						message.attr('hidden', true)
						list.removeAttr('hidden')
					}
				})
			}
		})
		calendar.render()
	})
</script>
