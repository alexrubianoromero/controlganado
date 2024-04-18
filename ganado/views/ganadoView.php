<?php
$raiz = dirname(dirname(dirname(__file__)));
// die($raiz); 
require_once($raiz.'/vista/vista.php');  
require_once($raiz.'/ganado/models/EventoModel.php');  
require_once($raiz.'/ganado/models/GanadoModel.php');  
require_once($raiz.'/ganado/models/SexoModel.php');  
require_once($raiz.'/ganado/models/NovedadModel.php');  
require_once($raiz.'/ganado/models/ImagenGanadoModel.php');  
require_once($raiz.'/dosis/models/DosisModel.php');  
require_once($raiz.'/dosis/models/DosisAplicadaModel.php');  

class ganadoView extends vista
{
    protected $model;
    protected $sexoModel;
    protected $novedadModel;
    protected $eventos;
    protected $imagenModel;
    protected $dosisModel;
    protected $dosisAplicadaModel;
    

    public function __construct()
    {
        $this->model = new GanadoModel(); 
        $this->eventos = new EventoModel(); 
        $this->sexoModel = new SexoModel(); 
        $this->novedadModel = new NovedadModel(); 
        $this->imagenModel = new ImagenGanadoModel();
        $this->dosisModel = new DosisModel();
        $this->dosisAplicadaModel = new DosisAplicadaModel();

        // if($_REQUEST['opcion'=='pantallaPrincipalGanado'])
        // {
        //     $this->view->pantallaPrincipalGanado();
        // }
    }

    public function pantallaPrincipalGanado($ganados=[])
    {
        ?>
    
        <div style="padding:10px; " class="row">
            <div class="col-lg-10" style="border:1px solid black;" >
                    <div class="row">
                        <label class="col-lg-3 mt-3">Buscar:</label>
                        <div class="col-lg-3 mt-3">
                            <input 
                                class="form-control" 
                                type="text" id="codigoGanadoTxt" 
                                placeholder="Nombre Bovino"
                                onkeyup="traerGanadoFiltradoCodigo();"
                                >
                            </div>
                            <div class="col-lg-3 mt-3">
                                <input 
                                class="form-control" 
                                type="text" id="codigoTatuajeTxt" 
                                placeholder="No Tatuaje"
                                onkeyup="traerGanadoFiltradoTatuaje();"
                                >
                        </div>
                        <div class="col-lg-3 mt-3">
                            <button  onclick = "formuNuevoGanado();"   class="btn btn-primary btn-block">Nuevo</button>
                        </div>
                    </div>
                    <!-- <div class="row">
                        <div class="col-lg-3 mt-3">
                            <button  onclick = "buscarGanado();" class="btn btn-primary">Buscar</button>
                        </div>
                    </div> -->
                    <div class="row "  id="div_resultados_ganado">
                            <?php  $this->traerGanado($ganados);    ?>
                    </div>
            </div>


            <!-- <div class="col-lg-6" id="div_ver_mas_resultados_ganado" style="padding:15px; border:1px solid black;">
                    dos
            </div> -->

        </div>
        <?php   $this->modalInfoGanado();  ?>
        <?php   $this->modalNuevoHijo();  ?>
        <?php   $this->modalModificarGanado();  ?>
        <?php   $this->modalVerImagenGanado();  ?>
        <?php   $this->modalDosisGanado();  ?>
          
       
        <?php
    }

