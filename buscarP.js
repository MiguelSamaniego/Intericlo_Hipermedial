function buscarPedido() {
    var numero = document.getElementById("numero").value;
    var nombre = document.getElementById("nombre").value;
    if (numero == "" || nombre == "") {
        document.getElementById("listado").innerHTML = "";
    } else {
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari 
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5 
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }  
        xmlhttp.open("GET", " buscarPed.php?numero=" + numero + "&nombre=" + nombre, true);
        xmlhttp.send();
        xmlhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("listado").innerHTML = this.responseText;
            }
        };
    } return false;
}