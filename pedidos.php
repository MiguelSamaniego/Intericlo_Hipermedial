<?php 
  session_start();
  if(!isset($_SESSION['lista'])){
    $_SESSION['lista']=array();
    $_SESSION['total']=0.0;
    
  }else{
    $nuevo= $_SESSION['lista'];
    $total3s=$_SESSION['lista'];
  }
  
  
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    
    <link rel="stylesheet" href="./css/bootstrap.min.css" />
    <link rel="stylesheet" href="./css/mio.css" />
    <link rel="stylesheet" href="./css/mio.css" />
    <script src="buscarTarjeta.js" type="text/javascript"></script>

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
          <a class="nav-link" href="pedidos.php">Pedidos</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="buscarPedidos.php">Ver pedidos</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="verpedidos.html">Buscar</a>
        </li>
        
      </ul>
    </div>
  </div>
</nav>
  <!-- inicia la tabla de pedidos  -->
  <?php
include('conf/conexionBD.php');
$txtCodigo = (isset($_POST['txtCodigo'])) ? $_POST['txtCodigo'] : "";
$txtCantidad = (isset($_POST['txtCantidad'])) ? $_POST['txtCantidad'] : "";
$txtNombre = (isset($_POST['txtCliente'])) ? $_POST['txtCliente'] : "";
$txtPresio = (isset($_POST['txtPresio'])) ? $_POST['txtPresio'] : "";
$accion = (isset($_POST['accion'])) ? $_POST['accion'] : "";
$precio = doubleval($txtPresio);
$txtObservaciones=(isset($_POST['txtObservaciones'])) ? $_POST['txtObservaciones'] : "";

$sql="SELECT * FROM comida ";
$restaurantes=$coon->query($sql);
switch ($accion) {
    case 'Agregar':
        $subtotal= (int)($txtCantidad)*$precio;
        $arreglo= [$txtCantidad,$precio,$subtotal,$txtCodigo];
        $_SESSION['lista'][]=$arreglo;
        $total3s=$_SESSION['lista'];
        break;
    case 'Comprar':
        date_default_timezone_set("America/Guayaquil");
        $fecha = date('Y-m-d');
        $cabSubtotal=0.0;
        $Iva=0.0;
        
        foreach($total3s as $t){
            $_SESSION['total']=$_SESSION['total']+$t[2];
        }
        $total=$_SESSION['total'];
        $sentenciaSQL = "INSERT INTO pedido_cabecera VALUES (0,'$fecha','$txtNombre',$total,1,'$txtObservaciones')";
        $Seleccionado = $coon->query($sentenciaSQL);
        if ($Seleccionado === TRUE) {
                foreach($total3s as $t){
                    $busCod = "SELECT MAX(cab_codigo) FROM pedido_cabecera ";
                    $row = mysqli_fetch_array($coon->query($busCod));
                    $cabId = intval($row[0]);
                    $cantidad=$t[0];
                    $precioUni=$t[1];
                    $totalDet=$t[2];
                    $codProducto=$t[3];
                    $sentenciaSQL = "INSERT INTO pedido_detalle VALUES (0,$cantidad,$precioUni,$totalDet,$t[3],$cabId)";
                    $Seleccionado = $coon->query($sentenciaSQL);
                }
                $_SESSION['lista']=array();
                $_SESSION['total']=0.0;
        }else{
           // echo 'NO cargo';
        }
        break;
    case 'Cancelar':
        $_SESSION['lista']=array();
        $_SESSION['total']=0.0;
        $sentenciaSQL = "SELECT * FROM comida WHERE com_codigo=$txtCodigo ";
        $Seleccionado = $coon->query($sentenciaSQL);
        break;
    case 'Selecionar':
        $txtNombre =$txtNombre ;
        $sentenciaSQL = "SELECT * FROM comida WHERE com_codigo=$txtCodigo ";
        $Seleccionado = $coon->query($sentenciaSQL);
        foreach ($Seleccionado as $productoss) {
            $txtCodigo =$txtCodigo ;
            $txtNombre =$txtNombre ;
            $txtPresio = $productoss['com_precio'];
            $txtNombreComida=$productoss['com_nombre'];
            echo $txtNombreComida;
            
        }
       
        break;
    case 'Borrar':
        $sentenciaSQL = "DELETE FROM comida WHERE pro_codigo=$txtCodigo ";
        $Seleccionado = $coon->query($sentenciaSQL);
        break;
}

