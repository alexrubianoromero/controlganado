<?php

$raiz =dirname(dirname(dirname(__file__)));
//  die('rutamodel '.$raiz);

require_once($raiz.'/conexion/Conexion.php');

class GanadoModel extends Conexion
{

    public function registrarGanado($request)
    {
        $sql = "insert into ganado  (codigo,fechaNacimiento,numeroCria,tatuajeOreja,sexo,
        intervaloPartos,proximoParto,idMadre,evento,fechaCompra)    
            values (
            '".$request['numeroCria']."'
            ,'".$request['fechaNacimiento']."'
            ,'".$request['numeroCria']."'
            ,'".$request['tatuajeOreja']."'
            ,'".$request['sexo']."'
            ,'".$request['intervaloPartos']."'
            ,'".$request['proximoParto']."'
            ,'".$request['idMadre']."'
            ,'".$request['evento']."'
            ,'".$request['fechaCompra']."'
            ) ";
            // ,'".$request['novedad']."'
            // ,'".$request['ventaEvento']."'
            // die($sql); 
        $consulta = mysql_query($sql,$this->connectMysql());
        // $clientes = $this->get_table_assoc($consulta);
        // return $clientes;
    }
    public function registrarHijo($request)
    {
        $sql = "insert into ganado  (codigo,fechaNacimiento,numeroCria,tatuajeOreja,
        sexo,idMadre,evento,numeroAnterior,intervaloPartos,proximoParto,novedad,fechaventaoevento)    
            values (
            '".$request['codigo']."'
            ,'".$request['fechaNaci']."'
            ,'".$request['noCria']."'
            ,'".$request['noTatuaje']."'
            ,'".$request['sexo']."'
            ,'".$request['idMadre']."'
            ,'".$request['tipoevento']."'
            ,'".$request['numeroAnterior']."'
            ,'".$request['intervaloPartos']."'
            ,'".$request['proximoParto']."'
            ,'".$request['novedad']."'
            ,'".$request['fechaVenta']."'
            ) ";
            // die($sql); 
        $consulta = mysql_query($sql,$this->connectMysql());
        // $clientes = $this->get_table_assoc($consulta);
        // return $clientes;
    }

    
    



    public function actualizarGanado($request)
    {
        $sql = "update ganado set 
                numeroCria = '".$request['numeroCria']."' 
                ,numeroAnterior = '".$request['numeroCriaAnterior']."' 
                ,codigo = '".$request['numeroCria']."' 
                ,tatuajeOreja = '".$request['tatuajeOreja']."' 
                ,sexo = '".$request['sexo']."'
                ,intervaloPartos = '".$request['intervaloPartos']."'
                ,proximoParto = '".$request['proximoParto']."'
                ,novedad = '".$request['novedad']."'
                ,fechaventaoevento = '".$request['fechaventaoevento']."'
                ,proximoParto = '".$request['proximoParto']."'
                ,fechaCompra = '".$request['fechaCompra']."'
                ,fechaNacimiento = '".$request['fechaNacimiento']."'

                where id = '".$request['idGanado']."' 
        ";
        // die($sql); 
        $consulta = mysql_query($sql,$this->connectMysql());

    }
    public function actualizarNumeroImagenesGanado($idGanado,$numero)
    {
        $sql = "update ganado set 
                numeroImagenes = '".$numero."' 
                where id = '".$idGanado."' 
        ";
        $consulta = mysql_query($sql,$this->connectMysql());
    }

    public function traerGanadoCodigo($codigo)
    {
        $sql = "select * from ganado where codigo ='".$codigo."' ";
        $consulta = mysql_query($sql,$this->connectMysql());
        $ganado = mysql_fetch_assoc($consulta);
        return $ganado;
    }

    public function traerGanadoId($id)
    {
        $sql = "select * from ganado where id ='".$id."' ";
        $consulta = mysql_query($sql,$this->connectMysql());
        $ganado = mysql_fetch_assoc($consulta);
        return $ganado;
    }
    public function traerGanado()
    {
        $sql = "select * from ganado order by id  ";
        $consulta = mysql_query($sql,$this->connectMysql());
        $ganado =  $this->get_table_assoc($consulta); 
        return $ganado;
    }
    public function traerGanadoHembras()
    {
        $sql = "select * from ganado where sexo = 2 ";
        $consulta = mysql_query($sql,$this->connectMysql());
        $ganado =  $this->get_table_assoc($consulta); 
        return $ganado;
    }
    public function traerGanadoFiltradoCodigo($codigo)
    {
        $sql = "select * from ganado where codigo like  '%".$codigo."%' ";
        $consulta = mysql_query($sql,$this->connectMysql());
        $ganado =  $this->get_table_assoc($consulta); 
        return $ganado;
    }
    public function traerGanadoFiltradoTatuaje($tatuaje)
    {
        $sql = "select * from ganado where tatuajeOreja like  '%".$tatuaje."%' ";
        $consulta = mysql_query($sql,$this->connectMysql());
        $ganado =  $this->get_table_assoc($consulta); 
        return $ganado;
    }

    public function traerHijosGanadoIdMadre($idMadre)
    {
        $sql = "select * from ganado 
            where 
            idMadre ='".$idMadre."' 
            order by id asc";
        // die($sql);
        $consulta = mysql_query($sql,$this->connectMysql());
        $ganado = $this->get_table_assoc($consulta); 
        return $ganado;
    }

    /*
    **function  traerGanadoPorGenero()
    ** $genero   1 machos 
    ** $genero   2 hembras 
    */
    public function traerGanadoPorGenero($genero)
    {
        $sql = "select * 
                from ganado 
                where sexo = '".$genero."' 
                and novedad = 0
                ";
        // die($sql);
        $consulta = mysql_query($sql,$this->connectMysql());
        $ganado = $this->get_table_assoc($consulta); 
        return $ganado;
    }
    
    public function eliminarGanado($id)
    {   
        $sql = "delete from ganado where id = '".$id."' "; 
        $consulta = mysql_query($sql,$this->connectMysql());
    }

}