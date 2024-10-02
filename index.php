<?php include('db.php'); ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Equipos</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Captura de Datos</h2>
        <form action="upload.php" method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="marca" class="form-label">Marca</label>
                <input type="text" class="form-control" id="marca" name="marca" required>
            </div>
            <div class="mb-3">
                <label for="modelo" class="form-label">Modelo</label>
                <input type="text" class="form-control" id="modelo" name="modelo" required>
            </div>
            <div class="mb-3">
                <label for="no_serie" class="form-label">No. Serie</label>
                <input type="text" class="form-control" id="no_serie" name="no_serie" required>
            </div>
            <div class="mb-3">
                <label for="codigo" class="form-label">Código</label>
                <input type="text" class="form-control" id="codigo" name="codigo" required>
            </div>
            <div class="mb-3">
                <label for="centro" class="form-label">Centro</label>
                <input type="text" class="form-control" id="centro" name="centro" required>
            </div>
            <div class="mb-3">
                <label for="image" class="form-label">Cargar Imagen</label>
                <input type="file" class="form-control" id="image" name="image" accept="image/*" alt="NoImage">
            </div>
            <button type="submit" class="btn btn-primary">Guardar</button>
        </form>

        <h2 class="mt-5">Lista de Datos</h2>
        <?php
        // Conectar a la base de datos
        $mysqli = new mysqli("localhost", "root", "", "datos_dgsp");

        // Verifica la conexión
        if ($mysqli->connect_error) {
            die("Error en la conexión: " . $mysqli->connect_error);
        }

        // Código para mostrar los datos de la base de datos
        $query = "SELECT id, marca, modelo, no_serie, codigo, centro, image FROM productos";
        $result = $mysqli->query($query);

        if ($result->num_rows > 0) {
            echo "<table class='table table-hover'>";
            echo "<tr><th>Marca</th><th>Modelo</th><th>No. Serie</th><th>Código</th><th>Centro</th><th>Imagen</th><th>Acciones</th></tr>";
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['marca'] . "</td>";
                echo "<td>" . $row['modelo'] . "</td>";
                echo "<td>" . $row['no_serie'] . "</td>";
                echo "<td>" . $row['codigo'] . "</td>";
                echo "<td>" . $row['centro'] . "</td>";
                echo "<td><img src='" . $row['image'] . "' alt='Imagen' width='250'></td>";
                echo "<td>
                        <a href='edit.php?id=" . $row['id'] . "' class='btn btn-warning'>Editar</a>
                        <a href='delete.php?id=" . $row['id'] . "' class='btn btn-danger'>Eliminar</a>
                      </td>";
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "No se encontraron datos.";
        }

        // Cerrar conexión a la base de datos
        $mysqli->close();
        ?>


<?php
// Conectar a la base de datos
$mysqli = new mysqli("localhost", "root", "", "datos_dgsp");

// Verifica la conexión
if ($mysqli->connect_error) {
    die("Error en la conexión: " . $mysqli->connect_error);
}

// Realiza la consulta
$result = $mysqli->query("SELECT * FROM productos");

if (!$result) {
    die("Error en la consulta: " . $mysqli->error); // Manejo de errores
}

// Verifica si hay resultados
//if ($result->num_rows > 0) {
    // Salida de datos por cada fila
   // while ($row = $result->fetch_assoc()) {
      //  echo "Marca: " . $row["marca"] . " - Modelo: " . $row["modelo"] . " - No. Serie: " . $row["no_serie"] . " - Código: " . $row["codigo"] . " - Centro: " . $row["centro"] . "<br>";
        // Para mostrar la imagen
       // echo "<img src='" . $row["image"] . "' alt='Imagen' style='width:100px;'><br>";
  //  }
//} else {
   // echo "No se encontraron datos.";
//}

// Botón para descargar los datos en CSV
echo '<br><a href="download.php" class="btn btn-primary mb-5">Descargar Datos en Excel</a>';

// Cerrar conexión a la base de datos
$mysqli->close();
?>

    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.11/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
