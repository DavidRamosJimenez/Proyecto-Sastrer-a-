<?php


if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: index.html");
    exit;
}

$nombre = $_POST["nombre"] ?? "";
$correo = $_POST["correo"] ?? "";
$consulta = $_POST["consulta"] ?? "";

$servicios = [
    "Examen de vista - Bs 50",
    "Armazón clásico - Bs 180",
    "Lentes de sol - Bs 120",
];
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Cita Reservada - Óptica Mirasol</title>
</head>
<body>
    <h1>Cita Reservada En Óptica Mirasol</h1>

    <p><strong>Nombre:</strong> <?php echo htmlspecialchars($nombre); ?></p>
    <p><strong>Correo:</strong> <?php echo htmlspecialchars($correo); ?></p>
    <p><strong>Consulta:</strong> <?php echo htmlspecialchars($consulta); ?></p>

    <h2>Servicios disponibles</h2>
    <ul>
        <?php foreach ($servicios as $item): ?>
            <li><?php echo $item; ?></li>
        <?php endforeach; ?>
    </ul>

    <p>Te atiende Jhonathan David Ramos Jimenez</p>
</body>
</html>
