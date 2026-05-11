<?php
/// Powered by Evilnapsis go to http://evilnapsis.com
session_start();
ob_start();
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

// Agregamos los datos de la empresa
$pdf->Cell(5,$textypos,"ELIXIR CELESTIAL");
$pdf->SetFont('Arial','B',10);
$pdf->setY(30);$pdf->setX(10);
$pdf->Cell(5,$textypos,"DE:");
$pdf->SetFont('Arial','',10);
$pdf->setY(35);$pdf->setX(10);
$pdf->Cell(5,$textypos,"ELIXIR CELESTIAL");
$pdf->setY(40);$pdf->setX(10);
$pdf->Cell(5,$textypos,"Calle 127C No. 9A - 03");
$pdf->setY(45);$pdf->setX(10);
$pdf->Cell(5,$textypos,"745 9628 - 315 245 7801");
$pdf->setY(50);$pdf->setX(10);
$pdf->Cell(5,$textypos,"elixirCelestial@gmail.com");

// Agregamos los datos del cliente
$session = 5;
$clientes = new Cliente($session);
$clientes -> consultar();


$pdf->SetFont('Arial','B',10);
$pdf->setY(30);$pdf->setX(75);
$pdf->Cell(5,$textypos,"PARA:");
$pdf->SetFont('Arial','',10);
$pdf->setY(35);$pdf->setX(75);
$pdf->Cell(5,$textypos, $clientes -> getNombre()  . " " . $clientes -> getApellido());
$pdf->setY(40);$pdf->setX(75);
$pdf->Cell(5,$textypos, $clientes -> getDireccion());
$pdf->setY(45);$pdf->setX(75);
$pdf->Cell(5,$textypos, "--- --- ----");
$pdf->setY(50);$pdf->setX(75);
$pdf->Cell(5,$textypos, $clientes -> getCorreo());

// Agregamos los datos de la factura

$factura = new Factura("", $session); 
$factura -> ultimaFactura();
$numOrden = $factura -> getNumOrden();

$pdf->SetFont('Arial','B',10);
$pdf->setY(30);$pdf->setX(135);
$pdf->Cell(5,$textypos,"FACTURA: " . $numOrden);
$pdf->SetFont('Arial','',10);
$pdf->setY(35);$pdf->setX(135);
$pdf->Cell(5,$textypos,"Fecha: " . $factura -> getFecha());
$pdf->setY(45);$pdf->setX(135);
$pdf->Cell(5,$textypos,"");
$pdf->setY(50);$pdf->setX(135);
$pdf->Cell(5,$textypos,"");

/// Apartir de aqui empezamos con la tabla de productos
$pdf->setY(60);$pdf->setX(135);
$pdf->Ln();
/////////////////////////////
//// Array de Cabecera
$header = array("#.", "Descripcion.","Cant.","Precio.","SubTotal.");
//// Arrar de Productos

$productosFactura = new Orden("", "", $session, "", "", "", $numOrden, "");
$proFac = $productosFactura -> productosFacturaOrden();
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
$w = array(20, 95, 20, 25, 25);
// Header
for($i=0;$i<count($header);$i++)
    $pdf->Cell($w[$i],7,$header[$i],1,0,'C');
    $pdf->Ln();
    // Data
    $total = 0;
    $j = 1;
    foreach($proFac as $producActual)
    {
        //echo $producActual -> getIdProducto() -> getIdMarca() -> getNombre();
        $pdf->Cell($w[0],6,$j++,1);
        $pdf->Cell($w[1],6,$producActual -> getIdProducto() -> getIdClaseLicor() -> getNombre() . " " . $producActual -> getIdProducto() -> getIdMarca() -> getNombre() . " " . $producActual -> getIdProducto() -> getTipo() ,1);
        $pdf->Cell($w[2],6,number_format($producActual -> getUnidades()),'1',0,'R');
        $pdf->Cell($w[3],6,"$ ".number_format($producActual -> getPrecioUnidad(),2,".",","),'1',0,'R');
        $pdf->Cell($w[4],6,"$ ".number_format($producActual -> getSubTotal(),2,".",","),'1',0,'R');
        
        $pdf->Ln();
        $total+=$producActual -> getSubTotal();
        
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
        array("Subtotal",$total),
        array("Descuento", 0),
        array("Impuesto", 0),
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
    /////////////////////////////
    
    $yposdinamic += (count($data2)*10);
    $pdf->SetFont('Arial','B',10);
    
    $pdf->setY($yposdinamic);
    $pdf->setX(10);
    $pdf->Cell(5,$textypos,"TERMINOS Y CONDICIONES");
    $pdf->SetFont('Arial','',10);
    
    $pdf->setY($yposdinamic+10);
    $pdf->setX(10);
    $pdf->Cell(5,$textypos,"El cliente se compromete a pagar la factura.");
    $pdf->setY($yposdinamic+20);
    $pdf->setX(10);
    $pdf->Cell(5,$textypos,"Powered by Evilnapsis");
    
    
    ob_end_clean();
    $pdf->Output();