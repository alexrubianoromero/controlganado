function formuFactura(idCliente)
{
    //  alert(idCliente);
    const http=new XMLHttpRequest();
    const url = 'facturas/facturas.php';
    http.onreadystatechange = function(){

        if(this.readyState == 4 && this.status ==200){
               document.getElementById("modalBodyFactura").innerHTML  = this.responseText;
        }
    };
    http.open("POST",url);
    http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    http.send('opcion=formuFactura'
                +'&idCliente='+idCliente
    );
}
function grabarFactura(idCliente)
{
    //  alert(idCliente);
    // var idCliente = document.getElementById('idCliente').value;
    var observaciones = document.getElementById('observaciones').value;
    var valor = document.getElementById('valor').value;

    const http=new XMLHttpRequest();
    const url = 'facturas/facturas.php';
    http.onreadystatechange = function(){

        if(this.readyState == 4 && this.status ==200){
               document.getElementById("modalBodyFactura").innerHTML  = this.responseText;
        }
    };
    http.open("POST",url);
    http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    http.send('opcion=grabarFactura'
                +'&idCliente='+idCliente
                +'&observaciones='+observaciones
                +'&valor='+valor
    );
}