$sentenciaSQL = "SELECT * FROM comida ";
$listado = $coon->query($sentenciaSQL);
?>
<section id="buscarT">
        <form id="Pedidos" onsubmit="return buscarTarjeta()">
            <br>
            <br>
            <div class="col-sm-10">
                <input type="text" id="tarjeta" class="form-control" aria-describedby="emailHelp" name="tarjeta" value="" placeholder="Ingrese el  numero de la Tarjeta">
            </div>
            <br>
            <br>
            <div class="col-sm-10">
                <button type="submit" class="btn btn-primary" id="buscar" name="buscar" value="Buscar" onclick="buscarTarjeta()">Buscar</button>
            </div>
        </form>
</section>
<section class="producto">

<div class="col-md-5">

    <div class="card">
        <div class="card-body">
            <h1>Ingrese el Producto</h1>
            <form method="POST" enctype="multipart/form-data"  >
                <div class="form-group">
                </div>
                <div class="form-group">
                    
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" name="txtCliente" value="<?php echo $txtNombre; ?>" placeholder="Cliente">
                        <label for="floatingInput">Cliente</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id = "tarjeta"  name="txtNumeroTarjeta" value="" placeholder="Tarjeta">
                        <label for="floatingInput">Tarjeta</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" name="txtCodigo" value="<?php echo $txtCodigo; ?>" placeholder="Codigo Producto">
                        <label for="floatingInput">Codigo Producto</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" name="txtCantidad" value="" placeholder="cantidad">
                        <label for="floatingInput">Cantidad</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" name="txtPresio" value="<?php echo $txtPresio; ?>" placeholder="Precio">
                        <label for="floatingInput">Precio</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" name="txtObservaciones" value="<?php echo $txtObservaciones; ?>" placeholder="Observaciones">
                        <label for="floatingInput">Observaciones</label>
                    </div>
                    
                </div>
                <div class="btn-group" role="group" aria-label="">
                    <button type="submit" name="accion" value="Comprar" class="btn btn-success">Comprar</button>
                    <button type="submit" name="accion"  value="Agregar" class="btn btn-success">Agregar</button>
                    <button type="submit" name="accion" value="Cancelar" class="btn btn-info">Limpiar</button>
                    <input type="button" id="tarjeta" name="buscar" value="Buscar Tarjeta" onclick="buscarTarjeta()">
                </div>
            </form>
        </div>
    </div>
</div>
</section>

</div>

<!-- TERMINA LA TABLA DE PEDIDOS-->


 <div class="col-md-7">
    <table class="table">
    <thead>
            <tr>
                <th>Codigo</th>
                <th>Nombre</th>
                <th>Precio</th>
                <th>Elegir</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($restaurantes as $res) { ?>
                <tr>
                
                    <td><?php echo $res['com_codigo']; ?></td>
                    <td><?php echo $res['com_nombre']; ?></td>
                    <td><?php echo $res['com_precio']; ?></td>
                    <td>
                        <form method="POST">
                            <input type="hidden" name="txtCodigo" id="txtCodigo" value="<?php echo $res['com_codigo']; ?>" />
                            <input type="hidden" name="txtprecio" id="txtPresio" value="<?php echo $res['com_precio']; ?>" />
                            <input type="submit" name="accion" value="Selecionar" class="btn btn-success">
                        </form>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>


    <div class="col-md-7">
    <table class="table">
    <thead>
            <tr class="table-light">
                <th>nombre comida</th>
                <th>cantidad</th>
                <th>Precio unitario</th>
                <th>Precio totaltotal</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($total3s as $to) { ?>
                <tr class="table-primary">
                    <?php
                    $sentensSQL = "SELECT * FROM comida WHERE com_codigo=$to[3] ";
                    $Seleccionado = $coon->query($sentensSQL);
                    foreach ($Seleccionado as $comidas) {
                                $txtNombreComida=$comidas['com_nombre'];
                    } 
                    ?>
                    <td><?php echo "$txtNombreComida"; ?></td>
                    <td><?php echo $to[0]; ?></td>
                    <td><?php echo $to[1]; ?></td>
                    <td><?php echo $to[2]; ?></td>
                    <td>
                        <form method="POST">
                            <input type="hidden" name="txtCodigo" id="txtCodigo" value="<?php echo $res['com_codigo']; ?>" />
                            <input type="hidden" name="txtprecio" id="txtPresio" value="<?php echo $res['com_precio']; ?>" />
                            <input type="submit" name="accion" value="Selecionar" class="btn btn-success">
                        </form>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

    <!-- total -->
    <thead>
            <tr class="table-light">
                <th>TOTAL  </th>
            </tr>
        </thead>
        <tbody>
                <tr class="table-primary">

                    <td><?php $n=$_SESSION['total']; echo "$n" ?></td>
                    
                </tr>
        </tbody>
    </table>

    
</body>
</html>