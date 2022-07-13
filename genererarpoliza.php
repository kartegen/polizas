<?php
ini_set('display_errors', 'on');
ini_set('log_errors',1);
error_reporting(E_ALL | E_STRICT);

//ob_end_clean();
//PHP
//request id
$id=$_REQUEST['id'];
require("conexion.php"); //el error que arrojaba era por el include y se cambió por require
// $query="SELECT * FROM polizas WHERE idPoliza= '$id' ";
$query="SELECT polizas.*,agencias.*,users.* FROM polizas INNER JOIN agencias ON polizas.idAgencia = agencias.idAgencia INNER JOIN users ON polizas.idUser = users.id WHERE polizas.idPoliza = '$id' ";
$resultado = $conn->query($query);
$row=$resultado->fetch_assoc();

//require 'lib/fpdf/fpdf.php';
require('fpdf/fpdf.php');

class PDF extends FPDF
{
    // Cabecera de p�gina
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
        // Salto de l�nea
        $this->Ln(3);
        $this->Cell(190);
        $this->Cell(1,30,utf8_decode('R.F.C. GAW2108133K1'),0, 0, 'R');
        $this->Ln(3);
        $this->Cell(190);
        $this->Cell(1,30,utf8_decode('Manuel j Cloutier 304 Piso 4 suite 400'),0, 0, 'R');
        $this->Ln(3);
        $this->Cell(190);
        $this->Cell(1,30,utf8_decode('Jardines del campestre Le�n, Guanajuato'),0, 0, 'R');
        $this->Ln(3);
        $this->Cell(190);
        $this->Cell(1,30,utf8_decode('CP 371218'),0, 0, 'R');
        $this->Ln(3);
        $this->Cell(190);
        $this->Cell(1,30,utf8_decode('Email: atencion@autowarranty.com'),0, 0, 'R');
    }
    
    // Pie de p�gina
    function Footer()
    {
        // Posici�n: a 1,5 cm del final
        $this->SetY(-15);
        // Arial italic 8
        $this->SetFont('Arial','I',8);
        // N�mero de p�gina
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
$pdf->Multicell(190,12,utf8_decode('CONTRATO DE GARANT�A MEC�NICA CELEBRADO CON AUTO WARRANTY'),0,'C',0);
$pdf->SetFont('Arial','B',9);
$pdf->Multicell(190,5,utf8_decode('______________________________________________________________________________________________________'),0,'C',0);
$pdf->Multicell(190,5,utf8_decode('             DATOS GENERALES NO. DE CONTRATO'),0,'L',0);
$pdf->SetFont('Arial','B',8);
$pdf->multicell(110,4,utf8_decode('                       No. de contrato            '.$row['prefijoAgencia'].''.$row['idPoliza'].''),0,'L',0);

$pdf->Cell(110,4,utf8_decode('Fecha de Contrato          '.$row['fechaInicio'].''),0,0,'L');
$pdf->Multicell(95,4,utf8_decode('Producto Contratado       '.$row['folioContrato'].' '),0,'L');


$pdf->Cell(110,4,utf8_decode('Limite por Aver�a'.$row['valorVenta'].''),0,0,'L');
$pdf->Multicell(80,4,utf8_decode('L�mite de Contrato'.$row['valorVenta'].' '),0,'L');

$pdf->SetFont('Arial','B',9);
$pdf->Multicell(190,5,utf8_decode('______________________________________________________________________________________________________'),0,'C',0);
$pdf->Multicell(190,5,utf8_decode('             VEH�CULO OBJETO DE CONTRATO:'),0,'L',0);
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
                     Limite por Aver�a           '.$row['vin'].'		                                                              L�mite de Contrato	           '.$row['valorVenta'].'
                     _____________________________________________________________________________________________________________________
    
                                                                  HOJA RESUMEN DEL CONTRATO DE GARANT�A MEC�NICA
    
                     VEH�CULO OBJETO DE CONTRATO:
    
                     MARCA		           '.$row['marca'].'                                                    NUMERO DE SERIE (VIN)		             '.$row['vin'].'
                     HP                     '.$row['hp'].'                                                    CC                                                     '.$row['cc'].'
                     MODELO             '.$row['subMarca'].'                                                  FECHA FACTURA PRIMORDIAL      '.$row['fechaFacturaPrimordial'].'
                     PLACAS              '.$row['placa'].'                                                 N� MOTOR	                                    '.$row['marca'].'
                     Kil�metros            '.$row['kms'].''),0,'J',0);

$pdf->SetFont('Arial','B',6);
$pdf->Multicell(190,4,utf8_decode('
*Los datos introducidos tendr�n que coincidir fehacientemente con los del veh�culo objeto de garant�a. En caso de error ser� motivo de rescisi�n del contrato.'),0,'C',0);

$pdf->SetFont('Arial','B',8);
$pdf->Multicell(190,3,utf8_decode('_____________________________________________________________________________________________________________________
    
                                                            CONTRATANTE DEL CONTRATO / DISTRIBUIDOR:
    
    
                    PUNTO DE VENTA '.$row['placa'].'	                                                    PERSONA DE CONTACTO    '.$row['nombreCliente'].'
                    RFC                       '.$row['rfc'].'                                               DIRECCI�N:	'.$row['calle'].', '.$row['numExt'].'
                    POBLACI�N      '.$row['localidad'].'                                                    ESTADO	'.$row['estado'].'
                    TELEFONO       '.$row['telefono'].'		                                                EMAIL   '.$row['email'].'
            		   C.P	           '.$row['codigoPostal'].'
    
    
                                    _____________________________________________________________________________________________________________________
    
                                                            BENEFICIARIO DEL CONTRATO / COMPRADOR:
    
                   NOMBRE		'.$row['nombreCliente'].'
                   R.F.C.       '.$row['rfc'].'		CURP'.$row['rfc'].'
                    DIRECCI�N:	'.$row['calle'].', '.$row['numExt'].'
                    POBLACI�N      '.$row['localidad'].'                                                    ESTADO	'.$row['estado'].'
                    TELEFONO       '.$row['telefono'].'		                                                EMAIL'.$row['email'].'
            		   C.P	           '.$row['codigoPostal'].'
    
'),0,'L',0);

$pdf->Multicell(190,3,utf8_decode('_____________________________________________________________________________________________________________________
    
                                                                     PERIODO DE VIGENCIA DEL CONTRATO:
    
    
    
    
                    FECHA INICIO GARANTIA   '.$row['fechaInicio'].'		                           	FECHA FIN GARANTIA   '.$row['fechaFin'].''),0,'L',0);

$pdf->SetFont('Arial','B',6);
$pdf->Multicell(190,4,utf8_decode('
*Siempre que se hayan realizado en el VEH�CULO en tiempo y forma los servicios y mantenimientos se�alados en la cl�usula 7 del presente Contrato; el PERIODO DE VIGENCIA DEL CONTRATO podr� comenzar a computarse hasta el momento en que expire la garant�a del fabricante o alguna otra garant�a de similar naturaleza, ya sea por sobrepasar el kilometraje o cumplirse el tiempo establecido en la misma. En cualquier caso, la Garant�a Mec�nica de Grupo Auto Warranty, S.A. de C.V. ser� v�lida conforme a los t�rminos y condiciones del presente Contrato
    
    
    
    
    
    
    
    
'),0,'L',0);



date_default_timezone_set('America/Mexico_City');
$fechaHoy= date("d/m/Y");
$pdf->SetFont('Arial','b',7);
$pdf->Multicell(190,4,utf8_decode("
1.- DEFINICIONES:
    
CONTRATANTE: Tendr� la consideraci�n de CONTRATANTE del contrato, el vendedor del VEH�CULO, que ser� el obligado al pago del precio del pre- sente contrato de garant�a mec�nica.
    
BENEFICIARIO: Tendr� la consideraci�n de BENEFICIARIO el comprador del VEH�CULO, quien ser� el destinatario de la garant�a mec�nica objeto del presente contrato.
    
VEH�CULO: A los efectos del presente contrato, tendr� la consideraci�n de VEH�CULO �nicamente el descrito en la HOJA RESUMEN DEL CONTRATO DE GARANT�A MEC�NICA que, en todo caso, no podr� tener m�s de 400 C.V. de potencia o tener denominaci�n industrial ya sea ligera o pesada.
    
AVER�A/AS: Se entiende por aver�a mec�nica, el�ctrica, o electr�nica, la inutilidad operativa (conforme a las especificaciones del fabricante) de la pieza garantizada, debido a una rotura imprevista / fortuita. No se incluye en esta definici�n la reducci�n gradual en el rendimiento operativo de la pieza ga- rantizada que sea proporcional y equivalente a su antig�edad y kilometraje (se entiende a partir de la primera matriculaci�n del veh�culo, y no a partir del inicio del contrato de garant�a), ni las aver�as derivadas de accidentes o cualesquiera influencias externas. A los efectos del presente contrato s�lo se consideran AVER�A/AS, las piezas que se describen a continuaci�n y de manera literal.
    
TALLER REPARADOR: A los efectos del presente contrato, tendr� la consideraci�n de TALLER REPARADOR el taller autorizado por la Marca del VEHIC- ULO que realiza la reparaci�n de la AVER�A. Dicho TALLER REPARADOR ser� elegido por el BENEFICIARIO dentro de la Red autorizada por la Marca de su VEHICULO. EL TALLER REPARADOR es responsable de realizar la reparaci�n de la AVER�A y otorgar posteriormente sobre la calidad y garant�a de la misma de acuerdo a lo estipulado por la Marca de VEH�CULO.
    
Mediante este contrato de Garant�a Grupo Auto Warranty, S.A de C.V. se compromete a pagar los costos razonables de reparaci�n de una aver�a cubierta relativa al veh�culo garantizado, dentro de los l�mites de pago por aver�a y condiciones del mismo. Quedan cubiertas por el presente contrato la repa- raci�n o sustituci�n de todas las piezas o componentes que presenten defectos como consecuencia de una aver�a fortuita en los elementos mec�nicos, el�ctricos o electr�nicos.
    
Se excluyen de manera expresa los siguientes elementos:
    
        1.	Asientos completos y mecanismos (mec�nicos)
        2.	Elementos internos del habit�culo y/o maletero (tapizados, guarnecidos, reposabrazos, salpicadero, consolas, soportes, tapas, aireadores, ceniceros, encendedor, l�mparas)
        3.	Neum�ticos, v�lvula de rueda (con o sin sensor)
        4.	Totalidad de los elementos de carrocer�a.
        5.	Totalidad de cristales y lunas, incluida t�rmica
        6.	Faros, intermitentes, calaveras, l�mparas
        7.	Molduras, embellecedores, espejos retrovisores completos, paragolpes
        8.	Consumibles (filtros, cartuchos, aceite, juntas), amortiguadores, escapes, discos de freno, pastillas, correas, servicio peri�dico, servicios intermedios, lubricantes, combustibles, aditivos, carga de circuito de a/a (salvo que sea necesario por aver�a cubierta), buj�as, calentadores, bater�a, escobillas, plumas limpiaparabrisas
        9.	Elementos que hayan perdido su morfolog�a inicial (bujes, gomas, soportes, juntas).
    
2.- OBJETO DEL CONTRATO:
    
En virtud del presente contrato de garant�a mec�nica, GRUPO AUTO WARRANTY, S.A DE C.V.. garantiza, dentro de los l�mites fijados en el presente documento, el pago de la reparaci�n de las AVER�A/AS descritas en el apartado anterior.
    
3.- DURACI�N DEL CONTRATO:
    
El periodo de garant�a cubierto por el presente contrato ser� el indicado en la HOJA RESUMEN DE CONTRATO DE GARANT�A MEC�NICA, en su apartado PERIODO DE VIGENCIA DEL CONTRATO. Por tanto, s�lo estar�n cubiertas las AVER�A/AS que tenga el VEH�CULO durante la vigencia del contrato.
    
No cabe la pr�rroga t�cita del contrato.
    
    
    
    
    
    
4.- PERFECCI�N Y EFECTOS DEL CONTRATO:
    
El contrato se perfecciona por el consentimiento manifestado con la firma del presente documento. No obstante, lo anterior, las garant�as contratadas no tendr�n efectos, y por tanto no generar�n obligaciones para GRUPO AUTO WARRANTY, S.A DE C.V., hasta que el CONTRATANTE no haya satisfecho la totalidad del precio del contrato de garant�a mec�nica.
    
En caso de demora en el pago del precio, las obligaciones de GRUPO AUTO WARRANTY, S.A DE C.V.. comenzar�n a las 24 horas del pago del precio, y siempre con efectos para AVER�A/AS surgidas con posterioridad al pago del mismo.
    
Si transcurridas 48 horas desde la firma del presente documento, el CONTRATANTE no hubiera pagado el precio, GRUPO AUTO WARRANTY, S.A DE C.V.. se reserva el derecho a dejar sin efecto el presente contrato, o a exigir el pago del mismo.
    
5.- DELIMITACI�N GEOGR�FICA:
    
La garant�a objeto del presente contrato se extiende y limita a las AVER�A/AS que tengan lugar dentro de la Rep�blica Mexicana.
    
6.- OBLIGACIONES DEL CONTRATANTE:
    
El CONTRATANTE, en relaci�n con el presente contrato, tiene las siguientes obligaciones:
    
        1.	Pagar a GRUPO AUTO WARRANTY, S.A DE C.V.. el precio del contrato de garant�a, y el I.V.A. correspondiente a dicho precio.
        2.	Con anterioridad a la venta del VEH�CULO al BENEFICIARIO, deber� revisar el VEH�CULO, y en caso de que el mismo tenga cualquier tipo de aver�a, tendr� la obligaci�n de repararla antes de la venta.
        3.	Deber� poner en conocimiento del BENEFICIARIO y de GRUPO AUTO WARRANTY, S.A DE C.V.. todas las reparaciones realizadas en el VEH�CULO, as� como si el mismo ha tenido alg�n accidente o siniestro.
                4.	Deber� entregar el VEH�CULO al BENEFICIARIO en perfectas condiciones de uso y mantenimientos, acordes con el kilometraje y antig�edad del mismo, haci�ndose responsable de aplicar la garant�a en los primeros 90 d�as de vigencia del presente contrato.
7.- OBLIGACIONES DEL BENEFICIARIO:
    
El BENEFICIARIO, en relaci�n con el presente contrato, tiene las siguientes obligaciones:
    
        1.	Comunicar a GRUPO AUTO WARRANTY, S.A DE C.V.. todas las AVER�A/AS que tenga el VEH�CULO durante el periodo de vigencia del contrato.
        2.	En caso de AVER�A/AS, seguir estrictamente el PROCEDIMIENTO EN CASO DE AVER�A/AS descrito en el presente contrato,.
        3.	Realizar en el VEH�CULO los mantenimientos peri�dicos exigidos tanto por el fabricante del VEH�CULO como por GRUPO AUTO WARRANTY,
        S.A DE C.V..
        4.	Conservar las facturas correspondientes a los trabajos o reparaciones de mantenimiento descritos en el apartado anterior.
        5.	Hacer un uso del VEH�CULO razonable a las caracter�sticas del mismo.
        6.	En caso de AVER�A/AS, no agravar la misma por un uso inadecuado o negligente del VEH�CULO.
    
8.- OBLIGACIONES DE GRUPO AUTO WARRANTY, S.A. DE C.V.:
    
GRUPO AUTO WARRANTY, S.A DE C.V.., en relaci�n con el presente contrato, tiene la obligaci�n de, en los t�rminos y con los l�mites fijados en el mis- mo, hacerse cargo de la reparaci�n de las AVER�A/AS cubiertas, que dentro del periodo de vigencia del contrato pueda tener el VEH�CULO, siempre y cuando dichas AVER�AS no traigan causa en un uso inadecuado del VEH�CULO, o en el deterioro y/o desgaste normal del mismo.
    
Se hace especial menci�n, que Grupo Auto Warranty, S.A. de C.V., proceder� a evaluar, canalizar al taller correspondiente para su diagn�stico y en su caso y de proceder, aprobar la reparaci�n del veh�culo, a partir del cuarto mes de vigencia del presente contrato o despu�s de 90 d�as naturales, ya que antes de este periodo, es decir antes de los primeros 90 d�as, corresponder� a EL CONTRATANTE, el proceso de aplicaci�n de la garant�a.
    
    
    
    
    
    
    
    
    
9.- MANTENIMIENTOS PERI�DICOS:
    
Para que el presente contrato sea efectivo, el BENEFICIARIO se obliga a efectuar en el VEH�CULO los trabajos o tareas de mantenimiento exigidas por GRUPO AUTO WARRANTY, S.A DE C.V.. que a continuaci�n se detallan, TANTO PARA NUEVOS COMO PARA SEMINUEVOS:
    
        �	NUEVOS: Para que el contrato sea efectivo, el propietario del veh�culo y titular del contrato, se compromete a efectuar las inspecciones requeridas POR EL FABRICANTE SIGUIENDO SU PLAN DE MANTENIMIENTO PROGRAMADO, tanto en periodos de tiempo como en kilometraje.
        �	SEMINUEVOS O AUTOS CUYO PERIODO DE GARANT�A DE F�BRICA HAYA TERMINADO: Para que el contrato sea efectivo, el propietario del ve- h�culo y titular del contrato, se compromete a efectuar las revisiones requeridas por Grupo Auto Warranty, S.A de C.V.. Estas revisiones se tendr�n que hacer en periodos de 6 meses o 10,000 kil�metros, lo que antes ocurra. Incluso si este periodo resultara ser inferior a lo indicado por el fabri- cante del auto. Las revisiones m�nimas consistir�n en cambio de Aceite Motor, Filtro de Aceite y Verificaci�n de Fugas, Ruidos y Holguras. Todos estos mantenimientos y revisiones deber�n realizarse en Distribuidores Autorizados por el FABRICANTE DEL AUTO. El contrato quedar� invali- dado por cualquier mantenimiento, intervenci�n o reparaci�n no realizada dentro de un distribuidor Autorizado por el FABRICANTE DEL AUTO.
        �	El Beneficiario deber� conservar su carnet de mantenimiento debidamente sellado por el Distribuidor, indicando cada mantenimiento, reparaci�n o revisi�n con el kilometraje correspondiente, as� mismo deber� conservar las facturas que lo amparen. Para comprobar que el Beneficiario hizo sus mantenimientos ser�n igualmente v�lidos el carnet de mantenimiento sellado por el Distribuidor o la factura de su �ltimo mantenimiento en tiempo y forma.
    
El incumplimiento de cualquiera de los requisitos anteriores invalidar� este contrato.
    
10.- PROCEDIMIENTO EN CASO DE AVER�A/AS:
En caso de AVER�A/AS del VEH�CULO, y para que la misma quede cubierta por el presente contrato de garant�a, se deber� seguir, obligatoriamente, el siguiente procedimiento:
    
1.	En cuanto tenga conocimiento de la AVER�A/AS, el BENEFICIARIO comunicar� la misma a GRUPO AUTO WARRANTY, S.A DE C.V.., por cualqui- era de los siguientes medios: i) Por correo electr�nico, a la direcci�n atencion@autowarranty.mx.
    
2.	En dicha comunicaci�n el BENEFICIARIO deber� facilitar a GRUPO AUTO WARRANTY, S.A DE C.V.., al menos, la siguiente informaci�n: i) N� de Garant�a Mec�nica, ii) Placas del VEH�CULO, iii) Declaraci�n de la AVER�A/AS, iv) Lugar en el que se ha producido la AVER�A/AS y v) Taller en el que est� el VEH�CULO. En caso de que el VEH�CULO no est� todav�a en ning�n taller, podr� solicitar a GRUPO AUTO WARRANTY, S.A DE C.V.,que le indique un taller en el que dejar el VEH�CULO.
    
3.	Una vez el VEH�CULO est� en un taller, el responsable del mismo volver� a contactar con GRUPO AUTO WARRANTY, S.A DE C.V.., para describir la AVER�A/AS, por los mismos medios descritos en la letra anterior, debiendo aportar igualmente la siguiente documentaci�n:
    
        a.	Orden de entrada del VEH�CULO, que contenga, al menos, la fecha de entrada del mismo, los kil�metros del VEH�CULO y descripci�n de la aver�a.
        b.	Presupuesto aproximado de la reparaci�n, QUE DEBER� REALIZARSE SIN INTERVENIR NI DESMONTAR EL VEH�CULO.
        c.	Copia del Libro de Mantenimiento del VEH�CULO (Si dispone del mismo).
        d.	Copia de las facturas de las inspecciones que indica Grupo Auto Warranty, S.A de C.V., S.A.P.I DE C.V., en el VEH�CULO. Dichas facturas, de conformidad con la normativa vigente, deber�n tener el siguiente detalle:
                i.	N�mero de taller, seg�n registro especial.
                ii.	Identificaci�n del mismo: Denominaci�n Social, R.F.C., domicilio fiscal, domicilio a efectos de notificaciones, etc.
                iii.	Identificaci�n del VEH�CULO con expresi�n de la marca, modelo, PLACA y n�mero de kil�metros.
                iv.	Reparaciones incluidas en la factura, desglosando las piezas sustituidas y la mano de obra empleada.
                v.	Fecha y firma o sello del taller.
                vi.	Fecha de entrega del VEH�CULO.
    
4.	Hasta que la reparaci�n de la AVER�A/AS no est� autorizada por GRUPO AUTO WARRANTY, S.A DE C.V.., no se podr� realizar en el mismo ning�n tipo de desmontaje, montaje, reparaci�n y/o intervenci�n; a no ser que GRUPO AUTO WARRANTY, S.A DE C.V.. lo requiera para poder determi- nar el origen de la aver�a. Cualquier autorizaci�n a trabajar sobre el veh�culo para efectuar (pruebas, desmontajes, diagnosis, etc.) anterior a la aceptaci�n de la aver�a parte de GRUPO AUTO WARRANTY, S.A DE C.V.., siempre tendr� que ser dada por el propietario del veh�culo. El VEH�CU- LO tendr� que permanecer inmovilizado hasta que GRUPO AUTO WARRANTY, S.A DE C.V.., resuelva el expediente.
    
    
    
    
    
    
5.	Una vez GRUPO AUTO WARRANTY, S.A DE C.V.., haya recibido la documentaci�n indicada en los apartados anteriores, GRUPO AUTO WARRAN- TY, S.A DE C.V.., estudiar� el asunto y decidir� sobre la necesidad de realizar un desmontaje para determinar la causa de la AVER�A/AS. GRUPO AUTO WARRANTY, S.A DE C.V.,se compromete a resolver por escrito y motivadamente el expediente , autorizando o rechazando la reparaci�n de la aver�a en el plazo m�ximo de 48 horas (que no incluir�n domingos ni festivos) a contar desde la recepci�n de la documentaci�n o posterior al desmontaje en caso de existir. La resoluci�n escrita del expediente a la que se hace referencia en este p�rrafo ser� remitida por GRUPO AUTO
    
WARRANTY, S.A DE C.V.. al taller desde el que se remiti� la documentaci�n sobre la AVER�A/AS. En caso de que no se siga el procedimiento se�alado o la reparaci�n de la Aver�a no se encuentre cubierta por el presente Contrato el costo del desmontaje, montaje y/o intervenci�n ser�n cubiertos por el Cliente, el propietario del Veh�culo o el Beneficiario.
6.	En caso de que la reparaci�n de la AVER�A/AS sea aceptada por GRUPO AUTO WARRANTY, S.A DE C.V.., en la resoluci�n por escrito del expedi- ente se detallar�n las reparaciones o trabajos que habr� que efectuar sobre el VEH�CULO para la reparaci�n de la AVER�A/AS, as� como la valo- raci�n de dichas actuaciones. En ning�n caso GRUPO AUTO WARRANTY, S.A DE C.V.. se har� cargo de trabajos o reparaciones no autorizadas en la resoluci�n escrita del expediente.
7.	Una vez autorizada la reparaci�n del VEH�CULO por GRUPO AUTO WARRANTY, S.A DE C.V.., el taller realizar� las reparaciones autorizadas por GRUPO AUTO WARRANTY, S.A DE C.V..
8.	Una vez reparado el VEH�CULO por el taller, �ste enviar� a GRUPO AUTO WARRANTY, S.A DE C.V.. el original de la factura de reparaci�n debid- amente firmada por el BENEFICIARIO, que incluir� �nicamente las reparaciones autorizadas por GRUPO AUTO WARRANTY, S.A DE C.V.., y que nunca podr� ser de un importe superior a la valoraci�n de la reparaci�n realizada por GRUPO AUTO WARRANTY, S.A DE C.V.., en su informe de resoluci�n del expediente. Junto con la factura, el taller deber� remitir a GRUPO AUTO WARRANTY, S.A DE C.V.., una copia firmada por el BENE- FICIARIO del informe de resoluci�n del expediente.
9.	La factura de reparaci�n emitida por el taller deber� estar a nombre de GRUPO AUTO WARRANTY, S.A DE C.V.. como destinatario de la misma.
10.	Una vez GRUPO AUTO WARRANTY, S.A DE C.V.., haya recibida toda la documentaci�n a la que se hace referencia en las letras anteriores, proced- er� al pago de la factura de reparaci�n, en el plazo de 15 d�as recepci�n factura.
11.	En el caso de que el presupuesto de reparaci�n de la AVER�A/AS realizado por el taller sea superior al valor de la reparaci�n autorizada por GRUPO AUTO WARRANTY, S.A DE C.V.., el BENEFICIARIO podr� optar por: i) Llevar el VEH�CULO al taller que le indique GRUPO AUTO WARRANTY, S.A DE C.V.. para realizar la reparaci�n tal como la misma haya sido autorizada en el informe de resoluci�n del expediente, corriendo a costa del BEN- EFICIARIO todos los gastos de desplazamiento del VEH�CULO, o ii)Reparar el VEH�CULO seg�n el presupuesto del taller. En este caso, el BENEFI- CIARIO deber� aceptar expresamente y por escrito que la diferencia entre el presupuesto dado por el taller y la valoraci�n de la reparaci�n de la AVER�A/AS autorizada por GRUPO AUTO WARRANTY, S.A DE C.V.., correr� �ntegramente a su cargo. En este caso, el taller deber� confeccionar dos facturas, una por un importe igual a la valoraci�n de la reparaci�n de la AVER�A/AS autorizada por GRUPO AUTO WARRANTY, S.A DE C.V.., que deber� entregar a GRUPO AUTO WARRANTY, S.A DE C.V..; y otra, que deber� entregar al BENEFICIARIO, por la diferencia asumida por �ste.
12.	GRUPO AUTO WARRANTY, S.A DE C.V.., se reserva el derecho a utilizar los medios de reparaci�n que considere oportunos, as� como el derecho a proporcionar las piezas que deban sustituirse o repararse en la reparaci�n autorizada.
    
11.- L�MITES DEL CONTRATO:
    
Adem�s de los l�mites del contrato se�alados en la HOJA RESUMEN DE CONTRATO DE GARANT�A MEC�NICA, en su apartado DATOS GENERALES, la valoraci�n de la reparaci�n de la AVER�A/AS del VEH�CULO nunca podr� superar el valor de venta del VEH�CULO que marque el libro azul que es la gu�a que indica los precios del VEH�CULO correspondiente al a�o de la venta. En caso de que la valoraci�n de la reparaci�n de la AVER�A/AS supere el valor de venta del VEH�CULO, GRUPO AUTO WARRANTY, S.A DE C.V.. pagar� al BENEFICIARIO con una cuant�a igual a la menor de las cantidades siguientes: i) el L�mite por AVER�A/AS del presente contrato, ii) el L�mite del contrato o iii) el valor de venta del VEH�CULO.
    
