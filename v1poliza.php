<?php
ini_set('display_errors', 'on');
ini_set('log_errors',1);
error_reporting(E_ALL | E_STRICT);

//ob_end_clean();
//PHP
//request id
$id=$_REQUEST['id'];
require("conexion.php"); //el error que arrojaba era por el include y se cambiÃƒÂ³ por require
// $query="SELECT * FROM polizas WHERE idPoliza= '$id' ";
$query="SELECT polizas.*,agencias.*,users.* FROM polizas LEFT JOIN agencias ON polizas.idAgencia = agencias.idAgencia LEFT JOIN users ON polizas.idUser = users.id WHERE polizas.idPoliza = '$id' ";
$resultado = $conn->query($query);
$row=$resultado->fetch_assoc();

//require 'lib/fpdf/fpdf.php';
require('fpdf/fpdf.php');

class PDF extends FPDF
{
    // Cabecera de pÃ¡gina
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
        // Salto de lÃ­nea
        $this->Ln(3);
        $this->Cell(190);
        $this->Cell(1,30,utf8_decode('R.F.C. GAW2108133K1'),0, 0, 'R');
        $this->Ln(3);
        $this->Cell(190);
        $this->Cell(1,30,utf8_decode('Manuel j Cloutier 304 Piso 4 suite 400'),0, 0, 'R');
        $this->Ln(3);
        $this->Cell(190);
        $this->Cell(1,30,utf8_decode('Jardines del campestre LeÃ³n, Guanajuato'),0, 0, 'R');
        $this->Ln(3);
        $this->Cell(190);
        $this->Cell(1,30,utf8_decode('CP 371218'),0, 0, 'R');
        $this->Ln(3);
        $this->Cell(190);
        $this->Cell(1,30,utf8_decode('Email: atencion@autowarranty.com'),0, 0, 'R');
    }
    
    // Pie de pÃ¡gina
    function Footer()
    {
        // PosiciÃ³n: a 1,5 cm del final
        $this->SetY(-15);
        // Arial italic 8
        $this->SetFont('Arial','I',8);
        // NÃºmero de pÃ¡gina
        $this->Cell(0,10,'Pagina '.$this->PageNo().'',0,0,'C');
    }
}


$pdf = new PDF();
//$pdf->AddPage();
date_default_timezone_set('America/Mexico_City');
$fechaa= date("d/m/Y");
$pdf->AddPage('P','letter');
$pdf->Cell(70,40,utf8_decode(' '),0,1,'R');
$pdf->SetFont('Arial','B',11.5);
$pdf->Multicell(190,12,utf8_decode('CONTRATO DE GARANTÃ�A MECÃ�NICA CELEBRADO CON AUTO WARRANTY'),0,'C',0);
$pdf->SetFont('Arial','B',10);
$pdf->Multicell(190,5,utf8_decode('______________________________________________________________________________________________'),0,'C',0);
$pdf->Multicell(190,5,utf8_decode('             DATOS GENERALES NO. DE CONTRATO:'),0,'L',0);
$pdf->SetFont('Arial','B',8);
$pdf->multicell(90,4,utf8_decode('                      No. de contrato              '.$row['prefijoAgencia'].''.$row['idPoliza'].''),0,'L',0);
$pdf->Cell(70,4,utf8_decode('                      Fecha de Contrato         '.$row['fechaInicio'].''),0,0,'L');
$pdf->Multicell(90,4,utf8_decode('                      Producto Contratado       '.$row['folioContrato'].' '),0,'L');
$pdf->Cell(70,4,utf8_decode('                      Limite por AverÃ­a           '.$row['valorVenta'].''),0,0,'L');
$pdf->Multicell(90,4,utf8_decode('                      LÃ­mite de Contrato           '.$row['valorVenta'].' '),0,'L');

