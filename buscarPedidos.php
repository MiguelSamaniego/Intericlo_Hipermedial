
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
        <a class="nav-link" href="verpedidos.html">Buscar</a>
        </li>
        
      </ul>
    </div>
  </div>
</nav>
  <!-- inicia la tabla de pedidos  -->
  <?php 
  include('conf/conexionBD.php');
   $sql="SELECT * FROM pedido_cabecera";
   $restaurantes=$coon->query($sql);
   $txtCodigo = (isset($_POST['txtCodigo'])) ? $_POST['txtCodigo'] : "";
   $accion = (isset($_POST['accion'])) ? $_POST['accion'] : "";
   switch ($accion) {
    case "Selecionar":
        header("Location:verDetelles.php?codig=$txtCodigo");
        break;
    }   
        
   ?>

 <div class="col-md-7">
    <table class="table">
    <thead>
            <tr>
                <th>Fecha</th>
                <th>Cliente</th>
                <th>Total</th>
                <th>Observacones</th>
                <th>Seleccionar</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($restaurantes as $res) { ?>
                <tr>
                    <td><?php echo $res['cab_fecha']; ?></td>
                    <td><?php echo $res['cab_cliente']; ?></td>
                    <td><?php echo $res['cab_total']; ?></td>
                    <td><?php echo $res['cab_observaciones']; ?></td>
                    <td>
                        <form method="POST">
                            <input type="hidden" name="txtCodigo" id="txtCodigo" value="<?php echo $res['cab_codigo']; ?>" />
                            <input type="submit" name="accion" value="Selecionar" class="btn btn-success">
                        </form>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

</body>
</html>
    
</body>
</html>