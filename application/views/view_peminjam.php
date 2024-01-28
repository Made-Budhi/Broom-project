<!-- load bootstrap, font-awesome, style, googlefont  -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="<?= base_url('assets/styles/sidebar.css')?>">

<style>
  @import url('https://fonts.googleapis.com/css2?family=Gabarito&family=Geologica&display=swap');
</style>

<h1>Data Peminjam</h1>

<br>

<!-- Search bar with dropdown -->
<div class="input-group mb-3 dropdown-content">
  <span class="input-group-text" id="basic-addon1">
      <i class="fa-solid fa-magnifying-glass"></i>
  </span>
  <input id="inputSearch" type="search"
         placeholder="Data Peminjam Nama/NIM/Telepon"
         aria-label="SearchRuangan" aria-describedby="basic-addon1"
         onkeyup="showResult('data_user')" autocomplete="off" autocapitalize="off"
         class="form-control dropdown-toggle" data-bs-toggle="dropdown"
         data-bs-auto-close="outside">
  <ul id="livesearch" class="dropdown-menu col-11">
    <li class="container d-flex">
      <div class="col">Nama</div>
      <div class="col">NIM/NIK</div>
      <div class="col">Telpon</div>
      <div class="col">Status</div>
      <li class="dropdown-divider">
    </li>
    <li><div class="dropdown-item disabled">No Suggestion</div></li>
  </ul>
  <ul id="default-result-dropdown" hidden>
    <li class="container d-flex">
      <div class="col">Nama</div>
      <div class="col">NIM/NIK</div>
      <div class="col">Telpon</div>
      <div class="col">Status</div>
    <li class="dropdown-divider">
    </li>
    <li>
      <div class="dropdown-item disabled">No Suggestion</div>
    </li>
  </ul>
</div>

<table class="table table-bordered" >

  <thead>
    <th class="text-center" scope="col">No</th>
    <th class="text-center" scope="col">Nama Lengkap</th>
    <th class="text-center" scope="col">NIM</th>
    <th class="text-center" scope="col">Telepon</th>
    <th class="text-center" scope="col">Aksi</th>
  </thead>
  
  <tbody>
    <?php
    view_data($hasil);
    $no=1;
    foreach ($hasil as $data):
    ?>
      <tr>
        <td class="text-center">
          <?php echo $no ?>
        </td>
        <td class="text-center">
          <?php echo $data->name ?>
        </td>
        <td class="text-center">
          <?php echo $data->id ?>
        </td>
        <td class="text-center">
          <?php echo $data->phone ?>
        </td>
        <td class="text-center">
          <a href="<?= site_url('account/peminjam/history/' . $data->id) ?>" class="btn btn-primary">Daftar Reservasi</a>
        </td>
      </tr>
    <?php
    $no++;
    endforeach;
    ?>
  </tbody>
  
</table>

<script src="<?= base_url('js/livesearch/search.js') ?>"></script>
