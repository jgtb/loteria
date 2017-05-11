<?php

include("../vendor/mpdf/mpdf/mpdf.php");

$mpdf = new mPDF('utf-8', 'A4-L', '', 'timesnewroman', 5, 5, 5, 5, '', 'P');

$css = file_get_contents('../web/css/pdf.css');
$mpdf->WriteHTML($css, 1);

$mpdf->SetTitle($model->getRelatorio());

$html = '<h1 class="pdf-title">Relatório de ' . $model->getRelatorio() . '</h1>';
$mpdf->WriteHTML($html);

$html = '<h1 class="pdf-subtitle">' . $model->getRelatorioData() . '</h1>';
$mpdf->WriteHTML($html);

$html = $this->render(!in_array($model->id, [6]) ? 'pages/' . $model->getPage() : 'prints/mensal-despesas', ['modelRelatorio' => $model]);
$mpdf->WriteHTML($html);

$mpdf->Output();
exit;
