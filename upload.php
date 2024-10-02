<?php
// Conectar a la base de datos
$mysqli = new mysqli("localhost", "root", "", "datos_dgsp");

// Verifica la conexión
if ($mysqli->connect_error) {
    die("Error en la conexión: " . $mysqli->connect_error);
}

// Verifica si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recibir datos del formulario
    $marca = $_POST['marca'];
    $modelo = $_POST['modelo'];
    $no_serie = $_POST['no_serie'];
    $centro =   $_POST['centro'];
    $codigo = $_POST['codigo'];
    

    // Manejar la carga de imagen
    if (isset($_FILES['image']) && $_FILES['image']['error'] == UPLOAD_ERR_OK) {
        // Configurar la carpeta de destino
        $target_dir = "uploads/"; // Asegúrate de crear esta carpeta
        $target_file = $target_dir . basename($_FILES["image"]["name"]);
        
        // Verificar si el archivo es una imagen
        $check = getimagesize($_FILES["image"]["tmp_name"]);
        if ($check === false) {
            die("El archivo no es una imagen.");
        }

        // Mover el archivo a la carpeta de destino
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
            // Guardar información en la base de datos
            $stmt = $mysqli->prepare("INSERT INTO productos (marca, modelo, no_serie, codigo, centro, image) VALUES (?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("ssssss", $marca, $modelo, $no_serie, $codigo, $centro, $target_file);

            if ($stmt->execute()) {
                header("Location: index.php"); // Redirige a la página principal
                exit();
            } else {
                echo "Error al guardar datos: " . $stmt->error;
            }
            $stmt->close();
        } else {
            echo "Error al mover el archivo.";
        }
    } else {
        echo "Error en la carga de la imagen.";
    }
}

// Cerrar conexión a la base de datos
$mysqli->close();
