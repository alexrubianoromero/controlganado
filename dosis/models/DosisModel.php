<?php

$raiz =dirname(dirname(dirname(__file__)));
//  die('rutamodel '.$raiz);

require_once($raiz.'/conexion/Conexion.php');

class DosisModel extends Conexion
{

    public function traerDosisId($id)
    {
        $sql = "select * from dosis where id ='".$id."' ";
        $consulta = mysql_query($sql,$this->connectMysql());
        $ganado = mysql_fetch_assoc($consulta);
        return $ganado;
    }
    
    public function traerDosis()
    {
        $sql = "select * from dosis order by id  ";
        $consulta = mysql_query($sql,$this->connectMysql());
        $ganado =  $this->get_table_assoc($consulta); 
        return $ganado;
    }
}