function formuNuevoGanado()
{
    // alert('formu nuevo '); 
    const http=new XMLHttpRequest();
    const url = 'ganado/ganado.php';
    http.onreadystatechange = function(){

        if(this.readyState == 4 && this.status ==200){
               document.getElementById("div_resultados_ganado").innerHTML  = this.responseText;
        }
    };
    http.open("POST",url);
    http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    http.send('opcion=formuNuevoGanado'
            // +'&idCliente='+idCliente
    );
}
function traerGanadoFiltradoCodigo()
{
    // alert('formu nuevo '); 
    var codigo = document.getElementById('codigoGanadoTxt').value;
    const http=new XMLHttpRequest();
    const url = 'ganado/ganado.php';
    http.onreadystatechange = function(){

        if(this.readyState == 4 && this.status ==200){
               document.getElementById("div_resultados_ganado").innerHTML  = this.responseText;
        }
    };
    http.open("POST",url);
    http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    http.send('opcion=traerGanadoFiltradoCodigo'
            +'&codigo='+codigo
    );
}
function eliminarGanado(id)
{
    $valida = confirm('Esta seguro de eliminar este registro?');
    if($valida){
        const http=new XMLHttpRequest();
        const url = 'ganado/ganado.php';
        http.onreadystatechange = function(){
            
            if(this.readyState == 4 && this.status ==200){
                document.getElementById("div_resultados_ganado").innerHTML  = this.responseText;
            }
        };
        http.open("POST",url);
        http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        http.send('opcion=eliminarGanado'
        +'&id='+id
        );
    }
}
function traerGanadoFiltradoTatuaje()
{
    // alert('formu nuevo '); 
    var tatuaje = document.getElementById('codigoTatuajeTxt').value;
    const http=new XMLHttpRequest();
    const url = 'ganado/ganado.php';
    http.onreadystatechange = function(){

        if(this.readyState == 4 && this.status ==200){
               document.getElementById("div_resultados_ganado").innerHTML  = this.responseText;
        }
    };
    http.open("POST",url);
    http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    http.send('opcion=traerGanadoFiltradoTatuaje'
            +'&tatuaje='+tatuaje
    );
}
function formuNuevoHijo(idMadre)
{
    // alert('formu nuevo '); 
    const http=new XMLHttpRequest();
    const url = 'ganado/ganado.php';
    http.onreadystatechange = function(){

        if(this.readyState == 4 && this.status ==200){
               document.getElementById("modalBodyNuevoHijo").innerHTML  = this.responseText;
        }
    };
    http.open("POST",url);
    http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    http.send('opcion=formuNuevoHijo'
            +'&idMadre='+idMadre
    );
}
function registrarHijo(idMadre)
{
    // alert('formu nuevo '); 
    var valida =  validaInfoRegistrarHijo();
    if(valida == '1')
    {
            var fechaNaci = document.getElementById('fechaNaciHijoTxt').value;
            var codigo = document.getElementById('numeroCriaHijoTxt').value;
            var noCria = document.getElementById('numeroCriaHijoTxt').value;
            var noTatuaje = document.getElementById('tatuajeHijoTxt').value;
            var sexo = document.getElementById('sexoHijoTxt').value;
            var tipoevento = document.getElementById('tipoEventoTxt').value;
            var numeroAnterior = document.getElementById('numeroAnteriorHijoTxt').value;
            var intervaloPartos = document.getElementById('intervaloPartosHijoTxt').value;
            var proximoParto = document.getElementById('proximoPartoHijoTxt').value;
            var novedad = document.getElementById('novedadHijoTxt').value;
            var fechaVenta = document.getElementById('fechaVentaHijoTxt').value;
            const http=new XMLHttpRequest();
            const url = 'ganado/ganado.php';
            http.onreadystatechange = function(){

                if(this.readyState == 4 && this.status ==200){
                    document.getElementById("modalBodyNuevoHijo").innerHTML  = this.responseText;
                }
            };
            http.open("POST",url);
            http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            http.send('opcion=registrarHijo'
                    +'&codigo='+codigo
                    +'&fechaNaci='+fechaNaci
                    +'&noCria='+noCria
                    +'&noTatuaje='+noTatuaje
                    +'&sexo='+sexo
                    +'&idMadre='+idMadre
                    +'&tipoevento='+tipoevento
                    +'&numeroAnterior='+numeroAnterior
                    +'&intervaloPartos='+intervaloPartos
                    +'&proximoParto='+proximoParto
                    +'&novedad='+novedad
                    +'&fechaVenta='+fechaVenta
            );
    }
}

