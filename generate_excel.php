<?php
// Incluir PhpSpreadsheet
//require 'vendor/autoload.php'; // Si instalaste usando Composer
require '/xampp/htdocs/DATOS_DGSP/PhpSpreadsheet/src/PhpSpreadsheet/';


use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

// Conectar a la base de datos
$mysqli = new mysqli("localhost", "root", "", "datos_dgsp");

// Verifica la conexión
if ($mysqli->connect_error) {
    die("Error en la conexión: " . $mysqli->connect_error);
}

// Consulta para obtener los datos de la tabla
$query = "SELECT marca, modelo, no_serie, codigo FROM tu_tabla"; // Cambia 'tu_tabla' al nombre de tu tabla
$result = $mysqli->query($query);

// Crear una nueva hoja de cálculo
$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

// Añadir los encabezados a la primera fila
$sheet->setCellValue('A1', 'Marca');
$sheet->setCellValue('B1', 'Modelo');
$sheet->setCellValue('C1', 'No. Serie');
$sheet->setCellValue('D1', 'Código');

// Añadir los datos de la base de datos a la hoja de cálculo
if ($result->num_rows > 0) {
    $row = 2; // Comenzamos desde la segunda fila
    while ($data = $result->fetch_assoc()) {
        $sheet->setCellValue('A' . $row, $data['marca']);
        $sheet->setCellValue('B' . $row, $data['modelo']);
        $sheet->setCellValue('C' . $row, $data['no_serie']);
        $sheet->setCellValue('D' . $row, $data['codigo']);
        $row++;
    }
} else {
    echo "No se encontraron datos";
}

// Generar el archivo Excel
$writer = new Xlsx($spreadsheet);

// Enviar encabezados para la descarga del archivo
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="reporte_datos.xlsx"');
header('Cache-Control: max-age=0');

// Descargar el archivo
$writer->save('php://output');

// Cerrar conexión a la base de datos
$mysqli->close();