En caso de que el VEH�CULO no est� en los boletines identificados en el p�rrafo anterior, el valor de venta del VEH�CULO se calcular� sobre la base del valor medio de mercado excluyendo del muestreo tanto el valor m�s bajo como el valor m�s elevado. Este c�lculo ser� realizado por un evaluador libremente elegido por GRUPO AUTO WARRANTY, S.A DE C.V.., asumiendo �sta los costos de dicha valoraci�n.
    
12.- EXCLUSIONES GENERALES DEL CONTRATO:
    
GRUPO AUTO WARRANTY, S.A DE C.V.. podr� rechazar la reparaci�n, y/o en su caso el pago de la AVER�A/AS en los siguientes supuestos:
    
        1.	Cuando se haya realizado cualquier tipo de trabajo sobre el VEH�CULO antes de la resoluci�n del expediente por GRUPO AUTO WARRANTY,
        S.A DE C.V..
    
    
    
    
    
    
    
        2.	Cuando el VEH�CULO no haya permanecido inmovilizado en el taller desde la comunicaci�n de la AVER�A/AS hasta la resoluci�n del expediente por GRUPO AUTO WARRANTY, S.A DE C.V..
        3.	Cuando el BENEFICIARIO no haya cumplido sus obligaciones en relaci�n con los mantenimientos e inspecciones exigidas en el presente contrato.
        4.	Cuando el carnet de mantenimientos debidamente sellado o las facturas correspondientes a los mantenimientos peri�dicos o cualquier docu- mentaci�n exigida dentro del Articulo 10.-PROCEDIMIENTO EN CASO DE AVER�AS/AS del presente contrato, no est�n debidamente cumplimen- tadas, o directamente no se aporten a GRUPO AUTO WARRANTY, S.A DE C.V.., en un plazo de 48 horas tras ser requeridas.
        5.	Cuando se detecte que los kil�metros de inicio del contrato no guardan relaci�n con los kil�metros de la aver�a o mantenimiento del veh�culo. Esta exclusi�n ser� motivo de recesi�n del contrato.
        6.	Cuando la AVER�A/AS haya sido comunicada a GRUPO AUTO WARRANTY, S.A DE C.V.., transcurrido el plazo de duraci�n del contrato, aun cuan- do la AVER�A/AS haya acontecido con anterioridad a su expiraci�n
        7.	Cuando haya habido cualquier tipo de incumplimiento por parte del CONTRATANTE o del BENEFICIARIO.
    
