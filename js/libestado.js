
document.addEventListener('click', function(e) {
    var campo = e.target.closest('.estado');
    if (!campo) {
        return;
    }

    var id = campo.dataset.id;
    var baja = campo.dataset.baja;

    if (baja == 1) {
        baja = 0;
    } else {
        baja = 1;
    }

    var url = 'clientes_estado.php?id=' + id + '&baja=' + baja;
    var ajax = NuevoAjax();

    ajax.open("GET", url, true);
    ajax.onreadystatechange = function() {
        if (ajax.readyState == 4 && ajax.status == 200) {
            if (ajax.responseText == 'ok') {
                campo.dataset.baja = baja;
                campo.innerHTML = baja;

                if (baja == 1) {
                    campo.style.color = 'red';
                } else {
                    campo.style.color = 'green';
                }
            }
        }
    };

    ajax.send(null);
});

function NuevoAjax() {
    var xmlhttp = false;
    try {
        xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
    } catch(e) {
        try {
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        } catch(E) {
            xmlhttp = false;
        }
    }

    if (!xmlhttp && typeof XMLHttpRequest != 'undefined') {
        xmlhttp = new XMLHttpRequest();
    }

    return xmlhttp;
}
