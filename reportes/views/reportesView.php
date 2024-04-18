<?php
$raiz = dirname(dirname(dirname(__file__)));

require_once($raiz.'/vista/vista.php'); 

// require_once($raiz.'/subtipos/models/SubtipoParteModel.php'); 

class reportesView extends vista
{
    // protected $reporteModel;
   
 

    public function __construct()
    {
        // $this->clienteModel = new clienteModel();
      
    }

    public function reportesMenu()
    {
        ?>
        <div style="padding:10px;"  id="div_general_reportes" class="row">
            <div>
                    <!-- REPORTES -->
            </div>
            <div class="row">
                <div class="col-lg-2">
                    <button class="btn btn-primary" onclick="reporteMachos();">Reporte Machos</button>
                </div>
                <div class="col-lg-2">
                    <button class="btn btn-primary" onclick="reporteHembras();">Reporte Hembras</button>
                </div>

                <!-- <div class="col-lg-1"><label>Excel</label></div>
                <div class="col-lg-2">
                    <select id="idEnviarExcel" class="form-control">
                        <option value ="-1">Seleccionar...</option>
                        <option value ="1">SI</option>
                        <option value ="2">NO</option>
                    </select>
                </div> -->
                
              

            </div>
            <div id="div_resultados_reportes">
                
            </div>
        </div>
        <?php
    }

