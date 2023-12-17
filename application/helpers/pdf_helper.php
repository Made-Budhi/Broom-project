<?php

use Dompdf\Dompdf;

function createpdf($html)
{
	$dompdf = new Dompdf();

	$paper_size 	= 'A4';
	$orientation 	= 'portrait';

	$dompdf->loadHtml($html);
	$dompdf->setPaper($paper_size, $orientation);
	$dompdf->render();
	$dompdf->stream('preview.pdf', array('Attachment' => 0));
}
