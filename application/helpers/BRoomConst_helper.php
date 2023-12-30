<?php

class StatusReservasi
{
	const DITERIMA = 'Diterima';
	const DITOLAK = 'Ditolak';
	const MENUNGGU = 'Menunggu';
}

class AccountRole
{
	const PEMINJAM = 'Peminjam';
	const PIMPINAN = 'Pimpinan';
	const PENGELOLA = 'Pengelola';
}

class PeminjamRole
{
	const MAHASISWA = 'Mahasiswa';
	const PEGAWAI = 'Pegawai';
}

class NotificationType
{
	const PEMINJAM_MENGAJUKAN = 101;
	const PEMINJAM_DISETUJUI = 102;
	const PEMINJAM_DITOLAK = 103;
	const PEMINJAM_DIBATALKAN = 104;
	const PIMPINAN_DIAJUKAN = 201;
	const PENGELOLA_DINOTIFIKASI = 301;
}