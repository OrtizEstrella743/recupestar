<?php
include 'db.php';

$no_de_ticket = $_POST['no_de_ticket'];
$fecha = $_POST['fecha'];
$tipo_de_material = $_POST['tipo_de_material'];
$material = $_POST['material'];
$kilos = $_POST['kilos'];
$kilos_pagados = $_POST['kilos_pagados'];
$precio = $_POST['precio'];
$factura = $_POST['factura'];
$kg_merma_ceypabasa = $_POST['kg_merma_ceypabasa'];
$kg_merma = $_POST['kg_merma'];
$total = $_POST['total'];
$no_de_pacas = $_POST['no_de_pacas'];
$fecha_pago = $_POST['fecha_pago'];
$cliente = $_POST['cliente'];
$linea = $_POST['linea'];

$sql = "INSERT INTO materiales (no_de_ticket, fecha, tipo_de_material, material, kilos, kilos_pagados, precio, factura, kg_merma_ceypabasa, kg_merma, total, no_de_pacas, fecha_pago, cliente, linea) 
VALUES ('$no_de_ticket', '$fecha', '$tipo_de_material', '$material', $kilos, $kilos_pagados, $precio, $factura, $kg_merma_ceypabasa, $kg_merma, $total, $no_de_pacas, '$fecha_pago', '$cliente', '$linea')";

if ($conn->query($sql) === TRUE) {
    echo "Nuevo registro creado exitosamente";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();

header('Location: materiales.php');
?>
