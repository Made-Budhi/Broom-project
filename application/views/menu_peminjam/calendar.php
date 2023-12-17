<?php

if (empty($id))
	$id = '';

?>

<body>
<div>
    <form method="post" action="<?php echo site_url('crooms/calendar/' . $id) ?>">
        <div class="mb-3">
            <label for="tgl">Input Tanggal</label>
            <input type="date" class="form-control w-50" name="tgl" id="tgl">
        </div>

        <input type="submit" value="Submit">
    </form>
</div>

<div class="container" id="jadwal">
	<?php
	if (!empty($tabel)) {
		echo $tabel;
	}
	?>
</div>
</body>
