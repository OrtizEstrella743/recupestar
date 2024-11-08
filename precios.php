<?php
$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "login_system";
$port = 3306;

$conn = new mysqli($servername, $username, $password, $dbname, $port);
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

function getMaterials($conn, $table)
{
    return $conn->query("SELECT * FROM $table");
}

function handleMaterial($conn, $table, $material, $precio = null, $action)
{
    $material = $conn->real_escape_string($material);
    if ($action === 'add') {
        $precio = $conn->real_escape_string($precio);
        $sql = "INSERT INTO $table (material, precio) VALUES ('$material', '$precio')";
    } elseif ($action === 'update') {
        $precio = $conn->real_escape_string($precio);
        $sql = "UPDATE $table SET precio='$precio' WHERE material='$material'";
    } elseif ($action === 'delete') {
        $sql = "DELETE FROM $table WHERE material='$material'";
    }
    if ($conn->query($sql) !== TRUE) {
        echo "Error: " . $sql . "<br>" . $conn->error;
    } else {
        echo ucfirst($action) . " operación completada correctamente.";
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $action = isset($_POST['add']) ? 'add' : (isset($_POST['update']) ? 'update' : 'delete');
    handleMaterial($conn, $_POST['table'], $_POST['material'], $_POST['precio'] ?? null, $action);
}

$editMaterial = $editTable = '';
if (isset($_GET['edit'])) {
    $editMaterial = $conn->real_escape_string($_GET['edit']);
    $editTable = $conn->real_escape_string($_GET['table']);
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Precios</title>
    <link rel="stylesheet" href="Css/precio.css">
</head>

<body>
    <header>
        <img src="logoa.png" alt="Logo" class="logo">
        <h1>Precios</h1>
    </header>
    <br></br>
    <button onclick="location.href='menu.php'">Regresar</button>
    <div class="container">
        <?php if ($editMaterial): ?>
            <div class="modal">
                <div class="modal-content">
                    <span class="close">&times;</span>
                    <h2>Editar Material</h2>
                    <form method="post">
                        <input type="hidden" name="table" value="<?php echo htmlspecialchars($editTable); ?>">
                        <label for="material">Material:</label>
                        <input type="text" name="material" id="material"
                            value="<?php echo htmlspecialchars($editMaterial); ?>" readonly><br>
                        <label for="precio">Precio:</label>
                        <input type="text" name="precio" id="precio"><br>
                        <input type="submit" name="update" value="Actualizar">
                    </form>
                </div>
            </div>
        <?php endif; ?>

        <?php
        $tables = ['precios_pet' => 'Precios PET', 'precios_chatarra' => 'Precios Chatarra', 'precios_metales_y_chatarra' => 'Precios Metales y Chatarra'];
        foreach ($tables as $table => $title): ?>
            <div>
                <h2><?php echo $title; ?></h2>
                <table>
                    <tr>
                        <th>Material</th>
                        <th>Precio</th>
                        <th>Acciones</th>
                    </tr>
                    <?php
                    $materials = getMaterials($conn, $table);
                    if ($materials->num_rows > 0) {
                        while ($row = $materials->fetch_assoc()) {
                            echo "<tr>
                                <td>" . htmlspecialchars($row['material']) . "</td>
                                <td>" . htmlspecialchars($row['precio']) . "</td>
                                <td>
                                    <a class='edit-btn' href='?edit=" . urlencode($row['material']) . "&table=$table'>Editar</a>
                                    <form method='post' style='display:inline;'>
                                        <input type='hidden' name='table' value='$table'>
                                        <input type='hidden' name='material' value='" . htmlspecialchars($row['material']) . "'>
                                        <input type='submit' name='delete' value='Eliminar'>
                                    </form>
                                </td>
                            </tr>";
                        }
                    }
                    ?>
                    <tr>
                        <form method="post">
                            <td><input type="text" name="material"></td>
                            <td><input type="text" name="precio"></td>
                            <td>
                                <input type="hidden" name="table" value="<?php echo $table; ?>">
                                <input type="submit" name="add" value="Agregar">
                            </td>
                        </form>
                    </tr>
                </table>
            </div>
        <?php endforeach; ?>
    </div>

    <script>
        var modal = document.querySelector('.modal');
        var span = document.querySelector('.close');

        if (modal) {
            modal.style.display = 'block';
        }

        if (span) {
            span.onclick = function () {
                modal.style.display = 'none';
            }
        }

        window.onclick = function (event) {
            if (event.target == modal) {
                modal.style.display = 'none';
            }
        }
    </script>
</body>

</html>

<?php
$conn->close();
?>