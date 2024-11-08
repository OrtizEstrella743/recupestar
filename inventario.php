<?php
include 'db.php';
include 'functions.php';

$category = isset($_GET['category']) ? $_GET['category'] : '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['add'])) {
        addProduct($conn, $category, $_POST['nombre'], $_POST['cantidad'], $_POST['fecha_adquisicion'], $_POST['precio']);
    } elseif (isset($_POST['delete'])) {
        deleteProduct($conn, $category, $_POST['id']);
    } elseif (isset($_POST['edit'])) {
        // Aquí podrías añadir funcionalidad para editar productos si decides implementarlo más tarde.
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Inventario</title>
    <link rel="stylesheet" href="Css/inventarios.css">
</head>

<body>
    <header>
        <img src="logoa.png" alt="Logo" class="logo">
        <h1>Gestión de Inventario</h1>
    </header>
    <button onclick="location.href='menu.php'">Regresar</button>

    <div class="container">
        <a href="?category=Gruas_Trailers"><button>Gruas/Trailers</button></a>
        <a href="?category=Aseo"><button>Aseo</button></a>
        <a href="?category=Cocina"><button>Cocina</button></a>
        <a href="?category=Herramienta"><button>Herramienta</button></a>
    </div>

    <?php if ($category): ?>
        <h2>Tabla de <?php echo htmlspecialchars($category); ?></h2>
        <?php showTable($conn, $category); ?>
    <?php endif; ?>

</body>

</html>