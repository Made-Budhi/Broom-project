<div id="profile">
  <h3>Profile</h3>

  <br>

  <form name="profile_edit_form" method="post"
        action="<?= site_url('settings/profile_edit') ?>">
    <?php
    view_data($account);
    ?>
    <label for="nama_lengkap">Nama Lengkap</label>
    <input type="text" class="profile_edit_form form-control" name="account_name"
           id="nama_lengkap" value="<?= $account->name ?>" disabled>

    <br>

    <?php
    if ($account->role == AccountRole::PEMINJAM) {
      ?>
      <label for="telp">Nomer Telpon</label>
      <input type="text" class="profile_edit_form form-control" name="account_phone"
             id="telp" value="<?= $account->phone ?>" disabled>

      <br>
      <?php
    }
    ?>

   <div class="row">
	<div class="col">
		<label for="nip">NIM/NIP</label>
		<input type="number" name="account_id" class="w-100 form-control"
			id="nip" value="<?= $account->id ?>" disabled>
	</div>
	<div class="col">
		<label for="email">Alamat E-mail</label>
		<input type="text" name="account_email" class="w-100 form-control"
			id="email" value="<?= $account->email ?>" disabled>
	</div>
   </div>
    <br>

    <input id="form_button" type="button" value="Edit" class="btn btn-warning"
           onclick="changeProfileEditFormDisabledStatus();">
      
    <input type="submit" value="Simpan" class="btn btn-primary">
  </form>
</div>
