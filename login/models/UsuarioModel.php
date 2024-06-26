<?php

$raiz =dirname(dirname(dirname(__file__)));
//  die('rutamodel '.$raiz);

require_once($raiz.'/conexion/Conexion.php');

class UsuarioModel extends Conexion
{
    public function verificarCredenciales($request)
    {
        $conexion = $this->connectMysql();
        $sql = "select u.id_usuario,u.login,u.clave,u.nombre as nombreusuario ,u.id_perfil
        ,p.nombre_perfil,p.nivel,u.idSucursal 
        from usuarios u 
        inner join perfiles p on (p.id_perfil =  u.id_perfil )
        where login = '".$request['user']."'   "; 
        // die($sql); 
        $consulta = mysql_query($sql,$conexion);
        $filas = mysql_num_rows($consulta);
        
        $datosUser  =[];
        if($filas>0)
        {
            $datosUser = mysql_fetch_assoc($consulta);  
            if($datosUser['clave']==$request['clave']  )
            {
                $valida = 1; 
            }
            else {
                $valida = 0;
            }
        }else{
            $valida = 0; 
        } 
        $respu = [];
        $respu['valida'] = $valida;
        $respu['datos'] = $datosUser;
        // echo '<pre>'; 
        // print_r($respu); 
        // echo '</pre>';
        // die();
        
        return $respu;  
    } 
    public function verificarClaveActual($request)
    {
        $sql="select * from usuarios where id_usuario = '".$request['idUsuario']."' ";
        $consulta = mysql_query($sql,$this->connectMysql());
        $datosUser = mysql_fetch_assoc($consulta);
        return $datosUser;  
    }
    public function actualizarClave($request)
    {
        $sql = "update usuarios set
        clave = '".$request['claveNueva']."'
        where id_usuario = '".$request['idUsuario']."'  ";
        $consulta = mysql_query($sql,$this->connectMysql());
    }

    public function getUsers()
    {
        $sql = "select * from usuarios ";
        $consulta = mysql_query($sql,$this->connectMysql());
        $users = $this->get_table_assoc($consulta);
        return $users;
    }
    
    public function crearUsuario($request)
    {
        $sql = "insert into usuarios (login,email,nombre,apellido,clave,idSucursal,id_perfil) 
        values (
            '".$request['email']."'
            ,'".$request['email']."'
            ,'".$request['nombreUsuario']."'
            ,'".$request['apellidoUsuario']."'
            ,'".$request['password']."'
            ,'".$request['idSucursal']."'
            ,'".$request['idPerfil']."'
            
        ) " ; 
        
        $consulta = mysql_query($sql,$this->connectMysql());
        
    }
    public function  traerTecnicos()
    {
        $sql = "select u.id_usuario as id_usuario , u.nombre as nombre 
                from usuarios u 
                inner join perfiles p on (p.id_perfil = u.id_perfil) 
                where p.nombre_perfil = 'Tecnico'";
        $consulta = mysql_query($sql,$this->connectMysql());
        $tecnicos = $this->get_table_assoc($consulta);
        return $tecnicos;
        // die($sql);   
    }
    
    public function traerInfoId($idUsuario)
    {
        $sql = "select * from usuarios where id_usuario = '".$idUsuario."'  ";
        $consulta = mysql_query($sql,$this->connectMysql());
        $arrUsu = mysql_fetch_assoc($consulta);
        return $arrUsu;
    }
    
}

?>