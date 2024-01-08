<?php
// Verifica si se han enviado datos mediante el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recoge los datos del formulario
    $inmueble = $_POST["inmueble"];
    $numero = $_POST["numero"];
    $fecha = $_POST["fecha"];
    $monto = $_POST["monto"];
    $direccion = $_POST["direccion"];
    $inquilino = $_POST["inquilino"];
    $concepto = $_POST["concepto"];
    $periodo = $_POST["periodo"];
    $metodo = $_POST["metodo"];
} else {
    // Si no se han enviado datos, muestra un mensaje de error o redirige a la página del formulario
    echo "<p>Error: No se han recibido datos del formulario.</p>";
}

if (isset($_POST['servicio'])) {
    $servicios = " (" . implode(", ",$_POST['servicio']) . "), ";
} else {
    $servicios = "";
}



$formatter = new NumberFormatter('es', NumberFormatter::SPELLOUT);
$texto = $formatter->format($monto);
$meses = array(
    '01' => 'enero',
    '02' => 'febrero',
    '03' => 'marzo',
    '04' => 'abril',
    '05' => 'mayo',
    '06' => 'junio',
    '07' => 'julio',
    '08' => 'agosto',
    '09' => 'septiembre',
    '10' => 'octubre',
    '11' => 'noviembre',
    '12' => 'diciembre'
);
list($año, $mes, $dia) = explode('-', $fecha);
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo "Comprobante $numero $inmueble $concepto $periodo ".date('Y');  ?></title>
    <link rel="stylesheet" href="index.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body style="padding: 50px;">

    <div class="" style="border: 1px dashed black;padding: 10px; ">
        <div class="row">
            <div class="col">
                <p class="titulo">COMPROBANTE DE PAGO</p>
            </div>
            <div class="col-4">
                <p><span>Número:</span> <?php echo $numero; ?></p>
                <p><span>Fecha:</span> <?php echo date('d-m-Y'); ?></p>
                <p><span>Importe: $<?php echo  number_format($monto, 2, ',', '.') ?></span>  </p>
            </div>

        </div>
        <hr>
        <div class="col-12" style="padding: 20px;">
            <p style="font-size: 20px;"><span><?php echo "$dia de ". $meses[$mes] ." del $año"; ?></span></p>
            <p style="font-size: 18px;">Recibí de <span><?php echo $inquilino ?></span> la cantidad de <span>$<?php echo number_format($monto, 2, ',', '.') . " (" . ucfirst($texto) ." pesos),";?></span> en concepto de <span><?php echo "$concepto $servicios";?></span> del inmueble ubicado en calle <span><?php echo  $direccion ?>,</span> mediante <span><?php echo $metodo; ?></span>, correspondiente al período de <span><?php echo  $periodo ?></span> con vencimiento el día <span>10</span> de <span><?php echo  $periodo . " " . date('Y'); ?></span> .</p>
        </div>
        <div style="display:flex; justify-content: end; margin-right: 25px;">
            <div style="display: flex; flex-direction: column; justify-content:center; align-items: center;">
                <img src="firma.png" alt="" style="width: 120px; border-bottom: 1px solid black;">
                <p style="font-weight: bold; margin: 0;">Ignacio Ariel Valdivia </p>
                <p style="font-weight: bold;margin: 0;">43.117.608</p>
            </div>
        </div>
    </div>
    <p style="font-size: 10px; color:black;">Generado por <span> &lt;IV&#47;&gt; </span> Software    igna.a.valdivia@gmail.com +542616865810</p>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  
</body>

</html>