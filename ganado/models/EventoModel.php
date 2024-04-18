<?php

$raiz =dirname(dirname(dirname(__file__)));
//  die('rutamodel '.$raiz);

require_once($raiz.'/conexion/Conexion.php');

class EventoModel extends Conexion
{

    public function traerEventoId($id)
    {
        $sql = "select * from eventos where id ='".$id."' ";
        $consulta = mysql_query($sql,$this->connectMysql());
        $ganado = mysql_fetch_assoc($consulta);
        return $ganado;
    }
    public function traerEventos()
    {
        $sql = "select * from eventos  ";
        $consulta = mysql_query($sql,$this->connectMysql());
        $ganado = $this->get_table_assoc($consulta);
        return $ganado;
    }

}