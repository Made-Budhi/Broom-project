<h2>Daftar Prodi</h2>
  <table class="table table-bordered">
    <thead>
      <tr>
        <th>No</th>
        <th>Tanggal dan Waktu Mulai</th>
        <th>Tanggal dan Waktu Selesai</th>
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
        <td><?php echo format_indo($data->date_start) . ', ' . $data->time_start ?></td>
        <td><?php echo format_indo($data->date_end) . ', ' . $data->time_end ?></td>
        <td>
        <button type="button" class="btn btn-sm btn-primary">Kontak Peminjam</button>
        </td>
      </tr>
      
     <?php
	 		$no++;
	 		endforeach;
		}
	 ?>
    </tbody>
  </table>
