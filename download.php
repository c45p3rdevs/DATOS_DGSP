<?php
// Conectar a la base de datos
$mysqli = new mysqli("localhost", "root", "", "datos_dgsp");

// Verifica la conexión
if ($mysqli->connect_error) {
    die("Error en la conexión: " . $mysqli->connect_error);
}

// Establece la cabecera para descargar el archivo CSV
header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename=data.csv');

// Crea un archivo de salida
$output = fopen('php://output', 'w');

// Escribe la cabecera del archivo CSV
fputcsv($output, array('Marca', 'Modelo', 'No. Serie', 'Código', 'centro', 'Imagen'));

// Realiza la consulta
$result = $mysqli->query("SELECT * FROM productos");

if (!$result) {
    die("Error en la consulta: " . $mysqli->error); // Manejo de errores
}

// Verifica si hay resultados y los escribe en el CSV
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        fputcsv($output, array($row['marca'], $row['modelo'], $row['no_serie'], $row['codigo'], $row['centro'], $row['image']));
    }
} else {
    // Si no hay datos, puedes optar por escribir una fila vacía
    fputcsv($output, array('No hay datos disponibles.'));
}

// Cierra el archivo de salida
fclose($output);

// Cerrar conexión a la base de datos
$mysqli->close();
exit(); // Asegúrate de salir para evitar salida adicional
?>
