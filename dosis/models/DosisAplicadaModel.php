<?php

$raiz =dirname(dirname(dirname(__file__)));
//  die('rutamodel '.$raiz);

require_once($raiz.'/conexion/Conexion.php');

class DosisAplicadaModel extends Conexion
{

    public function traeDosisAplicadasIdGanado($id)
    {
        $sql = "select * from dosisAplicadas where idGanado ='".$id."' order by fecha desc ";
        // die($sql); 
        $consulta = mysql_query($sql,$this->connectMysql());
        $ganado = $this->get_table_assoc($consulta);
        return $ganado;
    }
    public function traerDosisAplicadaId($id)
    {
        $sql = "select * from dosisAplicadas where id ='".$id."' ";
        $consulta = mysql_query($sql,$this->connectMysql());
        $ganado = mysql_fetch_assoc($consulta);
        return $ganado;
    }

    public function traerDosisAplicadas()
    {
        $sql = "select * from dosisAplicadas order by id  ";
        $consulta = mysql_query($sql,$this->connectMysql());
        $ganado =  $this->get_table_assoc($consulta); 
        return $ganado;
    }

    
    public function grabarDosisGanado($request)
    {
        $sql = "insert into dosisAplicadas  (idGanado,fecha,idTipoDosis,nombreMedicamento,dosis,marcaMedicamento)    
            values (
            '".$request['idGanado']."'
            ,'".$request['fechaDosis']."'
            ,'".$request['idTipoDosis']."'
            ,'".$request['nombreMedicamento']."'
            ,'".$request['dosisMed']."'
            ,'".$request['marcaMed']."'
            ) ";
            // die($sql); 
        $consulta = mysql_query($sql,$this->connectMysql());
        // $clientes = $this->get_table_assoc($consulta);
        // return $clientes;
    }
    
    
    public function eliminarDosisAplicada($idDosisAplicada)
    {
        $sql = "delete from dosisAplicadas  where id = '".$idDosisAplicada."'  "; 
        // die($sql);
        $consulta = mysql_query($sql,$this->connectMysql());

    }
}