function  validaInfoRegistrarHijo()
{
    if( document.getElementById('fechaNaciHijoTxt').value == ''){
        alert('Por favor digitar Fecha Nacimiento');
        document.getElementById('fechaNaciHijoTxt').focus();
        return 0;
    }
    if( document.getElementById('tipoEventoTxt').value == '-1'){
        alert('Por favor Escoger Evento');
        document.getElementById('tipoEventoTxt').focus();
        return 0;
    }
    if( document.getElementById('numeroCriaHijoTxt').value == ''){
        alert('Por favor digitar numero cria');
        document.getElementById('numeroCriaHijoTxt').focus();
        return 0;
    }
    if( document.getElementById('tatuajeHijoTxt').value == ''){
        alert('Por favor digitar tatuaje oreja');
        document.getElementById('tatuajeHijoTxt').focus();
        return 0;
    }
    if( document.getElementById('sexoHijoTxt').value == '-1'){
        alert('Por favor digitar sexo');
        document.getElementById('sexoHijoTxt').focus();
        return 0;
    }
  
    return 1;
}


function buscarGanado()
{
    var codigo = document.getElementById('codigoGanadoTxt').value;
    const http=new XMLHttpRequest();
    const url = 'ganado/ganado.php';
    http.onreadystatechange = function(){

        if(this.readyState == 4 && this.status ==200){
               document.getElementById("div_resultados_ganado").innerHTML  = this.responseText;
               document.getElementById("div_ver_mas_resultados_ganado").innerHTML  = '';;
        }
    };
    http.open("POST",url);
    http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    http.send('opcion=buscarGanado'
            +'&codigo='+codigo
    );
}

function verMasInfoGanado(idGanado)
{
    // var codigo = document.getElementById('codigoGanadoTxt').value;
    const http=new XMLHttpRequest();
    const url = 'ganado/ganado.php';
    http.onreadystatechange = function(){

        if(this.readyState == 4 && this.status ==200){
               document.getElementById("div_ver_mas_resultados_ganado").innerHTML  = this.responseText;
        }
    };
    http.open("POST",url);
    http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    http.send('opcion=verMasInfoGanado'
            +'&idGanado='+idGanado
    );
}
function verMasInfoGanadoModal(idGanado)
{
    // var codigo = document.getElementById('codigoGanadoTxt').value;
    const http=new XMLHttpRequest();
    const url = 'ganado/ganado.php';
    http.onreadystatechange = function(){

        if(this.readyState == 4 && this.status ==200){
               document.getElementById("modalBodyInfoGanado").innerHTML  = this.responseText;
        }
    };
    http.open("POST",url);
    http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    http.send('opcion=verMasInfoGanado'
            +'&idGanado='+idGanado
    );
}
function verDosisGanado(idGanado)
{
    // var codigo = document.getElementById('codigoGanadoTxt').value;
    const http=new XMLHttpRequest();
    const url = 'ganado/ganado.php';
    http.onreadystatechange = function(){

        if(this.readyState == 4 && this.status ==200){
               document.getElementById("modalBodyDosisfoGanado").innerHTML  = this.responseText;
        }
    };
    http.open("POST",url);
    http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    http.send('opcion=verDosisGanado'
            +'&idGanado='+idGanado
    );
}
function grabarDosisGanado(idGanado)
{
    var valida = validaInfoDosis();
    if(valida)
    {
        var fechaDosis = document.getElementById('fechaDosis').value;
        var idTipoDosis = document.getElementById('idTipoDosis').value;
        var nombreMedicamento = document.getElementById('nombreMed').value;
        var dosisMed = document.getElementById('dosisMed').value;
        var marcaMed = document.getElementById('marcaMed').value;
        const http=new XMLHttpRequest();
        const url = 'ganado/ganado.php';
        http.onreadystatechange = function(){
            
            if(this.readyState == 4 && this.status ==200){
                document.getElementById("modalBodyDosisfoGanado").innerHTML  = this.responseText;
            }
        };
        http.open("POST",url);
        http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        http.send('opcion=grabarDosisGanado'
        +'&idGanado='+idGanado
        +'&fechaDosis='+fechaDosis
        +'&idTipoDosis='+idTipoDosis
        +'&nombreMedicamento='+nombreMedicamento
        +'&dosisMed='+dosisMed
        +'&marcaMed='+marcaMed
        );
        setTimeout(() => {
            verDosisGanado(idGanado); 
        }, 250);
    }
}


