<?php
App::import('Vendor','xtcpdf');
App::import('Vendor', 'format');
$tcpdf = new XTCPDF();
$format = new format();
$tcpdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
$tcpdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);
$tcpdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$tcpdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$tcpdf->SetFooterMargin(PDF_MARGIN_FOOTER);
$tcpdf->SetFont('helvetica','', 10);

$texto =
'<b>N° de crédito:</b> '  . $credito['Credito']['id'] .
'<br><b>Cliente:</b> ' . $credito['Cliente']['nombre'] . ' ' . $credito['Cliente']['apellido_paterno'] . ' ' . $credito['Cliente']['apellido_materno'] .
'<br><b>Domicilio:</b> ' . $credito['Cliente']['direccion'] . ' ' . $credito['Cliente']['colonia'] . ', ' . $credito['Cliente']['localidad'] . ', ' . $credito['Cliente']['estado'] .
'<br>
<br>
<br><b>Monto del préstamo: $' . number_format($credito['Credito']['prestamo'], 2) .
'<br>Interés Ordinario: $' . number_format($total_interes, 2) . ' + I.V.A.
<br>Pagos: ' . $periodo_plural .
'<br>Número de pagos: ' . $credito['Credito']['cuotas'] .
'<br>Monto del pago 1 al ' . $credito['Credito']['cuotas'] . ' $' . number_format($credito['Pago'][0]['pago'], 2) .
'<br>Primer pago: ' . $format->fechapago($credito['Pago'][0]['fecha']) . 
'<br>Último pago: ' . $format->fechapago($credito['Pago'][count($credito['Pago'])-1]['fecha']) . 
'</b><br>
<br>CONTRATO DE PRESTAMO celebrado en la fecha que arriba se señala, entre “GRUPO KELQ”, S.A.P.I DE C.V. SO.F.O.M. E.N.R. (En lo
sucesivo el Acreedor), con domicilio fiscal en la AV. 7 n° 401 ALTABRISA, MERIDA, YUCATÁN. Y la o las personas cuyos nombres
y firmas se señalan en este contrato actuando respectivamente como Cliente (es), de conformidad con las siguientes declaraciones
y cláusulas:
<br>
<br>';

$texto2 = 
'I. El Acreedor no es una institución bancaria y no está regulado por leyes financieras. Por lo tanto, no requiere autorización por
parte de la Secretaria de Hacienda y Crédito Público para llevar a cabo actividades de préstamo, incluyendo la celebración del
presente contrato.
<br>II. El representante del Acreedor cuenta con los poderes y facultades suficientes para celebrar el presente contrato y obligar al
acreedor en los términos aquí estipulados.
<br>III. El /los Cliente(es) declaran que la información proporcionada al Acreedor en la Solicitud de Crédito anexa (misma que forma
parte del presente Contrato) es veraz y que el/los Cliente(es) y el Acreedor desean celebrar el presente contrato de conformidad
con las siguientes:
<br>
<br>';