    /*
    **este reporte funciona para machos y para hembras 
    */
    public function reportePorGenero($machos,$titulo,$tipo)
    {
        $totalMachos = 0; 
        $menores3Meses = 0; 
        $de3A9Meses = 0; 
        $de9A12Meses = 0; 
        $de1A2Anos = 0;
        $de2A3Anos = 0;
        $mayora3anos=0;
        $entre3y5Anos = 0; 
        $mayores5anos = 0;
        $totalGanado = 0;

        $fecha_actual= date("Y/m/d");
            foreach($machos as $macho)
            {
                    $fecha_dada= $macho['fechaNacimiento'];
                    $dias = $this->dias_pasados($fecha_dada,$fecha_actual);
                    if($dias < 90){
                        $stringMenores3Meses .= '/'.$macho['codigo'];
                        $menores3Meses = $menores3Meses +1; 
                    }

                    if($dias >= 90 && $dias < 270){
                        $stringde3A9Meses  .= '/'.$macho['codigo'];
                        $de3A9Meses = $de3A9Meses +1; 
                    }

                    if($dias >= 270 && $dias < 360){
                        $stringde9A12Meses .= '/'.$macho['codigo'];
                        $de9A12Meses = $de9A12Meses +1; 
                    }
                    if($dias >=360 && $dias < 720){
                        $stringde1A2Anos .= '/'.$macho['codigo'];
                        $de1A2Anos = $de1A2Anos +1; 
                    }
                    if($dias >=720 && $dias <= 1095){
                        $stringde2A3Anos .= '/'.$macho['codigo'];
                        $de2A3Anos = $de2A3Anos +1; 
                    }
                    if($dias >1095 ){
                        $stringmasde3anos .= '/'.$macho['codigo'];
                        $mayora3anos = $entre3y5Anos +1; 
                    }

                    $totalMachos = $totalMachos +1; 
                    if($dias >1095 && $dias < 1825){
                        $stringmasde3A5Anos .= '/'.$macho['codigo'];
                        $entre3y5Anos = $entre3y5Anos +1; 
                    }

                    if($dias >1825){
                        $stringmayores5anos .= '/'.$macho['codigo'];
                        $mayores5anos = $mayores5anos +1; 
                    }
                    $totalMachos = $totalMachos +1; 

            }

            $totalGanado = $menores3Meses + $de3A9Meses + $de9A12Meses + $de1A2Anos + $de2A3Anos ;
            if($tipo == 1)
            {
                $totalGanado = $totalGanado +$mayora3anos;
            }
            if($tipo == 2)
            {
                $totalGanado = $totalGanado + $entre3y5Anos + $mayores5anos;
            }
            
            //mostrar el resultado del informe
            ?>
            <?php
            if($tipo == 1){
                echo '<div class="row">';
                echo '<div class="col-lg-1"></div>'; 
                echo '<div class="col-lg-2">';
                echo '<a href="generarExcel.php?tipo=1&titulo='.$titulo.'"  target="_blank" >Excel</a>';
                echo '<a href="reportes/pdf/generarPdf.php?tipo=1&titulo='.$titulo.'"  target="_blank" ><img width="30px" src="imagenes/pdf.png"></a>';
                echo '</div>'; 
                echo '</div>'; 
            }
            if($tipo == 2){
                echo '<div class="row">';
                echo '<div class="col-lg-1"></div>'; 
                echo '<div class="col-lg-2">';
                echo '<a href="generarExcel.php?tipo=2&titulo='.$titulo.'" target="_blank" >Excel</a>';
                echo '<a href="reportes/pdf/generarPdf.php?tipo=2&titulo='.$titulo.'"  target="_blank" ><img width="30px" src="imagenes/pdf.png"></a>';
                echo '</div>'; 
                echo '</div>'; 
            }
            $fecha_hoy= date("d/m/Y");
            ?>
            <div class="mt-3"><h3><?php  echo $titulo;  ?></h3></div>
            <div>FECHA: <?php echo $fecha_hoy ?> </div>
                  <table class="table table-striped hover-hover">
                        <thead>
                            
                            <th>EDAD</th>
                            <th>CANTIDAD</th>
                            <th>NOMBRE BOVINOS </th>
                        </thead>
                        <tbody>
                            <tr>
                                <td>MENOR A 3 MESES</td>
                                <td><?php  echo $menores3Meses; ?></td>
                                <td><?php  echo $stringMenores3Meses; ?></td>
                            </tr>

                            <tr>
                                <td>DE 3 HASTA 9 MESES</td>
                                <td><?php  echo $de3A9Meses; ?></td>
                                <td><?php echo $stringde3A9Meses; ?></td>
                            </tr>
                            <tr>
                                <td>DE 9 HASTA 12 MESES</td>
                                <td><?php  echo $de9A12Meses; ?></td>
                                <td><?php  echo $stringde9A12Meses; ?></td>
                            </tr>
                            <tr>
                                <td>DE 1 HASTA 2 ANOS</td>
                                <td><?php  echo $de1A2Anos; ?></td>
                                <td><?php  echo $stringde1A2Anos; ?></td>
                            </tr>
                            <tr>
                                <td>DE 2 HASTA 3 ANOS</td>
                                <td><?php  echo $de2A3Anos; ?></td>
                                <td><?php  echo $stringde2A3Anos; ?></td>
                            </tr>
                            <?php 
                                if($tipo == 1)
                                {
                                    ?>
                            <tr>
                                <td>MAYORES DE 3 ANOS</td>
                                <td><?php  echo $mayora3anos; ?></td>
                                <td><?php  echo $stringmasde3anos; ?></td>
                            </tr>
                          
                            <?php
                                }
                            ?>
                            <?php 
                                if($tipo == 2)
                                {
                                    ?>
                            <tr>
                                <td>DE 3 HASTA 5 ANOS</td>
                                <td><?php  echo $entre3y5Anos; ?></td>
                                <td><?php  echo $stringmasde3A5Anos; ?></td>
                            </tr>
                            <tr>
                                <td>MAYORES A 5 ANOS</td>
                                <td><?php  echo $mayores5anos; ?></td>
                                <td><?php  echo $stringmayores5anos; ?></td>
                            </tr>
                            <?php
                                }
                            ?>
                            <tr>
                                <td>TOTAL:</td>
                                <td><?php  echo $totalGanado  ?> </td>
                                <td></td>
                            </tr>
                        <tbody>  

                   </table>
            
            <?php

    }
    
 
    function dias_pasados($fecha_inicial,$fecha_final)
    {
        $dias = (strtotime($fecha_inicial)-strtotime($fecha_final))/86400;
        $dias = abs($dias); $dias = floor($dias);
        return $dias;
    }

    


}    