<?php

$role = $this->session->get_userdata()['role'];

$manual = match ($role) {
	AccountRole::PENGELOLA 	=> 'PENGELOLA_MANUAL.pdf',
	AccountRole::PIMPINAN 	=> 'PIMPINAN_MANUAL.pdf',
	AccountRole::PEMINJAM	=> 'PEMINJAM_MANUAL.pdf'
};

?>

<h3>Bantuan</h3>

<br>

<!-- Some support menu -->
<div>
	<a id="panduan-penggunaan" href="<?php echo base_url('assets/manual/') . $manual ?>" download
	class="support-menu btn rounded border border-light4 border-2 d-block p-3 text-start fs-5">
		<i class="fa-regular fa-circle-question"></i>
		Panduan Penggunaan
	</a>
	<br>
	<!-- TODO: implement sending e-mail to 2215354023@pnb.ac.id -->
	<button type="button" class="support-menu btn rounded border border-light4 border-2 d-block w-100 p-3 text-start fs-5"
			data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="Laporkan Bug">
		<i class="fa-solid fa-bug"></i>
		Lapor Bug
	</button>
	<br>
	<button type="button" class="support-menu btn rounded border border-light4 border-2 d-block w-100 p-3 text-start fs-5"
			data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="Kritik & Saran">
		<i class="fa-solid fa-user-pen"></i>
		Kritik & Saran
	</button>
</div>


<!--MODAL-->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h1 class="modal-title fs-5" id="exampleModalLabel"></h1>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<form action="<?= site_url('csetting/send_user_feedback') ?>" method="post">
					<input type="text" name="perihal" class="form-control" id="perihal" hidden>

					<div class="mb-3">
						<label for="message" class="col-form-label">Pesan:</label>
						<textarea name="message" rows="5" class="form-control" id="message"></textarea>
					</div>

					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
						<button type="submit" class="btn btn-primary px-4">Kirim</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

<script>
	const exampleModal = document.getElementById('exampleModal')

	if (exampleModal) {
		exampleModal.addEventListener('show.bs.modal', event => {
			// Button that triggered the modal
			const button = event.relatedTarget
			// Extract info from data-bs-* attributes
			const title = button.getAttribute('data-bs-whatever')
			// Update the modal's content.
			const modalBodyInput = exampleModal.querySelector('#perihal')
			// Update title
			const modalTitle = exampleModal.querySelector('.modal-title')
			// Set reservation id into #reservasi_id input
			modalBodyInput.value = `tes ${title}`
			modalTitle.textContent = title
		})
	}
</script>
