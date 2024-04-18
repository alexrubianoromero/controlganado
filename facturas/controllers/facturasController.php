<?php
$raiz = dirname(dirname(dirname(__file__)));
require_once($raiz.'/facturas/views/facturasView.php'); 
require_once($raiz.'/facturas/models/FacturaModel.php'); 
require_once($raiz.'/clientes/models/ClienteModel.php'); 
require_once($raiz.'/correo/EnviarCorreoPhpMailer.class.php'); 
// require_once($raiz.'/partes/models/PartesModel.php'); 
// require_once($raiz.'/movimientos/models/MovimientoParteModel.php'); 

class facturasController
{
    protected $view;
    protected $model;
    protected $cliente;
    // protected $partesModel;
    // protected $MovParteModel;

    public function __construct()
    {
        $this->view = new facturasView();
        $this->model = new FacturaModel();
        $this->cliente = new ClienteModel();
        // $this->partesModel = new PartesModel();
        // $this->MovParteModel = new MovimientoParteModel();

        if($_REQUEST['opcion']=='facturasMenu')
        {
            $this->view->facturasMenu();
        }
        if($_REQUEST['opcion']=='formuFactura')
        {
            $this->view->formuFactura($_REQUEST['idCliente']);
        }
        if($_REQUEST['opcion']=='grabarFactura')
        {
            // echo '<pre>'; print_r($_REQUEST); echo '</pre>';
            $this->grabarFactura($_REQUEST);
        }
        
    }
    
    public function grabarFactura($request)
    {
        $this->model->grabarFactura($request);
        //enviar el correo 
        $infoCLiente= $this->cliente->traerClienteId($request['idCliente']); 
        // echo '<pre>'; print_r($infoCLiente); echo '</pre>';
        // die(); 
        $body = $this->traerBody($infoCLiente['nombre'],$request);
        $this->enviarCorreo = new enviarCorreoPhpMailer($infoCLiente[0]['email'],$body);
        echo 'Factura grabada'; 
    }

    public function traerBody($nombre,$request)
    {
        $body = '
        Hemos creado una factura con la siguiente informacion. <br>
        nombre: '.$nombre.'<br>
        TRABAJO REALIZADO : '.$request['descripcion'].'<br>
        valor: '.$request['valor'] ; 
        return $body;

    }
    
}