<?php

$raiz = dirname(dirname(dirname(__file__)));
//    die('desde controlador'.$raiz);
require_once($raiz.'/ganado/views/ganadoView.php');  
require_once($raiz.'/ganado/models/GanadoModel.php');  
require_once($raiz.'/ganado/models/EventoModel.php');  
require_once($raiz.'/ganado/models/ImagenGanadoModel.php');  
require_once($raiz.'/dosis/models/DosisModel.php');  
require_once($raiz.'/dosis/models/DosisAplicadaModel.php');  
// die('paso1');
// $ganadoController = new ganadoController();

class ganadoController
{
    protected $view;
    protected $model;
    protected $imagenModel;
    protected $dosisModel;
    protected $dosisAplicadaModel;

    public function __construct()
    {
        $this->view= new ganadoView();
        $this->model = new GanadoModel();
        $this->imagenModel = new ImagenGanadoModel();
        $this->dosisModel = new DosisModel();
        $this->dosisAplicadaModel = new DosisAplicadaModel();

        if($_REQUEST['opcion']=='pantallaPrincipalGanado')
        {
            $this->pantallaPrincipalGanado();
        }

        if($_REQUEST['opcion']=='formuNuevoGanado')
        {
            $this->view->formuNuevoGanado();
        }
        if($_REQUEST['opcion']=='formuModificarGanado')
        {
            $this->view->formuModificarGanado($_REQUEST['idGanado']);
        }

        if($_REQUEST['opcion']=='formuNuevoHijo')
        {
            // $noCriaActual = $this->model->traerNoCriaActualMadre();  
            $infoMadre = $this->model->traerGanadoId($_REQUEST['idMadre']);  
            $this->view->formuNuevoHijo($_REQUEST['idMadre'],$infoMadre);
        }
        if($_REQUEST['opcion']=='registrarGanado')
        {
            $this->registrarGanado($_REQUEST);
        }
        if($_REQUEST['opcion']=='registrarHijo')
        {
            $this->registrarHijo($_REQUEST);
        }
        if($_REQUEST['opcion']=='buscarGanado')
        {
            $this->buscarGanado($_REQUEST);
        }
        if($_REQUEST['opcion']=='verMasInfoGanado')
        {
            $this->verMasInfoGanado($_REQUEST);
        }
        if($_REQUEST['opcion']=='traerGanadoFiltradoCodigo')
        {
            $this->traerGanadoFiltradoCodigo($_REQUEST);
        }
        if($_REQUEST['opcion']=='traerGanadoFiltradoTatuaje')
        {
            $this->traerGanadoFiltradoTatuaje($_REQUEST);
        }
        if($_REQUEST['opcion']=='actualizarGanado')
        {
            $this->actualizarGanado($_REQUEST);
        }
        if($_REQUEST['opcion']=='verImagenGanadoModal')
        {
            $this->verImagenGanadoModal($_REQUEST['idGanado']);
        }
        if($_REQUEST['opcion']=='eliminarGanado')
        {
            $this->eliminarGanado($_REQUEST['id']);
        }

        if($_REQUEST['opcion']=='verDosisGanado')
        {
            $this->verDosisGanado($_REQUEST['idGanado']);
        }
        if($_REQUEST['opcion']=='grabarDosisGanado')
        {
            $this->grabarDosisGanado($_REQUEST);
        }
        if($_REQUEST['opcion']=='eliminardosisAplicada')
        {
            $this->eliminardosisAplicada($_REQUEST);
        }
        if($_REQUEST['opcion']=='realizarCargaArchivo')
        {
            $this->realizarCargaArchivo($_REQUEST);
        }
        if($_REQUEST['opcion']=='eliminarImagenGanado')
        {
            $this->eliminarImagenGanado($_REQUEST);
        }
        
    }
    
    public function eliminarImagenGanado($request){
        // die('llego aca');
        //eliminacion fisica 
         $this->eliminarFisicamenteImagenGanado($request['idImagenGanado']);
         //eliminacion del registro 
         $this->imagenModel->deleteImagenGanado($request['idImagenGanado']); 
        //  die('pasoo33');

         echo 'Imagen Eliminada';

    }

