<!-- load bootstrap, font-awesome, style  -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="<?= base_url('assets/styles/sidebar.css')?>">

<h1>Dashboard</h1>
<br>
<h3>Fitur yang bisa kamu coba</h3>

<h4>History Reservasi</h4>

<table class="table table-bordered">

    <thead>
        <th class="text-center" scope="col">Tanggal</th>
        <th class="text-center" scope="col">Ruangan</th>
        <th class="text-center" scope="col">Status</th>
        <th class="text-center" scope="col">Aksi</th>
    </thead>

    <tbody>

    <?php
		if(empty($hasil))
		{
			echo "Data Kosong";	
		}
		else
		{
			$no=1;
			foreach ($hasil as $data):
	?>

        <tr>
            <td class="text-center"><?php echo $data->date_start;?> <br> <?php echo $data->date_end ?></td>
            <td class="text-center"><?php echo $data->ruangan_id ?></td>
            <td class="text-center"><?php echo $data->status ?></td>

            <!-- TODO Detail mengarah ke arah PDF form -->
            <td class="text-center">
                <button type="button" class="btn btn-sm btn-primary">Detail</button>
            </td>

        </tr>
        
        <?php
	 		$no++;
	 		endforeach;
		}
	 ?>

    </tbody>



</table>