<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
	<!-- load bootstrap, font-awesome, style, googlefont  -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="<?= base_url('assets/styles/sidebar.css')?>">
  
	<!-- Menu peminjam styles -->
	<link rel="stylesheet" href="<?= base_url('assets/styles/peminjam/reservasi.css')?>">

	<!-- Jquery -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

	<!-- FullCalendar -->
	<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.10/index.global.min.js"></script>

	<style>
		@import url('https://fonts.googleapis.com/css2?family=Gabarito&family=Geologica&display=swap');
	</style>

</head>

<body>
    <div class="container-fluid vh-100 position-relative d-flex">

		<!-- sidebar only  -->
        <div class="menubar p-3 h-100 d-flex flex-column fit-content">
				<div class="d-flex align-items-center gap-2 hide justify-content-center">
					<img src="<?= base_url('assets/images/logo-pnb.png')?>" width="60vw" class="logo" alt="">
					<div class="d-flex flex-column tablet-mode">
						<h2 class="geologica m-0">BRoom</h2>
						<small class="gabarito m-0 fs-7 text-nowrap">Aplikasi Peminjaman Ruangan</small>
					</div>
				</div>
                
          <div class="menubutton mt-4 h-100 text-center d-flex flex-md-column text-md-center">
            <a href="<?= site_url('dashboard') ?>" class="btn gabarito py-2 mb-3 fs-5 rounded-3 text-start w-100 <?= ((!empty($current_uri)) && $current_uri == 'dashboard') ? 'btn-primary' : '' ?>">
							<i class="fa fa-home fa-lg p-2"></i> <span>Dashboard</span>
						</a>

            <a href="<?=  site_url('rooms') ?>" class="btn gabarito py-2 mb-3 fs-5 rounded-3 text-start w-100 <?= ((!empty($current_uri)) && $current_uri == 'ruangan') ? 'btn-primary' : '' ?>">
							<i class="fa-solid fa-xl fa-building p-2"></i> <span>Ruangan</span>
						</a>

            <a href="<?= site_url('reservation') ?>"
					   	class="btn gabarito py-2 mb-3 fs-5 rounded-3 text-start w-100 <?= ((!empty($current_uri)) && $current_uri == 'reservasi') ? 'btn-primary' : '' ?>">
							<i class="fa-solid fa-file-circle-plus fa-lg p-2"></i> <span>Reservasi</span>
						</a>

            <a href="<?= site_url('notifications') ?>"
						   class="btn gabarito py-2 mb-3 fs-5 rounded-3 text-start w-100 <?= ((!empty($current_uri)) && $current_uri == 'notifikasi') ? 'btn-primary' : '' ?>">
							<i class="fa fa-bell fa-lg p-2"></i> <span>Notifikasi</span>
            </a>
            <span class="flex-grow-1 hide"></span>
                  
						<a onclick="" href="<?= site_url('settings') ?>" class="btn gabarito py-2 mb-3 fs-5 rounded-3 text-start w-100 <?= ((!empty($current_uri)) && $current_uri == 'pengaturan') ? 'btn-primary' : '' ?>">
              <i class="fa fa-gear px-2"></i> <span>Pengaturan</span>
            </a>
                  
              <a href="<?= site_url('logout') ?>" class="btn gabarito btn-danger py-2 mb-3 fs-5 rounded-3 text-start w-100 hide"><i class="fa-solid fa-right-from-bracket p-2">
                </i> <span>Logout</span>
              </a>
          </div>
        </div>

        <!-- content  -->
    
        <div class="content p-4 flex-grow-1 overflow-auto">
            <?php view("content") ?>
        </div>

    </div>

<script src="<?= base_url('js/settings/init.js'); ?>"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
