<?php
include 'db.php';

$id = $_POST['id'];
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

$sql = "UPDATE materiales SET no_de_ticket='$no_de_ticket', fecha='$fecha', tipo_de_material='$tipo_de_material', material='$material', kilos=$kilos, kilos_pagados=$kilos_pagados, precio=$precio, factura=$factura, kg_merma_ceypabasa=$kg_merma_ceypabasa, kg_merma=$kg_merma, total=$total, no_de_pacas=$no_de_pacas, fecha_pago='$fecha_pago', cliente='$cliente', linea='$linea' WHERE id=$id";

if ($conn->query($sql) === TRUE) {
    echo "Registro actualizado exitosamente";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();

header('Location: materiales.php');
?>
