<?php 
App::import('Vendor','tcpdf/tcpdf'); 

class XTCPDF  extends TCPDF 
{ 

    
    function Header() 
    {
        $image_file = K_PATH_IMAGES.'logo.jpg';
        $this->Image($image_file, 15, 0, 35, 25, 'JPG', '', 'T', true, 300, '', false, false, 0, false, false, false); 
    } 
    /** 
    * Overwrites the default footer 
    * set the text in the view using 
    * $fpdf->xfootertext = 'Copyright Â© %d YOUR ORGANIZATION. All rights reserved.'; 
    */ 
    function Footer() 
    { 
         
    } 
	
	public function ColoredTable($header,$pagos,$totales) {
        // Colors, line width and bold font
        $this->SetFillColor(34, 5, 100,0);
        $this->SetTextColor(255);
        $this->SetDrawColor(85,37,0,0);
        $this->SetLineWidth(0.3);
		$this->SetFont('helvetica','B',10);
		// Header
        $w = array(20,20,25,25,20,25,25,25);
        $num_headers = count($header);
        for($i = 0; $i < $num_headers; ++$i) {
            $this->Cell($w[$i], 7, $header[$i], 1, 0, 'C', 1);
        }
        $this->Ln();
        // Color and font restoration
        $this->SetFillColor(224, 235, 255);
        $this->SetTextColor(0);
        $this->SetFont('helvetica','',10);
        // Data
        $fill = 0;
        foreach($pagos as $pago) {
            $this->Cell($w[0], 6, $pago['Pago']['fecha'] , 'LR', 0, 'L', $fill);
			$this->Cell($w[1], 6, $pago['Pago']['numero_pago'] , 'LR', 0, 'R', $fill);
            $this->Cell($w[2], 6, '$'.number_format($pago['Pago']['pago_capital'],2) , 'LR', 0, 'R', $fill);
            $this->Cell($w[3], 6, '$'.number_format($pago['Pago']['intereses'],2) , 'LR', 0, 'R', $fill);
            $this->Cell($w[4], 6, '$'.number_format($pago['Pago']['iva_intereses'],2), 'LR', 0, 'R', $fill);
			$this->Cell($w[5], 6, '$'.number_format($pago['Pago']['pago'],2), 'LR', 0, 'R', $fill);
			$this->Cell($w[6], 6, '$'.number_format($pago['Pago']['saldo_insoluto'],2), 'LR', 0, 'R', $fill);
			$this->Cell($w[7], 6, $pago['Pago']['sitacion'], 'LR', 0, 'R', $fill);
            $this->Ln();
            $fill=!$fill;
        }
			$this->Cell($w[0],6,' ','LR',0,'R',$fill);		
			$this->Cell($w[1], 6, 'Total:', 'LR', 0, 'L', $fill);
            $this->Cell($w[2], 6, '$'.number_format($totales['total_capital'],2) , 'LR', 0, 'R', $fill);
            $this->Cell($w[3], 6, '$'.number_format($totales['total_interes'],2) , 'LR', 0, 'R', $fill);
            $this->Cell($w[4], 6, '$'.number_format($totales['total_iva'],2), 'LR', 0, 'R', $fill);
			$this->Cell($w[5], 6, '$'.number_format($totales['total_pago'],2), 'LR', 0, 'R', $fill);
			$this->Cell($w[6], 6, ' ', 'LR', 0, 'R', $fill);
			$this->Cell($w[7], 6, ' ', 'LR', 0, 'R', $fill);
            $this->Ln();
        $this->Cell(array_sum($w), 0, '', 'T');
    }

