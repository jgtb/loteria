<?php

include("../vendor/mpdf/mpdf/mpdf.php");

$mpdf = new mPDF('utf-8', 'A4-L', '', 'timesnewroman', 5, 5, 5, 5, '', 'P');

$css = file_get_contents('../web/css/pdf.css');
$mpdf->WriteHTML($css, 1);

$mpdf->SetTitle('Relatório de Despesa');

$html = '<h1 class="pdf-title">Relatório de Despesa, ' . $date . '</h1>';
$mpdf->WriteHTML($html);

$html = $this->render('_pdf', ['models' => $models]);

$mpdf->WriteHTML($html);

$mpdf->Output();
exit;