    public function traerGanado($ganados)
    {
        ?>
        <div style="padding:5px; overflow-auto;">

            <table class="table table-striped mt-3">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Imagen</th>
                        <th>Fecha Nacimiento</th>
                        <th>Número de Cria Actual</th>
                        <th>Número Tatuaje Oreja</th> 
                        <th>Manejo Bovinos</th> 
                        <th>Modificar/Eliminar</th> 
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $granTotal = 0; 
                    foreach($ganados as $ganado)
                    {
                        echo '<tr>';  
                        echo '<td><button
                        data-bs-toggle="modal" 
                        data-bs-target="#modalInfoGanado"
                        onclick=" verMasInfoGanadoModal('.$ganado['id'].'); " 
                        class="btn btn-primary btn-sm btn-block">'.$ganado['codigo'].'</button></td>'; 

                        echo '<td><button
                        data-bs-toggle="modal" 
                        data-bs-target="#modalVerImagenGanado"
                        onclick=" verImagenGanadoModal('.$ganado['id'].'); " 
                        class="btn btn-info btn-sm">Imagen</button></td>'; 
                           $ano = substr($ganado['fechaNacimiento'] , 0,4);  
                          $mes = substr($ganado['fechaNacimiento'] , 5,2);  
                          $dia = substr($ganado['fechaNacimiento'] , 8,2); 
                        //   echo '<td>'.$dia.'-'.$mes.'-'.$ano.'</td>'; 
                  
                          echo '<td>'.$dia.'-'.$mes.'-'.$ano .'</td>'; 
                          echo '<td>'.$ganado['numeroCria'].'</td>'; 
                          echo '<td>'.$ganado['tatuajeOreja'].'</td>'; 
                          echo '<td><button
                          data-bs-toggle="modal" 
                          data-bs-target="#modalDosisGanado"
                          onclick=" verDosisGanado('.$ganado['id'].'); " 
                          class="btn  btn-info btn-sm">Medicamentos</button></td>'; 
                          echo '<td><button
                          data-bs-toggle="modal" 
                          data-bs-target="#modalModificarGanado"
                          onclick=" formuModificarGanado('.$ganado['id'].'); " 
                          class="btn btn-warning btn-sm">Modificar/Eliminar</button></td>'; 
                          echo '</tr>';  
                        }  
                        ?>
                </tbody>
            </table>
        </div>
            <?php
    }