	public function ColoredTable_pagos_realizados($header,$pagos,$totales) {
        // Colors, line width and bold font
        $this->SetFillColor(34, 5, 100,0);
        $this->SetTextColor(255);
        $this->SetDrawColor(85,37,0,0);
        $this->SetLineWidth(0.3);
		$this->SetFont('helvetica','B',10);
		// Header
        $w = array(20,20,25,25,20,25,25,25);
        $num_headers = count($header);
        for($i = 0; $i < $num_headers; ++$i) {
            $this->Cell($w[$i], 7, $header[$i], 1, 0, 'C', 1);
        }
        $this->Ln();
        // Color and font restoration
        $this->SetFillColor(224, 235, 255);
        $this->SetTextColor(0);
        $this->SetFont('helvetica','',10);
        // Data
        $fill = 0;
        foreach($pagos as $pago) {
        	if($pago['Pago']['sitacion'] == 'Pagado'){
            $this->Cell($w[0], 6, $pago['Pago']['fecha'] , 'LR', 0, 'L', $fill);
			$this->Cell($w[1], 6, $pago['Pago']['numero_pago'] , 'LR', 0, 'R', $fill);
            $this->Cell($w[2], 6, '$'.number_format($pago['Pago']['pago_capital'],2) , 'LR', 0, 'R', $fill);
            $this->Cell($w[3], 6, '$'.number_format($pago['Pago']['intereses'],2) , 'LR', 0, 'R', $fill);
            $this->Cell($w[4], 6, '$'.number_format($pago['Pago']['iva_intereses'],2), 'LR', 0, 'R', $fill);
			$this->Cell($w[5], 6, '$'.number_format($pago['Pago']['pago'],2), 'LR', 0, 'R', $fill);
			$this->Cell($w[6], 6, '$'.number_format($pago['Pago']['saldo_insoluto'],2), 'LR', 0, 'R', $fill);
			$this->Cell($w[7], 6, $pago['Pago']['sitacion'], 'LR', 0, 'R', $fill);
            $this->Ln();
            $fill=!$fill;
			}
        }
			$this->Cell($w[0],6,' ','LR',0,'R',$fill);		
			$this->Cell($w[1], 6, 'Total:', 'LR', 0, 'L', $fill);
            $this->Cell($w[2], 6, '$'.number_format($totales['total_capital'],2) , 'LR', 0, 'R', $fill);
            $this->Cell($w[3], 6, '$'.number_format($totales['total_interes'],2) , 'LR', 0, 'R', $fill);
            $this->Cell($w[4], 6, '$'.number_format($totales['total_iva'],2), 'LR', 0, 'R', $fill);
			$this->Cell($w[5], 6, '$'.number_format($totales['total_pago'],2), 'LR', 0, 'R', $fill);
			$this->Cell($w[6], 6, ' ', 'LR', 0, 'R', $fill);
			$this->Cell($w[7], 6, ' ', 'LR', 0, 'R', $fill);
            $this->Ln();
        $this->Cell(array_sum($w), 0, '', 'T');
    }
	
	public function ColoredTable2($header,$pagos,$total,$clientes) {
        // Colors, line width and bold font
        $this->SetFillColor(34, 5, 100,0);
        $this->SetTextColor(255);
        $this->SetDrawColor(85,37,0,0);
        $this->SetLineWidth(0.3);
         $this->SetFont('helvetica','B',7);
        // Header
        $w = array(7,12,68,17,11,18,14,14,12);
        $num_headers = count($header);
        for($i = 0; $i < $num_headers; ++$i) {
            $this->Cell($w[$i], 7, $header[$i], 1, 0, 'C', 1);
        }
        $this->Ln();
        // Color and font restoration
        $this->SetFillColor(224, 235, 255);
        $this->SetTextColor(0);
          $this->SetFont('helvetica','', 8);
        // Data
        $fill = 0;
		$i = 1;
        foreach($pagos as $key => $arreglo) {
        	foreach($arreglo as $pago){
	        	$this->Cell($w[0], 6, $i++ , 'LR', 0, 'L', $fill);
	            $this->Cell($w[1], 6, $pago['Credito']['cheque'] , 'LR', 0, 'L', $fill);
	            $this->Cell($w[2], 6, $clientes[$key]['Cliente']['full_name'], 'LR', 0, 'R', $fill);
	            $this->Cell($w[3], 6, date('d/m/Y', strtotime($pago['Pago']['fecha'])) , 'LR', 0, 'R', $fill);
	            $this->Cell($w[4], 6, $pago['Pago']['numero_pago'], 'LR', 0, 'R', $fill);
				$this->Cell($w[5], 6, '$'.number_format($pago['Pago']['pago'],2), 'LR', 0, 'R', $fill);
				$this->Cell($w[6], 6, '$'.number_format($pago['Pago']['pago_capital'],2), 'LR', 0, 'R', $fill);
				$this->Cell($w[7], 6, '$'.number_format($pago['Pago']['intereses'],2), 'LR', 0, 'R', $fill);
				$this->Cell($w[8], 6, '$'.number_format($pago['Pago']['iva_intereses'],2), 'LR', 0, 'R', $fill);
	            $this->Ln();
	            $fill=!$fill;
			}
        }
			$this->Cell($w[0], 6, ' ' , 'LR', 0, 'L', $fill);
			$this->Cell($w[1], 6, ' ' , 'LR', 0, 'L', $fill);
            $this->Cell($w[2], 6, ' ' , 'LR', 0, 'R', $fill);
            $this->Cell($w[3], 6, ' ' , 'LR', 0, 'R', $fill);
            $this->Cell($w[4], 6, 'Total:' , 'LR', 0, 'R', $fill);
			$this->Cell($w[5], 6, '$'.number_format($total['Pago'],2), 'LR', 0, 'R', $fill);
			$this->Cell($w[6], 6, '$'.number_format($total['Capital'],2), 'LR', 0, 'R', $fill);
			$this->Cell($w[7], 6, '$'.number_format($total['Interes'],2), 'LR', 0, 'R', $fill);
			$this->Cell($w[8], 6, '$'.number_format($total['Iva'],2), 'LR', 0, 'R', $fill);
			$this->Ln();
        $this->Cell(array_sum($w), 0, '', 'T');
    }