$pdf->SetFont('Arial','B',10);
$pdf->Multicell(190,5,utf8_decode(''),0,'C',0);
$pdf->Multicell(190,5,utf8_decode('             VEHÃ�CULO OBJETO DE CONTRATO:'),0,'L',0);
$pdf->SetFont('Arial','B',8);
$pdf->Cell(70,4,utf8_decode('                      MARCA                       '.$row['marca'].''),0,0,'L');
$pdf->Multicell(90,4,utf8_decode('                      NUMERO DE SERIE (VIN)       '.$row['vin'].''),0,'L');
$pdf->Cell(70,4,utf8_decode('                      HP                                '.$row['hp'].''),0,0,'L');
$pdf->Multicell(90,4,utf8_decode('                      CC                                             '.$row['cc'].''),0,'L');
$pdf->Cell(70,4,utf8_decode('                      MODELO                     '.$row['subMarca'].''),0,0,'L');
$pdf->Multicell(90,4,utf8_decode('                      FECHA 1ERA FACTURA         '.$row['fechaFacturaPrimordial'].' '),0,'L');
$pdf->Cell(70,4,utf8_decode('                      PLACAS                      '.$row['placa'].''),0,0,'L');
$pdf->Multicell(90,4,utf8_decode('                      MOTOR                                     '.$row['motor'].''),0,'L');
$pdf->Cell(70,4,utf8_decode('                      KILOMETROS             '.$row['kms'].''),0,0,'L');
$pdf->Multicell(90,4,utf8_decode(''),0,'L');
$pdf->SetFont('Arial','B',6);
$pdf->MultiCell(190,4,utf8_decode('
*Los datos introducidos tendrÃ¡n que coincidir fehacientemente con los del vehÃ­culo objeto de garantÃ­a. En caso de error serÃ¡ motivo de rescisiÃ³n del contrato.'),0,'C',0);

$pdf->SetFont('Arial','B',10);
$pdf->Multicell(190,5,utf8_decode(''),0,'C',0);
$pdf->Multicell(190,5,utf8_decode('             CONTRATANTE DEL CONTRATO / DISTRIBUIDOR:'),0,'L',0);
$pdf->SetFont('Arial','B',8);
$pdf->Cell(70,4,utf8_decode('                      PUNTO DE VENTA            '.$row['nombreAgencia'].''),0,0,'L');
$pdf->Multicell(90,4,utf8_decode(' '),0,'L');
$pdf->Cell(70,4,utf8_decode('                      RFC                                    '.$row['rfcAgencia'].''),0,0,'L');
$pdf->Multicell(110,4,utf8_decode('                      DIRECCION    '.$row['direccionAgencia'].''),0,'L');
$pdf->Cell(70,4,utf8_decode('                      POBLACIÃ“N                      '.$row['localidadAgencia'].' '),0,0,'L');
$pdf->Multicell(90,4,utf8_decode('                      ESTADO	 	      '.$row['estadoAgencia'].''),0,'L');
$pdf->Cell(70,4,utf8_decode('                      TELEFONO                        '.$row['telefonoAgencia'].'	'),0,0,'L');
$pdf->Multicell(90,4,utf8_decode('                      C.P                  '.$row['cpAgencia'].' '),0,'L');
$pdf->Cell(70,4,utf8_decode('                      EMAIL                                '.$row['emailAgencia'].'      '),0,0,'L');
$pdf->Multicell(90,4,utf8_decode(' '),0,'L');

$pdf->SetFont('Arial','B',10);
$pdf->Multicell(190,5,utf8_decode(''),0,'C',0);
$pdf->Multicell(190,5,utf8_decode('             BENEFICIARIO DEL CONTRATO / COMPRADOR:'),0,'L',0);
$pdf->SetFont('Arial','B',8);
$pdf->Cell(70,4,utf8_decode('                      NOMBRE		                '.$row['nombreCliente'].''),0,0,'L');
$pdf->Multicell(90,4,utf8_decode(' '),0,'L');
$pdf->Cell(70,4,utf8_decode('                      R.F.C.                        '.$row['rfc'].'	'),0,0,'L');
$pdf->Multicell(90,4,utf8_decode('                      CURP                         '.$row['curpCliente'].''),0,'L');
$pdf->Cell(70,4,utf8_decode('                      DIRECCIÃ“N:             '.$row['calle'].', '.$row['numExt'].''),0,0,'L');
$pdf->Multicell(90,4,utf8_decode('                      POBLACIÃ“N:             '.$row['localidad'].'  '),0,'L');
$pdf->Cell(70,4,utf8_decode('                      ESTADO	                  '.$row['estado'].''),0,0,'L');
$pdf->Multicell(90,4,utf8_decode('                      C.P                              '.$row['codigoPostal'].''),0,'L');
$pdf->Cell(70,4,utf8_decode('                      TELEFONO               '.$row['telefono'].''),0,0,'L');
$pdf->SetFont('Arial','B',7);
$pdf->Multicell(100,4,utf8_decode('                         EMAIL   '.$row['emailCliente'].' '),0,'L');
$pdf->SetFont('Arial','B',10);
$pdf->Multicell(190,5,utf8_decode(''),0,'C',0);
$pdf->Multicell(190,5,utf8_decode('             PERIODO DE VIGENCIA DEL CONTRATO:'),0,'L',0);

$pdf->SetFont('Arial','B',8);
$pdf->Cell(90,4,utf8_decode('FECHA INICIO GARANTIA   '.$row['fechaInicio'].''),0,0,'C');
$pdf->Multicell(90,4,utf8_decode('FECHA FIN GARANTIA   '.$row['fechaFin'].''),0,'C',0);
$pdf->SetFont('Arial','B',6);
$pdf->Multicell(190,4,utf8_decode('
*Siempre que se hayan realizado en el VEHÃ�CULO en tiempo y forma los servicios y mantenimientos seÃ±alados en la clÃ¡usula 7 del presente Contrato; el PERIODO DE VIGENCIA DEL CONTRATO podrÃ¡ comenzar a computarse hasta el momento en que expire la garantÃ­a del fabricante o alguna otra garantÃ­a de similar naturaleza, ya sea por sobrepasar el kilometraje o cumplirse el tiempo establecido en la misma. En cualquier caso, la GarantÃ­a MecÃ¡nica de Grupo Auto Warranty, S.A. de C.V. serÃ¡ vÃ¡lida conforme a los tÃ©rminos y condiciones del presente Contrato
'),0,'L',0);
$pdf->SetFont('Arial','B',10);
$pdf->Multicell(190,5,utf8_decode('______________________________________________________________________________________________
    
    
    
    
    
    
'),0,'C',0);

// $pdf->SetFont('Arial','B',8);
// $pdf->Cell(80,4,utf8_decode(''),0,0,'L');
// $pdf->Multicell(80,4,utf8_decode(''),0,'C',0);





//aqui termina la pagina principal

date_default_timezone_set('America/Mexico_City');
$fechaHoy= date("d/m/Y");
$pdf->SetFont('Arial','b',7);
$pdf->Multicell(190,4,utf8_decode("
1.- DEFINICIONES:
    
CONTRATANTE: TendrÃ¡ la consideraciÃ³n de CONTRATANTE del contrato, el vendedor del VEHÃ�CULO, que serÃ¡ el obligado al pago del precio del pre- sente contrato de garantÃ­a mecÃ¡nica.
    
BENEFICIARIO: TendrÃ¡ la consideraciÃ³n de BENEFICIARIO el comprador del VEHÃ�CULO, quien serÃ¡ el destinatario de la garantÃ­a mecÃ¡nica objeto del presente contrato.
    
VEHÃ�CULO: A los efectos del presente contrato, tendrÃ¡ la consideraciÃ³n de VEHÃ�CULO Ãºnicamente el descrito en la HOJA RESUMEN DEL CONTRATO DE GARANTÃ�A MECÃ�NICA que, en todo caso, no podrÃ¡ tener mÃ¡s de 400 C.V. de potencia o tener denominaciÃ³n industrial ya sea ligera o pesada.
    
AVERÃ�A/AS: Se entiende por averÃ­a mecÃ¡nica, elÃ©ctrica, o electrÃ³nica, la inutilidad operativa (conforme a las especificaciones del fabricante) de la pieza garantizada, debido a una rotura imprevista / fortuita. No se incluye en esta definiciÃ³n la reducciÃ³n gradual en el rendimiento operativo de la pieza ga- rantizada que sea proporcional y equivalente a su antigÃ¼edad y kilometraje (se entiende a partir de la primera matriculaciÃ³n del vehÃ­culo, y no a partir del inicio del contrato de garantÃ­a), ni las averÃ­as derivadas de accidentes o cualesquiera influencias externas. A los efectos del presente contrato sÃ³lo se consideran AVERÃ�A/AS, las piezas que se describen a continuaciÃ³n y de manera literal.
    
TALLER REPARADOR: A los efectos del presente contrato, tendrÃ¡ la consideraciÃ³n de TALLER REPARADOR el taller autorizado por la Marca del VEHIC- ULO que realiza la reparaciÃ³n de la AVERÃ�A. Dicho TALLER REPARADOR serÃ¡ elegido por el BENEFICIARIO dentro de la Red autorizada por la Marca de su VEHICULO. EL TALLER REPARADOR es responsable de realizar la reparaciÃ³n de la AVERÃ�A y otorgar posteriormente sobre la calidad y garantÃ­a de la misma de acuerdo a lo estipulado por la Marca de VEHÃ�CULO.
    
Mediante este contrato de GarantÃ­a Grupo Auto Warranty, S.A de C.V. se compromete a pagar los costos razonables de reparaciÃ³n de una averÃ­a cubierta relativa al vehÃ­culo garantizado, dentro de los lÃ­mites de pago por averÃ­a y condiciones del mismo. Quedan cubiertas por el presente contrato la repa- raciÃ³n o sustituciÃ³n de todas las piezas o componentes que presenten defectos como consecuencia de una averÃ­a fortuita en los elementos mecÃ¡nicos, elÃ©ctricos o electrÃ³nicos.
    
Se excluyen de manera expresa los siguientes elementos:
    
        1.	Asientos completos y mecanismos (mecÃ¡nicos)
        2.	Elementos internos del habitÃ¡culo y/o maletero (tapizados, guarnecidos, reposabrazos, salpicadero, consolas, soportes, tapas, aireadores, ceniceros, encendedor, lÃ¡mparas)
        3.	NeumÃ¡ticos, vÃ¡lvula de rueda (con o sin sensor)
        4.	Totalidad de los elementos de carrocerÃ­a.
        5.	Totalidad de cristales y lunas, incluida tÃ©rmica
        6.	Faros, intermitentes, calaveras, lÃ¡mparas
        7.	Molduras, embellecedores, espejos retrovisores completos, paragolpes
        8.	Consumibles (filtros, cartuchos, aceite, juntas), amortiguadores, escapes, discos de freno, pastillas, correas, servicio periÃ³dico, servicios intermedios, lubricantes, combustibles, aditivos, carga de circuito de a/a (salvo que sea necesario por averÃ­a cubierta), bujÃ­as, calentadores, baterÃ­a, escobillas, plumas limpiaparabrisas
        9.	Elementos que hayan perdido su morfologÃ­a inicial (bujes, gomas, soportes, juntas).
    
2.- OBJETO DEL CONTRATO:
    
En virtud del presente contrato de garantÃ­a mecÃ¡nica, GRUPO AUTO WARRANTY, S.A DE C.V.. garantiza, dentro de los lÃ­mites fijados en el presente documento, el pago de la reparaciÃ³n de las AVERÃ�A/AS descritas en el apartado anterior.
    
3.- DURACIÃ“N DEL CONTRATO:
    
El periodo de garantÃ­a cubierto por el presente contrato serÃ¡ el indicado en la HOJA RESUMEN DE CONTRATO DE GARANTÃ�A MECÃ�NICA, en su apartado PERIODO DE VIGENCIA DEL CONTRATO. Por tanto, sÃ³lo estarÃ¡n cubiertas las AVERÃ�A/AS que tenga el VEHÃ�CULO durante la vigencia del contrato.
    
No cabe la prÃ³rroga tÃ¡cita del contrato.
    
    
    
    
    
    
4.- PERFECCIÃ“N Y EFECTOS DEL CONTRATO:
    
El contrato se perfecciona por el consentimiento manifestado con la firma del presente documento. No obstante, lo anterior, las garantÃ­as contratadas no tendrÃ¡n efectos, y por tanto no generarÃ¡n obligaciones para GRUPO AUTO WARRANTY, S.A DE C.V., hasta que el CONTRATANTE no haya satisfecho la totalidad del precio del contrato de garantÃ­a mecÃ¡nica.
    
En caso de demora en el pago del precio, las obligaciones de GRUPO AUTO WARRANTY, S.A DE C.V.. comenzarÃ¡n a las 24 horas del pago del precio, y siempre con efectos para AVERÃ�A/AS surgidas con posterioridad al pago del mismo.
    
Si transcurridas 48 horas desde la firma del presente documento, el CONTRATANTE no hubiera pagado el precio, GRUPO AUTO WARRANTY, S.A DE C.V.. se reserva el derecho a dejar sin efecto el presente contrato, o a exigir el pago del mismo.
    
5.- DELIMITACIÃ“N GEOGRÃ�FICA:
    
La garantÃ­a objeto del presente contrato se extiende y limita a las AVERÃ�A/AS que tengan lugar dentro de la RepÃºblica Mexicana.
    
6.- OBLIGACIONES DEL CONTRATANTE:
    
El CONTRATANTE, en relaciÃ³n con el presente contrato, tiene las siguientes obligaciones:
    
        1.	Pagar a GRUPO AUTO WARRANTY, S.A DE C.V.. el precio del contrato de garantÃ­a, y el I.V.A. correspondiente a dicho precio.
        2.	Con anterioridad a la venta del VEHÃ�CULO al BENEFICIARIO, deberÃ¡ revisar el VEHÃ�CULO, y en caso de que el mismo tenga cualquier tipo de averÃ­a, tendrÃ¡ la obligaciÃ³n de repararla antes de la venta.
        3.	DeberÃ¡ poner en conocimiento del BENEFICIARIO y de GRUPO AUTO WARRANTY, S.A DE C.V.. todas las reparaciones realizadas en el VEHÃ�CULO, asÃ­ como si el mismo ha tenido algÃºn accidente o siniestro.
                4.	DeberÃ¡ entregar el VEHÃ�CULO al BENEFICIARIO en perfectas condiciones de uso y mantenimientos, acordes con el kilometraje y antigÃ¼edad del mismo, haciÃ©ndose responsable de aplicar la garantÃ­a en los primeros 90 dÃ­as de vigencia del presente contrato.
7.- OBLIGACIONES DEL BENEFICIARIO:
    
El BENEFICIARIO, en relaciÃ³n con el presente contrato, tiene las siguientes obligaciones:
    
        1.	Comunicar a GRUPO AUTO WARRANTY, S.A DE C.V.. todas las AVERÃ�A/AS que tenga el VEHÃ�CULO durante el periodo de vigencia del contrato.
        2.	En caso de AVERÃ�A/AS, seguir estrictamente el PROCEDIMIENTO EN CASO DE AVERÃ�A/AS descrito en el presente contrato,.
        3.	Realizar en el VEHÃ�CULO los mantenimientos periÃ³dicos exigidos tanto por el fabricante del VEHÃ�CULO como por GRUPO AUTO WARRANTY,
        S.A DE C.V..
        4.	Conservar las facturas correspondientes a los trabajos o reparaciones de mantenimiento descritos en el apartado anterior.
        5.	Hacer un uso del VEHÃ�CULO razonable a las caracterÃ­sticas del mismo.
        6.	En caso de AVERÃ�A/AS, no agravar la misma por un uso inadecuado o negligente del VEHÃ�CULO.
    
8.- OBLIGACIONES DE GRUPO AUTO WARRANTY, S.A. DE C.V.:
    
GRUPO AUTO WARRANTY, S.A DE C.V.., en relaciÃ³n con el presente contrato, tiene la obligaciÃ³n de, en los tÃ©rminos y con los lÃ­mites fijados en el mis- mo, hacerse cargo de la reparaciÃ³n de las AVERÃ�A/AS cubiertas, que dentro del periodo de vigencia del contrato pueda tener el VEHÃ�CULO, siempre y cuando dichas AVERÃ�AS no traigan causa en un uso inadecuado del VEHÃ�CULO, o en el deterioro y/o desgaste normal del mismo.
    
Se hace especial menciÃ³n, que Grupo Auto Warranty, S.A. de C.V., procederÃ¡ a evaluar, canalizar al taller correspondiente para su diagnÃ³stico y en su caso y de proceder, aprobar la reparaciÃ³n del vehÃ­culo, a partir del cuarto mes de vigencia del presente contrato o despuÃ©s de 90 dÃ­as naturales, ya que antes de este periodo, es decir antes de los primeros 90 dÃ­as, corresponderÃ¡ a EL CONTRATANTE, el proceso de aplicaciÃ³n de la garantÃ­a.
    
    
    
    
    
    
    
    
    
9.- MANTENIMIENTOS PERIÃ“DICOS:
    
Para que el presente contrato sea efectivo, el BENEFICIARIO se obliga a efectuar en el VEHÃ�CULO los trabajos o tareas de mantenimiento exigidas por GRUPO AUTO WARRANTY, S.A DE C.V.. que a continuaciÃ³n se detallan, TANTO PARA NUEVOS COMO PARA SEMINUEVOS:
    
        â€¢	NUEVOS: Para que el contrato sea efectivo, el propietario del vehÃ­culo y titular del contrato, se compromete a efectuar las inspecciones requeridas POR EL FABRICANTE SIGUIENDO SU PLAN DE MANTENIMIENTO PROGRAMADO, tanto en periodos de tiempo como en kilometraje.
        â€¢	SEMINUEVOS O AUTOS CUYO PERIODO DE GARANTÃ�A DE FÃ�BRICA HAYA TERMINADO: Para que el contrato sea efectivo, el propietario del ve- hÃ­culo y titular del contrato, se compromete a efectuar las revisiones requeridas por Grupo Auto Warranty, S.A de C.V.. Estas revisiones se tendrÃ¡n que hacer en periodos de 6 meses o 10,000 kilÃ³metros, lo que antes ocurra. Incluso si este periodo resultara ser inferior a lo indicado por el fabri- cante del auto. Las revisiones mÃ­nimas consistirÃ¡n en cambio de Aceite Motor, Filtro de Aceite y VerificaciÃ³n de Fugas, Ruidos y Holguras. Todos estos mantenimientos y revisiones deberÃ¡n realizarse en Distribuidores Autorizados por el FABRICANTE DEL AUTO. El contrato quedarÃ¡ invali- dado por cualquier mantenimiento, intervenciÃ³n o reparaciÃ³n no realizada dentro de un distribuidor Autorizado por el FABRICANTE DEL AUTO.
        â€¢	El Beneficiario deberÃ¡ conservar su carnet de mantenimiento debidamente sellado por el Distribuidor, indicando cada mantenimiento, reparaciÃ³n o revisiÃ³n con el kilometraje correspondiente, asÃ­ mismo deberÃ¡ conservar las facturas que lo amparen. Para comprobar que el Beneficiario hizo sus mantenimientos serÃ¡n igualmente vÃ¡lidos el carnet de mantenimiento sellado por el Distribuidor o la factura de su Ãºltimo mantenimiento en tiempo y forma.
    
El incumplimiento de cualquiera de los requisitos anteriores invalidarÃ¡ este contrato.
    
10.- PROCEDIMIENTO EN CASO DE AVERÃ�A/AS:
En caso de AVERÃ�A/AS del VEHÃ�CULO, y para que la misma quede cubierta por el presente contrato de garantÃ­a, se deberÃ¡ seguir, obligatoriamente, el siguiente procedimiento:
    
1.	En cuanto tenga conocimiento de la AVERÃ�A/AS, el BENEFICIARIO comunicarÃ¡ la misma a GRUPO AUTO WARRANTY, S.A DE C.V.., por cualqui- era de los siguientes medios: i) Por correo electrÃ³nico, a la direcciÃ³n atencion@autowarranty.mx.
    
2.	En dicha comunicaciÃ³n el BENEFICIARIO deberÃ¡ facilitar a GRUPO AUTO WARRANTY, S.A DE C.V.., al menos, la siguiente informaciÃ³n: i) NÂº de GarantÃ­a MecÃ¡nica, ii) Placas del VEHÃ�CULO, iii) DeclaraciÃ³n de la AVERÃ�A/AS, iv) Lugar en el que se ha producido la AVERÃ�A/AS y v) Taller en el que estÃ¡ el VEHÃ�CULO. En caso de que el VEHÃ�CULO no estÃ© todavÃ­a en ningÃºn taller, podrÃ¡ solicitar a GRUPO AUTO WARRANTY, S.A DE C.V.,que le indique un taller en el que dejar el VEHÃ�CULO.
    
3.	Una vez el VEHÃ�CULO estÃ© en un taller, el responsable del mismo volverÃ¡ a contactar con GRUPO AUTO WARRANTY, S.A DE C.V.., para describir la AVERÃ�A/AS, por los mismos medios descritos en la letra anterior, debiendo aportar igualmente la siguiente documentaciÃ³n:
    
        a.	Orden de entrada del VEHÃ�CULO, que contenga, al menos, la fecha de entrada del mismo, los kilÃ³metros del VEHÃ�CULO y descripciÃ³n de la averÃ­a.
        b.	Presupuesto aproximado de la reparaciÃ³n, QUE DEBERÃ� REALIZARSE SIN INTERVENIR NI DESMONTAR EL VEHÃ�CULO.
        c.	Copia del Libro de Mantenimiento del VEHÃ�CULO (Si dispone del mismo).
        d.	Copia de las facturas de las inspecciones que indica Grupo Auto Warranty, S.A de C.V., S.A.P.I DE C.V., en el VEHÃ�CULO. Dichas facturas, de conformidad con la normativa vigente, deberÃ¡n tener el siguiente detalle:
                i.	NÃºmero de taller, segÃºn registro especial.
                ii.	IdentificaciÃ³n del mismo: DenominaciÃ³n Social, R.F.C., domicilio fiscal, domicilio a efectos de notificaciones, etc.
                iii.	IdentificaciÃ³n del VEHÃ�CULO con expresiÃ³n de la marca, modelo, PLACA y nÃºmero de kilÃ³metros.
                iv.	Reparaciones incluidas en la factura, desglosando las piezas sustituidas y la mano de obra empleada.
                v.	Fecha y firma o sello del taller.
                vi.	Fecha de entrega del VEHÃ�CULO.
    
4.	Hasta que la reparaciÃ³n de la AVERÃ�A/AS no estÃ© autorizada por GRUPO AUTO WARRANTY, S.A DE C.V.., no se podrÃ¡ realizar en el mismo ningÃºn tipo de desmontaje, montaje, reparaciÃ³n y/o intervenciÃ³n; a no ser que GRUPO AUTO WARRANTY, S.A DE C.V.. lo requiera para poder determi- nar el origen de la averÃ­a. Cualquier autorizaciÃ³n a trabajar sobre el vehÃ­culo para efectuar (pruebas, desmontajes, diagnosis, etc.) anterior a la aceptaciÃ³n de la averÃ­a parte de GRUPO AUTO WARRANTY, S.A DE C.V.., siempre tendrÃ¡ que ser dada por el propietario del vehÃ­culo. El VEHÃ�CU- LO tendrÃ¡ que permanecer inmovilizado hasta que GRUPO AUTO WARRANTY, S.A DE C.V.., resuelva el expediente.
    
    
    
    
    
    
    
    
    
5.	Una vez GRUPO AUTO WARRANTY, S.A DE C.V.., haya recibido la documentaciÃ³n indicada en los apartados anteriores, GRUPO AUTO WARRAN- TY, S.A DE C.V.., estudiarÃ¡ el asunto y decidirÃ¡ sobre la necesidad de realizar un desmontaje para determinar la causa de la AVERÃ�A/AS. GRUPO AUTO WARRANTY, S.A DE C.V.,se compromete a resolver por escrito y motivadamente el expediente , autorizando o rechazando la reparaciÃ³n de la averÃ­a en el plazo mÃ¡ximo de 48 horas (que no incluirÃ¡n domingos ni festivos) a contar desde la recepciÃ³n de la documentaciÃ³n o posterior al desmontaje en caso de existir. La resoluciÃ³n escrita del expediente a la que se hace referencia en este pÃ¡rrafo serÃ¡ remitida por GRUPO AUTO
    
WARRANTY, S.A DE C.V.. al taller desde el que se remitiÃ³ la documentaciÃ³n sobre la AVERÃ�A/AS. En caso de que no se siga el procedimiento seÃ±alado o la reparaciÃ³n de la AverÃ­a no se encuentre cubierta por el presente Contrato el costo del desmontaje, montaje y/o intervenciÃ³n serÃ¡n cubiertos por el Cliente, el propietario del VehÃ­culo o el Beneficiario.
6.	En caso de que la reparaciÃ³n de la AVERÃ�A/AS sea aceptada por GRUPO AUTO WARRANTY, S.A DE C.V.., en la resoluciÃ³n por escrito del expedi- ente se detallarÃ¡n las reparaciones o trabajos que habrÃ¡ que efectuar sobre el VEHÃ�CULO para la reparaciÃ³n de la AVERÃ�A/AS, asÃ­ como la valo- raciÃ³n de dichas actuaciones. En ningÃºn caso GRUPO AUTO WARRANTY, S.A DE C.V.. se harÃ¡ cargo de trabajos o reparaciones no autorizadas en la resoluciÃ³n escrita del expediente.
7.	Una vez autorizada la reparaciÃ³n del VEHÃ�CULO por GRUPO AUTO WARRANTY, S.A DE C.V.., el taller realizarÃ¡ las reparaciones autorizadas por GRUPO AUTO WARRANTY, S.A DE C.V..
8.	Una vez reparado el VEHÃ�CULO por el taller, Ã©ste enviarÃ¡ a GRUPO AUTO WARRANTY, S.A DE C.V.. el original de la factura de reparaciÃ³n debid- amente firmada por el BENEFICIARIO, que incluirÃ¡ Ãºnicamente las reparaciones autorizadas por GRUPO AUTO WARRANTY, S.A DE C.V.., y que nunca podrÃ¡ ser de un importe superior a la valoraciÃ³n de la reparaciÃ³n realizada por GRUPO AUTO WARRANTY, S.A DE C.V.., en su informe de resoluciÃ³n del expediente. Junto con la factura, el taller deberÃ¡ remitir a GRUPO AUTO WARRANTY, S.A DE C.V.., una copia firmada por el BENE- FICIARIO del informe de resoluciÃ³n del expediente.
9.	La factura de reparaciÃ³n emitida por el taller deberÃ¡ estar a nombre de GRUPO AUTO WARRANTY, S.A DE C.V.. como destinatario de la misma.
10.	Una vez GRUPO AUTO WARRANTY, S.A DE C.V.., haya recibida toda la documentaciÃ³n a la que se hace referencia en las letras anteriores, proced- erÃ¡ al pago de la factura de reparaciÃ³n, en el plazo de 15 dÃ­as recepciÃ³n factura.
11.	En el caso de que el presupuesto de reparaciÃ³n de la AVERÃ�A/AS realizado por el taller sea superior al valor de la reparaciÃ³n autorizada por GRUPO AUTO WARRANTY, S.A DE C.V.., el BENEFICIARIO podrÃ¡ optar por: i) Llevar el VEHÃ�CULO al taller que le indique GRUPO AUTO WARRANTY, S.A DE C.V.. para realizar la reparaciÃ³n tal como la misma haya sido autorizada en el informe de resoluciÃ³n del expediente, corriendo a costa del BEN- EFICIARIO todos los gastos de desplazamiento del VEHÃ�CULO, o ii)Reparar el VEHÃ�CULO segÃºn el presupuesto del taller. En este caso, el BENEFI- CIARIO deberÃ¡ aceptar expresamente y por escrito que la diferencia entre el presupuesto dado por el taller y la valoraciÃ³n de la reparaciÃ³n de la AVERÃ�A/AS autorizada por GRUPO AUTO WARRANTY, S.A DE C.V.., correrÃ¡ Ã­ntegramente a su cargo. En este caso, el taller deberÃ¡ confeccionar dos facturas, una por un importe igual a la valoraciÃ³n de la reparaciÃ³n de la AVERÃ�A/AS autorizada por GRUPO AUTO WARRANTY, S.A DE C.V.., que deberÃ¡ entregar a GRUPO AUTO WARRANTY, S.A DE C.V..; y otra, que deberÃ¡ entregar al BENEFICIARIO, por la diferencia asumida por Ã©ste.
12.	GRUPO AUTO WARRANTY, S.A DE C.V.., se reserva el derecho a utilizar los medios de reparaciÃ³n que considere oportunos, asÃ­ como el derecho a proporcionar las piezas que deban sustituirse o repararse en la reparaciÃ³n autorizada.
    