    public function modalInfoGanado()
    {
        ?>
            <!-- Modal -->
            <div class="modal fade" id="modalInfoGanado" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Informacion Bovino</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="modalBodyInfoGanado">
                    
                </div>
                <div class="modal-footer">
                    <button  type="button" class="btn btn-secondary" data-bs-dismiss="modal" onclick="" >Cerrar</button>
                    <!-- <button  type="button" class="btn btn-primary"  id="btnEnviar"  onclick="grabarCliente();" >Grabar Cliente</button> -->
                </div>
                </div>
            </div>
            </div>
   
        <?php
    }
    public function modalDosisGanado()
    {
        ?>
            <!-- Modal -->
            <div class="modal fade" id="modalDosisGanado" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Medicamentos Bovino</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="modalBodyDosisfoGanado">
                    
                </div>
                <div class="modal-footer">
                    <button  type="button" class="btn btn-secondary" data-bs-dismiss="modal" onclick="" >Cerrar</button>
                    <!-- <button  type="button" class="btn btn-primary"  id="btnEnviar"  onclick="grabarCliente();" >Grabar Cliente</button> -->
                </div>
                </div>
            </div>
            </div>
   
        <?php
    }
    public function modalModificarGanado()
    {
        ?>
            <!-- Modal -->
            <div class="modal fade" id="modalModificarGanado" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Modificar Ganado</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="modalBodyModificarGanado">
                    
                </div>
                <div class="modal-footer">
                    <button  type="button" class="btn btn-secondary" data-bs-dismiss="modal" onclick="ganado();" >Cerrar</button>
                    <!-- <button  type="button" class="btn btn-primary"  id="btnEnviar"  onclick="grabarCliente();" >Grabar Cliente</button> -->
                </div>
                </div>
            </div>
            </div>
   
        <?php
    }
    public function modalVerImagenGanado()
    {
        ?>
            <!-- Modal -->
            <div class="modal fade" id="modalVerImagenGanado" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Imagen Ganado</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="modalBodyVerImagenGanado">
                    
                </div>
                <div class="modal-footer">
                    <button  type="button" class="btn btn-secondary" data-bs-dismiss="modal" onclick="" >Cerrar</button>
                    <!-- <button  type="button" class="btn btn-primary"  id="btnEnviar"  onclick="grabarCliente();" >Grabar Cliente</button> -->
                </div>
                </div>
            </div>
            </div>
   
        <?php
    }
    public function modalNuevoHijo()
    {
        ?>
            <!-- Modal -->
            <div class="modal fade" id="modalNuevoHijo" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Nuevo Hijo </h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="modalBodyNuevoHijo">
                    
                </div>
                <div class="modal-footer">
                    <button  type="button" class="btn btn-secondary" data-bs-dismiss="modal" onclick="" >Cerrar</button>
                    <!-- <button  type="button" class="btn btn-primary"  id="btnEnviar"  onclick="grabarCliente();" >Grabar Cliente</button> -->
                </div>
                </div>
            </div>
            </div>
   
        <?php
    }
    /*
    ** $control se usa para saber si es captura de informacion o consulta de informacion
    **$control = 0 es solo consulta 
    **$control = 1 es para captura de informacion 
    */
    public function formuNuevoGanado()
    {
        $ganadosHembras =  $this->model->traerGanadoHembras(); 
        $eventos =  $this->eventos->traerEventos();
        ?>
        <div class="row mt-3">
               
            <div class="row">
             <label>Madre:</label>
              <select class="form-control" name="idMadre" id="idMadre">
                <option value = '-1'>Seleccione...</option>
                <option value = '-1'>Sin Informacion Madre</option>
                    <?php
                      foreach($ganadosHembras as $hembra)
                      {
                          echo '<option value="'.$hembra['id'].'">'.'Numero '.$hembra['codigo'].'   tatuaje Oreja'.$hembra['tatuajeOreja'].'</option>';  
                         
                      }  
                    ?>
              </select>
            </div>
       
            <div class="row mt-3"></div>
            
            <div class="col-lg-3">
                <label>Fecha Nacimiento:</label>
                <input class="form-control" type="date"  id="fechaNacimientoTxt"  >
            </div>

            <div class="col-lg-3">
                <label>Fecha Compra/Permuta/Otro:</label>
                <input class="form-control" type="date"  id="fechaComnpraUOtroTxt"  >
            </div>

            <div class="col-lg-3">
                <label>Evento:</label>
                <select class="form-control" id="eventoTxt">
                    <option value="-1">Seleccione...</option>
                    <?php
                         foreach($eventos as $evento)
                         {
                             echo '<option value="'.$evento['id'].'">'.$evento['descripcion'].'</option>';  
                         } 
                    ?>
                </select>
            </div>
            <div class="col-lg-3">
                <label>Nombre:</label>
                <input class="form-control" type="text"  id="numeroCriaTxt"   >
            </div>
            <div class="col-lg-3 mt-3">
                <label>Tatuaje Oreja:</label>
                <input class="form-control" type="text"  id="tatuajeOrejaTxt"  >
            </div>
            <div class="col-lg-3 mt-3">
                <label>Género:</label>
                <select class="form-control" id="sexoTxt">
                    <option value="">Seleccione...</option>
                    <option value="1">MACHO</option>
                    <option value="2">HEMBRA</option>
                </select>
               
            </div>
            <div class="col-lg-3 mt-3">
                <label>Intervalo Partos:</label>
                <input class="form-control" type="text"  id="intervaloPartosTxt" >
            </div>
            <div class="col-lg-3 mt-3">
                <label>Proximo Parto:</label>
                <input class="form-control" type="text"  id="proximoPartoTxt"  >
            </div>
        
     
        </div>
      
           <div class="row mt-3">
                <button  onclick="registrarGanado();" class="btn btn-primary" >Registrar Ganado </button>
            </div>
      
        <?php
    }

