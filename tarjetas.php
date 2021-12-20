<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/bootstrap.min.css" />
    <link rel="stylesheet" href="./css/mio.css" />
    <title>Ingresar Tarjeta</title>
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
          <a class="nav-link" href="tarjetas.php">Tarjetas</a>
        </li>
       
        
      </ul>
    </div>
  </div>
</nav>
    <p class="texto">Ingresar Tarjeta</p>
    <div class="Registro">
        <form id="formulario01" method="POST" >
            <form>
                <span class="fontawesome-user"></span><input type="text" name="numero"required placeholder="Número de tarjeta"
                    autocomplete="off">
                <span class="fontawesome-envelope-alt"></span><input type="text" name="nombre" required placeholder="Nombre"
                    autocomplete="off">
                <span class="fontawesome-envelope-al"></span><input type="date" name="fecha" required placeholder="fecha de caducidad"
                    autocomplete="off">
                <span class="fontawesome-envelope-alt"></span><input type="text" name="cvv" required placeholder="cvv"
                    autocomplete="off">
                <br>
                <br>
                <button type="submit" name="accion" value="Agregar" class="btn btn-success">Registrar</button>
                <br>
                <br>     
            </form>
            
        </form>
        
    </div>
    
</body>

</html>

<!DOCTYPE html>
<html>



<body>
    <?php
    //incluir conexión a la base de datos
    include('conf/conexionBD.php');
    $numero = isset($_POST["numero"]) ? trim($_POST["numero"]) : null;
    $nombre = isset($_POST["nombre"]) ? mb_strtoupper(trim($_POST["nombre"]), 'UTF-8') : null;
    $fecha = isset($_POST["fecha"]) ? trim($_POST["fecha"]): null; 
    $cvv = isset($_POST["cvv"]) ? trim($_POST["cvv"]) : null;
    
    $accion = (isset($_POST['accion'])) ? $_POST['accion'] : "";

switch ($accion) {
    case 'Agregar':
        $sql = "INSERT INTO tarjeta VALUES (0, '$numero', '$nombre', '$fecha', '$cvv')";
        if ($coon->query($sql) === TRUE) {
        echo "<p>Se ha creado la tarjeta correctamente</p>";
        break;
        }
    }        
    $coon->close();
    ?>
</body>

</html>