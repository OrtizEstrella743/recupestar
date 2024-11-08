<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Material</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f0fb;
            /* Color de fondo lila claro */
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            max-width: 500px; /* Ancho máximo del contenedor más pequeño */
            width: 100%;
            padding: 15px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 8px rgba(0, 0, 0, 0.1);
            box-sizing: border-box; /* Incluye padding en el ancho total */
        }

        h1 {
            color: #8e44ad;
            font-size: 20px;
            margin-bottom: 15px;
            text-align: center;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        label {
            margin: 4px 0 2px;
            color: #333;
            font-size: 14px;
        }

        input[type="text"],
        input[type="date"],
        input[type="number"],
        input[type="submit"] {
            width: 100%;
            padding: 6px;
            margin-bottom: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box; /* Incluye padding en el ancho total */
        }

        input[type="submit"] {
            background-color: #8e44ad;
            color: #fff;
            cursor: pointer;
            border: none;
            padding: 8px;
            font-size: 14px;
        }

        input[type="submit"]:hover {
            background-color: #732d91;
        }

        /* Estilo adicional para el ajuste del formulario en pantallas pequeñas */
        @media (max-width: 500px) {
            .container {
                padding: 10px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Editar Material</h1>

        <?php
        include 'db.php';

        $id = $_GET['id'];

        $sql = "SELECT * FROM materiales WHERE id=$id";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        ?>

        <form action="update.php" method="post">
            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
            <label for="no_de_ticket">No. de Ticket:</label>
            <input type="text" id="no_de_ticket" name="no_de_ticket" value="<?php echo $row['no_de_ticket']; ?>"><br>
            <label for="fecha">Fecha:</label>
            <input type="date" id="fecha" name="fecha" value="<?php echo $row['fecha']; ?>"><br>
            <label for="tipo_de_material">Tipo de Material:</label>
            <input type="text" id="tipo_de_material" name="tipo_de_material" value="<?php echo $row['tipo_de_material']; ?>"><br>
            <label for="material">Material:</label>
            <input type="text" id="material" name="material" value="<?php echo $row['material']; ?>"><br>
            <label for="kilos">Kilos:</label>
            <input type="number" id="kilos" name="kilos" value="<?php echo $row['kilos']; ?>"><br>
            <label for="kilos_pagados">Kilos Pagados:</label>
            <input type="number" id="kilos_pagados" name="kilos_pagados" value="<?php echo $row['kilos_pagados']; ?>"><br>
            <label for="precio">Precio:</label>
            <input type="number" step="0.01" id="precio" name="precio" value="<?php echo $row['precio']; ?>"><br>
            <label for="factura">Factura:</label>
            <input type="number" step="0.01" id="factura" name="factura" value="<?php echo $row['factura']; ?>"><br>
            <label for="kg_merma_ceypabasa">KG Merma CEYPABASA:</label>
            <input type="number" step="0.01" id="kg_merma_ceypabasa" name="kg_merma_ceypabasa" value="<?php echo $row['kg_merma_ceypabasa']; ?>"><br>
            <label for="kg_merma">KG Merma:</label>
            <input type="number" step="0.01" id="kg_merma" name="kg_merma" value="<?php echo $row['kg_merma']; ?>"><br>
            <label for="total">Total:</label>
            <input type="number" step="0.01" id="total" name="total" value="<?php echo $row['total']; ?>"><br>
            <label for="no_de_pacas">No. de Pacas:</label>
            <input type="number" id="no_de_pacas" name="no_de_pacas" value="<?php echo $row['no_de_pacas']; ?>"><br>
            <label for="fecha_pago">Fecha de Pago:</label>
            <input type="date" id="fecha_pago" name="fecha_pago" value="<?php echo $row['fecha_pago']; ?>"><br>
            <label for="cliente">Cliente:</label>
            <input type="text" id="cliente" name="cliente" value="<?php echo $row['cliente']; ?>"><br>
            <label for="linea">Línea:</label>
            <input type="text" id="linea" name="linea" value="<?php echo $row['linea']; ?>"><br>
            <input type="submit" value="Actualizar">
        </form>
    </div>
</body>
</html>