11.- LÃ�MITES DEL CONTRATO:
    
AdemÃ¡s de los lÃ­mites del contrato seÃ±alados en la HOJA RESUMEN DE CONTRATO DE GARANTÃ�A MECÃ�NICA, en su apartado DATOS GENERALES, la valoraciÃ³n de la reparaciÃ³n de la AVERÃ�A/AS del VEHÃ�CULO nunca podrÃ¡ superar el valor de venta del VEHÃ�CULO que marque el libro azul que es la guÃ­a que indica los precios del VEHÃ�CULO correspondiente al aÃ±o de la venta. En caso de que la valoraciÃ³n de la reparaciÃ³n de la AVERÃ�A/AS supere el valor de venta del VEHÃ�CULO, GRUPO AUTO WARRANTY, S.A DE C.V.. pagarÃ¡ al BENEFICIARIO con una cuantÃ­a igual a la menor de las cantidades siguientes: i) el LÃ­mite por AVERÃ�A/AS del presente contrato, ii) el LÃ­mite del contrato o iii) el valor de venta del VEHÃ�CULO.
    
En caso de que el VEHÃ�CULO no estÃ© en los boletines identificados en el pÃ¡rrafo anterior, el valor de venta del VEHÃ�CULO se calcularÃ¡ sobre la base del valor medio de mercado excluyendo del muestreo tanto el valor mÃ¡s bajo como el valor mÃ¡s elevado. Este cÃ¡lculo serÃ¡ realizado por un evaluador libremente elegido por GRUPO AUTO WARRANTY, S.A DE C.V.., asumiendo Ã©sta los costos de dicha valoraciÃ³n.
    
