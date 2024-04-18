<?php

$raiz =dirname(dirname(dirname(__file__)));
//  die('rutamodel '.$raiz);

require_once($raiz.'/conexion/Conexion.php');

class FacturaModel extends Conexion
{
    public function grabarFactura($request)
    {
        $sql = "insert into facturas  (fecha,observaciones,valor,idCliente)    
            values (
            now()
            ,'".$request['observaciones']."'
            ,'".$request['valor']."'
            ,'".$request['idCliente']."'
            ) ";
            // die($sql); 
        $consulta = mysql_query($sql,$this->connectMysql());
        // $clientes = $this->get_table_assoc($consulta);
        // return $clientes;
    }
}