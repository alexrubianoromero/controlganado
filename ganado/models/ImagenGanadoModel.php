<?php

$raiz =dirname(dirname(dirname(__file__)));
//  die('rutamodel '.$raiz);

require_once($raiz.'/conexion/Conexion.php');

class ImagenGanadoModel extends Conexion
{

    public function traerImagenesGanadoId($id)
    {
        $sql = "select * from imagenesGanado where idGanado ='".$id."' ";
        $consulta = mysql_query($sql,$this->connectMysql());
        $imagenes = $this->get_table_assoc($consulta);
        return $imagenes;
    }
    public function traerInfoImageneGanadoIdImagen($id)
    {
        $sql = "select * from imagenesGanado where id ='".$id."' ";
        $consulta = mysql_query($sql,$this->connectMysql());
        $infoImagen = mysql_fetch_assoc($consulta);
        return $infoImagen;
    }
    
    
    public function grabaregistroImagenesGanado($idGanado,$nombreIma,$ruta)
    {
        $sql = "insert into imagenesGanado(idganado,nombre,ruta) 
        values ('".$idGanado."','".$nombreIma."','".$ruta."')";
        $consulta = mysql_query($sql,$this->connectMysql());
    }

    public function deleteImagenGanado($id)
    {
        $sql = "delete  from imagenesGanado where id ='".$id."' ";
        $consulta = mysql_query($sql,$this->connectMysql());
    }

}