	public function ColoredTable3($header,$pagos,$arreglo) {
        // Colors, line width and bold font
        $this->SetFillColor(34, 5, 100,0);
        $this->SetTextColor(255);
        $this->SetDrawColor(85,37,0,0);
        $this->SetLineWidth(0.3);
        $this->SetFont('', 'B');
        // Header
        $w = array(25,20,28,25,35,30,30);
        $num_headers = count($header);
        for($i = 0; $i < $num_headers; ++$i) {
            $this->Cell($w[$i], 7, $header[$i], 1, 0, 'C', 1);
        }
        $this->Ln();
        // Color and font restoration
        $this->SetFillColor(224, 235, 255);
        $this->SetTextColor(0);
        $this->SetFont('');
        // Data
        $fill = 0;
        foreach($pagos['Pago'] as $pago) {
            $this->Cell($w[0], 6, $pago['fecha'] , 'LR', 0, 'L', $fill);
			$this->Cell($w[1], 6, $pago['numero_pago'] , 'LR', 0, 'C', $fill);
            $this->Cell($w[2], 6, '$'.number_format($pago['pago_capital'],2) , 'LR', 0, 'R', $fill);
            $this->Cell($w[3], 6, '$'.number_format($pago['intereses'],2) , 'LR', 0, 'R', $fill);
            $this->Cell($w[4], 6, '$'.number_format($pago['iva_intereses'],2), 'LR', 0, 'R', $fill);
			$this->Cell($w[5], 6, '$'.number_format($pago['pago'],2), 'LR', 0, 'R', $fill);
			$this->Cell($w[6], 6, '$'.number_format($pago['saldo_insoluto'],2), 'LR', 0, 'R', $fill);
            $this->Ln();
            $fill=!$fill;
        }
			$this->Cell($w[0], 6, 'Total:' , 'LR', 0, 'L', $fill);
			$this->Cell($w[1], 6, ' ' , 'LR', 0, 'C', $fill);
            $this->Cell($w[2], 6, '$'.number_format($arreglo['prestamo'],2), 'LR', 0, 'R', $fill);
            $this->Cell($w[3], 6, '$'.number_format($arreglo['total_interes'],2) , 'LR', 0, 'R', $fill);
            $this->Cell($w[4], 6, '$'.number_format($arreglo['total_iva'],2), 'LR', 0, 'R', $fill);
			$this->Cell($w[5], 6, '$'.number_format($arreglo['total_pago'],2), 'LR', 0, 'R', $fill);
			$this->Cell($w[6], 6,  ' ', 'LR', 0, 'R', $fill);
            $this->Ln();
        $this->Cell(array_sum($w), 0, '', 'T');
    }

public function ColoredTable4($header,$pagos,$arreglo2) {
        // Colors, line width and bold font
        $this->SetFillColor(34, 5, 100,0);
        $this->SetTextColor(255);
        $this->SetDrawColor(85,37,0,0);
        $this->SetLineWidth(0.3);
        $this->SetFont('helvetica','B',8);
        // Header
        $w = array(7, 15,70,16,16,10,15,15,15,13);
        $num_headers = count($header);
        for($i = 0; $i < $num_headers; ++$i) {
            $this->Cell($w[$i], 7, $header[$i], 1, 0, 'C', 1);
        }
        $this->Ln();
        // Color and font restoration
        $this->SetFillColor(224, 235, 255);
        $this->SetTextColor(0);
        $this->SetFont('helvetica',' ', 8);
        // Data
        $fill = 0;
		$i = 1;
        foreach($pagos as $pago) {
        	$this->Cell($w[0], 6, $i++ , 'LR', 0, 'L', $fill);
            $this->Cell($w[1], 6, $pago['cheque'] , 'LR', 0, 'L', $fill);
            $this->Cell($w[2], 6, $pago['nombre'] , 'LR', 0, 'R', $fill);
            $this->Cell($w[3], 6, $pago['fecha'] , 'LR', 0, 'R', $fill);
			$this->Cell($w[4], 6, $pago['fecha_pagado'] , 'LR', 0, 'R', $fill);
            $this->Cell($w[5], 6, $pago['numero_pago'], 'LR', 0, 'R', $fill);
			$this->Cell($w[6], 6, '$'.number_format($pago['retencion'],2), 'LR', 0, 'R', $fill);
			$this->Cell($w[7], 6, '$'.number_format($pago['capital'],2), 'LR', 0, 'R', $fill);
			$this->Cell($w[8], 6, '$'.number_format($pago['interes'],2), 'LR', 0, 'R', $fill);
			$this->Cell($w[9], 6, '$'.number_format($pago['iva'],2), 'LR', 0, 'R', $fill);
            $this->Ln();
            $fill=!$fill;
        }
			$this->Cell($w[0], 6, ' ' , 'LR', 0, 'L', $fill);
			$this->Cell($w[1], 6, ' ' , 'LR', 0, 'L', $fill);
            $this->Cell($w[2], 6, ' ' , 'LR', 0, 'R', $fill);
            $this->Cell($w[3], 6, ' ' , 'LR', 0, 'R', $fill);
			$this->Cell($w[4], 6, ' ' , 'LR', 0, 'R', $fill);
            $this->Cell($w[5], 6, 'Total:' , 'LR', 0, 'R', $fill);
			$this->Cell($w[6], 6, '$'.number_format($arreglo2['total'],2), 'LR', 0, 'R', $fill);
			$this->Cell($w[7], 6, '$'.number_format($arreglo2['total_capital'],2), 'LR', 0, 'R', $fill);
			$this->Cell($w[8], 6, '$'.number_format($arreglo2['total_interes'],2), 'LR', 0, 'R', $fill);
			$this->Cell($w[9], 6, '$'.number_format($arreglo2['total_iva'],2), 'LR', 0, 'R', $fill);
			$this->Ln();
        $this->Cell(array_sum($w), 0, '', 'T');
    }

public function ColoredTable5($header,$pagos) {
        // Colors, line width and bold font
        $this->SetFillColor(34, 5, 100,0);
        $this->SetTextColor(255);
        $this->SetDrawColor(85,37,0,0);
        $this->SetLineWidth(0.3);
        $this->SetFont('helvetica', 'B',8);
        // Header
        $w = array(25,25,15,25,25,25,25);
        $num_headers = count($header);
        for($i = 0; $i < $num_headers; ++$i) {
            $this->Cell($w[$i], 7, $header[$i], 1, 0, 'C', 1);
        }
        $this->Ln();
        // Color and font restoration
        $this->SetFillColor(224, 235, 255);
        $this->SetTextColor(0);
        $this->SetFont('helvetica',' ', 10);
        // Data
        $fill = 0;
        foreach($pagos['Pago'] as $pago) {
            $this->Cell($w[0], 6, $pago['fecha'] , 'LR', 0, 'R', $fill);
			$this->Cell($w[1], 6, $pago['fecha_pagado'] , 'LR', 0, 'R', $fill);
            $this->Cell($w[2], 6, $pago['numero_pago'], 'LR', 0, 'R', $fill);
			$this->Cell($w[3], 6, '$'.number_format($pago['pago'],2), 'LR', 0, 'R', $fill);
			$this->Cell($w[4], 6, '$'.number_format($pago['pago_capital'],2), 'LR', 0, 'R', $fill);
			$this->Cell($w[5], 6, '$'.number_format($pago['intereses'],2), 'LR', 0, 'R', $fill);
			$this->Cell($w[6], 6, '$'.number_format($pago['iva_intereses'],2), 'LR', 0, 'R', $fill);
            $this->Ln();
            $fill=!$fill;
        }
			$this->Cell($w[0], 6, ' ' , 'LR', 0, 'L', $fill);
            $this->Cell($w[1], 6, ' ' , 'LR', 0, 'R', $fill);
            $this->Cell($w[2], 6, 'Total:' , 'LR', 0, 'R', $fill);
			$this->Cell($w[3], 6, '$'.number_format($pagos['total'],2), 'LR', 0, 'R', $fill);
			$this->Cell($w[4], 6, '$'.number_format($pagos['total_capital'],2), 'LR', 0, 'R', $fill);
			$this->Cell($w[5], 6, '$'.number_format($pagos['total_interes'],2), 'LR', 0, 'R', $fill);
			$this->Cell($w[6], 6, '$'.number_format($pagos['total_iva'],2), 'LR', 0, 'R', $fill);
			$this->Ln();
        $this->Cell(array_sum($w), 0, '', 'T');
    }


public function ColoredTable6($header,$pagos,$arreglo) {
        // Colors, line width and bold font
        $this->SetFillColor(34, 5, 100,0);
        $this->SetTextColor(255);
        $this->SetDrawColor(85,37,0,0);
        $this->SetLineWidth(0.3);
        $this->SetFont('', 'B');
        // Header
        $w = array(25,20,28,25,35,30,30);
        $num_headers = count($header);
        for($i = 0; $i < $num_headers; ++$i) {
            $this->Cell($w[$i], 8, $header[$i], 1, 0, 'C', 1);
        }
        $this->Ln();
        // Color and font restoration
        $this->SetFillColor(224, 235, 255);
        $this->SetTextColor(0);
        $this->SetFont('');
        // Data
        $fill = 0;
        foreach($pagos['Pago'] as $pago) {
            $this->Cell($w[0], 6, $pago['fecha'] , 'LR', 0, 'L', $fill);
			$this->Cell($w[1], 6, $pago['numero_pago'] , 'LR', 0, 'C', $fill);
            $this->Cell($w[2], 6, '$'.number_format($pago['pago_capital'],2) , 'LR', 0, 'R', $fill);
            $this->Cell($w[3], 6, '$'.number_format($pago['intereses'],2) , 'LR', 0, 'R', $fill);
            $this->Cell($w[4], 6, '$'.number_format($pago['iva_intereses'],2), 'LR', 0, 'R', $fill);
			$this->Cell($w[5], 6, '$'.number_format($pago['pago'],2), 'LR', 0, 'R', $fill);
			$this->Cell($w[6], 6, '$'.number_format($pago['saldo_insoluto'],2), 'LR', 0, 'R', $fill);
			$this->Cell($w[7], 6, ucfirst($pago['sitacion'],2), 'LR', 0, 'R', $fill);
            $this->Ln();
            $fill=!$fill;
        }
			$this->Cell($w[0], 6, 'Total:' , 'LR', 0, 'L', $fill);
			$this->Cell($w[1], 6, ' ' , 'LR', 0, 'C', $fill);
            $this->Cell($w[2], 6, '$'.number_format($arreglo['prestamo'],2), 'LR', 0, 'R', $fill);
            $this->Cell($w[3], 6, '$'.number_format($arreglo['total_interes'],2) , 'LR', 0, 'R', $fill);
            $this->Cell($w[4], 6, '$'.number_format($arreglo['total_iva'],2), 'LR', 0, 'R', $fill);
			$this->Cell($w[5], 6, '$'.number_format($arreglo['total_pago'],2), 'LR', 0, 'R', $fill);
			$this->Cell($w[6], 6,  ' ', 'LR', 0, 'R', $fill);
            $this->Ln();
        $this->Cell(array_sum($w), 0, '', 'T');
    }

} 


?>