<?php
session_start();
if (!isset($_SESSION['carnet']) || $_SESSION['rol'] != 'doctor') {
    header("Location: index.html"); // Redirigir si no está autenticado o no es doctor
    exit();
}

// Aquí puedes mostrar las opciones normales del dashboard para doctores
// Y agregar el acceso al historial de pacientes
?>
<html>
<head>
    <title>Dashboard Doctor</title>
</head>
<body>
    <h1>Bienvenido Doctor</h1>
    <ul>
        <li><a href="ver_historial.php">Ver Historial de Pacientes</a></li>
        <li><a href="crear_cita.php">Crear Nueva Cita</a></li>
        <!-- Otras opciones específicas del doctor -->
    </ul>
</body>
</html>