13.- OPERACIONES NO INCLU�DAS EN LA GARANT�A OBJETO DEL PRESENTE CONTRATO:
    
No estar�n cubiertas por la garant�a objeto del presente contrato, y por tanto GRUPO AUTO WARRANTY, S.A DE C.V.., no estar� obligada a reparar ni a realizar el pago de las siguientes:
    
        1.	AVER�A/AS y/o defectos previsibles y/o preexistentes a la contrataci�n de la garant�a.
        2.	AVER�A/AS cuya causa era evidente en el momento en que estaba en vigor la garant�a del fabricante, independientemente del momento en que �sta se hubiere ocasionado.
        3.	AVER�A/AS que sean consecuencia de una mala reparaci�n anterior.
        4.	La sustituci�n, reparaci�n, ajustes o reglajes sobre piezas que hayan llegado al final de su vida �til como consecuencia de su funci�n y usabilidad natural.
        5.	Los da�os ocasionados por erosi�n, corrosi�n, deformaci�n, oxidaci�n, descomposici�n, herrumbre e incrustaciones, as� como elementos que hayan perdido su morfolog�a inicial (bujes, gomas, soportes, juntas, mangueras, retenes)
        6.	La sustituci�n de lubricantes y otros aditivos, buj�as, buj�as de encendido, filtros, cartuchos, aceites, juntas, carburantes, cargas de a/a, fugas de aceite, fugas de refrigerante o fugas de combustible, neum�ticos, amortiguadores, discos de freno, pastillas de freno, correas de distribuci�n, escapes, catalizadores, bater�a, plumas limpiaparabrisas, en definitiva, cualquier elemento consumible.
        7.	Las actualizaciones, programaciones o cargas de software de cualquier m�dulo electr�nico del veh�culo.
        8.	Los costos de diagn�stico cuando las aver�as no queden cubiertas por Grupo Auto Warranty, S.A. de  C.V.
        9.	AVER�A/AS causadas por elementos no garantizados.
        10.	Las operaciones de mantenimiento peri�dicas, de car�cter preventivo.
        11.	Los controles y/o reglajes, con o sin cambio de piezas.
        12.	Aver�as motivadas por defectos de serie, dise�o defectuoso, vicios ocultos, fallo epid�mico, campa�as del fabricante.
        13.	Cualquier da�o sobre piezas garantizadas que se haya producido por la alteraci�n o modificaci�n de la especificaci�n del fabricante.
        14.	Las AVER�A/AS ocasionadas por seguir circulando cuando con los indicadores de aver�a, incidencia o alarma indiquen un mal funcionamiento. 15.Las AVER�A/AS ocasionadas por mal uso o negligencia de utilizaci�n del veh�culo por parte del propietario del titular del contrato.
        16.	Las AVER�A/AS ocasionadas por el uso del veh�culo en competiciones.
        17.	Las AVER�A/AS ocasionadas por sobrecarga.
        18.	Las AVER�A/AS ocasionadas por el uso de agentes abrasivos.
        19.	Las AVER�A/AS ocasionadas por un accidente, robo, tentativa de robo, incendio, explosi�n, vandalismo o cat�strofes naturales.
        20.	Las piezas que sean cambiadas en el momento de la reparaci�n sin que hayan fallado. 21.Cualquier intervenci�n efectuada �in situ� por cualquier servicio de asistencia en carretera.
        22.	Los servicios de gr�a, remolque y gastos de transporte sobre el VEH�CULO y ocupantes.
        23.	Aver�as producidas por combustibles o lubricantes no conformes con las indicaciones del fabricante o con alto grado de agua o contami- naci�n de otros elementos qu�micos.
        24.	Sustituci�n, mantenimiento o reparaci�n de accesorios o piezas no montados de origen, aun siendo elementos garantizados.
        25.	Ning�n servicio de gr�a.
        26.	Gastos de estacionamiento y/o almacenamiento del VEH�CULO hasta su reparaci�n.
        27.	Da�os o p�rdidas ocasionadas como consecuencia de la AVER�A/AS o el retraso en su reparaci�n.
        28.	Lucro cesante por no poder utilizar el VEH�CULO.
        29.	Los da�os a terceros que traigan causa en la AVER�A/AS.
    
    
    
    
    
    
    