    public function verMasInfoGanado($infoGanado,$infoMadre,$infoHijos)
    {
        // $infoMadre = $this->model->traerGanadoId($infoGanado['idMadre']); 
        // echo '<pre>'; 
        // print_r($infoGanado); 
        // echo '</pre>';
        ?>
        <input type="hidden" id="idGanadoMAdreTxt" value ="<?php echo $infoGanado['id'];  ?>">
        <div class="row" style="border:1px solid black;">
            <div class="col-lg-12"><label>Informacion Madre:</label></div>
            <div class="col-lg-4" >
                <label>Nombre:</label>
                <span>
                    <button class="btn btn-primary" onclick = "verMasInfoGanadoModal(<?php  echo $infoMadre['id'];  ?>)" ><?php echo $infoMadre['codigo']   ?></button>
                    
                </span>
            </div>
            <div class="col-lg-4">
                <label>Fecha Nacimiento:</label>
                <?php
                   $ano = substr($infoMadre['fechaNacimiento'] , 0,4);  
                   $mes = substr($infoMadre['fechaNacimiento'] , 5,2);  
                   $dia = substr($infoMadre['fechaNacimiento'] , 8,2); 
                ?>
                <span><?php echo $dia.'-'.$mes.'-'.$ano  ?></span>
            </div>
            <!-- <div class="col-lg-4">
                <label>	Número de Cria Actual:</label>
                <span><?php 
                        // echo $infoMadre['numeroCria']   
                        ?></span>
            </div> -->
            <div class="col-lg-4">
                <label>Numero Tatuaje Oreja:</label>
                <span><?php echo $infoMadre['tatuajeOreja']   ?></span>
            </div>
        </div>
        

        <div class="row mt-3" style="border:1px solid black;">
            <!-- <div class="col-lg-12"><label>Nombre</label></div> -->
            <div class="col-lg-4">
                <label>	Nombre:</label>
                <span><?php echo $infoGanado['numeroCria']   ?></span>
            </div>
            <div class="col-lg-4" >
                <label>Nombre Anterior:</label>
                <span><?php echo $infoGanado['numeroAnterior']   ?></span>
            </div>
            <div class="col-lg-4">
                <label>Fecha Nacimiento:</label>
                <?php
                        $ano = substr($infoGanado['fechaNacimiento'] , 0,4);  
                          $mes = substr($infoGanado['fechaNacimiento'] , 5,2);  
                          $dia = substr($infoGanado['fechaNacimiento'] , 8,2); 
                        //   echo '<td>'.$dia.'-'.$mes.'-'.$ano.'</td>'; 
                 ?>         
                <span><?php echo $dia.'-'.$mes.'-'.$ano  ?></span>
            </div>
           
            <div class="col-lg-4">
                <label>Numero Tatuaje Oreja:</label>
                <span><?php echo $infoGanado['tatuajeOreja']   ?></span>
            </div>

        </div>


        <div class="row mt-3" style="border:1px solid black;">
        <div class="col-lg-12"><label>Informacion Hijos 
                <button 
                    data-bs-toggle="modal" 
                    data-bs-target="#modalNuevoHijo"
                    onclick="formuNuevoHijo(<?php echo $infoGanado['id'] ?>);" 
                    class="btn btn-primary btn-sm"
                    >Nuevo Hijo</button></label></div>
            <table class="table table-striped ">
                <thead>
                    <tr>
                        <th>Fecha Nacimiento</th>
                        <th>Evento</th>
                        <th>Número de Cria Anterior</th>
                        <th>Número de Cria Actual</th>
                        <th>Número Tatuaje Oreja</th> 
                        <th> Sexo/Género</th> 
                        <th>Intervalo de Partos</th> 
                        <th>Próximo Parto</th> 
                        <th>Novedad</th>
                        <th>Fecha Novedad</th> 
                        <th>VerInfo</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $granTotal = 0; 
                       foreach($infoHijos as $infoHijo)
                       {
                        //para calcular intervalo de partos 
                        //busque el id anterior de la misma mama
                        //verifique si existe 
                        //si existe verifique que tiene fecha 
                        //si tiene fecha haga la resta 

                          $infoEvento = $this->eventos->traerEventoId($infoHijo['evento']);   
                          $infoSexo = $this->sexoModel->traerSexoId($infoHijo['sexo']); 
                          $novedades= $this->novedadModel->traerNovedadId($infoHijo['novedad']);
                          echo '<tr>';  
                          $ano = substr($infoHijo['fechaNacimiento'], 0,4);  
                          $mes = substr($infoHijo['fechaNacimiento'], 5,2);  
                          $dia = substr($infoHijo['fechaNacimiento'], 8,2);  
                    
                          echo '<td>'.$dia.'-'.$mes.'-'.$ano.'</td>'; 
                          echo '<td>'.$infoEvento['descripcion'].'</td>'; 
                          echo '<td>'.$infoHijo['numeroAnterior'].'</td>'; 
                          echo '<td>'.$infoHijo['numeroCria'].'</td>'; 
                          echo '<td>'.$infoHijo['tatuajeOreja'].'</td>'; 
                          echo '<td>'.$infoSexo['descripcion'].'</td>'; 

                          echo '<td>'.$infoHijo['intervaloPartos'].'</td>'; 

                          echo '<td>'.$infoHijo['proximoParto'].'</td>'; 
                          echo '<td>'.$novedades['descripcion'].'</td>'; 

                          $ano = substr($infoHijo['fechaventaoevento'], 0,4);  
                          $mes = substr($infoHijo['fechaventaoevento'], 5,2);  
                          $dia = substr($infoHijo['fechaventaoevento'], 8,2); 
                          echo '<td>'.$dia.'-'.$mes.'-'.$ano.'</td>'; 

                          echo '<td><button class="btn btn-primary btn-sm" onclick ="verMasInfoGanadoModal('.$infoHijo['id'].')">VerInfo</button></td>'; 
                          echo '</tr>';  
                        }  
                    ?>
                </tbody>
            </table>

        </div>
        <?php
    }