function  validaInfoDosis()
{
    if( document.getElementById('fechaDosis').value == ''){
        alert('Por favor digitar Fecha');
        document.getElementById('fechaDosis').focus();
        return 0;
    }
    if( document.getElementById('idTipoDosis').value == '-1'){
        alert('Por favor Escoger Tipo dosis');
        document.getElementById('idTipoDosis').focus();
        return 0;
    }
    if( document.getElementById('dosisMed').value == '-1'){
        alert('Por favor Escoger  dosis');
        document.getElementById('dosisMed').focus();
        return 0;
    }
    if( document.getElementById('nombreMed').value == ''){
        alert('Por favor digitar nombre medicamento');
        document.getElementById('nombreMed').focus();
        return 0;
    }
    if( document.getElementById('marcaMed').value == ''){
        alert('Por favor digitar marca');
        document.getElementById('marcaMed').focus();
        return 0;
    }
    return 1;
}



function verImagenGanadoModal(idGanado)
{
    // var codigo = document.getElementById('codigoGanadoTxt').value;
    const http=new XMLHttpRequest();
    const url = 'ganado/ganado.php';
    http.onreadystatechange = function(){

        if(this.readyState == 4 && this.status ==200){
               document.getElementById("modalBodyVerImagenGanado").innerHTML  = this.responseText;
        }
    };
    http.open("POST",url);
    http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    http.send('opcion=verImagenGanadoModal'
            +'&idGanado='+idGanado
    );
}
function eliminardosisAplicada(idSosisAplicada)
{
    validar = confirm('David Esta seguro que desea eliminar este registro? ');
    if(validar){

        // var codigo = document.getElementById('codigoGanadoTxt').value;
        const http=new XMLHttpRequest();
        const url = 'ganado/ganado.php';
        http.onreadystatechange = function(){
            
                if(this.readyState == 4 && this.status ==200){
                           document.getElementById("modalBodyDosisfoGanado").innerHTML  = this.responseText;
                    }
                };
                http.open("POST",url);
                http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                http.send('opcion=eliminardosisAplicada'
                        +'&idSosisAplicada='+idSosisAplicada
                );
    }
                
}
function formuModificarGanado(idGanado)
{
    
    // var codigo = document.getElementById('codigoGanadoTxt').value;
    const http=new XMLHttpRequest();
    const url = 'ganado/ganado.php';
    http.onreadystatechange = function(){

        if(this.readyState == 4 && this.status ==200){
               document.getElementById("modalBodyModificarGanado").innerHTML  = this.responseText;
        }
    };
    http.open("POST",url);
    http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    http.send('opcion=formuModificarGanado'
            +'&idGanado='+idGanado
    );
}

function actualizarGanado(idGanado)
{
    
    var numeroCria = document.getElementById('numeroCriaTxt').value;
    var numeroCriaAnterior = document.getElementById('numeroCriaAnteriorTxt').value;
    var tatuajeOreja = document.getElementById('tatuajeOrejaTxt').value;
    var sexo = document.getElementById('sexoTxt').value;
    var intervaloPartos = document.getElementById('intervaloPartosTxt').value;
    var proximoParto = document.getElementById('proximoPartoTxt').value;
    var novedad = document.getElementById('novedadTxt').value;
    var fechaventaoevento = document.getElementById('fechaventaoeventoTxt').value;
    var fechaNacimiento = document.getElementById('fechaNacimientoTxt').value;
    var fechaCompra = document.getElementById('fechaCompraTxt').value;
    const http=new XMLHttpRequest();
    const url = 'ganado/ganado.php';
    http.onreadystatechange = function(){

        if(this.readyState == 4 && this.status ==200){
               document.getElementById("modalBodyModificarGanado").innerHTML  = this.responseText;
        }
    };
    http.open("POST",url);
    http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    http.send('opcion=actualizarGanado'
            +'&idGanado='+idGanado
            +'&numeroCria='+numeroCria
            +'&numeroCriaAnterior='+numeroCriaAnterior
            +'&tatuajeOreja='+tatuajeOreja
            +'&sexo='+sexo
            +'&intervaloPartos='+intervaloPartos
            +'&proximoParto='+proximoParto
            +'&novedad='+novedad
            +'&fechaventaoevento='+fechaventaoevento
            +'&fechaNacimiento='+fechaNacimiento
            +'&fechaCompra='+fechaCompra
    );
}


