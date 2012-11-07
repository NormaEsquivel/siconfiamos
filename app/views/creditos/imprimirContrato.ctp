<?php
$fecha_primer=explode('-',$credito['Pago'][0]['fecha']);
$fecha_contrato=explode('-',$credito['Credito']['fecha']);
$mes=array('0','Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre');
App::import('Vendor','xtcpdf');  
$tcpdf = new XTCPDF(); 
$textfont = 'freesans'; // looks better, finer, and more condensed than 'dejavusans' 
$tcpdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
$tcpdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);
$tcpdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$tcpdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$tcpdf->SetFooterMargin(PDF_MARGIN_FOOTER);
$tcpdf->SetFont('helvetica','', 10);
$cuenta=count($credito['Pago']);
$fecha_ultimo=explode('-',$credito['Pago'][$cuenta-1]['fecha']);
$txt0='Fecha: '.$fecha_contrato[2].' de '.$mes[$fecha_contrato[1][0]*10+$fecha_contrato[1][1]*1].' de '.$fecha_contrato[0];
$txt1='<br><br>Número de crédito: '.$credito['Credito']['id'].'
<br>Cliente: '.$credito['Cliente']['nombre'].' '.$credito['Cliente']['apellido_paterno'].' '.$credito['Cliente']['apellido_materno'].'
<br>Domicilio: '.$credito['Cliente']['direccion'].' '.$credito['Cliente']['colonia'].'. '.$credito['Cliente']['localidad'].', '.$credito['Cliente']['estado'].'.';
$txt2='<br><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Monto del préstamo: $'.number_format($credito['Credito']['prestamo'],2).'			
       <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Pagos: '.$periodo.'
       <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Numero de pagos: '.$credito['Credito']['cuotas'].'		 
       <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Monto del pago 1 al '.$credito['Credito']['cuotas'].': $'.number_format($credito['Pago'][0]['pago'],2).'
       <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Primer pago: '.$fecha_primer[0].' de '.$mes[$fecha_primer[1][0]*10+$fecha_primer[1][1]].' de '.$fecha_primer[2].'		
       <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Ultimo pago: '.$fecha_ultimo[0].' de '.$mes[$fecha_ultimo[1][0]*10+$fecha_ultimo[1][1]].' de '.$fecha_ultimo[2];
