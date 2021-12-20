function buscarTarjeta() {
    var tarjeta = document.getElementById("tarjeta").value;
    if (tarjeta == "" ) {
        document.getElementById("Pedidos").innerHTML = "";
    } else {
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari 
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5 
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }  
        xmlhttp.open("GET", "buscarTar.php?tarjeta=" + tarjeta, true);
      
        xmlhttp.send();
        xmlhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                
                document.getElementById("Pedidos").innerHTML = this.responseText;
            }
        };



    } return false;
}