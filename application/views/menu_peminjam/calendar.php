<?php
view_data($ruangan);
view_data($reservasi);
?>

<div class="row" id="content">
	<div class="col-6" id="left">
		<div class="" id="image">
			<img class="rounded w-100" src="<?= base_url('assets/images/ruangan/' . $ruangan->image) ?>" alt="<?= $ruangan->name ?>">
		</div>

		<form action="<?= site_url() ?>" class="mt-5">
			<button class="btn btn-primary w-100 p-2" type="submit">Ajukan Reservasi</button>
		</form>
	</div>

	<div class="col-6" id="right">
		<!-- Nama Ruangan -->
		<h3><?= $ruangan->name ?></h3>
		<p><?= $ruangan->description ?></p>
		<div id="calendar" class=""></div>
	</div>
</div>

<div>
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
