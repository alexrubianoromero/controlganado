<?php

// die('buenas'); 

$servidor = "localhost";
$usuario = "valderra_admin";
$clave  = "1973david";
$nombrebase = "valderra_base_controlganado";


$conexion =mysql_connect($servidor,$usuario,$clave);
$la_base =mysql_select_db($nombrebase,$conexion);



?>