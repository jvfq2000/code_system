<?php
//============================================================+
// File name   : example_005.php
// Begin       : 2008-03-04
// Last Update : 2013-05-14
//
// Description : Example 005 for TCPDF class
//               Multicell
//
// Author: Nicola Asuni
//
// (c) Copyright:
//               Nicola Asuni
//               Tecnick.com LTD
//               www.tecnick.com
//               info@tecnick.com
//============================================================+

/**
 * Creates an example PDF TEST document using TCPDF
 * @package com.tecnick.tcpdf
 * @abstract TCPDF - Example: Multicell
 * @author Nicola Asuni
 * @since 2008-03-04
 */

// Include the main TCPDF library (search for installation path).
//require_once('tcpdf_include.php');

// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('CODE SYSTEM');
$pdf->SetTitle('CONTROLE DAS ATIVIDADES COMPLEMENTARES');
$pdf->SetSubject('CODE SYSTEM');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
	require_once(dirname(__FILE__).'/lang/eng.php');
	$pdf->setLanguageArray($l);
}

// ---------------------------------------------------------

// set font
$pdf->SetFont('times', '', 10);

// add a page
$pdf->AddPage();

// set cell padding
$pdf->setCellPaddings(1, 1, 1, 1);

// set cell margins
$pdf->setCellMargins(1, 1, 1, 1);

// set color for background
$pdf->SetFillColor(255, 255, 127);

// MultiCell($w, $h, $txt, $border=0, $align='J', $fill=0, $ln=1, $x='', $y='', $reseth=true, $stretch=0, $ishtml=false, $autopadding=true, $maxh=0)
foreach($query->result() as $q){
    $titulo = <<< OED
        <h1>$q->quadro_descricao</h1>
    OED;

}

$pdf->WriteHTMLCell(0, 0, '', '', $titulo, 0, 1, 0, TRUE, 'C', TRUE);

foreach($query->result() as $q){
    //Primeira parte tabela

    $tabela1 = '<table style="border: 1px solid #000; padding:6px; ">';
        $tabela1 .= '<tr>
                        <th align="left">CAMPUS: '.$q->campus_descricao.'<br><br>CURSO: '.$q->curso_descricao.'<br><br>QTD TOTAL DE HORAS: '.$q->quadro_horas_max.'

                        </th>
                   </tr>';

    $tabela1 .= '</table><br><br>';
}

$pdf->WriteHTMLCell(0, 0, '', '', $tabela1, 0, 1, 0, TRUE, 'C', TRUE);

foreach($query->result() as $q){
    //Segunda parte tabela
    $tabela = '<table style="border: 1px solid #000; padding:6px; ">';
    $tabela .= '<tr style="background-color:#ccc;">
                    <th style="border: 1px solid #000; width:208px;" align="left">'.$q->atividade_cat_descricao.'</th>
                    <th style="border: 1px solid #000; width:208px;" align="left">Carga horário mínima</th>
                    <th style="border: 1px solid #000; width:208px;" align="left">Carga horário maxima</th>
                </tr>';
    foreach($query->result() as $q){
        $tabela .= '<tr>
                        <td style="border: 1px solid #000; width:208px;" align="left">'.$q->atividade_descricao.'</td>
                        <td style="border: 1px solid #000; width:208px;" align="left">'.$q->atividade_horas_min.'</td>
                        <td style="border: 1px solid #000; width:208px;" align="left">'.$q->atividade_horas_max.'</td>
                    </tr>';
    }
    //$soma_horas = $q->aluno_ati_qtd_horas;

}
$tabela .= '</table>';
$pdf->WriteHTMLCell(0, 0, '', '', $tabela, 0, 1, 0, TRUE, 'C', TRUE);
// move pointer to last page
$pdf->lastPage();

// ---------------------------------------------------------
ob_clean();
//Close and output PDF document
$pdf->Output('atividades_complementares.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
?>