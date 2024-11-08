<?php
// Datos del ticket
$storeName = "RECUPERE";
$address = "CENTRO DE RECICLAJE";
$date = date("Y-m-d H:i:s");
$material = isset($_POST['material']) ? $_POST['material'] : 'Desconocido';
$price = isset($_POST['precio']) ? $_POST['precio'] : 0;
$weight = isset($_POST['kilos']) ? $_POST['kilos'] : 0;
$merma = isset($_POST['merma']) ? $_POST['merma'] : 0;

// Calcular el total
$total = ($price * $weight) * (1 - $merma / 100);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Ticket</title>
    <style>
       body {
            font-family: Arial, sans-serif;
            text-align: center;
            background-color: #000000;
            margin: 0;
            padding: 20px;
            color: #ffffff; 
        }
        .ticket {
            max-width: 300px;
            margin: auto;
            padding: 20px;
            border: 1px solid #006B33; 
            background-color: #000000; 
            color: #ffffff; 
            transition: all 0.3s ease;
        }
        .ticket img {
            width: 80px; /* Ancho de la imagen */
            height: 60px; /* Altura de la imagen */
        }
        .ticket h1, .ticket h2 {
            margin: 10px 0;
            color: #ffffff; 
            transition: color 0.3s ease;
        }
        .ticket p {
            margin: 5px 0;
        }
        .ticket .total {
            font-weight: bold;
            margin-top: 15px;
        }
        .ticket:hover {
            border-color: #00A550;
            box-shadow: 0 0 20px rgba(0, 165, 80, 0.9); 
        }
        .ticket:hover h1, .ticket:hover h2 {
            color: #00A550; 
        }
    </style>
</head>
<body>
    <div class="ticket">
        <img src="logo.jpg" alt="Logo">
        <h1><?php echo htmlspecialchars($storeName); ?></h1>
        <h2><?php echo htmlspecialchars($address); ?></h2>
        <p><?php echo htmlspecialchars($date); ?></p>
        <p>Material: <?php echo htmlspecialchars($material); ?></p>
        <p>Precio: $<?php echo number_format($price, 2); ?> por kg</p>
        <p>Peso: <?php echo htmlspecialchars($weight); ?> kg</p>
        <p>Merma: <?php echo htmlspecialchars($merma); ?>%</p>