function registrarGanado()
{
    var valida = validaInfoNuevoGanado();
    if(valida)
    {
        // alert('paso validacion'); 
        
        var idMadre = document.getElementById('idMadre').value;
        var fechaNacimiento = document.getElementById('fechaNacimientoTxt').value;
        var evento = document.getElementById('eventoTxt').value;
        var numeroCria = document.getElementById('numeroCriaTxt').value;
        var tatuajeOreja = document.getElementById('tatuajeOrejaTxt').value;
        var sexo = document.getElementById('sexoTxt').value;
        var intervaloPartos = document.getElementById('intervaloPartosTxt').value;
        var proximoParto = document.getElementById('proximoPartoTxt').value;
        var fechaCompra = document.getElementById('fechaComnpraUOtroTxt').value;
        const http=new XMLHttpRequest();
        const url = 'ganado/ganado.php';
        http.onreadystatechange = function(){

            if(this.readyState == 4 && this.status ==200){
                document.getElementById("div_resultados_ganado").innerHTML  = this.responseText;
            }
        };
        http.open("POST",url);
        http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        http.send('opcion=registrarGanado'
                // +'&codigo='+codigo
                +'&idMadre='+idMadre
                +'&fechaNacimiento='+fechaNacimiento
                +'&evento='+evento
                +'&numeroCria='+numeroCria
                +'&tatuajeOreja='+tatuajeOreja
                +'&sexo='+sexo
                +'&intervaloPartos='+intervaloPartos
                +'&proximoParto='+proximoParto
                +'&fechaCompra='+fechaCompra
        );
    }  
}

function  validaInfoNuevoGanado()
{
  
    // if( document.getElementById('fechaNacimientoTxt').value == ''){
    //     alert('Por favor seleccionar fecha');
    //     document.getElementById('fechaNacimientoTxt').focus();
    //     return 0;
    // }
    
    if( document.getElementById('fechaComnpraUOtroTxt').value == ''){
        alert('Por favor seleccionar fecha compra');
        document.getElementById('fechaComnpraUOtroTxt').focus();
        return 0;
    }
    
    if( document.getElementById('eventoTxt').value == '-1'){
        alert('Por favor escoger evento');
        document.getElementById('eventoTxt').focus();
        return 0;
    }
    if( document.getElementById('numeroCriaTxt').value == ''){
        alert('Por favor digitar nombre');
        document.getElementById('numeroCriaTxt').focus();
        return 0;
    }
    if( document.getElementById('tatuajeOrejaTxt').value == ''){
        alert('Por favor digitar tatuaje Oreja');
        document.getElementById('tatuajeOrejaTxt').focus();
        return 0;
    }
    if( document.getElementById('sexoTxt').value == ''){
        alert('Por favor escoger el género');
        document.getElementById('sexoTxt').focus();
        return 0;
    }
    return 1;
}


function realizarCargaArchivo(idGanado)
{
    // var idPedidoDev = document.getElementById('idPedidoDev').value;
    // var idItemDev = document.getElementById('idItemDev').value;
    // var obseDevolucion = document.getElementById('obseDevolucion').value;
    // alert('clik en subir archivo ');
    var inputFile = document.getElementById('archivo');
    if (inputFile.files.length > 0) {
        let formData = new FormData();
        formData.append("archivo", inputFile.files[0]); // En la posición 0; es decir, el primer elemento
        formData.append("opcion", 'realizarCargaArchivo'); // En la posición 0; es decir, el primer elemento
        formData.append("idGanado", idGanado); // En la posición 0; es decir, el primer elemento
        // formData.append("idPedidoDev", idPedidoDev); // En la posición 0; es decir, el primer elemento
        // formData.append("idItemDev", idItemDev); // En la posición 0; es decir, el primer elemento
        // formData.append("obseDevolucion", obseDevolucion); // En la posición 0; es decir, el primer elemento
        fetch("ganado/ganado.php", {
            method: 'POST',
            body: formData,
        })
            .then(respuesta => respuesta.text())
            .then(decodificado => {
                console.log(decodificado.archivo);
                document.getElementById("div_cargue_archivo").innerHTML = 'Imagen Almacenada!!';
            });
    } else {
        alert("Selecciona un archivo");
    }
    setTimeout(() => {
        verImagenGanadoModal(idGanado); 
    }, 300);
    // var inputFile = document.getElementById('imagen');
    // if (inputFile.files.length > 0) {
    //     let formData = new FormData();
    //     formData.append("file", inputFile.files[0]); // En la posición 0; es decir, el primer elemento
    //     formData.append("opcion", 'subirFoto'); // En la posición 0; es decir, el primer elemento
    //     fetch("subir/subir.php", {
    //         method: 'POST',
    //         body: formData,
    //     })
    //         .then(respuesta => respuesta.text())
    //         .then(decodificado => {
    //             console.log(decodificado.archivo);
    //             document.getElementById("div_cargue_archivo").innerHTML = 'Cargue Realizado!!';
    //         });
    // } else {
    //     alert("Selecciona un archivo");
    // }
}