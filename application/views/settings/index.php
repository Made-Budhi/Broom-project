<div class="w-100 overflow-auto p-3 row">
  <h1>Pengaturan</h1>

  <br>

<!-- remember this anchor using user session, so in case this not working,
     please re-login -->
  <div class="col-md-4 col-12 mt-4">
    <a class="btn gabarito py-2 mb-3 fs-5 rounded-3 text-start border w-75 setting-item"
       onclick="loadDoc(edit_profile)" id="profile">
				<div class="d-flex align-items-center gap-3 py-2 px-3">
					<i class="fa-solid fa-user fa-lg fs-2"></i>
					<div class="d-flex flex-column">
						<small>Profil</small>
						<small class="text-opacity-75 fs-7">Ubah Nama, Nomor Telepon</small>
					</div>
				</div>
    </a>

    <a class="btn gabarito py-2 mb-3 fs-5 rounded-3 text-start border w-75 setting-item"
       onclick="loadDoc(edit_preference)" id="preference">
			<div class="d-flex align-items-center gap-3 py-2 px-3" onclick="initPreferences()">
					<i class="fa-solid fa-sliders fa-lg fs-2"></i>
					<div class="d-flex flex-column">
						<small class="">Preferensi</small>
						<small class=" text-opacity-75 fs-7">Ganti Tema</small>
					</div>
				</div>
    </a>

    <a class="btn gabarito py-2 mb-3 fs-5 rounded-3 text-start border w-75 setting-item"
       onclick="loadDoc(get_support)" id="support">
			<div class="d-flex align-items-center gap-3 py-2 px-3">
					<i class="fa-solid fa-circle-info fa-lg fs-2 text-base"></i>
					<div class="d-flex flex-column">
						<small>Bantuan</small>
						<small class="text-opacity-75 fs-7">Laporkan Saran, Masukan</small>
					</div>
				</div>
    </a>
  </div>

  <div id="right_panel" class="col-md-8 col-12 border rounded-4 mt-4 px-4 py-4"></div>
  
</div>

<script src="<?= base_url('js/settings/ajax.js') ?>"></script>
<script src="<?= base_url('js/settings/callbacks.js') ?>"></script>
<script>
	$(document).ready(function () {
		const profile = $('#profile')
		const preference = $('#preference')
		const support = $('#support')

		profile.click().addClass('btn-primary text-light')

		profile.click(function () {
			addRemoveHighlight(profile, preference, support)
		})
		preference.click(function () {
			addRemoveHighlight(preference, profile, support)
		})
		support.click(function () {
			addRemoveHighlight(support, profile, preference)
		})

		function addRemoveHighlight (highlighted, removedOne, removedTwo) {
			highlighted.addClass('btn-primary')
			highlighted.addClass('text-light')
			removedOne.add(removedTwo).removeClass('btn-primary text-light')
		}
	})
</script>
