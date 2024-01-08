<?php
require_once "conexion.php";

try {
    $stmt = $pdo->query("SELECT * FROM inmueble");
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
    <link rel="stylesheet" href="index.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body style="display: flex; justify-content: center; align-items:center; padding:30px;">
    <form action="comprobante.php" method="post" class="form-control" style="width:80%; padding:30px;">

        <div class="col-12">
            <label for="inmueble" class="form-label col-12">
                Inmueble:
                <select name="inmueble" id="inmueble" class="form-control form-select">
                    <?php
                    if ($resultados != null) {
                        echo '<option value="">Elija inmueble</option>';
                        foreach ($resultados as $row) {
                            echo "<option value='{$row['nombre']}'>{$row['nombre']}</option>";
                        }
                    } else {
                        echo '<option value="">No hay inmuebles registrados</option>';
                    }

                    ?>
                </select>
            </label>
        </div>

        <input type="number" value="" id="numero" name="numero" required>

        <div id="detallesInmueble" class="col-12 row">
            <label for="direccion" class="form-label col-7">Dirección:
                <input type="text" id="direccion" name="direccion" readonly class="form-control">
            </label>
            <label for="titular" class="form-label col">Inquilino:
                <input type="text" id="inquilino" name="inquilino" readonly class="form-control">
            </label>
        </div>

        <div class="row">
            <label for="monto" class="form-label col">Monto $:
                <input type="number" id="monto" name="monto" min="0" required class="form-control">
            </label>


            <label for="fecha" class="form-label col">Fecha:
                <input type="date" id="fecha" name="fecha" value="<?php date_default_timezone_set('America/Argentina/Mendoza');
                                                                    echo date('Y-m-d'); ?>" required class="form-control">
            </label>

            <label for="periodo" class="form-label col">
                Periodo:
                <select name="periodo" id="periodo" class="form-control form-select">
                    <?php
                    $meses = [
                        'Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio',
                        'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'
                    ];

                    $mesActual = date('F'); // Obtener el nombre del mes actual

                    foreach ($meses as $mes) {
                        $selected = ($mes == $mesActual) ? 'selected' : ''; // Marcar el mes actual como seleccionado
                        echo "<option value=\"$mes\" $selected>$mes</option>";
                    }
                    ?>
                </select>
            </label>
        </div>



        <div class="row col-12">
            <div class="form-check-label col">
                Concepto:
                <div style=" display: flex; flex-direction: column;">
                    <label for="alquiler">
                        <input class="form-check-input" type="radio" name="concepto" id="alquiler" value="Alquiler" required checked> Alquiler
                    </label>
                    <label for="servicio1">
                        <input class="form-check-input" type="radio" name="concepto" id="servicio1" value="Servicios"> Servicios
                    </label>
                    <label for="servicio2">
                        <input class="form-check-input" type="radio" name="concepto" id="servicio2" value="Alquiler + Servicios"> Alquiler + Servicios
                    </label>
                    <label for="deposito">
                        <input class="form-check-input" type="radio" name="concepto" id="deposito" value="Depósito garantía"> Depósito garantía
                    </label>
                </div>
            </div>
            <div class="form-check-label col">
                Servicios:
                <div style="display: flex; flex-direction: column;">
                    <?php
                    $servicios = array("Ecogas", "Aysam", "Edemsa", "Cooperativa eléctrica GC", "Municipalidad", "Expensas", "Seguro de incendios");

                    foreach ($servicios as $servicio) {
                        echo '<label for="' . strtolower($servicio) . '">';
                        echo '<input class="form-check-input" type="checkbox" name="servicio[]" id="' . strtolower($servicio) . '" value="' . $servicio . '" disabled> ' . $servicio;
                        echo '</label>';
                    }
                    ?>
                </div>
            </div>
        </div>
        <div class="form-check-label col">
            Método de pago:
            <div style=" display: flex; flex-direction: column;">
                <label for="metodo">
                    <input class="form-check-input" type="radio" name="metodo" id="" value="transferencia bancaria" required checked> Transferencia bancaria
                </label>
                <label for="metodo">
                    <input class="form-check-input" type="radio" name="metodo" id="" value="pago en efectivo"> Pago en efectivo
                </label>
                <label for="metodo">
                    <input class="form-check-input" type="radio" name="metodo" id="" value="depósito bancario"> Depósito bancario
                </label>
            </div>
        </div>

        <div class="col-12 text-end">
            <input class="btn btn-light m-2" type="submit" value="Generar" style="border: 1px solid grey;">
        </div>

    </form>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script>
        function generarComprobante(id, longitud = 9) {
            id = id.toString() + "1";
            return id.toString().padStart(longitud, '0');
        }

        document.getElementById('inmueble').addEventListener('change', function() {
            var seleccion = this.value;
            var detallesInmueble = document.getElementById('detallesInmueble');

            // Buscar el inmueble seleccionado en el array de resultados
            var inmuebleSeleccionado = <?php echo json_encode($resultados); ?>;
            var detalles = inmuebleSeleccionado.find(function(inmueble) {
                return inmueble.nombre === seleccion;
            });

            // Mostrar los detalles del inmueble seleccionado
            document.getElementById('direccion').value = detalles.direccion;
            document.getElementById('inquilino').value = detalles.titular;
            document.getElementById('monto').value = detalles.monto;
            document.getElementById('numero').value = generarComprobante(detalles.id);
        });
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var conceptoRadios = document.querySelectorAll('input[name="concepto"]');
            var serviciosCheckboxes = document.querySelectorAll('input[name="servicio[]"]');

            function toggleServicios() {
                serviciosCheckboxes.forEach(function(checkbox) {
                    checkbox.disabled = !(conceptoRadios[1].checked || conceptoRadios[2].checked);
                });
            }

            toggleServicios(); // Llamar a la función al cargar la página

            conceptoRadios.forEach(function(radio) {
                radio.addEventListener("change", toggleServicios);
            });
        });
    </script>

</body>

</html>