12.- EXCLUSIONES GENERALES DEL CONTRATO:
    
GRUPO AUTO WARRANTY, S.A DE C.V.. podrÃ¡ rechazar la reparaciÃ³n, y/o en su caso el pago de la AVERÃ�A/AS en los siguientes supuestos:
    
        1.	Cuando se haya realizado cualquier tipo de trabajo sobre el VEHÃ�CULO antes de la resoluciÃ³n del expediente por GRUPO AUTO WARRANTY,
        S.A DE C.V..
    
    
    
    
    
        2.	Cuando el VEHÃ�CULO no haya permanecido inmovilizado en el taller desde la comunicaciÃ³n de la AVERÃ�A/AS hasta la resoluciÃ³n del expediente por GRUPO AUTO WARRANTY, S.A DE C.V..
        3.	Cuando el BENEFICIARIO no haya cumplido sus obligaciones en relaciÃ³n con los mantenimientos e inspecciones exigidas en el presente contrato.
        4.	Cuando el carnet de mantenimientos debidamente sellado o las facturas correspondientes a los mantenimientos periÃ³dicos o cualquier docu- mentaciÃ³n exigida dentro del Articulo 10.-PROCEDIMIENTO EN CASO DE AVERÃ�AS/AS del presente contrato, no estÃ©n debidamente cumplimen- tadas, o directamente no se aporten a GRUPO AUTO WARRANTY, S.A DE C.V.., en un plazo de 48 horas tras ser requeridas.
        5.	Cuando se detecte que los kilÃ³metros de inicio del contrato no guardan relaciÃ³n con los kilÃ³metros de la averÃ­a o mantenimiento del vehÃ­culo. Esta exclusiÃ³n serÃ¡ motivo de recesiÃ³n del contrato.
        6.	Cuando la AVERÃ�A/AS haya sido comunicada a GRUPO AUTO WARRANTY, S.A DE C.V.., transcurrido el plazo de duraciÃ³n del contrato, aun cuan- do la AVERÃ�A/AS haya acontecido con anterioridad a su expiraciÃ³n
        7.	Cuando haya habido cualquier tipo de incumplimiento por parte del CONTRATANTE o del BENEFICIARIO.
    
