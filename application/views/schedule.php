<h2>Daftar Prodi</h2>
  <table class="table table-bordered">
    <thead>
      <tr>
        <th>No</th>
        <th>Title</th>
        <th>Desc</th>
        <th>Start</th>
        <th>End</th>
        <th>Aksi</th>
      </tr>
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
        <td><?php echo $no; ?></td>
        <td><?php echo $data->title ?></td>
        <td><?php echo $data->description ?></td>
        <td><?php echo $data->start_datetime ?></td>
        <td><?php echo $data->end_datetime ?></td>
        <td>
        <button type="button" class="btn btn-sm btn-primary">Ajukan</button>
        </td>
      </tr>
      
     <?php
	 		$no++;
	 		endforeach;
		}
	 ?>
    </tbody>
  </table>