$txt3='<br><br>CONTRATO DE PRESTAMO (el contrato) celebrado en la Fecha del Préstamo que se señala arriba, entre  “GRUPO KELQ”, S.A.P.I DE C.V. SO.F.O.M. E.N.R. (En lo sucesivo el  Acreedor),  con  domicilio  fiscal  en  la  AV. 7 n° 401 ALTABRISA, MERIDA, YUCATÁN. Y la o las personas cuyos  nombres  y  firmas se señalan en este contrato actuando respectivamente como Cliente (es), de conformidad con las siguientes declaraciones y cláusulas:
<br><br><b><div align="center">DECLARACIONES</div></b>
<br>I. El  Acreedor no es una institución bancaria y no está regulado por leyes financieras. Por lo tanto, no requiere autorización por parte de la Secretaria de Hacienda y Crédito Público para llevar a cabo actividades de préstamo, incluyendo la celebración del presente contrato.
<br>II. El representante del Acreedor cuenta con los poderes y facultades suficientes para celebrar el presente contrato y obligar al acreedor en los  términos aquí estipulados.
<br>III. El /los Cliente(es) declaran que la información proporcionada al Acreedor en la Solicitud de Crédito anexa (misma que forma parte del presente Contrato) es veraz y que el/los Cliente(es) y el Acreedor desean celebrar el presente contrato de conformidad con las siguientes:
<br><b><div align="center">CLÁUSULAS</div></b>
<br>1.	En este acto el Acreedor presta al /los Cliente(es) y el/los Cliente (es) reciben el monto del Préstamo indicado arriba. El/los Cliente (es), de forma incondicional, se obligan a pagar el Monto Total, que es la suma de: ($'.number_format($credito['Credito']['prestamo'],2).') "'.$letras_prestamo.'". Moneda Nacional; mas los Cargos Totales (consistentes en los Cargos Financieros y el I. V.A. Correspondiente) en el domicilio del Acreedor. El monto deberá ser pagado en el número de pagos '.$periodo.' que arriba se mencionan, en el entendido de que cada pago será igual al Monto '.$credito['Credito']['periodo_cuotas'].' de Pago arriba señalado. El Primer Pago '.$credito['Credito']['periodo_cuotas'].' se vencerá y será exigible '.$vencimiento.', justamente en la fecha que arriba se indica como Primer Pago'.$credito['Credito']['periodo cuotas'].', a menos que dicha fecha no exista, en cuyo caso, el Primer Pago '.$credito['Credito']['periodo_cuotas'].' se vencerá y será exigible el '.$vencimiento2.' calendario siguiente a la fecha del primer pago '.$credito['Credito']['periodo_cuotas'].'. Subsecuentemente, cada uno de los pagos '.$periodo.' se vencerá y será exigible '.$exigir.'. En lo sucesivo se hará referencia de manera indistinta, tanto a la fecha del primer pago '.$credito['Credito']['periodo_cuotas'].' como a las fechas '.$periodo.' subsecuentes en las que cada uno de los pagos '.$periodo.'. se venza y sea exigible de conformidad con lo estipulado en este Contrato, como Fecha (s) de Pago Programado. En caso de que una Fecha de pago Programado no caiga en día hábil, el /los Cliente (es) estarán obligados a realizar el pago correspondiente el día hábil inmediato siguiente.
<br>
<br>Para efectos de este contrato los días hábiles excluyen domingos, días de descanso obligatorios conforme a la ley Federal del Trabajo y cualesquiera otros días feriados en los que las oficinas y sucursales del Acreedor normalmente no laboren. Todos los pagos deberán efectuarse por el /los Cliente(es) en días y horas hábiles en las oficinas del Acreedor en el domicilio del Acreedor que más adelante se señala.
<br><br>2. Tasa de interés ordinario. La parte acreditada se obliga a pagar al Acreedor, intereses ordinarios sobre el saldo inicial mensual, sobre la suma ejercida, a la tasa anual del '.$credito['Credito']['tasa_interes'].'% ('.$letras_tasa.'por ciento anual).
<br>
<br>Los intereses se calcularan sobre la base de 360 trescientos sesenta días por año y se causaran sobre el saldo inicial por los días efectivamente transcurridos.
<br>
<br>Los pagos serán '.$vencimiento3.'
<br><br>3.   El Acreedor expedirá un recibo por cada pago efectuado por el/los Cliente (es) y registrara los pagos y el saldo pendiente de pago correspondiente al Monto Total en la cuenta de el/los Cliente(es) en su sistema. El/los Cliente (es) tendrán el derecho de solicitar, en las oficinas del Acreedor que correspondan, en días y horas hábiles y en cualquier momento previo a que se haya cubierto completamente el Monto Total, una copia de su estado de cuenta que indique el saldo insoluto del Monto Total.
<br>4.   En caso de que el/los Cliente(es) no paguen cualquier  Monto de Pago '.$credito['Pago'][0]['periodo_cuotas'].' en la Fecha de Pago Programado que corresponda el/los Cliente (es) estarán automáticamente en incumplimiento del presente Contrato. En dicho caso, el Acreedor podrá declarar el saldo insoluto del Monto total como no pagado e inmediatamente exigible.
<br>5.   Si cualquier monto '.$credito['Pago'][0]['periodo_cuotas'].' de Pago no es totalmente pagado dentro de la Fecha de Pago causará un interés moratorio igual a multiplicar la tasa de interés ordinario por 1.5 sobre el capital vencido así como una pena convencional del 10% sobre el monto total vencido.
<br>6.   El monto del I.V.A. señalado se cobrará como parte de cada uno de los Montos '.$periodo.' de Pago, aplicando la tasa del impuesto al valor agregado que corresponda de conformidad con la ley, a las porciones que correspondan de la Cuota de Adquisición y/o del Cargo Financiero incluido dentro de cada Monto '.$credito['Pago'][0]['periodo_cuotas'].' de Pago. En el caso de que las leyes fiscales aplicables modifiquen el impuesto al valor agregado aplicable, o su método de cálculo, el Acreedor tendrá el derecho de cobrar o la obligación de acreditar al /los Cliente(es) (según sea el caso) la diferencia en el monto del I. V. A. arriba señalado.
<br>7.   Cada pago realizado por el/los Cliente(es) será aplicado en el siguiente orden: (I) en su caso, Cargos por Cheques Devueltos., (II) en su caso, Cargos por Pagos Retrasados, y (III) a reducir el saldo del Monto Total.
<br>8.	 El/los Cliente (es) podrán pagar cualquier Monto '.$credito['Pago'][0]['periodo_cuotas'].' de Pago en una fecha previa a aquella(s) estipulada(s) como Fecha (s) Programadas de Pago. Los Pagos parciales anticipados del Monto Total no darán derecho al/los Cliente(es) a descuento o devolución alguna del Monto Total. La cuota de adquisición no estará sujeta a acreditamiento alguno o devolución, aún en el caso de pago anticipado del Monto Total. Si el saldo del Monto Total es pagado por completo por el/los Cliente(es) de forma anticipada y el /los Cliente(es) no se encuentra (n) en un incumplimiento con los términos y condiciones de este Contrato, el Acreedor otorgara al /los Cliente un descuento que le (s) será acreditado(en el entendido que, bajo ninguna circunstancia, se les reembolsara dinero en efectivo ) calculado sobre las porciones del cargo Financiero e I. V. A. correspondientes que no hayan vencido y no sean exigibles a la Fecha Programada de Pago aplicable para el descuento. La Fecha Programada de Pago para propósitos de descuento será la Fecha de Pago Programado siguiente al momento de prepago en su totalidad del Monto Total, salvo que dicho prepago ocurra exactamente en una Fecha de Pago Programada. En este último caso, se tomara dicha Fecha de Pago Programada para calcular el descuento a ser acreditado. El descuento a que hace referencia el presente párrafo se calculara utilizando la tabla de amortización que se anexa a este contrato.
<br>9.   Si el/los Cliente(es) deciden pagar con cheque, y el cheque es devuelto o no pagado al Acreedor por la institución financiera del/los Cliente (es), la cantidad por la que fue girado el cheque se seguirá considerando no pagada y debida por el /los Cliente(es) en términos de este Contrato. En este caso, el/los Cliente(es) convienen en pagar al Acreedor, además del monto adeudado no cubierto, un Cargo por Cheque Devuelto por una cantidad igual a (I) el veinte por ciento( 20%) del monto total del cheque en cuestión, mas (II) el Cargo fijo que el banco del Acreedor cobre por la devolución del cheque, el cual estará sujeto a cambios conforme a las políticas del banco del Acreedor, mas (III) el I. V. A. aplicable por este cargo. Cualquier pago estipulado en esta clausula es independiente de cualquier Cargo por Pago Retrasado (en caso de que exista), en Términos de la Cláusula 4 anterior.
<br>10.  El/los Cliente (es) convienen en otorgar a favor del Acreedor, si es que así lo solicita éste último, prenda o garantía suficiente para asegurar las obligaciones de pago estipuladas en este Contrato.
<br>11.  El /los Cliente(es) deberán abstenerse de llevar a cabo cualquier acción que materialmente afecte la capacidad de pagar el Monto Total en favor del Acreedor.
<br>12.  Cualquier notificación al Acreedor deberá ser efectuada en el domicilio de dicho Acreedor, mismo que se señala más abajo. Cualquier notificación al /los Cliente(es) será efectuada en el/los domicilio (s) proporcionados por el Cliente(es) en este Contrato y/o en el formato de Solicitud de Crédito. El /los Cliente (es) están obligados a notificar al Acreedor de cualquier cambio de domicilio dentro de los diez (10) días hábiles en que se hubiera efectuado, proporcionando este ultimo un comprobante de domicilio o alguna prueba del (de los ) nuevo (s) domicilio (s) declarando (s).
<br>13.  Este Contrato está sujeto a las leyes aplicables y jurisdicción del Estado de Yucatán, renunciando las partes a la aplicación de cualquier otra ley o jurisdicción que pudiese corresponderles por virtud de sus domicilios presentes o futuros.
<br>14.  Sin perjuicio de lo pactado en las clausulas conducentes de este contrato, respecto de la obligación de El/los Clientes de efectuar los pagos en el domicilio del Acreedor. Por este medio El Cliente autoriza a la empresa que maneja la nomina del Cliente a descontar de esta el pago semanal o'.$credito['Pago'][0]['periodo_cuotas'].' estipulado en este contrato y a entregarlo a “GRUPO KELQ”, S.A.P.I. DE C.V. S.O.F.O.M. E.N.R., hasta el pago total del crédito estipulado en este contrato.
<br>15.  El/los Cliente(es) reconocen y aceptan que este contrato les fue leído y explicado en su totalidad previa su firma, habiendo el /los Cliente(es) entendido la naturaleza y alcance de todas y cada una de las obligaciones estipuladas en este instrumento, y que el/los Cliente(es) libremente se acercaron al acreedor para pedir el préstamo y libremente desean celebrar este Contrato. El/los Cliente(es) declaran que están consientes de y conocen todas las obligaciones asumidas por virtud de la celebración de este contrato, no habiendo error, gozando plenamente de sus facultades, y contando con capacidad económica, bienes e ingresos suficientes para hacer frente a las obligaciones antes mencionadas, sin ser forzado (s) o encontrarse bajo amenaza o presión por parte del Acreedor. El/los Cliente(es) reconocen y aceptan que ninguna de las obligaciones estipuladas en este contrato, incluyendo cualquier pago a ser hecho a favor del Acreedor y los Cargos Totales Convenidos, son desproporcionadas o desfavorables para el/los Cliente (es), y que no existe lesión, conducta inapropiada, dolo, mala fe, abuso, cargos abusivos o ganancias desproporcionadas por parte del Acreedor en este Contrato. El/los Cliente(es) asumen las obligaciones de pago derivados de este Contrato sin que exista ni el Acreedor tome ventaja de posible apuro económico, necesidad urgente, extrema miseria, suma ignorancia o notoria inexperiencia de los mismos. El /los Cliente(es) convienen y aceptan que las obligaciones y cargos totales estipulados en este instrumento son ordinarios atendiendo a la naturaleza del contrato, y son justos de acuerdo a los usos comerciales y el mercado.
<br>
<br>Cliente 
<br>Yo, siendo el Cliente, reconozco, acepto y convengo todo lo previamente transcrito.
<br>Firma:
<br>Nombre: '.$credito['Cliente']['nombre'].' '.$credito['Cliente']['apellido_paterno'].' '.$credito['Cliente']['apellido_materno'].'
<br>Dirección: '.$credito['Cliente']['direccion'].' '.$credito['Cliente']['colonia'].'. '.$credito['Cliente']['localidad'].', '.$credito['Cliente']['estado'].'.'.'
<br>Tipo de identificación: '.$credito['Cliente']['identificacion'].'
<br>
<br>"GRUPO KELQ", S.A.P.I. DE C.V. S.O.F.O.M. E.N.R.
<br>
<br>Firma:
<br>Nombre: Javier Rolando Medina Campos
<br>Dirección: Av. 7 Número 401 Altabrisa, Mérida, Yucatán
<br><br>Firmado por el cliente en prescencia de:
<br><br><table>
<tr><td>Testigo:</td><td>Testigo:</td></tr>
<tr><td>Firma:</td><td>Firma:</td></tr>
<tr><td>Nombre:</td><td>Nombre:</td></tr>
</table><br>Para cualquier duda, aclaración o reclamación, favor de dirigirse a:
<br>Calle 73 n° 225 x 48 y 50 Montes de Ame  C.P. 97115 con el Lic. Javier Rolando Medina Campos';
$txt1000='<b><div align="center">PAGARÉ</b></div><br><br>
Por virtud de este pagare, '.$credito['Cliente']['nombre'].' '.$credito['Cliente']['apellido_paterno'].' '.$credito['Cliente']['apellido_materno'].' . En lo sucesivo Denominado (a) Como el Cliente o los Clientes indistintamente), promete (n) pagar incondicionalmente a la orden de “GRUPO KELQ”, S.A.P.I. DE C.V. SO.F.O.M. E.N.R (en lo sucesivo denominado el  "Tenedor”), en el domicilio del Tenedor que se indica más adelante, o cualquier otro domicilio para el pago proporcionado por el Tenedor al Cliente o Clientes, la cantidad de $'.number_format($credito['Credito']['prestamo'],2).' '.$letras_prestamo.' M.N (Moneda de curso legal en los Estados Unidos Mexicanos), en '.$credito['Credito']['cuotas'].' pagos parciales de $'.number_format($credito['Pago'][0]['pago'],2).' '.$letras_pago.' M.N. (Moneda en curso legal en los Estados Unidos Mexicanos) cada uno mismos que se vencerán y serán exigibles '.$mente.' (en lo sucesivo colectivamente denominados como Fechas de Vencimiento e individualmente denominado como fecha de vencimiento), comenzando el día '.$credito['Pago'][0]['fecha'].' y continuando '.$vencimiento3.' hasta que el presente pagaré se pague por completo.
<br>
<br>La tasa de interés ordinaria será del '.$credito['Credito']['tasa_interes'].'% sobre el saldo inicial mensual, calculado sobre la base de 360 días.
<br>
<br>El Tenedor tendrá el derecho a transmitir este pagare en cualquier momento, ya sea por endoso o cesión o cualquier otro medio permitido por la ley. En cualquier caso, incluso en los casos de endoso o cesión, el Tenedor no estará obligado a presentarlo antes de su cobro.
<br>
<br>En caso de incumplimiento del pago total de cualquier pago parcial aquí convenido en las Fechas de Vencimiento, el monto total de la suerte principal podrá ser declarado inmediatamente vencido y exigible por el Tenedor. Adicionalmente, si cualquier pago parcial no es completamente pagado dentro de la Fecha  de Vencimiento correspondiente a dicho pago parcial, el Cliente o Clientes deberán pagar un interés moratorio equivalente a la tasa de interés ordinaria multiplicada por 1.5 y una pena convencional del diez por ciento (10%) de cualquier monto que no haya sido cubierto,  mas el correspondiente impuesto al valor agregado.
<br>
<br>El presente pagare se suscribe el día '.date('d').' de '.$mes[date('n')].' de '.date('Y').' en Domicilio _____________________________,  Mérida, Yucatán, México.
<br>
<br>Cliente
<br>Firma:
<br>Nombre: '.$credito['Cliente']['nombre'].' '.$credito['Cliente']['apellido_paterno'].' '.$credito['Cliente']['apellido_materno'].'
<br>Dirección: '.$credito['Cliente']['direccion'].' '.$credito['Cliente']['colonia'].'. '.$credito['Cliente']['localidad'].', '.$credito['Cliente']['estado'];
$txt10000='<b><div align="center">CARTA DE AUTORIZACIÓN DE DESCUENTO A INGRESOS</div></b>';
$txt63='<br><br>Merida, Yucatán a '.date('d').' de '.$mes[date('n')].' de '.date('Y');
$txt64='<br><br>Yo, '.$credito['Cliente']['nombre'].' '.$credito['Cliente']['apellido_paterno'].' '.$credito['Cliente']['apellido_materno'].', por mi propio derecho e identificándome con credencial de elector, por medio del presente escrito:
<br>
<br>1.- Concedo mi Autorización expresa a la empresa que administra mi nomina, para que retenga de mi ingreso '.$credito['Credito']['periodo_cuotas'].', el monto de $'.number_format($credito['Pago'][0]['pago'],2).' por '.$credito['Credito']['cuotas'].' '.$ese.', por concepto del crédito que me otorgo “GRUPO KELQ”, S.A.P.I. DE C.V. S.O.F.O.M. E.N.R en esta fecha, por un monto de $'.number_format($credito['Credito']['prestamo'],2).' vía '.$forma_pago.'. Dicho descuento será a partir del '.$credito['Pago'][0]['fecha'].' y vencerá el día '.$credito['Pago'][$cuenta-1]['fecha'].'. 
<br>
<br>2.- Solicito y autorizo a que dichos montos sean transferidos el mismo día en que la empresa que administra mi nomina me cubra el importe de mis ingresos y se depositen a la cuenta 0806748423 a nombre de “GRUPO KELQ SAPI DE CV SOFOM ENR”,  en el banco BANORTE. Dichos pagos serán destinados a cubrir el crédito mencionado en el inciso anterior.
<br>
<br>3.- Solicito y autorizo a que en caso de mi separación de la empresa que administra mi nomina, esta retenga del monto que por dicho motivo me corresponda, hasta el importe del saldo insoluto pendiente de cubrir del crédito mencionado en el inciso (1) de este escrito. Tal cantidad deberá ser abonada el mismo día en que la empresa que administra mi nómina me cubra el citado importe y se deposite a la cuenta 0806748423  a nombre de “GRUPO KELQ SAPI DE CV SOFOM ENR”, en el banco BANORTE.<br>';
$txt65='<br><table><tr><td align="center">Atentamente</td><td align="center">Firma de Aprobado y Recibido de Empresa que administra la nómina</td></tr>
<tr><td align="center"><br>
<br>
<br>
<br>
<br>
<br> 
<br>'.$credito['Cliente']['nombre'].' '.$credito['Cliente']['apellido_paterno'].' '.$credito['Cliente']['apellido_materno'].'</td></tr></table>';
$tcpdf->AddPage();
$tcpdf->writeHtml($txt0, true, false, false, false,'R');
$tcpdf->writeHtml($txt1, true, false, false, false,'L');
$tcpdf->writeHtml($txt2, true, false, false, false,'L');
$tcpdf->writeHtml($txt3, true, false, false, false,'J');
$tcpdf->AddPage();
$tcpdf->writeHtml($txt1000, true, false, false, false,'J');
$tcpdf->AddPage();
$tcpdf->writeHtml($txt10000, true, false, false, false,'J');
$tcpdf->writeHtml($txt63, true, false, false, false,'R');
$tcpdf->writeHtml($txt64, true, false, false, false,'J');
$tcpdf->writeHtml($txt65, true, false, false, false,'J');




echo $tcpdf->Output('Contrato.pdf', 'I');
?>