$texto3 =
'1.En este acto el Acreedor presta al /los Cliente(es) y el/los Cliente (es) reciben el monto del Préstamo indicado arriba. El/los Cliente
es), de forma incondicional, se obligan a pagar el Monto Total, que es la suma de: $' . number_format($credito['Credito']['prestamo'], 2) .'(' . $letras_prestamo . ')' .
' Moneda Nacional; más los Cargos financieros de $'. number_format($total_interes, 2) . ' + I.V.A. en el domicilio del Acreedor. El monto deberá
ser pagado en el número de pagos ' . $periodo_plural . ' que arriba se mencionan, en el entendido de que cada pago será igual al Monto '
. strtoupper($credito['Credito']['periodo_cuotas']) . ' de Pago arriba señalado. El Primer Pago ' . strtoupper($credito['Credito']['periodo_cuotas']) . ' se vencerá y será exigible ' . $vencimiento .'
, justamente en la fecha que arriba se indica como Primer Pago ' . strtoupper($credito['Credito']['periodo_cuotas']) . ', a menos que dicha
fecha no exista, en cuyo caso, el Primer Pago ' . strtoupper($credito['Credito']['periodo_cuotas']) . ' se vencerá y será exigible el primer día del mes calendario siguiente a
la fecha del primer pago ' . strtoupper($credito['Credito']['periodo_cuotas']) . '. Subsecuentemente, cada uno de los pagos ' . $periodo_plural . ' se vencerá y será exigible ' . $vencimiento2 . '
En lo sucesivo se hará referencia de manera indistinta, tanto a la fecha del primer
pago ' . strtoupper($credito['Credito']['periodo_cuotas']) . ' como a las fechas ' . $periodo_plural . ' subsecuentes en las que cada uno de los pagos ' . $periodo_plural . ' se venza y sea
exigible de conformidad con lo estipulado en este Contrato, como Fecha (s) de Pago Programado. En caso de que una Fecha de pago
Programado no caiga en día hábil, el /los Cliente (es) estarán obligados a realizar el pago correspondiente el día hábil inmediato siguiente.
<br>
Para efectos de este contrato los días hábiles excluyen domingos, días de descanso obligatorios conforme a la ley Federal del
Trabajo y cualesquiera otros días feriados en los que las oficinas y sucursales del Acreedor normalmente no laboren. Todos los pagos
deberán efectuarse por el /los Cliente(es) en días y horas hábiles en las oficinas del Acreedor en el domicilio del Acreedor que más
adelante se señala.
<br>
2. Tasa de interés ordinario. La parte acreditada se obliga a pagar al Acreedor, intereses ordinarios sobre el saldo inicial mensual,
sobre la suma ejercida, a la tasa anual del ' . $credito['Credito']['tasa_interes'] . '% (' . $letras_tasa . ' por ciento anual) más el I.V.A. correspondiente.
<br>
Los intereses se calcularan sobre la base de 360 trescientos sesenta días por año y se causaran sobre el saldo inicial por los días
efectivamente transcurridos.
<br>
3.El Acreedor expedirá un recibo por cada pago efectuado por el/los Cliente (es) y registrara los pagos y el saldo pendiente de
pago correspondiente al Monto Total en la cuenta de el/los Cliente(es) en su sistema. El/los Cliente (es) tendrán el derecho de
solicitar, en las oficinas del Acreedor que correspondan, en días y horas hábiles y en cualquier momento previo a que se haya
cubierto completamente el Monto Total, una copia de su estado de cuenta que indique el saldo insoluto del Monto Total.
<br>
4.En caso de que el/los Cliente(es) no paguen cualquier Monto de Pago ' . strtoupper($credito['Credito']['periodo_cuotas']) . ' en la Fecha de Pago Programado que
corresponda el/los Cliente (es) estarán automáticamente en incumplimiento del presente Contrato. En dicho caso, el Acreedor
podrá declarar el saldo insoluto del Monto total como no pagado e inmediatamente exigible.
<br>
5.Si cualquier monto ' . strtoupper($credito['Credito']['periodo_cuotas']) . ' de Pago no es totalmente pagado dentro de la Fecha de Pago causará un interés moratorio
igual a multiplicar la tasa de interés ordinario por 1.5 sobre el capital vencido así como una pena convencional del 10% sobre el
monto total vencido.
<br>
6.El monto del I.V.A. señalado se cobrara como parte de cada uno de los Montos ' . $periodo_plural . ' de Pago, aplicando la tasa
del impuesto al valor agregado que corresponda de conformidad con la ley, a las porciones que correspondan de la Cuota de
Adquisición y/o del Cargo Financiero incluido dentro de cada Monto ' . strtoupper($credito['Credito']['periodo_cuotas']) . ' de Pago. En el caso de que las leyes fiscales
aplicables modifiquen el impuesto al valor agregado aplicable, o su método de cálculo, el Acreedor tendrá el derecho de cobrar o la
obligación de acreditar al /los Cliente(es) (según sea el caso) la diferencia en el monto del I. V. A. arriba señalado.
<br>
7.Cada pago realizado por el/los Cliente(es) será aplicado en el siguiente orden: (I) en su caso, Cargos por Cheques
Devueltos., (II) en su caso, Cargos por Pagos Retrasados, y (III) a reducir el saldo del Monto Total.
<br>
8.El/los Cliente (es) podrán pagar cualquier Monto ' . strtoupper($credito['Credito']['periodo_cuotas']) . ' de Pago en una fecha previa a aquella(s) estipulada(s) como
Fecha (s) Programadas de Pago. Los Pagos parciales anticipados del Monto Total no darán derecho al/los Cliente(es) a descuento o
devolución alguna del Monto Total. La cuota de adquisición no estará sujeta a acreditamiento alguno o devolución, aún en el caso
de pago anticipado del Monto Total. Si el saldo del Monto Total es pagado por completo por el/los Cliente(es) de forma anticipada y
el /los Cliente(es) no se encuentra (n) en un incumplimiento con los términos y condiciones de este Contrato, el Acreedor otorgara
al /los Cliente un descuento que le (s) será acreditado(en el entendido que, bajo ninguna circunstancia, se les reembolsara dinero en
efectivo ) calculado sobre las porciones del cargo Financiero e I. V. A. correspondientes que no hayan vencido y no sean exigibles a la
Fecha Programada de Pago aplicable para el descuento. La Fecha Programada de Pago para propósitos de descuento será la Fecha
de Pago Programado siguiente al momento de prepago en su totalidad del Monto Total, salvo que dicho prepago ocurra
exactamente en una Fecha de Pago Programada. En este último caso, se tomara dicha Fecha de Pago Programada para calcular el
descuento a ser acreditado. El descuento a que hace referencia el presente párrafo se calculara utilizando la tabla de amortización
que se anexa a este contrato.
<br>
9.Si el/los Cliente(es) deciden pagar con cheque, y el cheque es devuelto o no pagado al Acreedor por la institución financiera
del/los Cliente (es), la cantidad por la que fue girado el cheque se seguirá considerando no pagada y debida por el /los Cliente(es) en
términos de este Contrato. En este caso, el/los Cliente(es) convienen en pagar al Acreedor, además del monto adeudado no
cubierto, un Cargo por Cheque Devuelto por una cantidad igual a (I) el veinte por ciento( 20%) del monto total del cheque en
cuestión, mas (II) el Cargo fijo que el banco del Acreedor cobre por la devolución del cheque, el cual estará sujeto a cambios
conforme a las políticas del banco del Acreedor, mas (III) el I. V. A. aplicable por este cargo. Cualquier pago estipulado en esta
clausula es independiente de cualquier Cargo por Pago Retrasado (en caso de que exista), en Términos de la Cláusula 4 anterior.
<br>
10.El/los Cliente (es) convienen en otorgar a favor del Acreedor, si es que así lo solicita éste último, prenda o garantía
suficiente para asegurar las obligaciones de pago estipuladas en este Contrato.
<br>
11.El /los Cliente(es) deberán abstenerse de llevar a cabo cualquier acción que materialmente afecte la capacidad de pagar el
Monto Total en favor del Acreedor.
<br>
12.Cualquier notificación al Acreedor deberá ser efectuada en el domicilio de dicho Acreedor, mismo que se señala más abajo.
Cualquier notificación al /los Cliente(es) será efectuada en el/los domicilio (s) proporcionados por el Cliente(es) en este Contrato y/o
en el formato de Solicitud de Crédito. El /los Cliente (es) están obligados a notificar al Acreedor de cualquier cambio de domicilio
dentro de los diez (10) días hábiles en que se hubiera efectuado, proporcionando este ultimo un comprobante de domicilio o alguna
prueba del (de los ) nuevo (s) domicilio (s) declarando (s).
<br>
13.Este Contrato está sujeto a las leyes aplicables y jurisdicción del Estado de Yucatán, renunciando las partes a la aplicación
de cualquier otra ley o jurisdicción que pudiese corresponderles por virtud de sus domicilios presentes o futuros.
<br>
14.Sin perjuicio de lo pactado en las clausulas conducentes de este contrato, respecto de la obligación de El/los Clientes de
efectuar los pagos en el domicilio del Acreedor. Por este medio El Cliente autoriza a la empresa que maneja la nomina del Cliente a
descontar de esta el pago semanal o ' . strtoupper($credito['Credito']['periodo_cuotas']) . ' estipulado en este contrato y a entregarlo a “GRUPO KELQ”, S.A.P.I. DE C.V.
SO.F.O.M. E.N.R., hasta el pago total del crédito estipulado en este contrato.
<br>
15.El/los Cliente(es) reconocen y aceptan que este contrato les fue leído y explicado en su totalidad previa su firma, habiendo
el /los Cliente(es) entendido la naturaleza y alcance de todas y cada una de las obligaciones estipuladas en este instrumento, y que
el/los Cliente(es) libremente se acercaron al acreedor para pedir el préstamo y libremente desean celebrar este Contrato. El/los
Cliente(es) declaran que están consientes de y conocen todas las obligaciones asumidas por virtud de la celebración de este
contrato, no habiendo error, gozando plenamente de sus facultades, y contando con capacidad económica, bienes e ingresos
suficientes para hacer frente a las obligaciones antes mencionadas, sin ser forzado (s) o encontrarse bajo amenaza o presión por
parte del Acreedor. El/los Cliente(es) reconocen y aceptan que ninguna de las obligaciones estipuladas en este contrato, incluyendo
cualquier pago a ser hecho a favor del Acreedor y los Cargos Totales Convenidos, son desproporcionadas o desfavorables para el/los
Cliente (es), y que no existe lesión, conducta inapropiada, dolo, mala fe, abuso, cargos abusivos o ganancias desproporcionadas por
parte del Acreedor en este Contrato. El/los Cliente(es) asumen las obligaciones de pago derivados de este Contrato sin que exista ni
el Acreedor tome ventaja de posible apuro económico, necesidad urgente, extrema miseria, suma ignorancia o notoria inexperiencia
de los mismos. El /los Cliente(es) convienen y aceptan que las obligaciones y cargos totales estipulados en este instrumento son
ordinarios atendiendo a la naturaleza del contrato, y son justos de acuerdo a los usos comerciales y el mercado.
<br>
<br>
<br>
Cliente<br>
Siendo el Cliente, reconozco, acepto y convengo todo lo previamente transcrito.
<br>
<br>
Firma:<br>
Nombre: ' . $credito['Cliente']['nombre'] . ' ' . $credito['Cliente']['apellido_paterno'] . ' ' . $credito['Cliente']['apellido_materno'] . ' <br>
Dirección: ' . $credito['Cliente']['direccion'] . ' ' . $credito['Cliente']['colonia'] . ', ' . $credito['Cliente']['ciudad'] . ' ' . $credito['Cliente']['estado'] .
'<br>
Tipo de identificación: ' . $credito['Cliente']['identificacion'] . '
<br>
<br>
“GRUPO KELQ”, S.A.P.I. DE C.V. S.O.F.O.M. E.N.R.
<br>
<br>
FIRMA:
<br>
NOMBRE: ' . $usuario['User']['nombre'] . ' ' . $usuario['User']['apellido'] .'
<br>
DIRECCIÓN: Av. 7 Número 401 Altabrisa, Mérida, Yucatán
<br>
<br>
Firmado por el Cliente en presencia de:
<br>
<br>
Testigo:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Testigo:<br><br>
Firma:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Firma:<br><br>
Nombre:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Nombre:<br><br>';


