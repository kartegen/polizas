<?php
ini_set('display_errors', 'on');
ini_set('log_errors',1);
error_reporting(E_ALL | E_STRICT);

//ob_end_clean();
//PHP
//request id
$id=$_REQUEST['id'];
require("conexion.php"); //el error que arrojaba era por el include y se cambiÃ³ por require
// $query="SELECT * FROM polizas WHERE idPoliza= '$id' ";
$query="SELECT polizas.*,agencias.*,users.* FROM polizas INNER JOIN agencias ON polizas.idAgencia = agencias.idAgencia INNER JOIN users ON polizas.idUser = users.id WHERE polizas.idPoliza = '$id' ";
$resultado = $conn->query($query);
$row=$resultado->fetch_assoc();

//require 'lib/fpdf/fpdf.php';
require('fpdf/fpdf.php');

class PDF extends FPDF
{
    // Cabecera de página
    function Header()
    {
        // Logo
        $this->Image('dist/img/logo.png',14,12,33);
        $this->Image('dist/img/logo2.png',170,12,33);
        $this->Ln(2);
        // Arial bold 15
        $this->SetFont('Arial','I',8);
        // Movernos a la derecha
        $this->Cell(190);
        // TEXTO A MOSTRAR
        $this->Cell(1,30,utf8_decode('GRUPO WARRANTY S.A. DE C.V.'),0, 0, 'R');
        // Salto de línea
        $this->Ln(3);
        $this->Cell(190);
        $this->Cell(1,30,utf8_decode('R.F.C. GAW2108133K1'),0, 0, 'R');
        $this->Ln(3);
        $this->Cell(190);
        $this->Cell(1,30,utf8_decode('Manuel j Cloutier 304 Piso 4 suite 400'),0, 0, 'R');
        $this->Ln(3);
        $this->Cell(190);
        $this->Cell(1,30,utf8_decode('Jardines del campestre León, Guanajuato'),0, 0, 'R');
        $this->Ln(3);
        $this->Cell(190);
        $this->Cell(1,30,utf8_decode('CP 371218'),0, 0, 'R');
        $this->Ln(3);
        $this->Cell(190);
        $this->Cell(1,30,utf8_decode('Email: atencion@autowarranty.com'),0, 0, 'R');
    }
    
    // Pie de página
    function Footer()
    {
        // Posición: a 1,5 cm del final
        $this->SetY(-15);
        // Arial italic 8
        $this->SetFont('Arial','I',8);
        // Número de página
        $this->Cell(0,10,'Pagina '.$this->PageNo().'',0,0,'C');
    }
}


$pdf = new PDF();
//$pdf->AddPage();
date_default_timezone_set('America/Mexico_City');
$fechaa= date("d/m/Y");
$pdf->AddPage('P','letter');
$pdf->Cell(70,20,utf8_decode(' '),0,1,'R');
$pdf->SetFont('Arial','B',10);
$pdf->Multicell(190,12,utf8_decode('CONTRATO DE GARANTÍA MECÁNICA CELEBRADO CON AUTO WARRANTY'),0,'C',0);
$pdf->SetFont('Arial','B',9);
$pdf->Multicell(190,5,utf8_decode('______________________________________________________________________________________________________'),0,'C',0);
$pdf->Multicell(190,5,utf8_decode('             DATOS GENERALES NO. DE CONTRATO'),0,'L',0);
$pdf->SetFont('Arial','B',8);
$pdf->multicell(110,4,utf8_decode('                       No. de contrato            '.$row['prefijoAgencia'].''.$row['idPoliza'].''),0,'L',0);

$pdf->Cell(110,4,utf8_decode('Fecha de Contrato          '.$row['fechaInicio'].''),0,0,'L');
$pdf->Multicell(95,4,utf8_decode('Producto Contratado       '.$row['folioContrato'].' '),0,'L');


$pdf->Cell(110,4,utf8_decode('Limite por Avería'.$row['valorVenta'].''),0,0,'L');
$pdf->Multicell(80,4,utf8_decode('Límite de Contrato'.$row['valorVenta'].' '),0,'L');

$pdf->SetFont('Arial','B',9);
$pdf->Multicell(190,5,utf8_decode('______________________________________________________________________________________________________'),0,'C',0);
$pdf->Multicell(190,5,utf8_decode('             VEHÍCULO OBJETO DE CONTRATO:'),0,'L',0);
$pdf->SetFont('Arial','B',8);
$pdf->Cell(80,4,utf8_decode(''),0,0,'L');
$pdf->Multicell(80,4,utf8_decode(' '),0,'L');




$pdf->Cell(80,4,utf8_decode(''),0,0,'C');
$pdf->Multicell(80,4,utf8_decode(' '),0,'L');

