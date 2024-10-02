<?php include('db.php'); ?>

<?php
$id = $_GET['id'];
$query = "SELECT * FROM productos WHERE id = $id";
$result = $conn->query($query);
$row = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Producto</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">Editar Producto</h1>
        <form action="edit.php?id=<?php echo $id; ?>" method="POST">
            <div class="form-group">
                <label>Marca</label>
                <input type="text" name="marca" class="form-control" value="<?php echo $row['marca']; ?>" required>
            </div>
            <div class="form-group">
                <label>Modelo</label>
                <input type="text" name="modelo" class="form-control" value="<?php echo $row['modelo']; ?>" required>
            </div>
            <div class="form-group">
                <label>No. Serie</label>
                <input type="text" name="no_serie" class="form-control" value="<?php echo $row['no_serie']; ?>" required>
            </div>
            <div class="form-group">
                <label>Código</label>
                <input type="text" name="codigo" class="form-control" value="<?php echo $row['codigo']; ?>" required>
            </div>
            <div class="form-group">
                <label>Centro</label>
                <input type="text" name="centro" class="form-control" value="<?php echo $row['centro']; ?>" required>
            </div>
            <button type="submit" name="update_product" class="btn btn-primary mt-3">Actualizar</button>
        </form>
    </div>
    <script src="js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
if (isset($_POST['update_product'])) {
    $marca = $_POST['marca'];
    $modelo = $_POST['modelo'];
    $no_serie = $_POST['no_serie'];
    $codigo = $_POST['codigo'];
    $centro = $_POST['centro'];

    $query = "UPDATE productos SET marca='$marca', modelo='$modelo', no_serie='$no_serie', codigo='$codigo', centro='$centro' WHERE id = $id";
    $result = $conn->query($query);

    if ($result) {
        header('Location: index.php');
    } else {
        echo "Error al actualizar el producto";
    }
}
?>
