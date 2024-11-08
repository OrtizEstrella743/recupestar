<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menú Principal</title>
    <link rel="stylesheet" href="Css/men.css">
</head>

<body>
    <header>
        <h1>RECICLAJE STAR</h1>
        <img src="logoa.png" alt="Logo" class="logo">
    </header>

    <div class="container">
        <button onclick="location.href='materiales.php'">Materiales</button>
        <button onclick="location.href='inventario.php'">Inventario</button>
        <button onclick="location.href='proveedores.php'">Proveedores</button>
        <button onclick="location.href='precios.php'">Precios</button>
        <button onclick="location.href='calculator.php'">Notas</button>
        
        <!-- Botón de cerrar sesión -->
        <button class="logout-button" onclick="location.href='logout.php'">Cerrar sesión</button>
    </div>
</body>

</html>