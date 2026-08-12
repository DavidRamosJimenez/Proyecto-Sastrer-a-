<?php

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: index.html");
    exit;
}

$nombre = $_POST["nombre"] ?? "";
$correo = $_POST["correo"] ?? "";
$mensaje = $_POST["mensaje"] ?? "";

$servicios = [
    "Confección de Traje Masculino - Bs 600",
   "Confección de Traje Femenino - Bs 600",
    "Arreglo (depende el arreglo variada el precio) - Bs 15",
];
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Consulta recibida - Sastrería Jimenez</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

<header>
    <h1>Sastrería Jimenez</h1>
</header>

<main>
    <h2>Consulta recibida en Sastrería Jimenez</h2>

    <p><strong>Nombre:</strong> <?php echo htmlspecialchars($nombre); ?></p>
    <p><strong>Correo:</strong> <?php echo htmlspecialchars($correo); ?></p>
    <p><strong>Mensaje:</strong> <?php echo htmlspecialchars($mensaje); ?></p>

    <h3>Servicios disponibles</h3>
    <ul>
        <?php foreach ($servicios as $item): ?>
            <li><?php echo $item; ?></li>
        <?php endforeach; ?>
    </ul>

    <p>Te responde Jhonathan David Ramos Jimenez</p>

    <p><a href="index.html">Volver al formulario</a></p>
</main>

<footer>
    <p>&copy; 2026 Sastrería Jimenez.</p>
</footer>

</body>
</html>