13.- OPERACIONES NO INCLUÃ�DAS EN LA GARANTÃ�A OBJETO DEL PRESENTE CONTRATO:
    
No estarÃ¡n cubiertas por la garantÃ­a objeto del presente contrato, y por tanto GRUPO AUTO WARRANTY, S.A DE C.V.., no estarÃ¡ obligada a reparar ni a realizar el pago de las siguientes:
    
        1.	AVERÃ�A/AS y/o defectos previsibles y/o preexistentes a la contrataciÃ³n de la garantÃ­a.
        2.	AVERÃ�A/AS cuya causa era evidente en el momento en que estaba en vigor la garantÃ­a del fabricante, independientemente del momento en que Ã©sta se hubiere ocasionado.
        3.	AVERÃ�A/AS que sean consecuencia de una mala reparaciÃ³n anterior.
        4.	La sustituciÃ³n, reparaciÃ³n, ajustes o reglajes sobre piezas que hayan llegado al final de su vida Ãºtil como consecuencia de su funciÃ³n y usabilidad natural.
        5.	Los daÃ±os ocasionados por erosiÃ³n, corrosiÃ³n, deformaciÃ³n, oxidaciÃ³n, descomposiciÃ³n, herrumbre e incrustaciones, asÃ­ como elementos que hayan perdido su morfologÃ­a inicial (bujes, gomas, soportes, juntas, mangueras, retenes)
        6.	La sustituciÃ³n de lubricantes y otros aditivos, bujÃ­as, bujÃ­as de encendido, filtros, cartuchos, aceites, juntas, carburantes, cargas de a/a, fugas de aceite, fugas de refrigerante o fugas de combustible, neumÃ¡ticos, amortiguadores, discos de freno, pastillas de freno, correas de distribuciÃ³n, escapes, catalizadores, baterÃ­a, plumas limpiaparabrisas, en definitiva, cualquier elemento consumible.
        7.	Las actualizaciones, programaciones o cargas de software de cualquier mÃ³dulo electrÃ³nico del vehÃ­culo.
        8.	Los costos de diagnÃ³stico cuando las averÃ­as no queden cubiertas por Grupo Auto Warranty, S.A. de  C.V.
        9.	AVERÃ�A/AS causadas por elementos no garantizados.
        10.	Las operaciones de mantenimiento periÃ³dicas, de carÃ¡cter preventivo.
        11.	Los controles y/o reglajes, con o sin cambio de piezas.
        12.	AverÃ­as motivadas por defectos de serie, diseÃ±o defectuoso, vicios ocultos, fallo epidÃ©mico, campaÃ±as del fabricante.
        13.	Cualquier daÃ±o sobre piezas garantizadas que se haya producido por la alteraciÃ³n o modificaciÃ³n de la especificaciÃ³n del fabricante.
        14.	Las AVERÃ�A/AS ocasionadas por seguir circulando cuando con los indicadores de averÃ­a, incidencia o alarma indiquen un mal funcionamiento. 15.Las AVERÃ�A/AS ocasionadas por mal uso o negligencia de utilizaciÃ³n del vehÃ­culo por parte del propietario del titular del contrato.
        16.	Las AVERÃ�A/AS ocasionadas por el uso del vehÃ­culo en competiciones.
        17.	Las AVERÃ�A/AS ocasionadas por sobrecarga.
        18.	Las AVERÃ�A/AS ocasionadas por el uso de agentes abrasivos.
        19.	Las AVERÃ�A/AS ocasionadas por un accidente, robo, tentativa de robo, incendio, explosiÃ³n, vandalismo o catÃ¡strofes naturales.
        20.	Las piezas que sean cambiadas en el momento de la reparaciÃ³n sin que hayan fallado. 21.Cualquier intervenciÃ³n efectuada â€œin situâ€� por cualquier servicio de asistencia en carretera.
        22.	Los servicios de grÃºa, remolque y gastos de transporte sobre el VEHÃ�CULO y ocupantes.
        23.	AverÃ­as producidas por combustibles o lubricantes no conformes con las indicaciones del fabricante o con alto grado de agua o contami- naciÃ³n de otros elementos quÃ­micos.
        24.	SustituciÃ³n, mantenimiento o reparaciÃ³n de accesorios o piezas no montados de origen, aun siendo elementos garantizados.
        25.	NingÃºn servicio de grÃºa.
        26.	Gastos de estacionamiento y/o almacenamiento del VEHÃ�CULO hasta su reparaciÃ³n.
        27.	DaÃ±os o pÃ©rdidas ocasionadas como consecuencia de la AVERÃ�A/AS o el retraso en su reparaciÃ³n.
        28.	Lucro cesante por no poder utilizar el VEHÃ�CULO.
        29.	Los daÃ±os a terceros que traigan causa en la AVERÃ�A/AS.
    
    
    
    
    
    
