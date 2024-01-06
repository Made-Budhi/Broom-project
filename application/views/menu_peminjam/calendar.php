<?php
view_data($id);
?>

<body>
<div>
    <form method="post" action="<?php echo site_url('rooms/calendar/' . $id) ?>">
        <div class="mb-3">
            <label for="tgl">Input Tanggal</label>
            <input type="date" class="form-control w-50" name="tgl" id="tgl">
        </div>

        <input type="submit" value="Submit">
    </form>
</div>

<div class="container" id="jadwal">
	<?php view("tabel") ?>
</div>
</body>
