<section id="listaPedidos">
    <form id="listado" onsubmit="return buscarPedido()">
        <br>
        <br>
        <div class="col-sm-10">
            <input type="text" id="numero" class="form-control" aria-describedby="emailHelp" name="numero" value="" placeholder="Ingrese el  numero de la Tarjeta">
        </div>
        <br>
        <br>
        <div class="col-sm-10">
            <input type="text" id="nombre" class="form-control" aria-describedby="emailHelp" name="nombre" value="" placeholder="Ingrese el  nombre de la comida">
        </div>
        <br>
        <br>
        <div class="col-sm-10">
            <button type="submit" class="btn btn-primary" id="buscar" name="buscar" value="Buscar" onclick="buscarPedido()">Buscar</button>
        </div>
    </form>
</section>
<section id="TablaS">
    <table class="table">
        <thead>
            <tr>
                <th scope="col">Fecha de Pedido </th>
                <th scope="col">Cliente</th>
                <th scope="col">Descripción</th>
                <th scope="col">Comida</th>
                <th scope="col">Numero de Tarjeta</th>
                <th scope="col">Nombre de Tarjeta</th>
                <th scope="col">Caducidad</th>
                <th scope="col">cvv</th>
                <th scope="col">Total</th>
            </tr>
        </thead>
        <tbody>
            <h2 id="titabla">Listado de Pedidos</h2>
            <?php
            $nombre = $_GET['nombre'];
            $numero = $_GET['numero'];
            include('conf/conexionBD.php');
            $sql2 = "SELECT * from comida c,tarjeta t , pedido_detalle det, pedido_cabecera cab WHERE cab.tar_codigo_fk = t.tar_codigo and det.cab_codigo_fk= cab.cab_codigo AND det.com_codigo_fk = c.com_codigo AND t.tar_numero = $numero AND c.com_nombre = '$nombre'";
            $lista = $coon->query($sql2);
            if ($lista->num_rows > 0) {
                foreach ($lista as $found) {  ?>
                    <tr>
                        <td><?php echo $found['cab_fecha']; ?> </td>
                        <td><?php echo $found['cab_cliente']; ?> </td>
                        <td><?php echo $found['cab_observaciones']; ?> </td>
                        <td><?php echo $found['com_nombre']; ?> </td>
                        <td><?php echo $found['tar_numero']; ?> </td>
                        <td><?php echo $found['tar_nombre']; ?> </td>
                        <td><?php echo $found['tar_fecha']; ?> </td>
                        <td><?php echo $found['tar_cvv']; ?> </td>
                        <td><?php echo $found['cab_total']; ?> </td>
                    </tr>
                <?php }
            } else {
                ?>
                <h2>No se ha encontrado datos</h2>
            <?php } ?>
        </tbody>
    </table>
