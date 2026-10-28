document.addEventListener('click', function(e) {

    var enlace = e.target.closest('.paradetalle');

    if(!enlace){return;} // Si no se ha hecho click en uno de los productos (es decir, no es de la clase "paradetalle"), sacamos el flujo de la función para que siga su curso.)

    var url = 'productos_modal.php?id='+enlace.dataset.id;

    var ajax = NuevoAjax();

    ajax.open("GET", url, true); 

    ajax.onreadystatechange = function() {

        if (ajax.readyState == 4 && ajax.status == 200) {
            let divdetalle = document.getElementById('infodetalle');

            divdetalle.innerHTML = ajax.responseText; // Rellenamos el div "divdetalle" con el contenido que nos viene preparado desde PHP. 
            

        }

    };

    ajax.send(null);

});



 


function NuevoAjax(){
    var xmlhttp=false;
    try{
        xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
    }catch(e){
        try{
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }catch(E){
            xmlhttp = false;
        }
    }

    if(!xmlhttp && typeof XMLHttpRequest!='undefined'){
        xmlhttp = new XMLHttpRequest();
    }
    return xmlhttp;
}