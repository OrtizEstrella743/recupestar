<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Materiales</title>
    <link rel="stylesheet" href="Css/material.css">
</head>

<body>
    <header>
        <img src="logoa.png" alt="Logo" class="logo">
        <h1>RECICLAJE STAR</h1>
    </header>

    <div class="container">
        <h1></h1>

        <?php include 'db.php'; ?>

        <table>
            <tr>
                <th>No. de Ticket</th>
                <th>Fecha</th>
                <th>Tipo de Material</th>
                <th>Material</th>
                <th>Kilos</th>
                <th>Kilos Pagados</th>
                <th>Precio</th>
                <th>Factura</th>
                <th>KG Merma CEYPABASA</th>
                <th>KG Merma</th>
                <th>Total</th>
                <th>No. de Pacas</th>
                <th>Fecha de Pago</th>
                <th>Cliente</th>
                <th>Línea</th>
                <th>Acciones</th>
            </tr>

            <?php
            $sql = "SELECT * FROM materiales";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>" . $row["no_de_ticket"] . "</td>
                            <td>" . $row["fecha"] . "</td>
                            <td>" . $row["tipo_de_material"] . "</td>
                            <td>" . $row["material"] . "</td>
                            <td>" . $row["kilos"] . "</td>
                            <td>" . $row["kilos_pagados"] . "</td>
                            <td>" . $row["precio"] . "</td>
                            <td>" . $row["factura"] . "</td>
                            <td>" . $row["kg_merma_ceypabasa"] . "</td>
                            <td>" . $row["kg_merma"] . "</td>
                            <td>" . $row["total"] . "</td>
                            <td>" . $row["no_de_pacas"] . "</td>
                            <td>" . $row["fecha_pago"] . "</td>
                            <td>" . $row["cliente"] . "</td>
                            <td>" . $row["linea"] . "</td>
                            <td>
                                <a href='edit.php?id=" . $row["id"] . "'>Editar</a>
                                <a href='delete.php?id=" . $row["id"] . "'>Eliminar</a>
                            </td>
                        </tr>";
                }
            } else {
                echo "<tr><td colspan='16'>No hay registros</td></tr>";
            }
            $conn->close();
            ?>
        </table>

        <!-- Botón para abrir el modal -->
        <button id="myBtn">Agregar Nuevo Material</button>
        <button onclick="location.href='menu.php'">Regresar</button>

        <!-- El modal -->
        <div id="myModal" class="modal">
            <div class="modal-content">
                <span class="close">&times;</span>
                <h2>Agregar Nuevo Material</h2>
                <form action="add.php" method="post">
                    <label for="no_de_ticket">No. de Ticket:</label>
                    <input type="text" id="no_de_ticket" name="no_de_ticket"><br><br>
                    <label for="fecha">Fecha:</label>
                    <input type="date" id="fecha" name="fecha"><br><br>
                    <label for="tipo_de_material">Tipo de Material:</label>
                    <input type="text" id="tipo_de_material" name="tipo_de_material"><br><br>
                    <label for="material">Material:</label>
                    <input type="text" id="material" name="material"><br><br>
                    <label for="kilos">Kilos:</label>
                    <input type="number" id="kilos" name="kilos"><br><br>
                    <label for="kilos_pagados">Kilos Pagados:</label>
                    <input type="number" id="kilos_pagados" name="kilos_pagados"><br><br>
                    <label for="precio">Precio:</label>
                    <input type="number" step="0.01" id="precio" name="precio"><br><br>
                    <label for="factura">Factura:</label>
                    <input type="number" step="0.01" id="factura" name="factura"><br><br>
                    <label for="kg_merma_ceypabasa">KG Merma CEYPABASA:</label>
                    <input type="number" step="0.01" id="kg_merma_ceypabasa" name="kg_merma_ceypabasa"><br><br>
                    <label for="kg_merma">KG Merma:</label>
                    <input type="number" step="0.01" id="kg_merma" name="kg_merma"><br><br>
                    <label for="total">Total:</label>
                    <input type="number" step="0.01" id="total" name="total"><br><br>
                    <label for="no_de_pacas">No. de Pacas:</label>
                    <input type="number" id="no_de_pacas" name="no_de_pacas"><br><br>
                    <label for="fecha_pago">Fecha de Pago:</label>
                    <input type="date" id="fecha_pago" name="fecha_pago"><br><br>
                    <label for="cliente">Cliente:</label>
                    <input type="text" id="cliente" name="cliente"><br><br>
                    <label for="linea">Línea:</label>
                    <input type="text" id="linea" name="linea"><br><br>
                    <input type="submit" value="Agregar">
                </form>
            </div>
        </div>

        <script>
            // Obtener el modal
            var modal = document.getElementById("myModal");

            // Obtener el botón que abre el modal
            var btn = document.getElementById("myBtn");

            // Obtener el <span> que cierra el modal
            var span = document.getElementsByClassName("close")[0];

            // Cuando el usuario hace clic en el botón, abre el modal
            btn.onclick = function () {
                modal.style.display = "block";
            }

            // Cuando el usuario hace clic en <span> (x), cierra el modal
            span.onclick = function () {
                modal.style.display = "none";
            }

            // Cuando el usuario hace clic fuera del modal, cierra el modal
            window.onclick = function (event) {
                if (event.target == modal) {
                    modal.style.display = "none";
                }
            }
        </script>
    </div>
</body>

</html>