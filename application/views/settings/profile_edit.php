<div id="profile">
  <b>Profile</b>

  <br>

  <form name="profile_edit_form" method="post"
        action="<?= site_url('settings/profile_edit') ?>">
    <?php
    view_data($account);
    ?>
    <label for="nama_lengkap">Nama Lengkap</label>
    <input type="text" class="profile_edit_form" name="account_name"
           id="nama_lengkap" value="<?= $account->name ?>" disabled>

    <br>

    <?php
    if ($account->role == AccountRole::PEMINJAM) {
      ?>
      <label for="telp">Nomer Telpon</label>
      <input type="text" class="profile_edit_form" name="account_phone"
             id="telp" value="<?= $account->phone ?>" disabled>

      <br>
      <?php
    }
    ?>

    <label for="nip">NIM/NIP</label>
    <input type="number" name="account_id"
           id="nip" value="<?= $account->id ?>" disabled>

    <label for="email">Alamat E-mail</label>
    <input type="text" name="account_email"
           id="email" value="<?= $account->email ?>" disabled>

    <br>

    <input id="form_button" type="button" value="Edit"
           onclick="changeProfileEditFormDisabledStatus();">
      
    <input type="submit" value="Simpan">
  </form>
</div>