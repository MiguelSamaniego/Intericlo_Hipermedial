
<?php 
 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restaurante</title>
    <link rel="stylesheet" href="../../css/bootstrap.min.css" />
    <link rel="stylesheet" href="../../css/base.css" />
</head>
<body>
<nav class="navbar navbar-expand navbar-light bg-light">
    <ul class="nav navbar-nav">
    
        <li class="nav-item active">
            <a class="nav-link" href="principal_restaurante.php">Administrar Productos </a>
        </li>
        
        <li class="nav-item">
            <a class="nav-link" href="../../index.html">Salir</a>
        </li>
    </ul>
</nav>

<?php

//inicio de productos 
$txtCodigo = (isset($_POST['txtCodigo'])) ? $_POST['txtCodigo'] : "";
$txtNombre = (isset($_POST['txtNombre'])) ? $_POST['txtNombre'] : "";
$txtDescripcion = (isset($_POST['txtDescripcion'])) ? $_POST['txtDescripcion'] : "";
$txtPresio = (isset($_POST['txtPresio'])) ? $_POST['txtPresio'] : "";
$accion = (isset($_POST['accion'])) ? $_POST['accion'] : "";
$precio = doubleval($txtPresio);
$c=(int)($_GET["codRes"]);
//echo $txtCodigo;
include '../../conf/conexionBD.php';
switch ($accion) {
    case 'Agregar':
        $sentenciaSQL = "INSERT INTO productos VALUES (0,'$txtNombre','$txtDescripcion','$precio',$c)";
        if ($coon->query($sentenciaSQL) == true) {
        } else {
            echo "No Vale" . mysqli_error($coon);
        }
        header('Locatio:platillos.php');
        break;
    case "Modificar" :
        $sentenciaSQL = "UPDATE productos SET pro_nombre= '$txtNombre' WHERE pro_codigo=$txtCodigo ";
        $Seleccionado = $coon->query($sentenciaSQL);
        break;
    case 'Cancelar':
        break;
    case 'Selecionar':
        $sentenciaSQL = "SELECT * FROM productos WHERE pro_codigo=$txtCodigo ";
        $Seleccionado = $coon->query($sentenciaSQL);

        foreach ( $Seleccionado as $productoss) {
            $txtNombre = $productoss['pro_nombre']; 
            $txtDescripcion = $productoss['pro_descripcion'];
            $txtPresio = $productoss['pro_precio'];
            $txtCodigo = $productoss['pro_codigo'];
            
        }


        break;
    case 'Eliminar':
        $sentenciaSQL = "DELETE FROM productos WHERE pro_codigo=$txtCodigo ";
        $Seleccionado = $coon->query($sentenciaSQL);
        if($coon->query($sentenciaSQL) ==TRUE){
           //  echo "Eliminado";
        }else{
            //echo "no eliminado";
        }
        break;
}

$sentenciaSQL = "SELECT * FROM productos WHERE res_codigo_fk=$c";
$listado = $coon->query($sentenciaSQL);
?>
<section class="producto">
<div class="col-md-5">

    <div class="card">
        <div class="card-body">
            <h1>Ingrese el Producto</h1>
            <form method="POST" enctype="multipart/form-data">
                <div class="form-group">
                </div>
                <div class="form-group">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" name="txtNombre" value="<?php echo $txtNombre; ?>" placeholder="Nombre">
                        <label for="floatingInput">Nombre</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" name="txtDescripcion" value="<?php echo $txtDescripcion; ?>" placeholder="Descripcion">
                        <label for="floatingInput">Descripcion</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" name="txtPresio" value="<?php echo $txtPresio; ?>" placeholder="Precio">
                        <label for="floatingInput">Presio</label>
                    </div>
                    
                </div>
                <div class="btn-group" role="group" aria-label="">
                    <button type="submit" name="accion" <?php echo ($accion=='Selecionar')?'disabled':'';?> value="Agregar" class="btn btn-success">Agregar</button>
                    <button type="submit" name="accion" <?php echo ($accion!='Selecionar')?'disabled':'';?> value="Modificar" class="btn btn-warning">Modificar</button>
                    <button type="submit" name="accion" <?php echo ($accion!='Selecionar')?'disabled':'';?> value="Cancelar" class="btn btn-info">Limpiar</button>
                </div>
            </form>
        </div>
    </div>
</div>
</section>

<div class="col-md-7">
    <table class="table">
        <thead>
            <tr>
                <th>Codigo</th>
                <th>Nombre</th>
                <th>Descripcion</th>
                <th>Precio</th>
                <th>Seleccionar/Eliminar</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($listado as $producto) { ?>
                <tr>
                    <td><?php echo $producto['pro_codigo']; ?></td>
                    <td><?php echo $producto['pro_nombre']; ?></td>
                    <td><?php echo $producto['pro_descripcion']; ?></td>
                    <td><?php echo $producto['pro_precio']; ?></td>
                    <td>
                        <form method="POST">
                            <input type="hidden" name="txtCodigo" id="txtCodigo" value="<?php echo $producto['pro_codigo']; ?>" />
                            <input type="submit" name="accion" value="Selecionar" class="btn btn-success">
                            <input type="submit" name="accion" value="Eliminar" class="btn btn-danger">
                        </form>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

    
</body>
</html>