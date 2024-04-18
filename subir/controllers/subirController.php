<?php

// die('controller'); 

class subirController
{
    public function __construct()
    {
        // echo 'desde cargar archivo'; 
        // echo '<pre>';
        // print_r($_FILES); 
        // echo '</pre>';
        // echo '<br>buenas desde controller '; 
            if($_REQUEST['opcion']=='subirFoto')
            {
                $this->subirFoto();
            }
    }

    public function subirFoto()
    {
        echo 'desde cargar archivo'; 
        echo '<pre>';
        print_r($_FILES); 
        echo '</pre>';

        echo 'REQUEST'; 
        echo '<pre>';
        print_r($_REQUEST); 
        echo '</pre>';
        // die(); 
        // echo '<br>llego a subir foto'; 

        
        $destino = "../imagenes/foto.jpg";

        $nAncho = 400;
        $nAlto = 400;

            // if($_FILES['imagen']['error']=== UPLOAD_ERR_OK)
            // {
        $imagen_original = $_FILES['imagen']['tmp_name'];

        $img_original = imagecreatefromjpeg($imagen_original);
        $ancho_original = imagesx($img_original);
        $alto_original = imagesy($img_original);
        $tmp = imagecreatetruecolor($nAncho, $nAlto);
        imagecopyresized($tmp, $img_original,0,0,0,0, $nAncho,$nAlto,$ancho_original,$alto_original);
        imagejpeg($tmp,$destino,65);

    }

}


?>