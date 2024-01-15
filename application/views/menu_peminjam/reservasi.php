<?php

date_default_timezone_set('Asia/Makassar');
$current_date = now();
$formatted_date = format_indo(date('Y-m-d', $current_date));

?>

<section class="reservasi">
	<h1>Formulir</h1>
	<p>Keterangan:</p>
	<ul>
		<li><span class="keterangan">*</span> : wajib</li>
		<li><span class="keterangan">**</span> : wajib jika kondisi sebelumnya adalah iya/benar</li>
	</ul>

	<hr>
  
  <div class="message">
    <p><?php div_alert_info('message'); ?></p>
  </div>

	<?= form_open_multipart('', 'id="form-reservasi"') ?>
	<div>
		<!-- Data Peminjam: organisasi (opsional), penyelenggara, ketua-panitia (nama, id, ttd)  -->
		<h3>Data Peminjam</h3>

		<div class="pilihan-organisasi">
			<label for="organisasi">Organisasi Mahasiswa?<span class="keterangan">*</span></label>

			<label for="pilihan-organisasi-ya">Ya</label>
			<input type="radio" name="pilihan-organisasi" id="pilihan-organisasi-ya" value="<?= true ?>">

			<label for="pilihan-organisasi-tidak">Tidak</label>
			<input type="radio" name="pilihan-organisasi" id="pilihan-organisasi-tidak" value="<?= false ?>" checked>

			<div class="organisasi-tidak">
				<label for="nama-organisasi">Nama Organisasi<span class="keterangan">**</span></label>
				<input type="text" name="nama-organisasi" id="nama-organisasi">
			</div>
		</div>

		<br><br>

		<label for="penyelenggara">Penyelenggara<span class="keterangan">*</span></label>
		<input type="text" name="penyelenggara" id="penyelenggara" required>

		<br><br>

		<div class="ketua-panitia">
			<label for="nama-ketua-panitia">Ketua Panitia<span class="keterangan">*</span></label>
			<input type="text" name="nama-ketua-panitia" id="nama-ketua-panitia" required>

			<br><br>

			<label for="id-ketua-panitia">Nomor Induk Ketua Panitia<span class="keterangan">*</span></label>
			<input type="text" name="id-ketua-panitia" id="id-ketua-panitia" required>

			<br><br>

			<label for="ttd-ketua-panitia">Spesimen Tanda Tangan Ketua Panitia<span class="keterangan">*</span></label>
			<input type="file" name="ttd-ketua-panitia" id="ttd-ketua-panitia" required>
		</div>

		<br><hr><br>

		<!-- Ruangan: ruangan, tanggal-mulai, jam-mulai, tanggal-selesai, jam-selesai -->
		<h3>Ruangan</h3>

		<label for="ruangan">Ruangan<span class="keterangan">*</span></label>
		<select name="ruangan" id="ruangan" required>
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

		<br><br>

		<div class="waktu-mulai">
			<label for="tanggal-mulai">Tanggal Mulai<span class="keterangan">*</span></label>
			<input type="date" name="tanggal-mulai" id="tanggal-mulai" required>

			<label for="jam-mulai">Jam<span class="keterangan">*</span></label>
			<input type="time" name="jam-mulai" id="jam-mulai" required>
		</div>

		<div class="waktu-selesai">
			<label for="tanggal-selesai">Tanggal Selesai<span class="keterangan">*</span></label>
			<input type="date" name="tanggal-selesai" id="tanggal-selesai" required>

			<label for="jam-selesai">Jam<span class="keterangan">*</span></label>
			<input type="time" name="jam-selesai" id="jam-selesai" required>
		</div>

		<br>
		<div class="ketersediaan-ruangan" hidden>
			<p id="ruangan-message"></p>
			<p id="reservasi-message"></p>
		</div>

		<br><hr><br>

		<!-- Data Dokumen -->

		<h3>Data Dokumen</h3>

		<div>
			<label for="tanggal-pengajuan">Tanggal Pengajuan</label>
			<input type="text" name="tanggal-pengajuan" value="<?= $formatted_date ?>" disabled>

			<br>

			<label for="nomor-dokumen">Nomor Dokumen<span class="keterangan">*</span></label>
			<input type="text" name="nomor-dokumen" id="nomor-dokumen" required>

			<br>

			<label for="lampiran">Lampiran<span class="keterangan">*</span></label>
			<input type="text" name="lampiran" id="lampiran" required>

			<br>

			<label for="perihal">Perihal<span class="keterangan">*</span></label>
			<input type="text" name="perihal" id="perihal" required>

			<br>

			<label for="kegiatan">Kegiatan<span class="keterangan">*</span></label>
			<input type="text" name="kegiatan" id="kegiatan" required>


			<br><br>

			<label for="pimpinan">Persetujuan Pimpinan<span class="keterangan">*</span></label>
			<select name="pimpinan" id="pimpinan" required>
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
			<label for="tembusan">Tembusan<span class="keterangan">*</span> (pisahkan dengan koma, tanpa spasi)</label><br>
			<textarea name="tembusan" id="tembusan" cols="30" rows="10" required></textarea>
		</div>

		<br>

		<!-- Kostumisasi Lanjutan: Kustom logo kiri dan kanan (default: logo kiri pnb, logo kanan kosong) -->
		<h3>
			<label for="kostumisasi-lanjutan" id="label-kostumisasi">
				Kostumisasi Lanjutan
				<i style="transition: .3s ease; transform: rotateZ(180deg)" class="fa-solid fa-caret-up" id="icon-dropdown"></i>
			</label>
		</h3>
		<input type="checkbox" name="kostumisasi-lanjutan" id="kostumisasi-lanjutan">

		<div class="kostumisasi-lanjutan">
			<label for="logo-pnb">Sertakan Logo PNB</label>

			<label for="pilihan-logo-pnb-ya">Ya</label>
			<input type="radio" name="pilihan-logo-pnb" id="pilihan-logo-pnb-ya" value="<?= true ?>" checked>

			<label for="pilihan-logo-pnb-tidak">Tidak</label>
			<input type="radio" name="pilihan-logo-pnb" id="pilihan-logo-pnb-tidak" value="<?= false ?>">

			<div class="logo-kiri">
				<label for="logo-kiri">Input Logo</label>
				<input type="file" name="logo-kiri" id="logo-kiri">
			</div>

			<br><br>

			<label for="logo-kanan">Input Logo Kanan Header</label>
			<input type="file" name="logo-kanan" id="logo-kanan">
		</div>

	</div>

	<br>

	<input type="submit" value="Submit Button" id="submit-button" hidden>
	<button type="submit" name="preview-doc" id="preview-doc" formtarget="_blank">Document Preview</button>
	<input type="submit" name="pengajuan-reservasi" id="pengajuan-reservasi" value="Ajukan Reservasi">
	<?= form_close() ?>

	<script>
		// Create different form action depending on user input
		const form 				= document.getElementById('form-reservasi');
		const buttonpreview 	= document.getElementById('preview-doc');
		const buttonpengajuan 	= document.getElementById('pengajuan-reservasi');
		const submitButton		= document.getElementById('submit-button');

		buttonpreview.addEventListener('click', function() {
			form.action = "<?php echo site_url('reservation/previewpdf') ?>";
			submitButton.click();
		});

		buttonpengajuan.addEventListener('click', function() {
			form.action = "<?php echo site_url('reservation/uploadpdf') ?>";
			submitButton.click();
		});

		// For Kostumisasi Lanjutan dropdown
		const checkKostumisasi 	= document.getElementById('kostumisasi-lanjutan');
		const labelKostumisasi 	= document.getElementById('label-kostumisasi');
		const iconDropdown 		= document.getElementById('icon-dropdown');

		labelKostumisasi.addEventListener('click', function() {
			console.log(iconDropdown)

			if (checkKostumisasi.checked) {
				iconDropdown.style.transform = 'rotateZ(180deg)';
			} else {
				iconDropdown.style.transform = '';
			}
		})

		// Clear sub-input
		const pilihanLogoPnb 	= document.getElementById('pilihan-logo-pnb-ya');
		const inputLogoKiri 	= document.getElementById('logo-kiri');

		const pilihanOrganisasi 	= document.getElementById('pilihan-organisasi-tidak');
		const pilihanOrganisasiYa 	= document.getElementById('pilihan-organisasi-ya');
		const namaOrganisasi		= document.getElementById('nama-organisasi');

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

		$(document).ready(function() {


			// Triggered when user select Ruangan
			$('#ruangan').change(function () {
				let ruangan 	= $(this).val();

				$.post("<?= site_url('creservasi/check_ruangan_availability') ?>", {
					ruangan: ruangan,
				},
				function (response) {
					$('#ruangan-message').html(response + ' Reservasi ditemukan.');
					$('.ketersediaan-ruangan').removeAttr('hidden');
				});
			});

			$('#ruangan, #tanggal-mulai, #tanggal-selesai, #jam-mulai, #jam-selesai').change(function () {
				let ruangan		= $('#ruangan').val();
				let dateStart 	= $('#tanggal-mulai').val();
				let dateEnd		= $('#tanggal-selesai').val();
				let timeStart	= $('#jam-mulai').val();
				let timeEnd		= $('#jam-selesai').val();

				$.post("<?= site_url('creservasi/check_reservation_collide') ?>", {
					ruangan		: ruangan,
					dateStart	: dateStart,
					dateEnd		: dateEnd,
					timeStart	: timeStart,
					timeEnd		: timeEnd
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
						}
						else {
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

