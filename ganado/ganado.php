<?php
    date_default_timezone_set('America/Bogota');
    $raiz = dirname(__file__);
    //   die($raiz);
    require_once($raiz.'/controllers/ganadoController.php');  
    $ganadoController = new ganadoController();
?>