$texto4 = '
<br>
<br>Por virtud de este pagare, ' . $credito['Cliente']['nombre'] . ' ' . $credito['Cliente']['apellido_paterno'] . ' ' . $credito['Cliente']['apellido_materno'] .'. En lo sucesivo denominado (a) Como el Deudor o los Deudores indistintamente),
promete (n) pagar incondicionalmente a la orden de “GRUPO KELQ”, S.A.P.I. DE C.V. SO.F.O.M. E.N.R (en lo sucesivo denominado
el "Tenedor”), en el domicilio del Tenedor que se indica más adelante, o cualquier otro domicilio para el pago proporcionado
por el Tenedor al Cliente o Clientes, la cantidad de $' . number_format(round($credito['Pago'][0]['pago'],2)*$credito['Credito']['cuotas'], 2) . '(' . $letras_total . ') (Moneda de
curso legal en los Estados Unidos Mexicanos), mismo que equivale al capital y a los intereses más el I.V.A. correspondientes, en
' . $credito['Credito']['cuotas'] . ' pagos parciales de $' . number_format($credito['Pago'][0]['pago'],2) . ' (' . $letras_pago . ') (Moneda en curso legal en los Estados Unidos Mexicanos)
cada uno mismos que se vencerán y serán exigibles (en lo sucesivo colectivamente denominados como Fechas de Vencimiento
e individualmente denominado como fecha de vencimiento), comenzando el día ' . $format->fechapago($credito['Pago'][0]['fecha']) . ' y continuando ' . $incremento_pagos .' hasta que el presente pagaré se pague
por completo.
<br>
<br>
El presente pagaré se suscribe el dia ' . $format->fecha(date('Y-m-d')) . '. Mérida, Yucatán, México.
<br>
<br>
<b>Cliente (es)
<br>
<br>
<br>
Firma:
<br>
Nombre: ' . $credito['Cliente']['nombre'] . ' ' . $credito['Cliente']['apellido_paterno'] . ' ' . $credito['Cliente']['apellido_materno'] .
'<br>
Dirección: ' . $credito['Cliente']['direccion'] . ' ' . $credito['Cliente']['colonia'] . ', ' . $credito['Cliente']['localidad'] . ', ' . $credito['Cliente']['estado'] . '</b>';

$descontante = $credito['Cliente']['division'] != null ? $credito['Cliente']['division'] : $credito['Cliente']['Empresa']['nombre'];
$cobradora = $credito['Cliente']['division'] != null ? $credito['Cliente']['division'] : $credito['Cliente']['Empresa']['nombre'];

$texto5 ='<br><br>' .
$cobradora . '
<br>
' . $credito['Cliente']['Empresa']['representante'] . '
<br>
<br>
Presente:
<br>
<br>
' . $credito['Cliente']['nombre'] . ' ' . $credito['Cliente']['apellido_paterno'] . ' ' . $credito['Cliente']['apellido_materno'] . ', por mi propio derecho e identificándome con credencial de elector, por medio del presente escrito:
<br>
<br>
1.- Concedo mi Autorización expresa a la empresa ' . $descontante . ', para que retenga
de mis ingresos ' . $periodo_plural . ', el monto de $' . number_format($credito['Pago'][0]['pago'], 2) . ' (' . $letras_pago . ') por ' . $credito['Credito']['cuotas'] . ' ' . $plural . ', por concepto
del crédito que me otorgo “GRUPO KELQ”, S.A.P.I. DE C.V. S.O.F.O.M. E.N.R en esta fecha, por un monto de $' . number_format(round($credito['Pago'][0]['pago'],2)*$credito['Credito']['cuotas'], 2) . ' (' . $letras_total . ').
Dicho descuento será a partir del '. $format->fechapago($credito['Pago'][0]['fecha']) . ' y vencerá el día '. $format->fechapago($credito['Pago'][count($credito['Pago'])-1]['fecha']) .' .
<br>
<br>
2.- Solicito y autorizo a que dichos montos sean transferidos el mismo día en que ' . $cobradora . ' me cubra el importe de mis ingresos y se depositen a la cuenta 0806748423 a nombre de “GRUPO KELQ SAPI DE CV
SOFOM ENR”, en el banco BANORTE. Dichos pagos serán destinados a cubrir el crédito mencionado en el inciso anterior.
<br>
<br>
3.- Solicito y autorizo a que en caso de mi separación, por renuncia y/o despido, me sea retenido del monto que por dicho motivo
me corresponda como concepto de finiquito, el importe total del saldo pendiente por cubrir del crédito a “GRUPO KELQ”, S.A.P.I. DE
C.V. S.O.F.O.M. E.N.R.
<br>
<br>';

$texto6 ='<br>
<br>
ATENTAMENTE
<br>
<br>
<br>
<table><tr><td align="center">Cliente</td><td align="center">Titular o Jefe Inmediato</td></tr>
<tr><td align="center"><br>
<br>
<br>
<br>
<br>
<br> 
<br>'.$credito['Cliente']['nombre'].' '.$credito['Cliente']['apellido_paterno'].' '.$credito['Cliente']['apellido_materno'].'</td><td align="center"><br>
<br>
<br>
<br>
<br>
<br> 
<br>'.$credito['Cliente']['Empresa']['representante'].'</td></tr></table>';

$texto7='
<br>
<br>GRUPO KELQ S.AP.I. DE C.V. SOFOM E.N.R, con domicilio en calle 73 No. 225 por 48 y 50 colonia Montes de Amé con código postal 97115 
en la ciudad de Mérida, Yucatán, es responsable de recabar sus datos personales, del uso que se le dé a los mismos y de su protección. 
<br>
<br>
Su información personal será utilizada para proveer los servicios y productos que ha solicitado, informarle sobre cambios en los mismos y 
evaluar la calidad del servicio que le brindamos. Para las finalidades antes mencionadas, requerimos obtener los siguientes datos personales: 
Nombre completo, dirección y teléfono; nombre completo del cónyuge o pareja, en caso de estar casado o vivir en unión libre; datos del 
domicilio particular y laboral; puesto y cargo desempeñado; antigüedad laboral, ingresos y cualquier otro que resulte de importancia para la 
realización de los trámites respectivos con nuestra entidad financiera. 
<br>
<br>
Usted tiene derecho de acceder, rectificar y cancelar sus datos personales, así como de oponerse al tratamiento de los mismos o revocar el 
consentimiento que para tal fin nos haya otorgado, a través de los procedimientos que hemos implementado. Para conocer dichos procedimientos, 
los requisitos y plazos, se puede poner en contacto con nuestros asesores financieros en nuestras oficinas ubicadas en la dirección antes 
mencionada o a los teléfonos: (999) 9300000 ext. 203.
<br>
<br>
<br>
<br>
<br>';
$texto8='
<br><table><tr><td aling= "center"> '.$credito['Cliente']['nombre'].' '.$credito['Cliente']['apellido_paterno'].'</td></tr>
<br>
<br><tr><td>Consiento que mis datos personales sean utilizados en los términos que señala el presente aviso de privacidad.</td></tr></table>';

$tcpdf->AddPage();
$tcpdf->writeHtml($format->fecha(date('Y-m-d')), true, false, false, false,'R');
$tcpdf->writeHtml($texto, true, false, false, false,'L');
$tcpdf->writeHtml('<b>DECLARACIONES</b>', true, false, false, false,'C');
$tcpdf->writeHtml($texto2, true, false, false, false,'L');
$tcpdf->writeHtml('<b>CLÁUSULAS</b>', true, false, false, false,'C');
$tcpdf->writeHtml($texto3, true, false, false, false,'L');

$tcpdf->AddPage();
$tcpdf->writeHtml('<b>PAGARÉ</b>', true, false, false, false,'C');
$tcpdf->writeHtml($texto4, true, false, false, false,'L');

$tcpdf->AddPage();
$tcpdf->writeHtml('<b>CARTA DE AUTORIZACIÓN</b>', true, false, false, false,'C');
$tcpdf->writeHtml($format->fecha(date('Y-m-d')), true, false, false, false,'R');
$tcpdf->writeHtml($texto5, true, false, false, false,'L');
$tcpdf->writeHtml($texto6, true, false, false, false,'C');

$tcpdf->AddPage();
$tcpdf->writeHTML('<b>AVISO DE PRIVACIDAD</b>', true, false, false, false,'C');
$tcpdf->writeHtml($texto7, true, false, false, false,'L');
$tcpdf->writeHtml($texto8, true, false, false, false,'C');
echo $tcpdf->Output('Contrato.pdf', 'I');

?>