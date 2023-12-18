<div id="preference">
  <b>Preference</b>

  <br>
  
<!-- Some preference settings -->
	<div id="lightThemeBlock">
		<img src="<?= base_url("assets/svg/light.svg") ?>" alt="">
		<div class="form-check">
			<input
				class="form-check-input"
				type="radio"
				name="themeRadio"
				id="lightThemeRadio"
			/>
			<label class="form-check-label" for="">
				Mode Terang
			</label>
		</div>
	</div>
	
	<div id="darkThemeBlock">
		<img src="<?= base_url("assets/svg/dark.svg") ?>" alt="">
		<div class="form-check">
			<input
				class="form-check-input"
				type="radio"
				name="themeRadio"
				id="darkThemeRadio"
			/>
			<label class="form-check-label" for="">
				Mode Gelap
			</label>
		</div>
	</div>

</div>

<script src="<?= base_url('js/settings/init.js'); ?>"></script>
