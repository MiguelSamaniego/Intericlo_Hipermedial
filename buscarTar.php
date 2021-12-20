 
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
<section id="TablaS">
    <table class="table">
        <thead>
            <tr>
                <th scope="col">Numero</th>
                <th scope="col">Nombre</th>
                <th scope="col">Caducidad</th>
                <th scope="col">cvv</th>
            </tr>
        </thead>
        <tbody>
            <h2 id="titabla">Datos de la Tarjeta</h2>
            <?php
            $tarjeta = $_GET['tarjeta'];
            include('conf/conexionBD.php');
            $sql2 = "SELECT * from tarjeta WHERE tar_numero = $tarjeta ";
            $lista = $coon->query($sql2);
            if ($lista->num_rows > 0) {
                foreach ($lista as $found) {  ?>
                    <tr>
                        <td><?php echo $found['tar_numero']; ?> </td>
                        <td><?php echo $found['tar_nombre']; ?> </td>
                        <td><?php echo $found['tar_fecha']; ?> </td>
                        <td><?php echo $found['tar_cvv']; ?> </td>
                    </tr>
                <?php }
            } else {
                ?>
                <h2>No se ha encontrado datos</h2>
            <?php } ?>
        </tbody>
    </table>
</section>