14.-DEVOLUCIONES:
    
En caso de rescisi�n anticipada del contrato por causas ajenas a GRUPO AUTO WARRANTY, S.A DE C.V.., �sta no estar� obligada a la devoluci�n del precio.
    
    
15.- HOJA RESUMEN DEL CONTRATO DE GARANT�A MEC�NICA:
    
La HOJA RESUMEN DEL CONTRATO DE GARANT�AS MEC�NICAS forma parte integrante del presente contrato, y tiene fuerza vinculante para los firmantes.
    
    
16.- AVISOS
    
Las partes acuerdan que en caso de que llegasen, por cualquier motivo, a mudarse del domicilio que indicaron en este contrato, deber�n hac�rselo saber a la otra parte con 30 d�as naturales de anticipaci�n a que efectuaren el cambio respectivo.
    
    
17.- RESCISI�N:
    
Ser�n causa de rescisi�n autom�tica del presente contrato el incumplimiento a cualquiera de las obligaciones establecidas en el presente contrato.
    
    
18.- SUMISI�N EXPRESA:
    
LA LEGISLACION APLICABLE, DE LA JURISDICCION Y DE LOS TRIBUNALES COMPETENTES: Siendo el presente
contrato de naturaleza mercantil, las partes convienen que para todo lo no previsto en �l, se sujetar�n a lo dispuesto en el C�digo de Comercio, as� mismo para el conocimiento de cualquier controversia que llegare a suscitarse con motivo de la interpretaci�n del presente contrato, las partes se som- eten a la jurisdicci�n de los Tribunales de la Ciudad de Aguascalientes, Ags. renunciando expresamente al fuero que pudiera corresponderles, en raz�n de sus domicilios presentes o futuros o bien, por cualquier otra causa. Manifestando el proveedor que en el presente contrato no existen prestaciones desproporcionadas, inequitativas o abusivas, o cualquier otra cl�usula o texto que viole las disposiciones de la Ley Federal de Protecci�n al Consumidor, las Normas Oficiales Mexicanas y dem�s ordenamientos aplicables.
    
    
Los Derechos y obligaciones como Cliente se rigen por las cl�usulas del presente Contrato y en los t�rminos se�alados por la Ley Federal de Protecci�n al Consumidor.
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
19.- PROTECCI�N DE DATOS:
    
