<div id="preference">
  <h3>Preference</h3>

  <br>
  <h6>Color Theme</h6>
  <div class="d-flex gap-3 w-100">

	<!-- Some preference settings -->
	<div id="lightThemeBlock" class="flex-grow-1 border rounded-3 px-2 text-center">
		<img src="<?= base_url("assets/svg/light.svg") ?>" class="w-75" alt="">
		<div class="form-check">
			<input
				class="form-check-input"
				type="radio"
				name="themeRadio"
				id="lightThemeRadio"
			/>
			<label class="form-check-label" for="lightThemeRadio">
				Mode Terang
			</label>
		</div>
	</div>
	
	<div id="darkThemeBlock" class="flex-grow-1 border rounded-3 px-2 text-center">
		<img src="<?= base_url("assets/svg/dark.svg") ?>" class="w-75" alt="">
		<div class="form-check">
			<input
				class="form-check-input"
				type="radio"
				name="themeRadio"
				id="darkThemeRadio"
			/>
			<label class="form-check-label" for="darkThemeRadio">
				Mode Gelap
			</label>
		</div>
	</div>

  </div>
</div>

<script src="<?= base_url('js/settings/init.js'); ?>"></script>
