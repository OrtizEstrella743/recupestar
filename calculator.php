<?php include 'db.php'; ?>

<?php
function getAllMaterials($conn) {
    $tables = ['precios_pet', 'precios_chatarra', 'precios_metales_y_chatarra'];
    $materials = [];
    foreach ($tables as $table) {
        $sql = "SELECT material, precio FROM $table";
        $result = $conn->query($sql);
        while ($row = $result->fetch_assoc()) {
            $materials[] = ['material' => $row['material'], 'precio' => $row['precio']];
        }
    }
    return $materials;
}

$materials = getAllMaterials($conn);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calculadora de Materiales</title>
    <link rel="stylesheet" href="Css/calculator.css">
</head>
<body>
    <img src="logoa.png" alt="Logo" class="logo">
    <div class="container">
        <h2>Calculadora de Materiales</h2>
        <button onclick="location.href='menu.php'">Regresar</button>
        <form id="calculator-form">
            <label for="material">Material:</label>
            <select id="material" name="material" required>
                <option value="" disabled selected>Selecciona un material</option>
                <?php foreach ($materials as $material): ?>
                    <option value="<?php echo htmlspecialchars($material['material']); ?>" data-precio="<?php echo htmlspecialchars($material['precio']); ?>">
                        <?php echo htmlspecialchars($material['material']); ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <label for="precio">Precio por kilo:</label>
            <input type="text" id="precio" name="precio" readonly>

            <label for="kilos">Cantidad en kilos:</label>
            <input type="number" id="kilos" name="kilos" min="0" step="0.01" required>

            <label for="merma">Merma (%):</label>
            <input type="number" id="merma" name="merma" min="0" max="100" step="0.01" required>

            <label for="total">Total a pagar:</label>
            <input type="text" id="total" name="total" readonly>

            <button type="submit">Calcular</button>
        </form>

        <div id="ticket">
            <h3>Ticket de Compra</h3>
            <p><strong>Material:</strong> <span id="ticket-material"></span></p>
            <p><strong>Precio por kilo:</strong> $<span id="ticket-precio"></span></p>
            <p><strong>Cantidad en kilos:</strong> <span id="ticket-kilos"></span> kg</p>
            <p><strong>Merma:</strong> <span id="ticket-merma"></span>%</p>
            <p><strong>Total a pagar:</strong> $<span id="ticket-total"></span></p>
            <button id="print-button">Imprimir Ticket</button>
        </div>
    </div>

    <script>
        document.getElementById('material').addEventListener('change', function() {
            var precio = this.options[this.selectedIndex].getAttribute('data-precio');
            document.getElementById('precio').value = precio;
            calculateTotal();
        });

        document.getElementById('kilos').addEventListener('input', calculateTotal);
        document.getElementById('merma').addEventListener('input', calculateTotal);

        document.getElementById('calculator-form').addEventListener('submit', function(event) {
            event.preventDefault();
            calculateTotal();
            displayTicket();
        });

        document.getElementById('print-button').addEventListener('click', function() {
            printTicket();
        });

        function calculateTotal() {
            var precio = parseFloat(document.getElementById('precio').value);
            var kilos = parseFloat(document.getElementById('kilos').value);
            var merma = parseFloat(document.getElementById('merma').value) / 100;

            if (!isNaN(precio) && !isNaN(kilos) && !isNaN(merma)) {
                var total = (precio * kilos) * (1 - merma);
                document.getElementById('total').value = total.toFixed(2);
            }
        }

        function displayTicket() {
            var material = document.getElementById('material').value;
            var precio = document.getElementById('precio').value;
            var kilos = document.getElementById('kilos').value;
            var merma = document.getElementById('merma').value;
            var total = document.getElementById('total').value;

            document.getElementById('ticket-material').textContent = material;
            document.getElementById('ticket-precio').textContent = precio;
            document.getElementById('ticket-kilos').textContent = kilos;
            document.getElementById('ticket-merma').textContent = merma;
            document.getElementById('ticket-total').textContent = total;

            document.getElementById('ticket').style.display = 'block';
        }

        function printTicket() {
            var printContents = document.getElementById('ticket').innerHTML;
            var originalContents = document.body.innerHTML;

            document.body.innerHTML = printContents;
            window.print();
            document.body.innerHTML = originalContents;
            window.location.reload();
        }
    </script>
</body>
</html>

<?php
$conn->close();
?>
