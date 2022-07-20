<?php

require "classes/pdf.php";
$datos = $d['datos'];

$pdf = new FPDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Times', '', 12);
$pdf->Image("classes/logo.png",50,0,100);

$pdf->setXY(0,25);
$pdf->Ln(5);
$pdf->Cell(12, 8, "#", 1,0,"C", 0);
$pdf->Cell(27, 8, "Rut", 1,0,"C", 0);
$pdf->Cell(75, 8, "Nombre completo", 1,0,"C", 0);
$pdf->Cell(37, 8, "Sede", 1,0,"C", 0);
$pdf->Cell(47, 8, "Carrera", 1,0,"C", 0);
$pdf->Ln(10);
 
foreach ($datos as $alumno) {
    $pdf->Cell(12, 10, $alumno->getCodigo(), 1, 0);
    $pdf->Cell(27, 10, $alumno->getRut(), 1, 0);
    $pdf->Cell(75, 10, $alumno->getNombres() . " " . $alumno->getApellidos() , 1, 0);
    $pdf->Cell(37, 10, $alumno->getSede(), 1, 0);
    $pdf->Cell(47, 10, $alumno->getCarrera(), 1, 1);
}
$pdf->Output();
