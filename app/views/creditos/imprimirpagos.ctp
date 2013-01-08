<?php
App::import('Vendor','xtcpdf');  
$tcpdf = new XTCPDF(); 
$textfont = 'freesans'; // looks better, finer, and more condensed than 'dejavusans' 
$tcpdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
$tcpdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);
$tcpdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$tcpdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$tcpdf->SetFooterMargin(PDF_MARGIN_FOOTER);
$tcpdf->SetFont('helvetica', 12);
// add a page (required with recent versions of tcpdf) 
$tcpdf->AddPage();  

//$header=array('Fecha','Número de pago','Capital','Intereses','Iva','Pago','Saldo Insoluto','Estado');
$header=array('Fecha','#','Pago Capital','Intereses','Iva Intereses','Pago','Saldo Insoluto','Estado');

$txt= <<<EOD

EOD;

$tcpdf->Write($h=0, $txt, $link='', $fill=0, $align='C', $ln=true, $stretch=0, $firstline=false, $firstblock=false, $maxh=0);

//$tcpdf->ColoredTable6($header,$cliente,$credito['pago']);


echo $tcpdf->Output('Pagos.pdf', 'I'); 
?>