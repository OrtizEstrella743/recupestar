<?php
session_start();

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}


// Redirigir al menú principal
header("Location: menu.php");
exit();
?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenido</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f0fb; /* Color de fondo lila claro */
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .welcome-container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .welcome-container h2 {
            color: #8e44ad; /* Color lila oscuro */
        }

        .welcome-container p {
            color: #555;
        }

        .welcome-container a {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #8e44ad; /* Color lila oscuro */
            color: #fff;
            text-decoration: none;
            border-radius: 4px;
        }

        .welcome-container a:hover {
            background-color: #732d91; /* Color lila más oscuro */
        }
    </style>
</head>
<body>
    <div class="welcome-container">
        <h2>Bienvenido, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h2>
        <p>Has iniciado sesión correctamente.</p>
        <a href="logout.php">Cerrar sesión</a>
    </div>
</body>
</html>