14.-DEVOLUCIONES:
En caso de rescisiÃ³n anticipada del contrato por causas ajenas a GRUPO AUTO WARRANTY, S.A DE C.V.., Ã©sta no estarÃ¡ obligada a la devoluciÃ³n del precio.
    
15.- HOJA RESUMEN DEL CONTRATO DE GARANTÃ�A MECÃ�NICA:
La HOJA RESUMEN DEL CONTRATO DE GARANTÃ�AS MECÃ�NICAS forma parte integrante del presente contrato, y tiene fuerza vinculante para los firmantes.
    
16.- AVISOS
Las partes acuerdan que en caso de que llegasen, por cualquier motivo, a mudarse del domicilio que indicaron en este contrato, deberÃ¡n hacÃ©rselo saber a la otra parte con 30 dÃ­as naturales de anticipaciÃ³n a que efectuaren el cambio respectivo.
    
    
17.- RESCISIÃ“N:
SerÃ¡n causa de rescisiÃ³n automÃ¡tica del presente contrato el incumplimiento a cualquiera de las obligaciones establecidas en el presente contrato.
    
    
18.- SUMISIÃ“N EXPRESA:
LA LEGISLACION APLICABLE, DE LA JURISDICCION Y DE LOS TRIBUNALES COMPETENTES: Siendo el presente
contrato de naturaleza mercantil, las partes convienen que para todo lo no previsto en Ã©l, se sujetarÃ¡n a lo dispuesto en el CÃ³digo de Comercio, asÃ­ mismo para el conocimiento de cualquier controversia que llegare a suscitarse con motivo de la interpretaciÃ³n del presente contrato, las partes se som- eten a la jurisdicciÃ³n de los Tribunales de la Ciudad de Aguascalientes, Ags. renunciando expresamente al fuero que pudiera corresponderles, en razÃ³n de sus domicilios presentes o futuros o bien, por cualquier otra causa. Manifestando el proveedor que en el presente contrato no existen prestaciones desproporcionadas, inequitativas o abusivas, o cualquier otra clÃ¡usula o texto que viole las disposiciones de la Ley Federal de ProtecciÃ³n al Consumidor, las Normas Oficiales Mexicanas y demÃ¡s ordenamientos aplicables.
Los Derechos y obligaciones como Cliente se rigen por las clÃ¡usulas del presente Contrato y en los tÃ©rminos seÃ±alados por la Ley Federal de ProtecciÃ³n al Consumidor.
    
