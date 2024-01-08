<?php
// Verifica si se han enviado datos mediante el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recoge los datos del formulario
    $fecha = $_POST["fecha"];
    $monto = $_POST["monto"];
    $descripcion = $_POST["descripcion"];
    $direccion = $_POST["direccion"];
    $persona = $_POST["persona"];
    $concepto = $_POST["concepto"];
    $periodo = $_POST["periodo"];
} else {
    // Si no se han enviado datos, muestra un mensaje de error o redirige a la página del formulario
    echo "<p>Error: No se han recibido datos del formulario.</p>";
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Procesar Formulario</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body style="padding: 50px;">
    <style>
        span {
            font-weight: bold;
            color: rgb(48, 103, 133);
        }

        .titulo {
            font-size: 40px;
            color: rgb(48, 103, 133);

        }
    </style>

    <div class="" style="border: 1px solid black;padding: 10px; ">
        <div class="row">
            <div class="col">
                <p class="titulo">COMPROBANTE DE PAGO</p>
            </div>
            <div class="col-4">
                <p><span>Número:</span> 0000000</p>
                <p><span>Fecha:</span> <?php echo $fecha ?></p>
                <p><span>Importe:</span> $<?php echo  $monto ?> </p>
            </div>

        </div>
        <hr>
        <div class="col-12">
            <p>Recibí de <span><?php echo $persona ?></span> la cantidad de <span>$<?php echo  $monto ?></span> por concepto de <span><?php echo $concepto ?></span> del inmueble ubicado en <span><?php echo  $direccion ?></span>, correspondiente al período de <span><?php echo  $periodo ?></span>  con vencimiento el día <span>10</span> de .</p>
        </div>
        <div style="display:flex; justify-content: end; margin-right: 25px;">
            <div style="display: flex; flex-direction: column; justify-content:center; align-items: center;">
                <img src="firma.png" alt="" style="width: 150px; border-bottom: 1px solid black;">
                <p style="font-weight: bold;">Ignacio Ariel Valdivia </p>
                <p style="font-weight: bold;">43.117.608</p>
            </div>
        </div>
    </div>
    <p>Generado por Software</p>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>