    public function formuNuevoHijo($idGanado)
    {
        // $idMadre = $idGanado; 
        $infoGanado = $this->model->traerGanadoId($idGanado); 
        // $this->printR($infoGanado);
        ?>
             <div class="row">
                 <label style="color:blue;">Madre: <?php  echo $infoGanado['numeroCria']; ?></label>
                  <!-- <input  class="form-control" type="date" id="" value ="<?php   echo $infoGanado['numeroCria'] ?>" > -->
             </div>
         <div class="row">

                <div class="col-lg-4">
                    <label>Fecha_Nacim:</label>
                     <input  class="form-control" type="date" id="fechaNaciHijoTxt" value ="" >
                </div>

                <div class="col-lg-3">
                    <label>Evento:</label>
                    <select class="form-control" id="tipoEventoTxt">
                        <option value="-1">Seleccione...</option>
                        <option value="1">PARTO</option>
                        <option value="2">OTRO</option>
                    </select>
                </div> 
                <div class="col-lg-4">
                    <label>No Cria Anterior:</label>
                    <input  class="form-control" type="text" id="numeroAnteriorHijoTxt" >
                </div>
                
                <div class="col-lg-3 mt-2">
                    <label>Numero Cria Actual:</label>
                    <input  class="form-control" type="text" id="numeroCriaHijoTxt" >
                </div>
                <div class="col-lg-3 mt-2">
                    <label>Tatuaje <br>Oreja:</label>
                    <input  class="form-control" type="text" id="tatuajeHijoTxt" >
                </div>
            <div class="col-lg-3 mt-2">
                <label><br>Género:</label>
                <!-- <input  class="form-control" type="text" id="sexoHijoTxt"> -->
                <select class="form-control" id="sexoHijoTxt">
                    <option value="-1">Seleccione...</option>
                    <option value="1">MACHO</option>
                    <option value="2">HEMBRA</option>
                </select>
            </div>
            <div class="col-lg-3 mt-2">
                <label>Intervalo Partos:</label>
                <input  class="form-control" type="text" id="intervaloPartosHijoTxt">
            </div>
            <div class="col-lg-3 mt-2">
                <label>Proximo Parto:</label>
                <input  class="form-control" type="text" id="proximoPartoHijoTxt">
            </div>
            <div class="col-lg-3 mt-2">
                <label><br>Novedad:</label>
                <!-- <input  class="form-control" type="text" id="novedadHijoTxt"> -->
                <select class="form-control" id="novedadHijoTxt">
                    <option value="0">Seleccione...</option>
                    <?php
                        $novedades =  $this->novedadModel->traerNovedades();
                        foreach($novedades as $novedad)
                        {
                            echo '<option value="'.$novedad['descripcion'].'">'.$novedad['descripcion'].'</option>';
                        } 
                    ?>
                </select>
            </div>
            <div class="col-lg-3 mt-2">
                <label>Fecha Venta U Otro Evento:</label>
                <input  class="form-control" type="date" id="fechaVentaHijoTxt">
            </div>
        </div>
      </div>
        <div class="row mt-3">
            <button onclick="registrarHijo(<?php  echo $idGanado ?>)"  class="btn btn-primary">Registrar Hijo </button>
        </div>
        <?php
    }
    
