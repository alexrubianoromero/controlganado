<?php

// $raiz= $_SERVER['DOCUMENT_ROOT'];
date_default_timezone_set('America/Bogota');
$ruta = dirname(dirname(dirname(__FILE__)));
//  die($ruta); 
require_once($ruta.'/fpdf/fpdf.php');
require_once($ruta.'/ganado/models/GanadoModel.php'); 

// require_once($ruta .'/orden/modelo/OrdenesModelo.class.php');
// require_once($ruta .'/inventario_codigos/modelo/CodigosInventarioModelo.php');

// $orden = new OrdenesModelo();
// $infoCode = new CodigosInventarioModelo();
// // $vehiculo = new VehiculosModelo(); 
// $datoOrden = $orden->traerOrdenId($_REQUEST['idOrden']);
// $datosCarro = $orden->traerDatosCarroConPlaca($datoOrden['placa']);
// $datosCliente = $orden->traerDatosPropietarioConPlaca($datosCarro['propietario']); 
// $datosItems = $orden->traerItemsAsociadosOrdenPorIdOrden($_REQUEST['idOrden']); 

$model = new GanadoModel();
$ganado = $model->traerGanadoPorGenero($_REQUEST['tipo']);
$pdf=new FPDF();

$pdf->AddPage();
//     $pdf->Image('speeddesign.jpeg',23,8,33);

    $pdf->SetFont('Arial','B',15);
//     // Movernos a la derecha
//     $pdf->Cell(80);
//     // T�tulo

$fecha_hoy= date("d/m/Y");
    $pdf->Cell(190,10,$_REQUEST['titulo'].' Fecha:'.$fecha_hoy,0,1,'C');
//     $pdf->Cell(19,10,$datoOrden['orden'],1,1,'');

    
// $pdf->Cell(80);

function dias_pasados($fecha_inicial,$fecha_final)
{
    $dias = (strtotime($fecha_inicial)-strtotime($fecha_final))/86400;
    $dias = abs($dias); $dias = floor($dias);
    return $dias;
}

/////////////////////////
$totalMachos = 0; 
$menores3Meses = 0; 
$de3A9Meses = 0; 
$de9A12Meses = 0; 
$de1A2Anos = 0;
$de2A3Anos = 0;
$mayora3anos=0;
$entre3y5Anos = 0; 
$mayores5anos = 0;
$totalGanado =0;

$fecha_actual= date("Y/m/d");
    foreach($ganado as $macho) //macho tambien es para hembras 
    {
            $fecha_dada= $macho['fechaNacimiento'];
            $dias = dias_pasados($fecha_dada,$fecha_actual);
            if($dias < 90){
                $stringMenores3Meses .= '/'.$macho['codigo'];
                $menores3Meses = $menores3Meses +1; 
            }

            if($dias >= 90 && $dias < 270){
                $stringde3A9Meses  .= '/'.$macho['codigo'];
                $de3A9Meses = $de3A9Meses +1; 
            }

            if($dias >= 270 && $dias < 360){
                $stringde9A12Meses .= ' /'.$macho['codigo'];
                $de9A12Meses = $de9A12Meses +1; 
            }
            if($dias >=360 && $dias < 720){
                $stringde1A2Anos .= '/'.$macho['codigo'];
                $de1A2Anos = $de1A2Anos +1; 
            }
            if($dias >=720 && $dias <= 1095){
                $stringde2A3Anos .= '/'.$macho['codigo'];
                $de2A3Anos = $de2A3Anos +1; 
            }
            if($dias >1095 ){
                $stringmasde3anos .= '/'.$macho['codigo'];
                $mayora3anos = $entre3y5Anos +1; 
            }

            $totalMachos = $totalMachos +1; 
            if($dias >1095 && $dias < 1825){
                $stringmasde3A5Anos .= '/'.$macho['codigo'];
                $entre3y5Anos = $entre3y5Anos +1; 
            }
            $totalMachos = $totalMachos +1; 

            if($dias >1825){
                $stringmayores5anos .= '/'.$macho['codigo'];
                $mayores5anos = $mayores5anos +1; 
            }
            $totalMachos = $totalMachos +1; 
    }

    
    $totalGanado = $menores3Meses + $de3A9Meses + $de9A12Meses + $de1A2Anos + $de2A3Anos ;
    if($_REQUEST['tipo'] == 1)
    {
        $totalGanado = $totalGanado +$mayora3anos;
    }
    if($_REQUEST['tipo']  == 2)
    {
        $totalGanado = $totalGanado + $entre3y5Anos + $mayores5anos;
    }
//////////////////////////

$anchoColumna = '110';
$altoFilas = 8;
$altoColumnaReporte = 6;
$espacioEntreEdades= 7;

$pdf->SetFont('Arial','',12);

