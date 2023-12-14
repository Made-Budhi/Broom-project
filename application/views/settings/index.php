<div class="w-100 overflow-auto p-3">
  <b>Pengaturan</b>
  
  <br>
  
<!-- remember this anchor using user session, so in case this not working,
     please re-login -->
  <div>
    <a class="btn gabarito py-2 mb-3 fs-5 rounded-3 text-start"
       onclick="loadDoc(edit_profile)">
      <i class="fa-regular fa-user fa-lg"></i> <span>Profile</span>
    </a>

    <br>

    <a class="btn gabarito py-2 mb-3 fs-5 rounded-3 text-start"
       onclick="loadDoc(edit_preference)">
      <i class="fa-regular fa-sliders fa-lg"></i> <span>Preferences</span>
    </a>

    <br>

    <a class="btn gabarito py-2 mb-3 fs-5 rounded-3 text-start"
       onclick="loadDoc(get_support)">
      <i class="fa-solid fa-circle-info fa-lg"></i> <span>Support</span>
    </a>
  </div>
  
  <div id="right_panel"></div>
  
</div>

<script src="<?= base_url('js/settings/ajax.js') ?>"></script>
<script src="<?= base_url('js/settings/callbacks.js') ?>"></script>