    public function formuModificarGanado($idGanado)
    {
        $infoGanado = $this->model->traerGanadoId($idGanado); 
        ?>  
         <div class="row mt-3">
             
             <div class="col-lg-3" >
                 <label>Fecha Compra/Permuta/Otro:</label>
                 <input class="form-control" type="date"  id="fechaCompraTxt" value = "<?php   echo  $infoGanado['fechaCompra']  ?>" >
            </div>
             <div class="col-lg-3" >
                 <label>Fecha de Nacimiento:</label>
                 <input class="form-control" type="date"  id="fechaNacimientoTxt" value = "<?php   echo  $infoGanado['fechaNacimiento']  ?>" >
            </div>
             <div class="col-lg-3" >
                 <label>Número de Cria Anterior:</label>
                 <input class="form-control" type="text"  id="numeroCriaAnteriorTxt" value = "<?php   echo  $infoGanado['numeroAnterior']  ?>" >
            </div>
             <div class="col-lg-3" >
                 <label>Número de Cria Actual:</label>
                 <input class="form-control" type="text"  id="numeroCriaTxt" value = "<?php   echo  $infoGanado['numeroCria']  ?>" >
            </div>
             <div class="col-lg-3" >
                 <label>Número Tatuaje Oreja:</label>
                 <input class="form-control" type="text"  id="tatuajeOrejaTxt" value = "<?php   echo  $infoGanado['tatuajeOreja']  ?>" >
            </div>

            <div class="col-lg-3">
                <label>Género:</label>
                <select class="form-control" id="sexoTxt">
                    <option value="0">Seleccione...</option>
                    <?php
                        $sexos = $this->sexoModel->traerSexos();
                        $this->colocarSelectCampoConOpcionSeleccionadaNuevo($sexos,$infoGanado['sexo'])
                        ?>
                </select>
            </div>

            <div class="col-lg-3" >
                <label>Intervalo Partos:</label>
                <input class="form-control" type="text"  id="intervaloPartosTxt" value = "<?php   echo  $infoGanado['intervaloPartos']  ?>" >
           </div>
            <div class="col-lg-3" >
                <label>Proximo Parto:</label>
                <input class="form-control" type="text"  id="proximoPartoTxt" value = "<?php   echo  $infoGanado['proximoParto']  ?>" >
           </div>
           <div class="col-lg-3">
                <label>Novedad:</label>
                <select class="form-control" id="novedadTxt">
                    <option value="0">Seleccione...</option>
                    <?php
                        $novedades = $this->novedadModel->traerNovedades();
                        $this->colocarSelectCampoConOpcionSeleccionadaNuevo($novedades,$infoGanado['novedad'])
                        ?>
                </select>
            </div>
            <div class="col-lg-3" >
                <label>Fecha Venta / Evento:</label>
                <input class="form-control" type="date"  id="fechaventaoeventoTxt" value = "<?php   echo  $infoGanado['fechaventaoevento']  ?>" >
           </div>
            <div class="col-lg-3 mt-3" >
                <button class="btn btn-danger btn-block mt-3" onclick="eliminarGanado(<?  echo $infoGanado['id'] ?>);" >Eliminar</button>
           </div>

            <div class="col-lg-12 mt-5" >
                <button class="btn btn-primary btn-block" onclick="actualizarGanado(<?  echo $infoGanado['id'] ?>);">Actualizar Registro</button>                    
           </div>
                
        </div>
      <?php  
    }
    public function verImagenGanadoModal($idGanado)
    {
        // $raiz = dirname(__FILE__); 
        ?>
            <form  enctype="multipart/form-data">
                <input name="archivo" id="archivo" type="file">
                <div id="div_muestre_resultado"></div>
                    <span id="demo"></span>
                </div>
            </form>
               
            <div class="mt-3">
                <button  class ="btn btn-primary"    onclick="realizarCargaArchivo(<?php echo $idGanado; ?>);" >SubirArchivo</button>
            </div>
        <?php

        $imagenes =    $this->imagenModel->traerImagenesGanadoId($idGanado);
        // echo 'ver fotos ganado';
        foreach($imagenes as $imagen)
        {
        ?>
        <div align="center" class="row mt-5">
            <div class="col-lg-12">
                <!-- <img src = "imagenes/imagen.jpg" width="300px;" > -->
                <img src = "imagenes/<?php echo $imagen['nombre'] ?>" width="450px;" >
            </div>
            <button class="btn btn-danger btn-sm mt-2">Eliminar</button>
        </div>
        <?php
    
        }

    }

