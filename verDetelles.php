<?php 
   include 'conf/conexionBD.php';
   //echo "El codigo es :".$_GET["codig"];
  
   $var=$_GET["codig"];
   //echo $var;
   $coP=(int)($var);
   //echo $coP;
   $c=intval($_GET["codig"]);
   //echo $c;
   
   //echo $sql;
   //$accion = (isset($_POST['accion'])) ? $_POST['accion'] : "";
   $sql="SELECT * FROM pedido_detalle WHERE cab_codigo_fk=$c";
   $restaurantes=$coon->query($sql);
        
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
          <a class="nav-link" href="#">About</a>
        </li>
        
      </ul>
    </div>
  </div>
</nav>
  

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
            <?php foreach ($restaurantes as $to) { ?>
                <tr class="table-primary">
                    <?php
                    $sentensSQL = "SELECT * FROM comida WHERE com_codigo=$to[com_codigo_fk] ";
                    $Seleccionado = $coon->query($sentensSQL);
                    foreach ($Seleccionado as $comidas) {
                        $txtNombreComida=$comidas['com_nombre'];
                    } 
                    ?>
                    <td><?php echo "$txtNombreComida"; ?></td>
                    <td><?php echo $to["det-cantidad"]; ?></td>
                    <td><?php echo $to["det_precio_uni"]; ?></td>
                    <td><?php echo $to["det_precio_total"]; ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

</body>
</html>