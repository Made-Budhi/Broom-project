<div id="preference">
  <b>Preference</b>

  <br>
  
<!-- Some preference settings -->
	<div id="lightThemeBlock">
		<label for="lightThemeRadio">
			<img src="<?= base_url("assets/svg/light.svg") ?>" alt="">
		</label>
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
	
	<div id="darkThemeBlock">
		<label for="darkThemeRadio">
			<img src="<?= base_url("assets/svg/dark.svg") ?>" alt="">
		</label>
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

<script src="<?= base_url('js/settings/init.js'); ?>"></script>
