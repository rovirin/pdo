document.addEventListener('DOMContentLoaded', function() {

    document.getElementById('dni').addEventListener('change', function(e) {

    	var campoDni = this; // Variable que referencia el campo DNI. 

    	var url = 'rellenacliente.php?dni='+campoDni.value; // Se establece la URL a la que AJAX enviará la petición

    	var ajax = NuevoAjax(); // Creamos la instancia AJAX

	    ajax.open("GET", url, true); // Lanzamos la petición AJAX

	    ajax.onreadystatechange = function() { // Si se recibe algún cambio en el estado de la petición

	        if (ajax.readyState == 4 && ajax.status == 200) {
                if(ajax.responseText!=''){ // Si se recibe como respuesta un string NO VACÍO....
				    let valores = ajax.responseText.split('_'); // Crea un array separando nombre y apellidos por el carácter separador indicado (en este caso un guion bajo)
                    
                    document.getElementById('nombre').value = valores[0];
                    document.getElementById('apellido1').value = valores[1];
                    document.getElementById('apellido2').value = valores[2];

                }
	        }

	    };

	    ajax.send(null);

    });

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