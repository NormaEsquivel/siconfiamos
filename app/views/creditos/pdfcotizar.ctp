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
$txt7='Cotización de Crédito


';
$txt8='*Esta tabla únicamente sirve para fines informativos';
$txt9='Cliente: '.$credito['Credito']['nombre_cliente'].'
Tasa de Interés: '.$credito['Credito']['tasa_interes'].'
Cuotas: '.$credito['Credito']['cuotas'].'
Periodo de pago: '.$credito['Credito']['periodo_cuotas'].'
Préstamo: '.$credito['Credito']['prestamo'].'
Fecha de cálculo: '.$credito['Credito']['fecha_cotizacion'] .'
Tipo de cálculo: '.$credito['Credito']['tipo_calculo'].'


';
// Now you position and print your page content 
// example: 
$header=array('Fecha','#','Pago Capital','Intereses','Iva Intereses','Pago','Saldo Insoluto');
//$datos=array();
//foreach($pagos as $pago){
	//$cadena=$pago['Pago']['fecha'].";".$pago['Pago']['pago_capital'].";".$pago['Pago']['intereses'].";".$pago['Pago']['pago'];
	//$datos[]=explode(';',$cadena);
//}
$txt = <<<EOD

EOD;
$tcpdf->Write($h=0, $txt, $link='', $fill=0, $align='C', $ln=true, $stretch=0, $firstline=false, $firstblock=false, $maxh=0);
$tcpdf->multiCell(0, 0,$txt7, 0, 'C', false);
$tcpdf->multiCell(0,0,$txt9,0,'L',false);
$tcpdf->ColoredTable3($header,$arreglo,$credito['Credito']);
$tcpdf->Ln();
$tcpdf->multiCell(0, 0,$txt8, 0, 'L', false);
// ... 
// etc. 
// see the TCPDF examples  

echo $tcpdf->Output('Cotizacion.pdf', 'I'); 


?>