    public function realizarCargaArchivo($request)
    {
        //traerinfoGanado
        $infoGanado = $this->model->traerGanadoId($request['idGanado']); 
        $noSigImagen = $infoGanado['numeroImagenes']+1;
        //crear el nombre del archivo
        $nombreArchivo =  $request['idGanado'].'-'.$noSigImagen.'-'.$_FILES['archivo']['name'];
        //actualizar el numero de imagenes en ganado
        $this->model->actualizarNumeroImagenesGanado($request['idGanado'],$noSigImagen);
        //subir el archivo
        $this->subirArchivoDevolucion($nombreArchivo);
        //insertar en  la tabla de imagenes
        $this->imagenModel->grabaregistroImagenesGanado($request['idGanado'],$nombreArchivo,'imagenes');
        // $this->dosisAplicadaModel->eliminarDosisAplicada($request['idSosisAplicada']);
        // echo 'Registro ELiminado';

    }
    public function eliminardosisAplicada($request)
    {
        $this->dosisAplicadaModel->eliminarDosisAplicada($request['idSosisAplicada']);
        echo 'Registro ELiminado';
    }
    public function verDosisGanado($idGanado)
    {
        // $dosisAplicadas = $this->dosisAplicadaModel->traeDosisAplicadasIdGanado($idGanado);
        $this->view->verDosisGanado($idGanado);
    }
    
        public function grabarDosisGanado($request)
        {
            $this->dosisAplicadaModel->grabarDosisGanado($request);
            echo 'Dosis Grabada';
        }

    public function eliminarGanado($idGanado)
    {
        $this->model->eliminarGanado($idGanado);
        echo 'Registro ELiminado';
    }
    public function verImagenGanadoModal($idGanado)
    {
        // $ganados = $this->model->traerImagenesGanado($request);  
        // echo '<pre>'; print_r($ganados); echo '</pre>'; die();
        // $imagenes = $this->imagenModel->traerImagenesGanadoId($idGanado); 
        $this->view->verImagenGanadoModal($idGanado);
        //  echo 'Registro Actualizado'; 
    }
    public function actualizarGanado($request)
    {
        // echo '<pre>';  
        // print_r($_REQUEST);
        // echo '</pre>';
        // die(); 
        $ganados = $this->model->actualizarGanado($request);  
        // echo '<pre>'; print_r($ganados); echo '</pre>'; die();
         echo 'Registro Actualizado'; 
    }
    public function traerGanadoFiltradoTatuaje($request)
    {
        $ganados = $this->model->traerGanadoFiltradoTatuaje($request['tatuaje']);  
        // echo '<pre>'; print_r($ganados); echo '</pre>'; die();
        $this->view->traerGanado($ganados);
        // echo 'Registro Realizado '; 
    }
    public function traerGanadoFiltradoCodigo($request)
    {
        $ganados = $this->model->traerGanadoFiltradoCodigo($request['codigo']);  
        // echo '<pre>'; print_r($ganados); echo '</pre>'; die();
        $this->view->traerGanado($ganados);
        // echo 'Registro Realizado '; 
    }
    public function pantallaPrincipalGanado()
    {
        $ganados = $this->model->traerGanado();  
        // echo '<pre>'; print_r($ganados); echo '</pre>'; die();
        $this->view->pantallaPrincipalGanado($ganados);
        // echo 'Registro Realizado '; 
    }

    public function verMasInfoGanado($request)
    {
        $infoGanado = $this->model->traerGanadoId($request['idGanado']);  
        $infoMadre = $this->model->traerGanadoId($infoGanado['idMadre']);  
        $infoHijos = $this->model->traerHijosGanadoIdMadre($request['idGanado']);  
        // echo '<pre>'; print_r($infoHijos); echo '</pre>'; die();
        $this->view->verMasInfoGanado($infoGanado,$infoMadre,$infoHijos);
    }
    public function registrarGanado($request)
    {
        $this->model->registrarGanado($request);  
        echo 'Registro Realizado '; 
    }
    public function registrarHijo($request)
    {
        $this->model->registrarHijo($request);  
        echo 'Registro Realizado '; 
    }
    public function buscarGanado($request)
    {
        // $infoGanado = $this->model->traerGanadoCodigo($request['codigo']);  
        $this->view->formuNuevoGanado();
        // echo 'Registro Realizado '; 
    }

    public function subirArchivoDevolucion($nombre_archivo)
    {
        //  $this->printR($_FILES);
        //  $nombre_archivo = $_FILES['archivo']['name'];
            // if (move_uploaded_file($_FILES['archivo']['tmp_name'],  'archivos/'.$nombre_archivo)){
            if (move_uploaded_file($_FILES['archivo']['tmp_name'],  '../imagenes/'.$nombre_archivo)){
                echo "El archivo ha sido cargado correctamente.";
            }else{
                echo "Ocurrió algún error al subir el fichero. No pudo guardarse.";
            }
            // die('Archivo subido');

    }

    public function eliminarFisicamenteImagenGanado($idImagen)
    {
        $infoImagen = $this->imagenModel->traerInfoImageneGanadoIdImagen($idImagen);
        unlink('../imagenes/'.$infoImagen['nombre']);
    }



}



?>