Con fundamento en la Ley Federal de Protecci�n de datos Personales en Posesi�n de los Particulares, publicada en el Diario Oficial de la Federaci�n el d�a 05 de Julio de 2010, los datos personales proporcionados entre las partes, en este acto ser�n tratados conforme a lo estipulado por la Ley antes se�alada, los cuales no podr�n ser transferidos a persona alguna, pero en cumplimiento de los ordenamientos legales, la informaci�n ser� guardada en el archivo correspondiente a cada una de las partes as� como en la documentaci�n adjunta y ser� proporcionada exclusivamente a las Autoridades que deban conocer del presente contrato celebrado entre las partes.
    
La informaci�n y archivos son propiedad exclusiva de GRUPO AUTO WARRANTY, S.A DE C.V.., extendi�ndose tambi�n esta titularidad a cuantas elab- oraciones, evaluaciones, segmentaciones o procesos similares que, en relaci�n con los mismos, realice, GRUPO AUTO WARRANTY, S.A DE C.V.., de acuerdo con los servicios que se pactan en el presente Contrato, declarando las partes que esta informaci�n es confidencial para todos los efectos, sujetos en consecuencia al m�s estricto secreto profesional, incluso una vez finalizada la presente relaci�n contractual.
    
Le�do que fue el presente contrato, as� como enteradas las partes de su contenido y alcances legales, lo firman por duplicado en Le�n, Guanajuato $fechaa.
    
    
    
    
    
    
    
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