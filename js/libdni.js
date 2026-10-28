document.addEventListener('DOMContentLoaded', function() {
   
    document.getElementById('dni').addEventListener('change', function(e) {
    	var campoDni = this;
    	var url = 'compruebadni.php?dni='+campoDni.value;
    	var ajax = NuevoAjax();
	    ajax.open("GET", url, true);
	    ajax.onreadystatechange = function() {
	        if (ajax.readyState == 4 && ajax.status == 200) {
	            // Esperamos la respuesta que el servidor le ha dado de vuelta a Ajax a través de ajax.responseText
	            if(ajax.responseText == 'ok'){
	            	campoDni.style.background='#C6FFC6';
	            }
	            else{
	            	campoDni.style.background='#FF9B9B';
	            	alert(ajax.responseText);
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