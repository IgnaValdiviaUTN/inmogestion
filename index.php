<?php
require_once "conexion.php";

try {
    // Realizar la consulta para obtener los nombres de la tabla inmueble
    $stmt = $pdo->query("SELECT nombre FROM inmueble");

    // Obtener todos los resultados como un array asociativo
    $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    echo "Error al obtener los datos: " . $e->getMessage();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Formulario</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>

  <h1>Formulario</h1>

  <form action="comprobante.php" method="post" class="form">
    
    <label for="inmueble">
        Inmueble:
        <select name="inmueble" id="inmueble" class="form-control">
            <?php
            if($resultados != null){
                echo '<option value="">Elija inmueble</option>';
                foreach ($resultados as $row) {
                    echo "<option value='{$row['nombre']}'>{$row['nombre']}</option>";
                }
            }else{
                echo '<option value="">No hay inmuebles registrados</option>';
            }
            
            ?>
        </select>
    </label>

    <label for="fecha">Fecha:
    <input type="date" id="fecha" name="fecha" required class="form-control">
    </label>

    <label for="monto">Monto:
    <input type="number" value="" id="monto" name="monto" step="0.01" required class="form-control">
    </label>

    <label for="direccion">
        Dirección:
        <select name="direccion" id="direccion" class="form-control">
            <option value="calle Italia 62, departamento 5, Godoy Cruz, Mendoza">Italia 62</option>
            <option value="calle Bernardo Ortiz 760, departametno 4, Godoy Cruz, Mendoza">Bernardo Ortiz 760</option>
            <option value="calle J.P.Norton 1292, Luján de Cuyo, Mendoza">J.P.Norton 1292</option>
            <option value="calle Rioja 1640, departamento 24, Mendoza">Rioja 24</option>
            <option value="calle Rioja 1640, departamento 9, Mendoza">Rioja 9</option>
        </select>
    </label>

    <label for="concepto">
        Concepto:
        <input type="checkbox" name="concepto" id="" value="Alquiler">Alquiler
        <input type="checkbox" name="concepto" id="" value="Servicios">Servicios
        <input type="checkbox" name="concepto" id="" value="Alquiler + Servicios">Alquiler + Servicios
        <input type="checkbox" name="concepto" id="" value="Depósito garantía">Depósito garantía
    </label>


    <label for="persona">Persona:
    <input type="text" id="persona" name="persona" required class="form-control ">
    </label>
    <br>

    <input class="btn" type="submit" value="Enviar">
  </form>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>