    public function verDosisGanado($idGanado)
    { 
        $dosisAplicadas =  $this->dosisAplicadaModel->traeDosisAplicadasIdGanado($idGanado);
        ?>
        <div class="row">
            <div class="col-lg-3 mt-3" >Fecha: <input id="fechaDosis" class="form-control" type="date"></div>
            <div class="col-lg-3 mt-3" >Tipo Medicamento:
                <select  class="form-control" id="idTipoDosis">
                    <option value="-1" >Seleccione..</option>
                    <?php
                        $dosis = $this->dosisModel->traerDosis();  
                        foreach($dosis as $dos)
                        {
                            echo '   <option value="'.$dos['id'].'" >'.$dos['descripcion'].'</option>'; 
                        }
                        ?>
                </select>
            </div>
            <div class="col-lg-3 mt-3" >Dosis: <input id="dosisMed" class="form-control" type="text"></div>
            <div class="col-lg-3 mt-3" >Nombre Medicamento: <input id="nombreMed" class="form-control" type="text"></div>
            <div class="col-lg-3 mt-3" >Marca Medicamento: <input id="marcaMed" class="form-control" type="text"></div>
            <div class="col-lg-3"><br>
                                <button 
                                        class="btn btn-primary btn-block"
                                        onclick="grabarDosisGanado(<?php  echo $idGanado; ?>);"
                                        >Grabar</button></div>
        </div>
        <div style="padding:5px; overflow-auto;" class="mt-3">

            <table class="table table-striped mt-3">
                <thead>
                    <tr>
                        <th>Fecha Aplicacion</th>
                        <th>Tipo Medicamento</th>
                        <th>Dosis</th>
                        <th>Nombre Medicamento</th>
                        <th>Marca Medicamento</th>
                        <th>Eliminar</th>
                       
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach($dosisAplicadas as $dosisAplicada)
                    {
                        $infoTipo = $this->dosisModel->traerDosisId($dosisAplicada['idTipoDosis']);  
                        echo '<tr>';  
                           $ano = substr($dosisAplicada['fecha'] , 0,4);  
                          $mes = substr($dosisAplicada['fecha'] , 5,2);  
                          $dia = substr($dosisAplicada['fecha'] , 8,2); 
                          echo '<td>'.$dia.'-'.$mes.'-'.$ano .'</td>'; 
                          echo '<td>'.$infoTipo['descripcion'].'</td>'; 
                          echo '<td>'.$dosisAplicada['dosis'].'</td>'; 
                          echo '<td>'.$dosisAplicada['nombreMedicamento'].'</td>'; 
                          echo '<td>'.$dosisAplicada['marcaMedicamento'].'</td>'; 
                          echo '<td><button class="btn btn-danger" onclick="eliminardosisAplicada('.$dosisAplicada['id'].');">Eliminar</button></td>'; 
                    }
                        ?>
                </tbody>
            </table>
        </div>
            <?php
    }

}



?>