<?php
$raiz = dirname(__file__);
require_once($raiz.'/reportes/views/reportesView.php'); 
require_once($raiz.'/ganado/models/GanadoModel.php'); 
$reportesView = new reportesView();
$model = new GanadoModel();
// die($raiz);
header('Content-Type:text/csv; charset=latin1');
header('Content-Disposition: attachment; filename="Reporte Marcaje.xls"');
$ganado = $model->traerGanadoPorGenero($_REQUEST['tipo']);
$reportesView->reportePorGenero($ganado,$_REQUEST['titulo'],$_REQUEST['tipo']); 
?>
