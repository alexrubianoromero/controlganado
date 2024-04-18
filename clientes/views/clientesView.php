<?php
$raiz = dirname(dirname(dirname(__file__)));
require_once($raiz.'/clientes/models/ClienteModel.php'); 
require_once($raiz.'/clientes/models/TipoContribuyenteModel.php'); 
// require_once($raiz.'/subtipos/models/SubtipoParteModel.php'); 
// require_once($raiz.'/marcas/models/MarcaModel.php'); 

class clientesView
{
 protected $model; 
 protected $tipoContriModel; 

 public function __construct()
 {
    $this->model= new ClienteModel(); 
    $this->tipoContriModel= new TipoContribuyenteModel(); 
 }   
 public function clientesMenu($clientes)
 {
    
    ?>
    <div style="padding:5px;" class="mt-3">
        <div class="row">
            <div class="col-lg-3">
                <button 
                data-bs-toggle="modal" 
                data-bs-target="#modalNuevoCliente"
                class="btn btn-primary" 
                onclick="formuNuevoCliente();"
                >Nuevo Cliente</button>
            </div>
            <div class="col-lg-3 ">
                <select id = "idCliente" name="idCliente" onchange="listarClienteFiltradoDesdeClientes();" class="form-control" >
                       <option value="-1">SeleccionarCliente</option>
                       <?php  
                           foreach($clientes as $cliente)
                           {
                               echo '<option value ='.$cliente['idcliente'].'>'.$cliente['nombre'].'</option>'; 
                           }
                       ?>
                </select>
            </div>

        </div>
        <div id="div_resultados_clientes" class="mt-3" style="padding:5px;">
               <?php  $this->mostrarCLientes($clientes);   ?>
        </div>

        <?php   $this->modalNuevoCliente(); ?>
        <?php   $this->modalFactura(); ?>
    </div>
    <?php
 }

 public function mostrarCLientes($clientes)
 {
    // $clientes = $this->model->traerClientes(); 
    echo '<table class="table table-striped">';
        echo '<tr>'; 
        echo '<th>Nombre/Razon Social</th>';
        echo '<th>Nit</th>';
        echo '<th>Telefono</th>';
        echo '<th>Correo</th>';
        echo '<th>Direccion</th>';
    
        echo '</tr>';
        foreach($clientes as $cliente)
        {
            $tipoCont =  $this->tipoContriModel->traerTipoId($cliente['idTipoContribuyente']);
            $idcliente = $cliente['idcliente']; 
            echo '<tr>'; 
            echo '<td><button 
                            class="btn btn-secondary"
                            data-bs-toggle="modal" 
                            data-bs-target="#modalFactura"
                            onclick ="formuFactura('.$idcliente.'); "

                        >'.$cliente['nombre'].'</button></td>'; 
            echo '<td>'.$cliente['identi'].'</td>'; 
            echo '<td>'.$cliente['telefono'].'</td>'; 
            echo '<td>'.$cliente['email'].'</td>'; 
            echo '<td>'.$cliente['direccion'].'</td>'; 
 
       
            echo '</tr>';
        }
    echo '</table>';   
 }
 public function modalNuevoCliente()
 {
     ?>
         <!-- Modal -->
         <div class="modal fade" id="modalNuevoCliente" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
         <div class="modal-dialog">
             <div class="modal-content">
             <div class="modal-header">
                 <h1 class="modal-title fs-5" id="exampleModalLabel">Info Cliente</h1>
                 <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
             </div>
             <div class="modal-body" id="modalBodyNuevoCliente">
                 
             </div>
             <div class="modal-footer">
                 <button  type="button" class="btn btn-secondary" data-bs-dismiss="modal" onclick="listarClientes();" >Cerrar</button>
                 <button  type="button" class="btn btn-primary"  id="btnEnviar"  onclick="grabarCliente();" >Grabar Cliente</button>
             </div>
             </div>
         </div>
         </div>

     <?php
 }
 public function modalFactura()
 {
     ?>
         <!-- Modal -->
         <div class="modal fade" id="modalFactura" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
         <div class="modal-dialog">
             <div class="modal-content">
             <div class="modal-header">
                 <h1 class="modal-title fs-5" id="exampleModalLabel">Factura</h1>
                 <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
             </div>
             <div class="modal-body" id="modalBodyFactura">
                 
             </div>
             <div class="modal-footer">
                 <button  type="button" class="btn btn-secondary" data-bs-dismiss="modal" onclick=";" >Cerrar</button>
               
             </div>
             </div>
         </div>
         </div>

     <?php
 }


 public function formuNuevoCliente()
 {
   
     ?>
     <div class="row">
             <div class="col-md-6">
                 <label for="">Nombre/Razon Social:</label>
                   <input class ="form-control" type="text" id="nombre">          
             </div>
             <div class="col-md-6">
                 <label for="">Nit:</label>
                   <input class ="form-control" type="text" id="nit">          
             </div>
     </div>

     <div class="row">
             <div class="col-md-6">
                 <label for="">Telefono/Celular:</label>
                   <input class ="form-control" type="text" id="telefono">          
             </div>
             <div class="col-md-6">
                 <label for="">Correo:</label>
                   <input class ="form-control" type="text" id="email">          
             </div>
     </div>
     <div class="row">
             <div class="col-md-6">
                 <label for="">Direccion:</label>
                   <input class ="form-control" type="text" id="direccion">          
             </div>
        
     </div>
   

     <?php
 }

}