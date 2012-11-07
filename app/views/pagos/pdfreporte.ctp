<?php 
App::import('Vendor','xtcpdf');  
$tcpdf = new XTCPDF(); // looks better, finer, and more condensed than 'dejavusans' 
$tcpdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
$tcpdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);
$tcpdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$tcpdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$tcpdf->SetFooterMargin(PDF_MARGIN_FOOTER);
$tcpdf->SetFont('helvetica', 10);
// add a page (required with recent versions of tcpdf) 
$tcpdf->AddPage(); 
$txt7='Reporte de pagos';
// Now you position and print your page content 
$texto='<br><br>Recibí de '.$reporte['Cliente']['nombre'].' '.$reporte['Cliente']['apellido_paterno'].' '.$reporte['Cliente']['apellido_materno'].' los siguientes pagos:';
$header=array('Fecha','Fecha pago','Pago','Retención','Capital','Interés','IVA');

$txt = <<<EOD



EOD;
$tcpdf->Write($h=0, $txt, $link='', $fill=0, $align='C', $ln=true, $stretch=0, $firstline=false, $firstblock=false, $maxh=0);
$tcpdf->multiCell(0, 0,$txt7, 0, 'C', false);
$tcpdf->writeHtml($texto,true,false,false,false,'L');
$tcpdf->multiCell(0,0,$txt9,0,'L',false);
$tcpdf->ColoredTable5($header,$reporte);
$tcpdf->Ln();
// ... 
// etc. 
// see the TCPDF examples  

echo $tcpdf->Output('Cotizacion.pdf', 'I'); 


?>