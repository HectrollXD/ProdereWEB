<?php
    session_start();
    include ('../php/verificar-inicio.php');
    include ('../php/verificar-usuario-existente.php');
    include ('../php/conexion-Oracle.php');
    require ('../files/tcpdf/tcpdf.php');

    $pdf = new TCPDF('l', 'mm', array(376,210), true, 'utf-8', false, true);
    $pdf -> SetCreator('Preparatoria No. 17');
    $pdf -> SetAuthor('Biblioteca');
    $pdf -> SetTitle('Reporte de prestamos de libros.');
    $pdf -> SetSubject('Universidad de Guadalajara');


    $pdf -> setHeaderData(PDF_HEADER_LOGO, 0, '', '', array(0,0,0), array(255,255,255));
    $pdf -> setFooterData(array(255,255,255),array(255,255,255));

    $pdf -> AddPage();
    $pdf -> SetXY(20, 5);
    $pdf -> Image('../images/UdG.png', $pdf->GetX(), $pdf->GetY(), 16.75, 24, 'PNG');
    $pdf -> SetXY(40, 5);
    $pdf -> SetFont('times', 'B', 18);
    $pdf -> SetTextColor(0,0,95);
    $pdf -> Write(0, 'Universidad de Guadalajara.');
    $pdf -> SetXY(40, 13);
    $pdf -> SetTextColor(0,0,0);
    $pdf -> SetFont('times', 'B', 14); 
    $pdf -> Write(0, 'Sistema de Educación Media Superior.');
    $pdf -> SetXY(40, 19);
    $pdf -> SetFont('times', 'B', 12);
    $pdf -> Write(0, 'Preparatoria No. 17.');
    $pdf -> SetXY(40, 24);
    $pdf -> Write(0, 'Sistema de registro de bibliotecas.');
    $pdf -> SetXY(332, 5);
    $pdf -> Image('../images/Logo P17.png', $pdf->GetX(), $pdf->GetY(), 26.75, 26.75, 'PNG');

    $pdf -> SetXY(20, 35);
    $pdf -> SetFont('Helvetica','B',14);
    $pdf -> SetFillColor(0,0,95);
    $pdf -> SetTextColor(255,255,255);
    $pdf -> Cell(336, 12, 'Reporte de registro de prestamos de libros.', 1, 1, 'C', 1);
    $pdf -> SetFont('Helvetica','B',11);

    $pdf -> SetTextColor(0,0,0);
    $pdf -> SetFillColor(170,170,170);
    $pdf -> SetXY($pdf->GetX()+10, $pdf->GetY());
    $pdf -> Cell(15, 7, '#', 1, 0, 'C', 1);
    $pdf -> Cell(70, 7, 'Título del libro', 1, 0, 'C', 1);
    $pdf -> Cell(13, 7, 'Ej', 1, 0, 'C', 1);
    $pdf -> Cell(30, 7, 'Código', 1, 0, 'C', 1);
    $pdf -> Cell(75, 7, 'Nombre del alumno', 1, 0, 'C', 1);
    $pdf -> Cell(30, 7, 'Fecha', 1, 0, 'C', 1);
    $pdf -> Cell(20, 7, 'Entrada', 1, 0, 'C', 1);
    $pdf -> Cell(20, 7, 'Salida', 1, 0, 'C', 1);
    $pdf -> Cell(40, 7, 'Firma', 1, 0, 'C', 1);
    $pdf -> Cell(23, 7, 'Status', 1, 1, 'C', 1);
    $Select = "SELECT * FROM PRESTAMOS_DE_LIBROS WHERE ELIMINADO = 0 ORDER BY NUMERO_DE_PRESTAMO_DE_LIBRO ASC";
    $Query = oci_parse($Conexion_a_la_base_de_datos_Oracle, $Select);
    oci_execute($Query);
    while($rows = oci_fetch_array($Query, OCI_NUM + OCI_RETURN_NULLS + OCI_RETURN_LOBS)){
        $titulo = ucfirst(strtolower($rows[1]));
        $nombre = ucwords(strtolower($rows[4]));
        if($rows[9] == 1){ $status = 'Entregado'; }
        else{ $status = 'N/A'; }
        if($rows[7] != ''){ $salida = $rows[7]; }
        else{ $salida = 'N/A'; }

        $X = $pdf -> GetY();

        if( $X >= 180){
            $pdf -> AddPage();
            $pdf -> SetXY($pdf->GetX()+10, $pdf->GetY()+5);
        }
        else{
            $pdf -> SetXY($pdf->GetX()+10, $pdf->GetY());
        }
        
        $pdf -> SetFont('Helvetica','',10);
        $pdf -> MultiCell(15, 15, $rows[0], 1, 'C', 0, 0, '', '', 1, 0, 0, 1, 15, 'M');
        $pdf -> MultiCell(70, 15, $titulo, 1, 'C', 0, 0, '', '', 1, 0, 0, 1, 15, 'M');
        $pdf -> MultiCell(13, 15, $rows[2], 1, 'C', 0, 0, '', '', 1, 0, 0, 1, 15, 'M');
        $pdf -> MultiCell(30, 15, $rows[3], 1, 'C', 0, 0, '', '', 1, 0, 0, 1, 15, 'M');
        $pdf -> MultiCell(75, 15, $nombre, 1, 'C', 0, 0, '', '', 1, 0, 0, 1, 15, 'M');
        $pdf -> MultiCell(30, 15, $rows[5], 1, 'C', 0, 0, '', '', 1, 0, 0, 1, 15, 'M');
        $pdf -> MultiCell(20, 15, $rows[6], 1, 'C', 0, 0, '', '', 1, 0, 0, 1, 15, 'M');
        $pdf -> MultiCell(20, 15, $salida, 1, 'C', 0, 0, '', '', 1, 0, 0, 1, 15, 'M'); 
            if($rows[8]==null){
                $img = "N/A";
                $pdf->SetFont('Helvetica','',10);
            }
            else{
                $imagen = base64_encode($rows[8]);
                $img_base64_encoded = 'data:image/png;base64,'.$imagen;
                $imageContent = file_get_contents($img_base64_encoded);
                $path = tempnam(sys_get_temp_dir(), 'prefix');
                file_put_contents ($path, $imageContent);
                $img = '<p></p><img width="30mm" height="12mm" src="' . $path . '">';
                $pdf->SetFont('Helvetica','',1);
            }
        $pdf -> writeHTMLCell(40, 15, $pdf->GetX(), $pdf->GetY(), $img    , 1, 0, 0, 0, 'C', 0);
        $pdf -> SetFont('Helvetica','',10);
        $pdf -> MultiCell(23, 15, $status, 1, 'C', 0, 1, '', '', 1, 0, 0, 1, 15, 'M');
    }
    $pdf -> Output('Reporte de prestamos de libros.');

?>
