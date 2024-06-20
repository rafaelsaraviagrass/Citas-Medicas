<?php
session_start();
include 'conexion.php'; // Include the database connection file

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $carnet = $_POST['carnet'];
    $password = $_POST['password'];
    $_SESSION['carnet']=$carnet;
    // Perform the query to check if the user exists in the database
    $query = "SELECT * FROM usuarios WHERE carnet = '$carnet' AND password = '$password'";
    $result = $con->query($query);

    if ($result->num_rows > 0) {
        // User exists, redirect to gestionEspecialidad.html
        $row = $result->fetch_assoc();
        
        // $nombreUsuario = $row['nombre'];
        // $_SESSION["nombre"]=$usuarios;
        // $_SESSION["carnet"]=$usuarios;
        header("Location: gestionEspecialidad.php");
        exit();
    } else {
        // User not registered, display a message
        echo "Usuario no registrado";
    }
} else {
    // Invalid request method
    echo "";
}
?>