//aqui termina la pagina principal
$pdf->SetFont('Arial','B',8);
$pdf->Multicell(190,3,utf8_decode('_____________________________________________________________________________________________________________________
    
                     DATOS GENERALES NO. DE CONTRATO
    
                     No. de contrato               '.$row['prefijoAgencia'].''.$row['idPoliza'].'
                     Fecha de Contrato	        '.$row['fechaInicio'].'	                                                           Producto Contratado       '.$row['vin'].'
                     Limite por Avería           '.$row['vin'].'		                                                              Límite de Contrato	           '.$row['valorVenta'].'
                     _____________________________________________________________________________________________________________________
    
                                                                  HOJA RESUMEN DEL CONTRATO DE GARANTÍA MECÁNICA
    
                     VEHÍCULO OBJETO DE CONTRATO:
    
                     MARCA		           '.$row['marca'].'                                                    NUMERO DE SERIE (VIN)		             '.$row['vin'].'
                     HP                     '.$row['hp'].'                                                    CC                                                     '.$row['cc'].'
                     MODELO             '.$row['subMarca'].'                                                  FECHA FACTURA PRIMORDIAL      '.$row['fechaFacturaPrimordial'].'
                     PLACAS              '.$row['placa'].'                                                 Nº MOTOR	                                    '.$row['marca'].'
                     Kilómetros            '.$row['kms'].''),0,'J',0);

$pdf->SetFont('Arial','B',6);
$pdf->Multicell(190,4,utf8_decode('
*Los datos introducidos tendrán que coincidir fehacientemente con los del vehículo objeto de garantía. En caso de error será motivo de rescisión del contrato.'),0,'C',0);

$pdf->SetFont('Arial','B',8);
$pdf->Multicell(190,3,utf8_decode('_____________________________________________________________________________________________________________________
    
                                                            CONTRATANTE DEL CONTRATO / DISTRIBUIDOR:
    
    
                    PUNTO DE VENTA '.$row['placa'].'	                                                    PERSONA DE CONTACTO    '.$row['nombreCliente'].'
                    RFC                       '.$row['rfc'].'                                               DIRECCIÓN:	'.$row['calle'].', '.$row['numExt'].'
                    POBLACIÓN      '.$row['localidad'].'                                                    ESTADO	'.$row['estado'].'
                    TELEFONO       '.$row['telefono'].'		                                                EMAIL   '.$row['email'].'
            		   C.P	           '.$row['codigoPostal'].'
    
    
                                    _____________________________________________________________________________________________________________________
    
                                                            BENEFICIARIO DEL CONTRATO / COMPRADOR:
    
                   NOMBRE		'.$row['nombreCliente'].'
                   R.F.C.       '.$row['rfc'].'		CURP'.$row['rfc'].'
                    DIRECCIÓN:	'.$row['calle'].', '.$row['numExt'].'
                    POBLACIÓN      '.$row['localidad'].'                                                    ESTADO	'.$row['estado'].'
                    TELEFONO       '.$row['telefono'].'		                                                EMAIL'.$row['email'].'
            		   C.P	           '.$row['codigoPostal'].'
    
'),0,'L',0);

$pdf->Multicell(190,3,utf8_decode('_____________________________________________________________________________________________________________________
    
                                                                     PERIODO DE VIGENCIA DEL CONTRATO:
    
    
    
    
                    FECHA INICIO GARANTIA   '.$row['fechaInicio'].'		                           	FECHA FIN GARANTIA   '.$row['fechaFin'].''),0,'L',0);

$pdf->SetFont('Arial','B',6);
$pdf->Multicell(190,4,utf8_decode('
*Siempre que se hayan realizado en el VEHÍCULO en tiempo y forma los servicios y mantenimientos señalados en la cláusula 7 del presente Contrato; el PERIODO DE VIGENCIA DEL CONTRATO podrá comenzar a computarse hasta el momento en que expire la garantía del fabricante o alguna otra garantía de similar naturaleza, ya sea por sobrepasar el kilometraje o cumplirse el tiempo establecido en la misma. En cualquier caso, la Garantía Mecánica de Grupo Auto Warranty, S.A. de C.V. será válida conforme a los términos y condiciones del presente Contrato
    
    
    
    
    
    
    
    
'),0,'L',0);



date_default_timezone_set('America/Mexico_City');
$fechaHoy= date("d/m/Y");
$pdf->SetFont('Arial','b',7);
$pdf->Multicell(190,4,utf8_decode("
1.- DEFINICIONES:
    
CONTRATANTE: Tendrá la consideración de CONTRATANTE del contrato, el vendedor del VEHÍCULO, que será el obligado al pago del precio del pre- sente contrato de garantía mecánica.
    
BENEFICIARIO: Tendrá la consideración de BENEFICIARIO el comprador del VEHÍCULO, quien será el destinatario de la garantía mecánica objeto del presente contrato.
    
VEHÍCULO: A los efectos del presente contrato, tendrá la consideración de VEHÍCULO únicamente el descrito en la HOJA RESUMEN DEL CONTRATO DE GARANTÍA MECÁNICA que, en todo caso, no podrá tener más de 400 C.V. de potencia o tener denominación industrial ya sea ligera o pesada.
    
AVERÍA/AS: Se entiende por avería mecánica, eléctrica, o electrónica, la inutilidad operativa (conforme a las especificaciones del fabricante) de la pieza garantizada, debido a una rotura imprevista / fortuita. No se incluye en esta definición la reducción gradual en el rendimiento operativo de la pieza ga- rantizada que sea proporcional y equivalente a su antigüedad y kilometraje (se entiende a partir de la primera matriculación del vehículo, y no a partir del inicio del contrato de garantía), ni las averías derivadas de accidentes o cualesquiera influencias externas. A los efectos del presente contrato sólo se consideran AVERÍA/AS, las piezas que se describen a continuación y de manera literal.
    
TALLER REPARADOR: A los efectos del presente contrato, tendrá la consideración de TALLER REPARADOR el taller autorizado por la Marca del VEHIC- ULO que realiza la reparación de la AVERÍA. Dicho TALLER REPARADOR será elegido por el BENEFICIARIO dentro de la Red autorizada por la Marca de su VEHICULO. EL TALLER REPARADOR es responsable de realizar la reparación de la AVERÍA y otorgar posteriormente sobre la calidad y garantía de la misma de acuerdo a lo estipulado por la Marca de VEHÍCULO.
    
Mediante este contrato de Garantía Grupo Auto Warranty, S.A de C.V. se compromete a pagar los costos razonables de reparación de una avería cubierta relativa al vehículo garantizado, dentro de los límites de pago por avería y condiciones del mismo. Quedan cubiertas por el presente contrato la repa- ración o sustitución de todas las piezas o componentes que presenten defectos como consecuencia de una avería fortuita en los elementos mecánicos, eléctricos o electrónicos.
    
Se excluyen de manera expresa los siguientes elementos:
    
        1.	Asientos completos y mecanismos (mecánicos)
        2.	Elementos internos del habitáculo y/o maletero (tapizados, guarnecidos, reposabrazos, salpicadero, consolas, soportes, tapas, aireadores, ceniceros, encendedor, lámparas)
        3.	Neumáticos, válvula de rueda (con o sin sensor)
        4.	Totalidad de los elementos de carrocería.
        5.	Totalidad de cristales y lunas, incluida térmica
        6.	Faros, intermitentes, calaveras, lámparas
        7.	Molduras, embellecedores, espejos retrovisores completos, paragolpes
        8.	Consumibles (filtros, cartuchos, aceite, juntas), amortiguadores, escapes, discos de freno, pastillas, correas, servicio periódico, servicios intermedios, lubricantes, combustibles, aditivos, carga de circuito de a/a (salvo que sea necesario por avería cubierta), bujías, calentadores, batería, escobillas, plumas limpiaparabrisas
        9.	Elementos que hayan perdido su morfología inicial (bujes, gomas, soportes, juntas).
    
2.- OBJETO DEL CONTRATO:
    
En virtud del presente contrato de garantía mecánica, GRUPO AUTO WARRANTY, S.A DE C.V.. garantiza, dentro de los límites fijados en el presente documento, el pago de la reparación de las AVERÍA/AS descritas en el apartado anterior.
    
3.- DURACIÓN DEL CONTRATO:
    
El periodo de garantía cubierto por el presente contrato será el indicado en la HOJA RESUMEN DE CONTRATO DE GARANTÍA MECÁNICA, en su apartado PERIODO DE VIGENCIA DEL CONTRATO. Por tanto, sólo estarán cubiertas las AVERÍA/AS que tenga el VEHÍCULO durante la vigencia del contrato.
    
No cabe la prórroga tácita del contrato.
    
    
    
    
    
    
4.- PERFECCIÓN Y EFECTOS DEL CONTRATO:
    
El contrato se perfecciona por el consentimiento manifestado con la firma del presente documento. No obstante, lo anterior, las garantías contratadas no tendrán efectos, y por tanto no generarán obligaciones para GRUPO AUTO WARRANTY, S.A DE C.V., hasta que el CONTRATANTE no haya satisfecho la totalidad del precio del contrato de garantía mecánica.
    
En caso de demora en el pago del precio, las obligaciones de GRUPO AUTO WARRANTY, S.A DE C.V.. comenzarán a las 24 horas del pago del precio, y siempre con efectos para AVERÍA/AS surgidas con posterioridad al pago del mismo.
    
Si transcurridas 48 horas desde la firma del presente documento, el CONTRATANTE no hubiera pagado el precio, GRUPO AUTO WARRANTY, S.A DE C.V.. se reserva el derecho a dejar sin efecto el presente contrato, o a exigir el pago del mismo.
    
5.- DELIMITACIÓN GEOGRÁFICA:
    
La garantía objeto del presente contrato se extiende y limita a las AVERÍA/AS que tengan lugar dentro de la República Mexicana.
    
6.- OBLIGACIONES DEL CONTRATANTE:
    
El CONTRATANTE, en relación con el presente contrato, tiene las siguientes obligaciones:
    
        1.	Pagar a GRUPO AUTO WARRANTY, S.A DE C.V.. el precio del contrato de garantía, y el I.V.A. correspondiente a dicho precio.
        2.	Con anterioridad a la venta del VEHÍCULO al BENEFICIARIO, deberá revisar el VEHÍCULO, y en caso de que el mismo tenga cualquier tipo de avería, tendrá la obligación de repararla antes de la venta.
        3.	Deberá poner en conocimiento del BENEFICIARIO y de GRUPO AUTO WARRANTY, S.A DE C.V.. todas las reparaciones realizadas en el VEHÍCULO, así como si el mismo ha tenido algún accidente o siniestro.
                4.	Deberá entregar el VEHÍCULO al BENEFICIARIO en perfectas condiciones de uso y mantenimientos, acordes con el kilometraje y antigüedad del mismo, haciéndose responsable de aplicar la garantía en los primeros 90 días de vigencia del presente contrato.
7.- OBLIGACIONES DEL BENEFICIARIO:
    
El BENEFICIARIO, en relación con el presente contrato, tiene las siguientes obligaciones:
    
        1.	Comunicar a GRUPO AUTO WARRANTY, S.A DE C.V.. todas las AVERÍA/AS que tenga el VEHÍCULO durante el periodo de vigencia del contrato.
        2.	En caso de AVERÍA/AS, seguir estrictamente el PROCEDIMIENTO EN CASO DE AVERÍA/AS descrito en el presente contrato,.
        3.	Realizar en el VEHÍCULO los mantenimientos periódicos exigidos tanto por el fabricante del VEHÍCULO como por GRUPO AUTO WARRANTY,
        S.A DE C.V..
        4.	Conservar las facturas correspondientes a los trabajos o reparaciones de mantenimiento descritos en el apartado anterior.
        5.	Hacer un uso del VEHÍCULO razonable a las características del mismo.
        6.	En caso de AVERÍA/AS, no agravar la misma por un uso inadecuado o negligente del VEHÍCULO.
    
8.- OBLIGACIONES DE GRUPO AUTO WARRANTY, S.A. DE C.V.:
    
GRUPO AUTO WARRANTY, S.A DE C.V.., en relación con el presente contrato, tiene la obligación de, en los términos y con los límites fijados en el mis- mo, hacerse cargo de la reparación de las AVERÍA/AS cubiertas, que dentro del periodo de vigencia del contrato pueda tener el VEHÍCULO, siempre y cuando dichas AVERÍAS no traigan causa en un uso inadecuado del VEHÍCULO, o en el deterioro y/o desgaste normal del mismo.
    
Se hace especial mención, que Grupo Auto Warranty, S.A. de C.V., procederá a evaluar, canalizar al taller correspondiente para su diagnóstico y en su caso y de proceder, aprobar la reparación del vehículo, a partir del cuarto mes de vigencia del presente contrato o después de 90 días naturales, ya que antes de este periodo, es decir antes de los primeros 90 días, corresponderá a EL CONTRATANTE, el proceso de aplicación de la garantía.
    
    
    
    
    
    
    
    
    
9.- MANTENIMIENTOS PERIÓDICOS:
    
Para que el presente contrato sea efectivo, el BENEFICIARIO se obliga a efectuar en el VEHÍCULO los trabajos o tareas de mantenimiento exigidas por GRUPO AUTO WARRANTY, S.A DE C.V.. que a continuación se detallan, TANTO PARA NUEVOS COMO PARA SEMINUEVOS:
    
        •	NUEVOS: Para que el contrato sea efectivo, el propietario del vehículo y titular del contrato, se compromete a efectuar las inspecciones requeridas POR EL FABRICANTE SIGUIENDO SU PLAN DE MANTENIMIENTO PROGRAMADO, tanto en periodos de tiempo como en kilometraje.
        •	SEMINUEVOS O AUTOS CUYO PERIODO DE GARANTÍA DE FÁBRICA HAYA TERMINADO: Para que el contrato sea efectivo, el propietario del ve- hículo y titular del contrato, se compromete a efectuar las revisiones requeridas por Grupo Auto Warranty, S.A de C.V.. Estas revisiones se tendrán que hacer en periodos de 6 meses o 10,000 kilómetros, lo que antes ocurra. Incluso si este periodo resultara ser inferior a lo indicado por el fabri- cante del auto. Las revisiones mínimas consistirán en cambio de Aceite Motor, Filtro de Aceite y Verificación de Fugas, Ruidos y Holguras. Todos estos mantenimientos y revisiones deberán realizarse en Distribuidores Autorizados por el FABRICANTE DEL AUTO. El contrato quedará invali- dado por cualquier mantenimiento, intervención o reparación no realizada dentro de un distribuidor Autorizado por el FABRICANTE DEL AUTO.
        •	El Beneficiario deberá conservar su carnet de mantenimiento debidamente sellado por el Distribuidor, indicando cada mantenimiento, reparación o revisión con el kilometraje correspondiente, así mismo deberá conservar las facturas que lo amparen. Para comprobar que el Beneficiario hizo sus mantenimientos serán igualmente válidos el carnet de mantenimiento sellado por el Distribuidor o la factura de su último mantenimiento en tiempo y forma.
    
El incumplimiento de cualquiera de los requisitos anteriores invalidará este contrato.
    
10.- PROCEDIMIENTO EN CASO DE AVERÍA/AS:
En caso de AVERÍA/AS del VEHÍCULO, y para que la misma quede cubierta por el presente contrato de garantía, se deberá seguir, obligatoriamente, el siguiente procedimiento:
    
1.	En cuanto tenga conocimiento de la AVERÍA/AS, el BENEFICIARIO comunicará la misma a GRUPO AUTO WARRANTY, S.A DE C.V.., por cualqui- era de los siguientes medios: i) Por correo electrónico, a la dirección atencion@autowarranty.mx.
    
2.	En dicha comunicación el BENEFICIARIO deberá facilitar a GRUPO AUTO WARRANTY, S.A DE C.V.., al menos, la siguiente información: i) Nº de Garantía Mecánica, ii) Placas del VEHÍCULO, iii) Declaración de la AVERÍA/AS, iv) Lugar en el que se ha producido la AVERÍA/AS y v) Taller en el que está el VEHÍCULO. En caso de que el VEHÍCULO no esté todavía en ningún taller, podrá solicitar a GRUPO AUTO WARRANTY, S.A DE C.V.,que le indique un taller en el que dejar el VEHÍCULO.
    
3.	Una vez el VEHÍCULO esté en un taller, el responsable del mismo volverá a contactar con GRUPO AUTO WARRANTY, S.A DE C.V.., para describir la AVERÍA/AS, por los mismos medios descritos en la letra anterior, debiendo aportar igualmente la siguiente documentación:
    
        a.	Orden de entrada del VEHÍCULO, que contenga, al menos, la fecha de entrada del mismo, los kilómetros del VEHÍCULO y descripción de la avería.
        b.	Presupuesto aproximado de la reparación, QUE DEBERÁ REALIZARSE SIN INTERVENIR NI DESMONTAR EL VEHÍCULO.
        c.	Copia del Libro de Mantenimiento del VEHÍCULO (Si dispone del mismo).
        d.	Copia de las facturas de las inspecciones que indica Grupo Auto Warranty, S.A de C.V., S.A.P.I DE C.V., en el VEHÍCULO. Dichas facturas, de conformidad con la normativa vigente, deberán tener el siguiente detalle:
                i.	Número de taller, según registro especial.
                ii.	Identificación del mismo: Denominación Social, R.F.C., domicilio fiscal, domicilio a efectos de notificaciones, etc.
                iii.	Identificación del VEHÍCULO con expresión de la marca, modelo, PLACA y número de kilómetros.
                iv.	Reparaciones incluidas en la factura, desglosando las piezas sustituidas y la mano de obra empleada.
                v.	Fecha y firma o sello del taller.
                vi.	Fecha de entrega del VEHÍCULO.
    
4.	Hasta que la reparación de la AVERÍA/AS no esté autorizada por GRUPO AUTO WARRANTY, S.A DE C.V.., no se podrá realizar en el mismo ningún tipo de desmontaje, montaje, reparación y/o intervención; a no ser que GRUPO AUTO WARRANTY, S.A DE C.V.. lo requiera para poder determi- nar el origen de la avería. Cualquier autorización a trabajar sobre el vehículo para efectuar (pruebas, desmontajes, diagnosis, etc.) anterior a la aceptación de la avería parte de GRUPO AUTO WARRANTY, S.A DE C.V.., siempre tendrá que ser dada por el propietario del vehículo. El VEHÍCU- LO tendrá que permanecer inmovilizado hasta que GRUPO AUTO WARRANTY, S.A DE C.V.., resuelva el expediente.
    
    
    
    
    
    
5.	Una vez GRUPO AUTO WARRANTY, S.A DE C.V.., haya recibido la documentación indicada en los apartados anteriores, GRUPO AUTO WARRAN- TY, S.A DE C.V.., estudiará el asunto y decidirá sobre la necesidad de realizar un desmontaje para determinar la causa de la AVERÍA/AS. GRUPO AUTO WARRANTY, S.A DE C.V.,se compromete a resolver por escrito y motivadamente el expediente , autorizando o rechazando la reparación de la avería en el plazo máximo de 48 horas (que no incluirán domingos ni festivos) a contar desde la recepción de la documentación o posterior al desmontaje en caso de existir. La resolución escrita del expediente a la que se hace referencia en este párrafo será remitida por GRUPO AUTO
    
WARRANTY, S.A DE C.V.. al taller desde el que se remitió la documentación sobre la AVERÍA/AS. En caso de que no se siga el procedimiento señalado o la reparación de la Avería no se encuentre cubierta por el presente Contrato el costo del desmontaje, montaje y/o intervención serán cubiertos por el Cliente, el propietario del Vehículo o el Beneficiario.
6.	En caso de que la reparación de la AVERÍA/AS sea aceptada por GRUPO AUTO WARRANTY, S.A DE C.V.., en la resolución por escrito del expedi- ente se detallarán las reparaciones o trabajos que habrá que efectuar sobre el VEHÍCULO para la reparación de la AVERÍA/AS, así como la valo- ración de dichas actuaciones. En ningún caso GRUPO AUTO WARRANTY, S.A DE C.V.. se hará cargo de trabajos o reparaciones no autorizadas en la resolución escrita del expediente.
7.	Una vez autorizada la reparación del VEHÍCULO por GRUPO AUTO WARRANTY, S.A DE C.V.., el taller realizará las reparaciones autorizadas por GRUPO AUTO WARRANTY, S.A DE C.V..
8.	Una vez reparado el VEHÍCULO por el taller, éste enviará a GRUPO AUTO WARRANTY, S.A DE C.V.. el original de la factura de reparación debid- amente firmada por el BENEFICIARIO, que incluirá únicamente las reparaciones autorizadas por GRUPO AUTO WARRANTY, S.A DE C.V.., y que nunca podrá ser de un importe superior a la valoración de la reparación realizada por GRUPO AUTO WARRANTY, S.A DE C.V.., en su informe de resolución del expediente. Junto con la factura, el taller deberá remitir a GRUPO AUTO WARRANTY, S.A DE C.V.., una copia firmada por el BENE- FICIARIO del informe de resolución del expediente.
9.	La factura de reparación emitida por el taller deberá estar a nombre de GRUPO AUTO WARRANTY, S.A DE C.V.. como destinatario de la misma.
10.	Una vez GRUPO AUTO WARRANTY, S.A DE C.V.., haya recibida toda la documentación a la que se hace referencia en las letras anteriores, proced- erá al pago de la factura de reparación, en el plazo de 15 días recepción factura.
11.	En el caso de que el presupuesto de reparación de la AVERÍA/AS realizado por el taller sea superior al valor de la reparación autorizada por GRUPO AUTO WARRANTY, S.A DE C.V.., el BENEFICIARIO podrá optar por: i) Llevar el VEHÍCULO al taller que le indique GRUPO AUTO WARRANTY, S.A DE C.V.. para realizar la reparación tal como la misma haya sido autorizada en el informe de resolución del expediente, corriendo a costa del BEN- EFICIARIO todos los gastos de desplazamiento del VEHÍCULO, o ii)Reparar el VEHÍCULO según el presupuesto del taller. En este caso, el BENEFI- CIARIO deberá aceptar expresamente y por escrito que la diferencia entre el presupuesto dado por el taller y la valoración de la reparación de la AVERÍA/AS autorizada por GRUPO AUTO WARRANTY, S.A DE C.V.., correrá íntegramente a su cargo. En este caso, el taller deberá confeccionar dos facturas, una por un importe igual a la valoración de la reparación de la AVERÍA/AS autorizada por GRUPO AUTO WARRANTY, S.A DE C.V.., que deberá entregar a GRUPO AUTO WARRANTY, S.A DE C.V..; y otra, que deberá entregar al BENEFICIARIO, por la diferencia asumida por éste.
12.	GRUPO AUTO WARRANTY, S.A DE C.V.., se reserva el derecho a utilizar los medios de reparación que considere oportunos, así como el derecho a proporcionar las piezas que deban sustituirse o repararse en la reparación autorizada.
    
11.- LÍMITES DEL CONTRATO:
    
Además de los límites del contrato señalados en la HOJA RESUMEN DE CONTRATO DE GARANTÍA MECÁNICA, en su apartado DATOS GENERALES, la valoración de la reparación de la AVERÍA/AS del VEHÍCULO nunca podrá superar el valor de venta del VEHÍCULO que marque el libro azul que es la guía que indica los precios del VEHÍCULO correspondiente al año de la venta. En caso de que la valoración de la reparación de la AVERÍA/AS supere el valor de venta del VEHÍCULO, GRUPO AUTO WARRANTY, S.A DE C.V.. pagará al BENEFICIARIO con una cuantía igual a la menor de las cantidades siguientes: i) el Límite por AVERÍA/AS del presente contrato, ii) el Límite del contrato o iii) el valor de venta del VEHÍCULO.
    
En caso de que el VEHÍCULO no esté en los boletines identificados en el párrafo anterior, el valor de venta del VEHÍCULO se calculará sobre la base del valor medio de mercado excluyendo del muestreo tanto el valor más bajo como el valor más elevado. Este cálculo será realizado por un evaluador libremente elegido por GRUPO AUTO WARRANTY, S.A DE C.V.., asumiendo ésta los costos de dicha valoración.
    
12.- EXCLUSIONES GENERALES DEL CONTRATO:
    
GRUPO AUTO WARRANTY, S.A DE C.V.. podrá rechazar la reparación, y/o en su caso el pago de la AVERÍA/AS en los siguientes supuestos:
    
        1.	Cuando se haya realizado cualquier tipo de trabajo sobre el VEHÍCULO antes de la resolución del expediente por GRUPO AUTO WARRANTY,
        S.A DE C.V..
    
    
    
    
    
    
    
        2.	Cuando el VEHÍCULO no haya permanecido inmovilizado en el taller desde la comunicación de la AVERÍA/AS hasta la resolución del expediente por GRUPO AUTO WARRANTY, S.A DE C.V..
        3.	Cuando el BENEFICIARIO no haya cumplido sus obligaciones en relación con los mantenimientos e inspecciones exigidas en el presente contrato.
        4.	Cuando el carnet de mantenimientos debidamente sellado o las facturas correspondientes a los mantenimientos periódicos o cualquier docu- mentación exigida dentro del Articulo 10.-PROCEDIMIENTO EN CASO DE AVERÍAS/AS del presente contrato, no estén debidamente cumplimen- tadas, o directamente no se aporten a GRUPO AUTO WARRANTY, S.A DE C.V.., en un plazo de 48 horas tras ser requeridas.
        5.	Cuando se detecte que los kilómetros de inicio del contrato no guardan relación con los kilómetros de la avería o mantenimiento del vehículo. Esta exclusión será motivo de recesión del contrato.
        6.	Cuando la AVERÍA/AS haya sido comunicada a GRUPO AUTO WARRANTY, S.A DE C.V.., transcurrido el plazo de duración del contrato, aun cuan- do la AVERÍA/AS haya acontecido con anterioridad a su expiración
        7.	Cuando haya habido cualquier tipo de incumplimiento por parte del CONTRATANTE o del BENEFICIARIO.
    
13.- OPERACIONES NO INCLUÍDAS EN LA GARANTÍA OBJETO DEL PRESENTE CONTRATO:
    
No estarán cubiertas por la garantía objeto del presente contrato, y por tanto GRUPO AUTO WARRANTY, S.A DE C.V.., no estará obligada a reparar ni a realizar el pago de las siguientes:
    
        1.	AVERÍA/AS y/o defectos previsibles y/o preexistentes a la contratación de la garantía.
        2.	AVERÍA/AS cuya causa era evidente en el momento en que estaba en vigor la garantía del fabricante, independientemente del momento en que ésta se hubiere ocasionado.
        3.	AVERÍA/AS que sean consecuencia de una mala reparación anterior.
        4.	La sustitución, reparación, ajustes o reglajes sobre piezas que hayan llegado al final de su vida útil como consecuencia de su función y usabilidad natural.
        5.	Los daños ocasionados por erosión, corrosión, deformación, oxidación, descomposición, herrumbre e incrustaciones, así como elementos que hayan perdido su morfología inicial (bujes, gomas, soportes, juntas, mangueras, retenes)
        6.	La sustitución de lubricantes y otros aditivos, bujías, bujías de encendido, filtros, cartuchos, aceites, juntas, carburantes, cargas de a/a, fugas de aceite, fugas de refrigerante o fugas de combustible, neumáticos, amortiguadores, discos de freno, pastillas de freno, correas de distribución, escapes, catalizadores, batería, plumas limpiaparabrisas, en definitiva, cualquier elemento consumible.
        7.	Las actualizaciones, programaciones o cargas de software de cualquier módulo electrónico del vehículo.
        8.	Los costos de diagnóstico cuando las averías no queden cubiertas por Grupo Auto Warranty, S.A. de  C.V.
        9.	AVERÍA/AS causadas por elementos no garantizados.
        10.	Las operaciones de mantenimiento periódicas, de carácter preventivo.
        11.	Los controles y/o reglajes, con o sin cambio de piezas.
        12.	Averías motivadas por defectos de serie, diseño defectuoso, vicios ocultos, fallo epidémico, campañas del fabricante.
        13.	Cualquier daño sobre piezas garantizadas que se haya producido por la alteración o modificación de la especificación del fabricante.
        14.	Las AVERÍA/AS ocasionadas por seguir circulando cuando con los indicadores de avería, incidencia o alarma indiquen un mal funcionamiento. 15.Las AVERÍA/AS ocasionadas por mal uso o negligencia de utilización del vehículo por parte del propietario del titular del contrato.
        16.	Las AVERÍA/AS ocasionadas por el uso del vehículo en competiciones.
        17.	Las AVERÍA/AS ocasionadas por sobrecarga.
        18.	Las AVERÍA/AS ocasionadas por el uso de agentes abrasivos.
        19.	Las AVERÍA/AS ocasionadas por un accidente, robo, tentativa de robo, incendio, explosión, vandalismo o catástrofes naturales.
        20.	Las piezas que sean cambiadas en el momento de la reparación sin que hayan fallado. 21.Cualquier intervención efectuada “in situ” por cualquier servicio de asistencia en carretera.
        22.	Los servicios de grúa, remolque y gastos de transporte sobre el VEHÍCULO y ocupantes.
        23.	Averías producidas por combustibles o lubricantes no conformes con las indicaciones del fabricante o con alto grado de agua o contami- nación de otros elementos químicos.
        24.	Sustitución, mantenimiento o reparación de accesorios o piezas no montados de origen, aun siendo elementos garantizados.
        25.	Ningún servicio de grúa.
        26.	Gastos de estacionamiento y/o almacenamiento del VEHÍCULO hasta su reparación.
        27.	Daños o pérdidas ocasionadas como consecuencia de la AVERÍA/AS o el retraso en su reparación.
        28.	Lucro cesante por no poder utilizar el VEHÍCULO.
        29.	Los daños a terceros que traigan causa en la AVERÍA/AS.
    
    
    
    
    
    
    
14.-DEVOLUCIONES:
    
En caso de rescisión anticipada del contrato por causas ajenas a GRUPO AUTO WARRANTY, S.A DE C.V.., ésta no estará obligada a la devolución del precio.
    
    
15.- HOJA RESUMEN DEL CONTRATO DE GARANTÍA MECÁNICA:
    
La HOJA RESUMEN DEL CONTRATO DE GARANTÍAS MECÁNICAS forma parte integrante del presente contrato, y tiene fuerza vinculante para los firmantes.
    
    
16.- AVISOS
    
Las partes acuerdan que en caso de que llegasen, por cualquier motivo, a mudarse del domicilio que indicaron en este contrato, deberán hacérselo saber a la otra parte con 30 días naturales de anticipación a que efectuaren el cambio respectivo.
    
    
17.- RESCISIÓN:
    
Serán causa de rescisión automática del presente contrato el incumplimiento a cualquiera de las obligaciones establecidas en el presente contrato.
    
    
18.- SUMISIÓN EXPRESA:
    
LA LEGISLACION APLICABLE, DE LA JURISDICCION Y DE LOS TRIBUNALES COMPETENTES: Siendo el presente
contrato de naturaleza mercantil, las partes convienen que para todo lo no previsto en él, se sujetarán a lo dispuesto en el Código de Comercio, así mismo para el conocimiento de cualquier controversia que llegare a suscitarse con motivo de la interpretación del presente contrato, las partes se som- eten a la jurisdicción de los Tribunales de la Ciudad de Aguascalientes, Ags. renunciando expresamente al fuero que pudiera corresponderles, en razón de sus domicilios presentes o futuros o bien, por cualquier otra causa. Manifestando el proveedor que en el presente contrato no existen prestaciones desproporcionadas, inequitativas o abusivas, o cualquier otra cláusula o texto que viole las disposiciones de la Ley Federal de Protección al Consumidor, las Normas Oficiales Mexicanas y demás ordenamientos aplicables.
    
    
Los Derechos y obligaciones como Cliente se rigen por las cláusulas del presente Contrato y en los términos señalados por la Ley Federal de Protección al Consumidor.
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
19.- PROTECCIÓN DE DATOS:
    
Con fundamento en la Ley Federal de Protección de datos Personales en Posesión de los Particulares, publicada en el Diario Oficial de la Federación el día 05 de Julio de 2010, los datos personales proporcionados entre las partes, en este acto serán tratados conforme a lo estipulado por la Ley antes señalada, los cuales no podrán ser transferidos a persona alguna, pero en cumplimiento de los ordenamientos legales, la información será guardada en el archivo correspondiente a cada una de las partes así como en la documentación adjunta y será proporcionada exclusivamente a las Autoridades que deban conocer del presente contrato celebrado entre las partes.
    
La información y archivos son propiedad exclusiva de GRUPO AUTO WARRANTY, S.A DE C.V.., extendiéndose también esta titularidad a cuantas elab- oraciones, evaluaciones, segmentaciones o procesos similares que, en relación con los mismos, realice, GRUPO AUTO WARRANTY, S.A DE C.V.., de acuerdo con los servicios que se pactan en el presente Contrato, declarando las partes que esta información es confidencial para todos los efectos, sujetos en consecuencia al más estricto secreto profesional, incluso una vez finalizada la presente relación contractual.
    
Leído que fue el presente contrato, así como enteradas las partes de su contenido y alcances legales, lo firman por duplicado en León, Guanajuato $fechaa.
    
    
    
    
    
    
    
                                                ________________________________                                                                                  ________________________________
                                                   NOMBRE Y FIMRA BENEFICIARIO                                                                                                        CONTRATANTE
    
    
    
    
    
    
    
                                                                                                                           ________________________________
                                                                                                                            GRUPO AUTO WARRANTY SA DE CV
    
    
    
"),0,'L',0);






//$pdf->Cell(350,4,"Fecha: ".$fechaa,0,0,'R');

// $pdf->Multicell(190,12,utf8_decode('ATENTAMENTE'),0,'c',0);

// $image4='dist/img/logo.png';
// //$pdf->Cell( 190, 20, $pdf->Image($image4, $pdf->GetX(), $pdf->GetY(), 72), 1, 1, 'L', false );
// $pdf->Cell(190,40,$pdf->Image($image4,$pdf->GetX(),$pdf->GetY(),72),0,1,'L',false);

$pdf->Multicell(190,7,utf8_decode('
    
XXXX XXXXXXXXX XXXXXXX
XXXXXXXXX XXXXXX XXXXXX
XXXXXXXX XXXXXX XXXXXX
    
'),0,'L',0);

$pdf->Output();
?>