$pdf->Ln(5);
$pdf->Cell(40,6,'EDAD',0,0,'C');
$pdf->Cell(30,6,'CANTIDAD',0,0,'C');
$pdf->Cell($anchoColumna,6,'NOMBRE BOVINOS',0,1,'C');

$pdf->SetFont('Arial','',10);

// $nuevoAlto = $altoColumnaReporte;

// $filas = $menores3Meses/6;
// if($filas <= 0){ $filas == 1;}
// $filas = round($filas); 
// $arrayGanado =  explode( '/', $stringMenores3Meses ); 
// $tamanoArreglo= sizeof($arrayGanado); 
// for($i = 1 ; $i< $tamanoArreglo;$i++)
// {
//     if($i%6 == 0)
//     {
//         $nuevoArreglo .='/'.$arrayGanado[$i];
//     }
//     else{
//         $nuevoArreglo .='/'.$arrayGanado[$i];

//     }
// } 
$pdf->Ln(5);
$pdf->Cell(40,$altoColumnaReporte,'MENOR A 3 MESES',0,0,'l');
$pdf->Cell(30,$altoColumnaReporte,$menores3Meses,0,0,'C');
$pdf->MultiCell($anchoColumna,$altoColumnaReporte,$stringMenores3Meses,0,1,'J');



// $longitud = strlen($stringde3A9Meses);
// $filas = $longitud/$anchoColumna;
// $filas = round($filas); 
// $nuevoAlto = (($filas *$altoColumnaReporte)*2)+6;

$pdf->Ln($espacioEntreEdades);
$pdf->Cell(40,$altoColumnaReporte,'DE 3 HASTA 9 MESES',0,0,'l');
$pdf->Cell(30,$altoColumnaReporte,$de3A9Meses,0,0,'C');
$pdf->MultiCell($anchoColumna,$altoColumnaReporte,$stringde3A9Meses,0,1,'J');


$pdf->Ln($espacioEntreEdades);
$pdf->Cell(40,6,'DE 9 HASTA 12 MESES',0,0,'l');
$pdf->Cell(30,6,$de9A12Meses,0,0,'C');
$pdf->MultiCell($anchoColumna,$altoColumnaReporte,$stringde9A12Meses,0,1,'C');

$pdf->Ln($espacioEntreEdades);
$pdf->Cell(40,6,'DE 1 HASTA 2 ANOS',0,0,'l');
$pdf->Cell(30,6, $de1A2Anos,0,0,'C');
$pdf->MultiCell($anchoColumna,$altoColumnaReporte,$stringde1A2Anos,0,1,'C');


$pdf->Ln($espacioEntreEdades);
$pdf->Cell(40,6,'DE 2 HASTA 3 ANOS',0,0,'l');
$pdf->Cell(30,6, $de2A3Anos,0,0,'C');
$pdf->MultiCell($anchoColumna,$altoColumnaReporte,$stringde2A3Anos,0,1,'C');

if($_REQUEST['tipo'] == 1)
{
    $pdf->Ln($espacioEntreEdades);
    $pdf->Cell(40,6,'MAYORES DE 3 ANOS',0,0,'l');
    $pdf->Cell(30,6,  $mayora3anos,0,0,'C');
    $pdf->MultiCell($anchoColumna,$altoColumnaReporte,  $stringmasde3anos,0,1,'C');
}

if($_REQUEST['tipo'] == 2)
{
    $pdf->Ln($espacioEntreEdades);
    $pdf->Cell(40,6,'DE 3 HASTA 5 ANOS',0,0,'l');
    $pdf->Cell(30,6, $entre3y5Anos,0,0,'C');
    $pdf->MultiCell($anchoColumna,$altoColumnaReporte, $stringmasde3A5Anos,0,1,'C');
    
    $pdf->Ln($espacioEntreEdades);
    $pdf->Cell(40,6,'MAYORES A 5 ANOS',0,0,'l');
    $pdf->Cell(30,6, $mayores5anos,0,0,'C');
    $pdf->MultiCell($anchoColumna,$altoColumnaReporte,  $stringmayores5anos,0,1,'C');
    
}

$pdf->Ln($espacioEntreEdades);
$pdf->Cell(40,6,'TOTAL',0,0,'l');
$pdf->Cell(30,6, $totalGanado,0,0,'C');
$pdf->Cell($anchoColumna,6,'',0,1,'C');

    // function Footer()
    // {
    //     // Go to 1.5 cm from bottom
    //     $this->SetY(-15);
    //     // Select Arial italic 8
    //     $this->SetFont('Arial', 'I', 8);
    //     // Print centered page number
    //     $this->Cell(0, 10, 'Page '.$this->PageNo(), 0, 0, 'C');
    // }

$pdf->Output();

?>