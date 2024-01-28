<h2>Daftar Pimpinan</h2>
  <table class="table table-bordered">
    <thead>
      <tr>
        <th>No</th>
        <th>Nama</th>
        <th>NIP</th>
        <th>Jabatan</th>
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
        <td><?php echo $data->name ?></td>
        <td><?php echo $data->id ?></td>
        <td><?php echo $data->position ?></td>
        <td>
          <button type="button" class="btn btn-sm btn-primary edit-btn" data-bs-whatever="<?php echo $data->account_id ?>">Edit</button>
        	<button type="button"  onclick="hapusdata('<?php echo $data->account_id; ?>');" class="btn btn-sm btn-danger">Hapus</button>
        </td>
      </tr>
      
     <?php
	 		$no++;
	 		endforeach;
		}
	 ?>
      
      
    </tbody>
  </table>
  
<script>
  $(document).ready(function() {
    
    $('.edit-btn').click(function() {
      let id = $(this).attr('data-bs-whatever')
	  $('#signature').removeAttr('required')

      $.post("<?= site_url('cpengelola/edit_pimpinan') ?>", {
        id: id
      },
      function(response) {
        let data = JSON.parse(response)
        console.log(data[0].name)

        $('#name').val(data[0].name)
        $('#id').val(data[0].id)
        $('#email').val(data[0].email)
        $('#position').val(data[0].position)
        $('#account_id').val(data[0].account_id)
	    $('#password').val(data[0].password)

        $('#toggle-edit').attr('value', 'Simpan')
        $('#password-field').attr('hidden', 'true')
      })
    })

    $('#button-batal').click(function() {
	  $('#signature').attr('required', 'true')
      $('#toggle-edit').attr('value', 'Tambah')
      $('#password-field').removeAttr('hidden')
    })

  })

  function hapusdata(account_id)
  {
    if(confirm("Apakah yakin menghapus data ini?"))
    {
      window.open("<?php echo base_url() ?>cpengelola/hapusdata/"+account_id,"_self");
    }	
  }

</script>
  
