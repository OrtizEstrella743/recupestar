<?php
include 'db.php';

$id = $_GET['id'];

$sql = "DELETE FROM materiales WHERE id=$id";

if ($conn->query($sql) === TRUE) {
    echo "Registro eliminado exitosamente";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();

header('Location: materiales.php');
?>
