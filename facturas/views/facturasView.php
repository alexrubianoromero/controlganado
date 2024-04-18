<?php
$raiz = dirname(dirname(dirname(__file__)));
require_once($raiz.'/clientes/models/ClienteModel.php'); 
require_once($raiz.'/clientes/models/TipoContribuyenteModel.php'); 
// require_once($raiz.'/subtipos/models/SubtipoParteModel.php'); 
// require_once($raiz.'/marcas/models/MarcaModel.php'); 

class facturasView
{

    public function facturasMenu()
    {
        echo 'MENU FACTURAS '; 
    }

    public function formuFactura($idCliente)
    {
     ?>
    
       <div class="row mt-3">
           <label for="">Descripcion:</label>
           <textarea id="observaciones"></textarea>      
        </div>               
        
        <div class="row mt-3">
            <label for="">Valor:</label>
            <input class ="form-control" type="text" id="valor">          
        </div>

        <div class="mt-3">
         <button  type="button" class="btn btn-primary btn-block"  onclick="grabarFactura(<?php echo $idCliente;   ?>);" >Grabar Factura</button>
        </div>
    
       
     <?php
    }


}