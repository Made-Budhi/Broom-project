<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * To format function date('dmY') into readable Indonesian date format.
 *
 * @param string $date		must be date('dmY') format
 * @return string			date format in Indonesian language
 */
function format_indo(string $date): string
{
    $nama_bulan = array("Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");

    // Separating the timestamp into date, month, and year
    $tanggal 	= substr($date,8,2);
    $bulan 		= substr($date,5,2);
    $tahun 		= substr($date,0,4);

	// Format the timestamp to proper date format and in Indonesian language
	return $tanggal . " " . $nama_bulan[(int)$bulan-1] . " " . $tahun;
}
