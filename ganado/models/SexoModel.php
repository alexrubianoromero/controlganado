<?php


$raiz =dirname(dirname(dirname(__file__)));
//  die('rutamodel '.$raiz);

require_once($raiz.'/conexion/Conexion.php');

class SexoModel extends Conexion
{

    public function traerSexoId($id)
    {
        $sql = "select * from sexo where id ='".$id."' ";
        $consulta = mysql_query($sql,$this->connectMysql());
        $sexo = mysql_fetch_assoc($consulta);
        return $sexo;
    }
    public function traerSexos()
    {
        $sql = "select * from sexo  ";
        $consulta = mysql_query($sql,$this->connectMysql());
        $sexo = $this->get_table_assoc($consulta);
        return $sexo;
    }

}



?>