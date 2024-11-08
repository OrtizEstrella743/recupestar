<?php
// Mostrar errores en PHP
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include 'db.php'; // Incluir el archivo de conexión a la base de datos

// Agregar proveedor
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];

    $sql = "INSERT INTO suppliers (name, email, phone, address) VALUES ('$name', '$email', '$phone', '$address')";
    if ($conn->query($sql) === TRUE) {
        echo "Nuevo proveedor agregado con éxito";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Eliminar proveedor
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete'])) {
    $id = $_POST['id'];

    $sql = "DELETE FROM suppliers WHERE id='$id'";
    if ($conn->query($sql) === TRUE) {
        echo "Proveedor eliminado con éxito";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Consultar proveedores
$whereClause = '';
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['search'])) {
    $searchName = $_POST['searchName'];
    $whereClause = "WHERE name LIKE '%$searchName%'";
}

// Obtener proveedores
$sql = "SELECT id, name, email, phone, address FROM suppliers $whereClause";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>

<head>
    <title>Proveedores</title>
    <link rel="stylesheet" href="Css/proveedor.css">
</head>

<body>
    <img src="logoa.png" alt="Logo" class="logo">
    <div class="container">
        <h2>Proveedores</h2>
        <button onclick="location.href='menu.php'" class="boton">Regresar</button>
        <form method="POST" action="">
            <label for="searchName">Buscar por nombre:</label>
            <input type="text" id="searchName" name="searchName">
            <button type="submit" name="search">Buscar</button>
        </form>

        <table>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Email</th>
                <th>Teléfono</th>
                <th>Dirección</th>
                <th>Acciones</th>
            </tr>
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                        <td>" . $row["id"] . "</td>
                        <td>" . $row["name"] . "</td>
                        <td>" . $row["email"] . "</td>
                        <td>" . $row["phone"] . "</td>
                        <td>" . $row["address"] . "</td>
                        <td>
                            <form method='POST' action='' style='display:inline-block;'>
                                <input type='hidden' name='id' value='" . $row["id"] . "'>
                                <button type='submit' name='delete'>Eliminar</button>
                            </form>
                        </td>
                    </tr>";
                }
            } else {
                echo "<tr><td colspan='6'>No hay proveedores</td></tr>";
            }
            ?>
        </table>

        <form method="POST" action="">
            <input type="hidden" name="add" value="1">
            <label for="name">Nombre:</label>
            <input type="text" id="name" name="name" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>

            <label for="phone">Teléfono:</label>
            <input type="text" id="phone" name="phone" required>

            <label for="address">Dirección:</label>
            <input type="text" id="address" name="address" required>

            <button type="submit">Agregar Proveedor</button>
        </form>


    </div>
</body>

</html>

<?php
$conn->close();
?>