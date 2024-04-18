<?php
$raiz = dirname(dirname(dirname(__file__)));
// die('controller'.$raiz);

require_once($raiz.'/reportes/views/reportesView.php'); 
require_once($raiz.'/ganado/models/GanadoModel.php'); 
// require_once($raiz.'/pedidos/models/PedidoModel.php'); 
// require_once($raiz.'/pedidos/models/ItemInicioPedidoModel.php'); 
// require_once($raiz.'/hardware/models/HardwareModel.php'); 
// require_once($raiz.'/pagos/models/PagoModel.php'); 
// require_once($raiz.'/pedidos/models/AsignacionTecnicoPedidoModel.php'); 
// die('control123'.$raiz);

class reportesController
{
    protected $view; 
    protected $model; 
   
    // protected $model ; 
    // protected $pagoModel ; 

    public function __construct()
    {
        // die('desde controlador') ;
        // session_start();
        $this->view = new reportesView();
        $this->model = new GanadoModel();
        // $this->itemInicioModel = new ItemInicioPedidoModel();
        // $this->HardwareModel = new HardwareModel();

        if($_REQUEST['opcion']=='reportesMenu')
        {
            $this->view->reportesMenu();
        }
        
        if($_REQUEST['opcion']=='reporteMachos')
        {
            $machos =    $this->model->traerGanadoPorGenero(1);
            $this->view->reportePorGenero($machos,'Reporte Machos',1);
        }
        if($_REQUEST['opcion']=='reporteHembras')
        {
            $hembras =    $this->model->traerGanadoPorGenero(2);
            $this->view->reportePorGenero($hembras,'Reporte Hembras',2);
        }
    }
    

    public function otra ()
    {
        $fechapan =  time();
        $fechapan =  date ( "Y/m/j" , $fechapan ); 
        // $fecha1= new DateTime("2017-08-01");
        $fecha1= new DateTime($fechapan);
        $fecha2= new DateTime("2023-10-22");
        // $diff = $fecha1->diff($fecha2);
        $diff = $fecha1->diff($fecha2);
    
        // El resultados sera 3 dias
        echo $diff->days . ' dias';
        
    }

}   