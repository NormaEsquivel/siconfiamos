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
$txt7='Incidencias de la empresa '.$generales['nombre_empresa'].'



';
// Now you position and print your page content 
// example: 
$header=array('#', 'CHEQUE','NOMBRE', 'EMISIÓN','PAGO','RETENCIÓN','CAPITAL','INTERÉS','IVA');
//$datos=array();
//foreach($pagos as $pago){
	//$cadena=$pago['Pago']['fecha'].";".$pago['Pago']['pago_capital'].";".$pago['Pago']['intereses'].";".$pago['Pago']['pago'];
	//$datos[]=explode(';',$cadena);
//}
$txt = <<<EOD



EOD;
$tcpdf->Write($h=0, $txt, $link='', $fill=0, $align='C', $ln=true, $stretch=0, $firstline=false, $firstblock=false, $maxh=0);
$tcpdf->multiCell(0, 0,$txt7, 0, 'C', false);
$tcpdf->ColoredTable2($header,$incidencia,$generales, $clientes);
// ... 
// etc. 
// see the TCPDF examples  

echo $tcpdf->Output('Incidencia.pdf', 'I'); 


?>