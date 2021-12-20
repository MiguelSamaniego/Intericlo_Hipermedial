<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./css/bootstrap.min.css" />
    <link rel="stylesheet" href="./css/mio.css" />
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="index.html">INICIO</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor02" aria-controls="navbarColor02" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarColor02">
      <ul class="navbar-nav me-auto">
        <li class="nav-item">
          <a class="nav-link" href="#">Comidas</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Ver Comidas</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">About</a>
        </li>
        
      </ul>
    </div>
  </div>
</nav>

<?php
include('conf/conexionBD.php');
$txtNombre = (isset($_POST['Nombre'])) ? $_POST['Nombre'] : "";
$txtPrecio = (isset($_POST['Precio'])) ? $_POST['Precio'] : "";
$txtImagen = (isset($_FILES['Imagen']['name'])) ? $_FILES['Imagen']['name'] : "";
$accion = (isset($_POST['accion'])) ? $_POST['accion'] : "";
$precio = doubleval($txtPrecio);

switch ($accion) {
    case 'Agregar':
      //echo "Entraste a Agregar" ;
        //$fecha = new DateTime();
        //$nombreArchivo = ($txtImagne != "") ? $fecha->getTimestamp() . "_" . $_FILES['txtImagne']['name'] : "imagen.jpg";
        //$tmpimagen = $_FILES['txtImagne']['tmp_name'];
        //if ($tmpimagen != "") {
          //  move_uploaded_file($tmpimagen, '../../../img/' . $nombreArchivo);
       // }

        $sentenciaSQL = "INSERT INTO comida VALUES (0,'$txtNombre','$precio','imagen.jpg')";
        $Seleccionado = $coon->query($sentenciaSQL);
        //header('Locatio:platillos.php');
        break;
    case 'Modificar':

        $sentenciaSQL = "UPDATE app_producto SET pro_nombre='$txtNombre', pro_descripcion='$txtDescripcion', pro_precio='$precio' WHERE pro_id=$txtCodigo ";
        $Seleccionado = $coon->query($sentenciaSQL);

        if ($txtImagne != "") {
            $fecha = new DateTime();
            $nombreArchivo = ($txtImagne != "") ? $fecha->getTimestamp() . "_" . $_FILES['txtImagne']['name'] : "imagen.jpg";
            $tmpimagen = $_FILES['txtImagne']['tmp_name'];
            move_uploaded_file($tmpimagen, '../../../img/' . $nombreArchivo);

            $sentenciaSQL = "SELECT pro_imagen FROM app_producto WHERE pro_id=$txtCodigo ";
            $Seleccionado = $coon->query($sentenciaSQL);
            foreach ($Seleccionado as $productoss) {
                if (isset($productoss["pro_imagen"]) && ($productoss["pro_imagen"] != "imagen.jpg")) {
                    if (file_exists('../../../img/' . $productoss['pro_imagen'])) {
                        unlink('../../../img/' . $productoss['pro_imagen']);
                    }
                }
            }

            $sentenciaSQL = "UPDATE app_producto SET pro_imagen='$nombreArchivo' WHERE pro_id=$txtCodigo ";
            $Seleccionado = $coon->query($sentenciaSQL);
        }
        header('Locatio:platillos.php');
        break;
    case 'Cancelar':
        header('Locatio:platillos.php');
        break;
    case 'Selecionar':
        $sentenciaSQL = "SELECT * FROM app_producto WHERE pro_id=$txtCodigo ";
        $Seleccionado = $coon->query($sentenciaSQL);
        foreach ($Seleccionado as $productoss) {
            $txtNombre = $productoss['pro_nombre'];
            $txtDescripcion = $productoss['pro_descripcion'];
            $txtPresio = $productoss['pro_precio'];
            $txtImagne = $productoss['pro_imagen'];
        }
       
        break;
    case 'Borrar':
        $sentenciaSQL = "SELECT pro_imagen FROM app_producto WHERE pro_id=$txtCodigo ";
        $Seleccionado = $coon->query($sentenciaSQL);
        foreach ($Seleccionado as $productoss) {
            if (isset($productoss["pro_imagen"]) && ($productoss["pro_imagen"] != "imagen.jpg")) {
                if (file_exists('../../../img/' . $productoss['pro_imagen'])) {
                    unlink('../../../img/' . $productoss['pro_imagen']);
                }
            }
        }

        $sentenciaSQL = "DELETE FROM app_producto WHERE pro_id=$txtCodigo ";
        $Seleccionado = $coon->query($sentenciaSQL);
        header('Locatio:platillos.php');
        break;
}

$sentenciaSQL = "SELECT * FROM app_producto ";
$listado = $coon->query($sentenciaSQL);
?>
<div class="col-md-5">

  <form method="POST" enctype="multipart/form-data">
    <fieldset>
      <legend>COMIDAS</legend>
      <div class="form-group row">
        <label for="nombre" class="col-sm-2 col-form-label">Nombre</label>
        <div class="col-sm-10">
          <input type="text" readonly="" class="form-control-plaintext" id="staticEmail" value="comida">
        </div>
      </div>

    <div class="form-group">
      <label class="col-form-label mt-4" for="inputDefault">Nombre</label>
      <input type="text" class="form-control" name="Nombre" placeholder="Nombre" id="inputDefault" spellcheck="false" data-ms-editor="true">
    </div>
    <div class="form-group">
      <label class="col-form-label mt-4" for="inputDefault">Precio</label>
      <input type="text" class="form-control" name="Precio" placeholder="Precio" id="inputDefault" spellcheck="false" data-ms-editor="true">
    </div>
<!--
    <div class="form-group">
      <label for="formFile" class="form-label mt-4">Ingrese una imagen</label>
      <input class="form-control"  name="Imagen" type="file" id="formFile">
    </div>  
-->
    <br>
    <div class="btn-group" role="group" aria-label="">
                    <button type="submit" name="accion" value="Agregar" class="btn btn-success">Agregar</button>
                    <button type="submit" name="accion" value="Cancelar" class="btn btn-info">Cancelar</button>
                </div>  
  </form>
</div>
</section>

</div>
</body>
</html>