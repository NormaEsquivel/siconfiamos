<?php 
App::import('Vendor','xtcpdf');
App::import('Vendor','format'); 
$format= new format();  
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

// Now you position and print your page content 
// example: 
	$header=array('Fecha','Numero','Capital','Intereses','Iva','Pago','Saldo Insoluto','Situación');
//$datos=array();
//foreach($pagos as $pago){
	//$cadena=$pago['Pago']['fecha'].";".$pago['Pago']['pago_capital'].";".$pago['Pago']['intereses'].";".$pago['Pago']['pago'];
	//$datos[]=explode(';',$cadena);
//}
$empresas = $cliente['Cliente']['division'] != null ? '(' . $cliente['Cliente']['division'] . ')' : null;
$txt2='*Esta tabla únicamente sirve para fines informativos';
$txt = <<<EOD


EOD;
$html = 'Fecha: ' . $format->fecha(date('Y-m-d')) . '<br>
		<br>
		Cliente: ' . $cliente['Cliente']['nombre'] . ' ' . $cliente['Cliente']['apellido_paterno'] . ' ' . $cliente['Cliente']['apellido_materno'] . '<br>
		Empresa: ' . $cliente['Empresa']['nombre'] . ' ' . $empresas .'<br> 
		<br>
		Datos del Credito:<br>
		<br>
		Préstamo: $' . number_format($credito['Credito']['prestamo'], 2) . '<br>
		Tasa de interés: ' . $credito['Credito']['tasa_interes'] . '%<br>
		Número de Pagos: ' . $credito['Credito']['cuotas'] . '<br>
		Periodo de Pagos: ' . $credito['Credito']['periodo_cuotas'] . '<br>
		Fecha de calculo: ' . $format->fecha($credito['Credito']['fecha_calculo']);
$tcpdf->writeHTML($html);
$tcpdf->Write($h=0, $txt, $link='', $fill=0, $align='C', $ln=true, $stretch=0, $firstline=false, $firstblock=false, $maxh=0);
$tcpdf->ColoredTable($header,$pagos,$totales);
$tcpdf->Ln();
$tcpdf->multiCell(0, 0,$txt2, 0, 'L', false);
// ... 
// etc. 
// see the TCPDF examples  

echo $tcpdf->Output('Reporte_pagos.pdf', 'I'); 


?>