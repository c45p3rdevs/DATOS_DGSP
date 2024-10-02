<?php
include('db.php');
$id = $_GET['id'];

$query = "DELETE FROM productos WHERE id = $id";
$result = $conn->query($query);

if ($result) {
    header('Location: index.php');
} else {
    echo "Error al eliminar el producto";
}
?>
