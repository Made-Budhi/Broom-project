<?php
div_alert_error('register_error');
?>

<?= form_open_multipart(site_url('cpengelola/simpandata')) ?>
  <input type="hidden" name="account_id" id="account_id"/>
  <div class="mb-3 mt-3">
    Nama
    <input type="text" class="form-control" name="name" id="name" required>
  </div>

  <div class="mb-3 mt-3" id="password-field">
    Password
    <input type="password" class="form-control" name="password" id="password" required>
  </div>

  <div class="mb-3">
    NIP
    <input type="text" class="form-control" name="id" id="id" required>
  </div>

  <div class="mb-3">
    Email
    <input type="text" class="form-control" name="email" id="email" required>
  </div>

  <div class="mb-3">
    Jabatan
    <input type="text" class="form-control" name="position" id="position" required>
  </div>

  <div class="mb-3">
    Signature
    <input type="file" class="form-control" name="signature" id="signature" required>
  </div>

  <div class="mb-3">
    <input type="submit" id="toggle-edit" class="btn btn-primary" value="Tambah">
    <input type="reset" id="button-batal" class="btn btn-danger" value="Batal">
  </div>
<?= form_close() ?>

