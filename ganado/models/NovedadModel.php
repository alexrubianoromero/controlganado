<?php


$raiz =dirname(dirname(dirname(__file__)));
//  die('rutamodel '.$raiz);

require_once($raiz.'/conexion/Conexion.php');

class NovedadModel extends Conexion
{

    public function traerNovedades()
    {
        $sql = "select * from novedades order by descripcion asc ";
        $consulta = mysql_query($sql,$this->connectMysql());
        $novedad = $this->get_table_assoc($consulta);
        return $novedad;
    }
    public function traerNovedadId($id)
    {
        $sql = "select * from novedades where id ='".$id."' ";
        $consulta = mysql_query($sql,$this->connectMysql());
        $novedad = mysql_fetch_assoc($consulta);
        return $novedad;
    }

}



?>