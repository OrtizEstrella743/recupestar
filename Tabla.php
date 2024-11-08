<?php
include 'db.php';

$sql = "SELECT Material, Precio, Merma, Peso_bruto, Peso_neto FROM tu_tabla"; // Asegúrate de cambiar 'tu_tabla' al nombre de tu tabla en la base de datos
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Materiales</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 8px;
            text-align: left;
            border: 1px solid #ddd;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h1>Lista de Materiales</h1>
    <table>
        <thead>
            <tr>
                <th>Material</th>
                <th>Precio</th>
                <th>Merma</th>
                <th>Peso Bruto</th>
                <th>Peso Neto</th>
                <th>Precio por Kilo</th>
                <th>Cantidad</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    $precioKilo = $row["Precio"] / $row["Peso_bruto"];
                    $cantidad = $row["Peso_neto"] / $row["Peso_bruto"];
                    $total = $precioKilo * $row["Peso_neto"];
                    echo "<tr>";
                    echo "<td>" . $row["Material"] . "</td>";
                    echo "<td>" . $row["Precio"] . "</td>";
                    echo "<td>" . $row["Merma"] . "</td>";
                    echo "<td>" . $row["Peso_bruto"] . "</td>";
                    echo "<td>" . $row["Peso_neto"] . "</td>";
                    echo "<td>" . number_format($precioKilo, 2) . "</td>";
                    echo "<td>" . number_format($cantidad, 2) . "</td>";
                    echo "<td>" . number_format($total, 2) . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='8'>No hay datos disponibles</td></tr>";
            }
            ?>
        </tbody>
    </table>
</body>
</html>

<?php
$conn->close();
?>
