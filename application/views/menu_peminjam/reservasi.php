<?php

date_default_timezone_set('Asia/Makassar');
$current_date = now();
$formatted_date = format_indo(date('Y-m-d', $current_date));

?>


<div class="overflow-hidden h-100 row d-flex w-75 m-auto justify-content-center align-items-center"
	 id="intro-reservasi">
	<div class="align-items-start d-flex">
		<div class="col">
			<img src="<?= base_url("assets/svg/reservation-img.svg") ?>" alt="">
		</div>
		<div class="col d-flex gap-2 flex-column">
			<h2>Ajukan reservasi hanya dalam genggaman</h2>
			<p class="">Dapatkan kemudahan dalam mengakses jadwal peminjaman dan meminjam gedung yang tersedia di Kampus
				Politeknik Negeri Bali.</p>
			<button class="text-center btn gabarito my-4 py-2 mb-3 fs-5 rounded-3 text-start w-100 btn-primary"
					onClick="toggleUnhide()">Buat Reservasi Baru
			</button>
		</div>
	</div>
</div>

<section class="reservasi d-none row gap-5 overflow-hidden">
	<div>
		<h1>Formulir</h1>
		<p>Keterangan:</p>
		<ul>
			<li><span class="keterangan">*</span> : wajib</li>
			<li><span class="keterangan">**</span> : wajib jika kondisi sebelumnya adalah iya/benar</li>
		</ul>

		<div class="message">
			<p><?php div_alert_info('message'); ?></p>
		</div>
	</div>

	<?= form_open_multipart('', "id='form-reservasi' class='form-reservasi col-12 col-md-8 position-relative'") ?>

	<div class="wizard-v1-content">
		<div class="wizard-form">
			<form class="form-reservasi" id="form-reservasi" action="#" method="post">
				<div id="form-total">
					<!-- SECTION 1 -->
					<h2>
						<span class="step-icon"><i class="fa-solid fa-check"></i></span>
						<span class="step-number text-reset">Langkah 1</span>
						<span class="step-text text-reset">Data Peminjam</span>
					</h2>
					<section>
						<h3>Data Peminjam</h3>

						<div class="pilihan-organisasi">
							<label for="organisasi">Organisasi Mahasiswa?<span class="keterangan">*</span></label>

							<label for="pilihan-organisasi-ya">Ya</label>
							<input type="radio" name="pilihan-organisasi" id="pilihan-organisasi-ya"
								   value="<?= true ?>">

							<label for="pilihan-organisasi-tidak">Tidak</label>
							<input type="radio" name="pilihan-organisasi" id="pilihan-organisasi-tidak"
								   value="<?= false ?>" checked>

							<div class="organisasi-tidak">
								<label for="nama-organisasi">Nama Organisasi<span class="keterangan">**</span></label>
								<input class="w-100 form-control" type="text" name="nama-organisasi"
									   id="nama-organisasi">
							</div>
						</div>

						<label for="penyelenggara">Penyelenggara<span class="keterangan">*</span></label>
						<input class="w-100 form-control" type="text" name="penyelenggara" id="penyelenggara" required>

						<div class="ketua-panitia">
							<label for="nama-ketua-panitita">Ketua Panitia<span class="keterangan">*</span></label>
							<input class="w-100 form-control" type="text" name="nama-ketua-panitia"
								   id="nama-ketua-panitia" required>

							<label for="id-ketua-panitia">Nomor Induk Ketua Panitia<span
									class="keterangan">*</span></label>
							<input class="w-100 form-control" type="text" name="id-ketua-panitia" id="id-ketua-panitia"
								   required>

							<label for="ttd-ketua-panitia">Spesimen Tanda Tangan Ketua Panitia<span
									class="keterangan">*</span></label>
							<input class="w-100 form-control" type="file" name="ttd-ketua-panitia"
								   id="ttd-ketua-panitia" required>
						</div>


						<!-- Ruangan: ruangan, tanggal-mulai, jam-mulai, tanggal-selesai, jam-selesai -->

						<h3 class="mt-3">Ruangan</h3>

						<label for="ruangan">Ruangan<span class="keterangan">*</span></label>
						<select class="w-100 form-control" name="ruangan" id="ruangan">
							<option value="" selected disabled>Pilih Ruangan</option>

							<?php

							$dataruangan = $this->db->get('Ruangan')->result();

							foreach ($dataruangan as $ruangan) {

								?>
								<option value="<?= $ruangan->id ?>"><?= $ruangan->name ?></option>
								<?php

							}

							?>
						</select>

						<div class="waktu-mulai">
							<label for="tanggal-mulai">Tanggal Mulai<span class="keterangan">*</span></label>
							<input class="w-100 form-control" type="date" name="tanggal-mulai" id="tanggal-mulai"
								   required>

							<label for="jam-mulai">Jam<span class="keterangan">*</span></label>
							<input class="w-100 form-control" type="time" name="jam-mulai" id="jam-mulai" required>
						</div>

						<div class="waktu-selesai">
							<label for="tanggal-selesai">Tanggal Selesai<span class="keterangan">*</span></label>
							<input class="w-100 form-control" type="date" name="tanggal-selesai" id="tanggal-selesai"
								   required>

							<label for="jam-selesai">Jam<span class="keterangan">*</span></label>
							<input class="w-100 form-control" type="time" name="jam-selesai" id="jam-selesai">
						</div>

						<br>
						<div class="ketersediaan-ruangan" hidden>
							<p id="ruangan-message"></p>
							<p id="reservasi-message"></p>
						</div>

					</section>
					<!-- SECTION 2 -->
					<h2>
						<span class="step-icon"><i class="fa-solid fa-check"></i></span>
						<span class="step-number text-reset">Langkah 2</span>
						<span class="step-text text-reset">Data Dokumen</span>
					</h2>
					<section>
						<h3>Data Dokumen</h3>

						<div>
							<label for="tanggal-pengajuan">Tanggal Pengajuan</label>
							<input class="w-100 form-control" type="text" name="tanggal-pengajuan"
								   value="<?= $formatted_date ?>" disabled>


							<label for="nomor-dokumen">Nomor Dokumen<span class="keterangan">*</span></label>
							<input class="w-100 form-control" type="text" name="nomor-dokumen" id="nomor-dokumen"
								   required>


							<label for="lampiran">Lampiran<span class="keterangan">*</span></label>
							<input class="w-100 form-control" type="text" name="lampiran" id="lampiran" required>


							<label for="perihal">Perihal<span class="keterangan">*</span></label>
							<input class="w-100 form-control" type="text" name="perihal" id="perihal" required>

							<label for="kegiatan">Kegiatan<span class="keterangan">*</span></label>
							<input class="w-100 form-control" type="text" name="kegiatan" id="kegiatan" required>

							<label for="pimpinan">Persetujuan Pimpinan<span class="keterangan">*</span></label>
							<select class="w-100 form-control" name="pimpinan" id="pimpinan" required>
								<option value="" disabled selected>Pilih Pimpinan</option>

								<?php
								$datapimpinan = $this->db->get('Pimpinan')->result();

								foreach ($datapimpinan as $pimpinan) {
									?>
									<option value="<?= $pimpinan->id ?>"><?= $pimpinan->position ?></option>
									<?php
								}

								?>

							</select>

						</div>

						<div>
							<label for="tembusan">Tembusan<span class="keterangan">*</span> (pisahkan dengan koma, tanpa
								spasi)</label><br>
							<textarea class="w-100 form-control" name="tembusan" id="tembusan" cols="30" rows="10"
									  required></textarea>
						</div>

						<h3>
							<label for="kostumisasi-lanjutan" id="label-kostumisasi" class="mt-3">
								Kostumisasi Lanjutan
								<i style="transition: .3s ease; transform: rotateZ(180deg)" class="fa-solid fa-caret-up"
								   id="icon-dropdown"></i>
							</label>
						</h3>
						<input class="w-100 form-control" type="checkbox" name="kostumisasi-lanjutan"
							   id="kostumisasi-lanjutan">


						<div class="kostumisasi-lanjutan">
							<label for="logo-pnb">Sertakan Logo PNB</label>

							<label for="pilihan-logo-pnb-ya">Ya</label>
							<input class="" type="radio" name="pilihan-logo-pnb" id="pilihan-logo-pnb-ya"
								   value="<?= true ?>" checked>

							<label for="pilihan-logo-pnb-tidak">Tidak</label>
							<input class="" type="radio" name="pilihan-logo-pnb" id="pilihan-logo-pnb-tidak"
								   value="<?= false ?>">

							<div class="logo-kiri">
								<label for="logo-kiri">Input Logo</label>
								<input class="w-100 form-control" type="file" name="logo-kiri" id="logo-kiri">
							</div>

							<br><br>

							<label for="logo-kanan">Input Logo Kanan Header</label>
							<input class="w-100 form-control" type="file" name="logo-kanan" id="logo-kanan">
						</div>
					</section>
				</div>

				<input type="submit" id="submit-button" value="submit" hidden>
			</form>
		</div>
	</div>
	<br>

	<div class="col-md-3 col-12 text-center position-absolute top-50 end-0 translate-middle-y gap-4 me-5 fit-content p-3 ">
		<img src="<?= base_url("assets/svg/reservation-note-img.svg") ?>" alt="">
		<div class="d-flex flex-column gap-1 mt-4">
			<a class="btn btn-secondary w-100" id="preview-doc" target="_blank">Document Preview</a>
			<button class="btn btn-primary w-100" type="button" data-bs-toggle="modal" data-bs-target="#exampleModal">
				Ajukan Reservasi
			</button>
		</div>
	</div>
	<div class="modal fade border-0" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
		 aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header d-flex flex-column text-center">
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					<img src="<?= base_url("assets/svg/reservation-upload-img.svg") ?>" alt="">
					<h5 class="modal-title" id="exampleModalLabel">Reservasi akan diajukan</h5>
				</div>
				<div class="modal-body text-center w-100">
					<p>Reservasi akan diajukan ke pimpinan. Konfirmasi dengan menekan tombol dibawah dan cek status di
						Dashboard</p>
				</div>
				<div class="modal-footer m-auto">
					<button type="button" class="btn btn-primary" data-bs-dismiss="modal" name="pengajuan-reservasi"
							id="pengajuan-reservasi">Konfirmasi Pengajuan
					</button>
				</div>
			</div>
		</div>
	</div>

	<?= form_close() ?>

	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
	<script src="<?= base_url('js/reservasi-steps/jquery.steps.js'); ?>"></script>
	<script src="<?= base_url('js/reservasi-steps/main.js'); ?>"></script>
	<script>

		const toggleUnhide = () => {
			document.querySelector("#intro-reservasi").classList.toggle("d-none");
			document.querySelector(".reservasi").classList.toggle("d-none");
		}
		// Create different form action depending on user input
		const form = document.getElementById('form-reservasi');
		const buttonpreview = document.getElementById('preview-doc');
		const buttonpengajuan = document.getElementById('pengajuan-reservasi');
		const submitButton = document.getElementById('submit-button');

		buttonpreview.addEventListener('click', function () {
			console.log('lmaoo');
			form.action = "<?php echo site_url('reservation/previewpdf') ?>";
			form.setAttribute('target', '_blank')
			submitButton.click()
		});

		buttonpengajuan.addEventListener('click', function () {
			form.action = "<?php echo site_url('reservation/uploadpdf') ?>";
			submitButton.click()
		});

		// For Kostumisasi Lanjutan dropdown
		const checkKostumisasi = document.getElementById('kostumisasi-lanjutan');
		const labelKostumisasi = document.getElementById('label-kostumisasi');
		const iconDropdown = document.getElementById('icon-dropdown');

		labelKostumisasi.addEventListener('click', function () {
			console.log(iconDropdown)

			if (checkKostumisasi.checked) {
				iconDropdown.style.transform = 'rotateZ(180deg)';
			} else {
				iconDropdown.style.transform = '';
			}
		})

		// Clear sub-input
		const pilihanLogoPnb = document.getElementById('pilihan-logo-pnb-ya');
		const inputLogoKiri = document.getElementById('logo-kiri');

		const pilihanOrganisasi = document.getElementById('pilihan-organisasi-tidak');
		const pilihanOrganisasiYa = document.getElementById('pilihan-organisasi-ya');
		const namaOrganisasi = document.getElementById('nama-organisasi');

		pilihanOrganisasiYa.addEventListener('click', function () {
			namaOrganisasi.setAttribute('required', 'true')
		})

		pilihanLogoPnb.addEventListener('click', function () {
			inputLogoKiri.value = null;
		});

		pilihanOrganisasi.addEventListener('click', function () {
			namaOrganisasi.value = null;
			namaOrganisasi.removeAttribute('required')
		});

		$(document).ready(function () {
			$('label').addClass('mt-2')

			// Triggered when user select Ruangan
			$('#ruangan').change(function () {
				let ruangan = $(this).val();

				$.post("<?= site_url('creservasi/check_ruangan_availability') ?>", {
						ruangan: ruangan,
					},
					function (response) {
						$('#ruangan-message').html(response + ' Reservasi ditemukan.');
						$('.ketersediaan-ruangan').removeAttr('hidden');
					});
			});

			$('#ruangan, #tanggal-mulai, #tanggal-selesai, #jam-mulai, #jam-selesai').change(function () {
				let ruangan = $('#ruangan').val();
				let dateStart = $('#tanggal-mulai').val();
				let dateEnd = $('#tanggal-selesai').val();
				let timeStart = $('#jam-mulai').val();
				let timeEnd = $('#jam-selesai').val();

				$.post("<?= site_url('creservasi/check_reservation_collide') ?>", {
						ruangan: ruangan,
						dateStart: dateStart,
						dateEnd: dateEnd,
						timeStart: timeStart,
						timeEnd: timeEnd
					},
					function (response) {
						let data = JSON.parse(response)
						let message = $('#reservasi-message')
						let buttonPengajuan = $('#pengajuan-reservasi')

						if (data.isNull) {
							message.html('Harap isi form dengan lengkap.');
							message.css('color', 'red')
						} else {
							if (data.isAvailable) {
								message.html('Ruangan tersedia.');
								message.css('color', 'green')
								buttonPengajuan.removeAttr('disabled')
							} else {
								message.html('Sudah ter-reservasi.');
								message.css('color', 'red')
								buttonPengajuan.attr('disabled', 'true')
							}

							$('.ketersediaan-ruangan').removeAttr('hidden');
						}
					});
			});

		});
	</script>

</section>

