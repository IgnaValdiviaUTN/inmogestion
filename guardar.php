<?php
try {
    require_once "conexion.php";
    $inmueble = $_POST["inmueble"];
    $numero = $_POST["numero"];
    $fecha = $_POST["fecha"];
    $monto = $_POST["monto"];
    $concepto = $_POST["concepto"];
    $periodo = $_POST["periodo"];
    $metodo = $_POST["metodo"];
    // Preparar la consulta SQL para insertar datos en la tabla "comprobante"
    $consulta = $pdo->prepare("INSERT INTO comprobante (inmueble, monto, concepto, fecha, periodo, metodo, numero) VALUES (?,?, ?, ?, ?, ?, ?)");

    // Ejecutar la consulta con los valores proporcionados
    $consulta->execute([$inmueble, $monto, $concepto, $fecha, $periodo, $metodo, $numero]);

    // Cerrar la conexión a la base de datos
    $conexion = null;

    // Devolver una respuesta exitosa
    echo "Datos guardados correctamente en la tabla comprobante.";
} catch (PDOException $e) {
    // Manejar errores de la base de datos
    echo "Error al guardar datos: " . $e->getMessage();
}
