<?php
/// Powered by Evilnapsis go to http://evilnapsis.com
session_start();
require 'logica/Cliente.php';
require 'logica/TelCliente.php';
require 'logica/Marca.php';
require 'logica/ClaseLicor.php';
require 'logica/Producto.php';
require 'logica/Orden.php';
require 'logica/Factura.php';
require 'logica/Vendedor.php';

include "fpdf/fpdf.php";

$pdf = new FPDF('P','mm', 'Letter');
$pdf->AddPage();
$pdf->SetFont('Arial','B',20);
$textypos = 5;
$pdf->setY(12);
$pdf->setX(10);

date_default_timezone_set('America/Bogota');
setlocale(LC_ALL, 'es_ES');
$fecha = date('y/m/d');

// Agregamos los datos de la empresa
$pdf->Cell(5,$textypos,"ELIXIR CELESTIAL");
$pdf->SetFont('Arial','B',10);
$pdf->setY(30);$pdf->setX(10);
$pdf->Cell(5,$textypos,"REPORTE DE VENTAS DEL DIA " . $fecha);
$pdf->setY(40);$pdf->setX(10);
$pdf->Cell(5,$textypos,"Calle 127C No. 9A - 03");
$pdf->setY(45);$pdf->setX(10);
$pdf->Cell(5,$textypos,"745 9628 - 315 245 7801");
$pdf->setY(50);$pdf->setX(10);
$pdf->Cell(5,$textypos,"elixirCelestial@gmail.com");


/// Apartir de aqui empezamos con la tabla de productos
$pdf->setY(60);$pdf->setX(135);
$pdf->Ln();
/////////////////////////////
//// Array de Cabecera
$header = array("#.", "Descripcion.","Cant.","SubTotal.");
//// Arrar de Productos

$facturasDia = new Factura();
$factur = $facturasDia -> busquedaHistorialVentas($fecha);
//var_dump($proFac);

$products = array(
    array("0010", "Producto 1",2,120,0),
    array("0024", "Producto 2",5,80,0),
    array("0001", "Producto 3",1,40,0),
    array("0001", "Producto 3",5,80,0),
    array("0001", "Producto 3",4,30,0),
    array("0001", "Producto 3",7,80,0),
);
// Column widths
$w = array(20, 95, 20, 25);
// Header
for($i=0;$i<count($header);$i++)
    $pdf->Cell($w[$i],7,$header[$i],1,0,'C');
    $pdf->Ln();
    // Data
    $total = 0;
    $j = 1;
    foreach($factur as $producActual)
    {
        
        if($producActual -> getNumOrden()){
            $producto = $producActual -> getNumOrden();
            foreach ($producto as $valueProd) {
                $pdf->Cell($w[0],6,$j++,1);
                $pdf->Cell($w[1],6,$valueProd -> getIdProducto() -> getIdClaseLicor() -> getNombre() . " " . $valueProd -> getIdProducto() -> getIdMarca() -> getNombre() . " " . $valueProd -> getIdProducto() -> getTipo() ,1);
                $pdf->Cell($w[2],6,number_format($valueProd -> getUnidades()),'1',0,'R');
                $pdf->Cell($w[3],6,"$ ".number_format($valueProd -> getSubTotal(),2,".",","),'1',0,'R');
                
                $pdf->Ln();
                $total+=$valueProd -> getSubTotal();
            }
        }
        
        
    }
    /////////////////////////////
    //// Apartir de aqui esta la tabla con los subtotales y totales
    $yposdinamic = 60 + (count($products)*10);
    
    $pdf->setY($yposdinamic);
    $pdf->setX(235);
    $pdf->Ln();
    /////////////////////////////
    $header = array("", "");
    $data2 = array(
        array("Total", $total),
    );
    // Column widths
    $w2 = array(40, 40);
    // Header
    
    $pdf->Ln();
    // Data
    foreach($data2 as $row)
    {
        $pdf->setX(115);
        $pdf->Cell($w2[0],6,$row[0],1);
        $pdf->Cell($w2[1],6,"$ ".number_format($row[1], 2, ".",","),'1',0,'R');
        
        $pdf->Ln();
    }
    
    $pdf->output();
?>