19.- PROTECCIÃ“N DE DATOS:
Con fundamento en la Ley Federal de ProtecciÃ³n de datos Personales en PosesiÃ³n de los Particulares, publicada en el Diario Oficial de la FederaciÃ³n el dÃ­a 05 de Julio de 2010, los datos personales proporcionados entre las partes, en este acto serÃ¡n tratados conforme a lo estipulado por la Ley antes seÃ±alada, los cuales no podrÃ¡n ser transferidos a persona alguna, pero en cumplimiento de los ordenamientos legales, la informaciÃ³n serÃ¡ guardada en el archivo correspondiente a cada una de las partes asÃ­ como en la documentaciÃ³n adjunta y serÃ¡ proporcionada exclusivamente a las Autoridades que deban conocer del presente contrato celebrado entre las partes.
La informaciÃ³n y archivos son propiedad exclusiva de GRUPO AUTO WARRANTY, S.A DE C.V.., extendiÃ©ndose tambiÃ©n esta titularidad a cuantas elab- oraciones, evaluaciones, segmentaciones o procesos similares que, en relaciÃ³n con los mismos, realice, GRUPO AUTO WARRANTY, S.A DE C.V.., de acuerdo con los servicios que se pactan en el presente Contrato, declarando las partes que esta informaciÃ³n es confidencial para todos los efectos, sujetos en consecuencia al mÃ¡s estricto secreto profesional, incluso una vez finalizada la presente relaciÃ³n contractual.
LeÃ­do que fue el presente contrato, asÃ­ como enteradas las partes de su contenido y alcances legales, lo firman por duplicado en ".$row['localidadAgencia'].", ".$row['estadoAgencia'].", ".$row['fechaInicio'].".
    
    
    
    
                                               ".$row['nombreCliente']."
                                      ------------------------------------------------------------------                                                           -------------------------------------------------------------
                                                NOMBRE Y FIRMA BENEFICIARIO                                                                                             CONTRATANTE
    
    
    
    
                                                                                                       ________________________________
                                                                                                         GRUPO AUTO WARRANTY SA DE CV"),0,'L',0);


$pdf->Image('dist/img/sign.png',90,219,33);
$pdf->Multicell(190,5,utf8_decode('______________________________________________________________________________________________
    
    
    
    
    
    
'),0,'C',0);

$pdf->Image('dist/img/talleres.png',9,55,200);
//$pdf->Cell(350,4,"Fecha: ".$fechaa,0,0,'R');

// $pdf->Multicell(190,12,utf8_decode('ATENTAMENTE'),0,'c',0);

// $image4='dist/img/logo.png';
// //$pdf->Cell( 190, 20, $pdf->Image($image4, $pdf->GetX(), $pdf->GetY(), 72), 1, 1, 'L', false );
// $pdf->Cell(190,40,$pdf->Image($image4,$pdf->GetX(),$pdf->GetY(),72),0,1,'L',false);

// $pdf->Multicell(190,7,utf8_decode('

// XXXX XXXXXXXXX XXXXXXX
// XXXXXXXXX XXXXXX XXXXXX
// XXXXXXXX XXXXXX XXXXXX

// '),0,'L',0);

$pdf->Output();
?>