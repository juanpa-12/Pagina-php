<?php
session_start();
include 'php/conexion.php';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Administrador</title>
    <link rel="stylesheet" href="http://localhost/pagina%20final/css/PaginaAdmi.css">
</head>
<body>
    <div class="container">
        <header>
            <h1>Panel de Administración</h1>
            <form action="php/cerrarSesion.php" method="post" class="cerrar-sesion-form">
                <button type="submit" class="cerrar-sesion-btn">Cerrar Sesión</button>
            </form>
        </header>
        
        <nav>
            <ul>
                <li><a href="#cotizaciones">Revisar Cotizaciones</a></li>
                <li><a href="#inventario">Revisar/Actualizar Inventario</a></li>
                <li><a href="#enviarNotificacion">Enviar Notificaciones</a></li>
                <li><a href="#importaciones">Estado de Importaciones</a></li>
            </ul>
        </nav>
        
        <section id="cotizaciones">
            <h2>Cotizaciones</h2>
            <table id="tablaCotizaciones">
                <thead>
                    <tr>
                        <th>ID Cotización</th>
                        <th>Cliente</th>
                        <th>Producto</th>
                        <th>Monto</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>001</td>
                        <td>Cliente 1</td>
                        <td>Producto A</td>
                        <td>$500</td>
                        <td id="estado-001">Pendiente</td>
                        <td><button onclick="habilitarCompra('001')">Habilitar Compra</button></td>
                    </tr>
                    <tr>
                        <td>002</td>
                        <td>Cliente 2</td>
                        <td>Producto B</td>
                        <td>$300</td>
                        <td id="estado-002">Pendiente</td>
                        <td><button onclick="habilitarCompra('002')">Habilitar Compra</button></td>
                    </tr>
                </tbody>
            </table>
        </section>
        
        <section id="inventario">
            <h2>Inventario</h2>
            <div class="inventario-controls">
                <label for="producto">Producto:</label>
                <input type="text" id="producto" name="producto">
                <label for="cantidad">Cantidad:</label>
                <input type="number" id="cantidad" name="cantidad">
                <button id="actualizarInventario">Actualizar Inventario</button>
            </div>
            <div id="estadoInventario"></div>
        </section>

        <section id="enviarNotificacion">
            <h2>Enviar Notificación</h2>
            <form id="formNotificacion" method="post" action="php/enviar_notificacion.php">
                <label for="cliente">Seleccionar Cliente:</label>
                <select id="cliente" name="cliente" required>
                <?php
                    // Obtener la lista de clientes desde la base de datos
                    $sql = "SELECT id, nombre, apellido FROM usuarios WHERE rol = 'cliente'";
                    $result = mysqli_query($conn, $sql);
        
                    if (mysqli_num_rows($result) > 0) {
                        while($row = mysqli_fetch_assoc($result)) {
                            echo "<option value='" . $row['id'] . "'>" . $row['nombre'] . " " . $row['apellido'] . "</option>";
                        }
                    } else {
                        echo "<option value=''>No hay usuarios disponibles</option>";
                    }
                ?>
                </select>

                <label for="tipoNotificacion">Tipo de Notificación:</label>
                <select id="tipoNotificacion" name="tipoNotificacion" required>
                    <option value="informacion">Información</option>
                    <option value="advertencia">Advertencia</option>
                    <option value="urgente">Urgente</option>
                </select>

                <label for="descripcion">Descripción:</label>
                <textarea id="descripcion" name="descripcion" required></textarea>

                <button type="submit" id="enviarNotificacion">Enviar Notificación</button>
            </form>
        </section>

        <section id="importaciones">
            <h2>Estado de Importaciones</h2>
            <div id="estadoImportacion">Consultando estado...</div>
            <button id="consultarImportacion">Consultar Estado</button>
        </section>
    </div>

    <script src="http://localhost/pagina%20final/js/PaginaAdmi.js"></script>
</body>
</html>
