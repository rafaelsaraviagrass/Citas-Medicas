<?php
include 'conexion.php';
session_start();
$carnet = $_SESSION['carnet'];

?>
<!DOCTYPE html>
<html>

<head>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;500&display=swap" rel="stylesheet">


    <nav>
    <img src="img/tecno.jpg" alt="" class="logo-danicodex">

        <ul class="cont-ul">
            <li><a href="">INICIO</a></li>
            <li><a href="">NOSOTROS</a></li>
            <li><a href="">AFILIACION</a></li>
            <li><a href="">PRESTACIONES</a></li>
            <li><a href="">COTIZACIONES</a></li>
            <li class="publicaciones">
                PUBLICACIONES
                <ul class="ul-second">
                    <li><a href="">ASESORIA LEGAL</a></li>
                    <li><a href="">MOMORIA ANUAL</a></li>
                    <li><a href="">REVISTA ESTADISTICA</a></li>
                    <li><a href="">UND. AUD. INTERNA</a></li>
                    <li><a href="">AREA DE SALUD</a></li>
                    <li><a href="">AREA ADMINSTRATIVA</a></li>
                    <li><a href="">UND. PERSONAL</a></li>
                </ul>
            <li><a href="index.html">FICHA EN LINEA</a></li>
        </ul>
    </nav>
</head>

<body>


    <div class="container">

        <!-- Formulario para la ficha médica -->
        <form id="fichaMedicaForm">
            <!-- Nombre del asegurado (ya acreditado) -->
            <label for="asegurado">Nombre del Asegurado:</label>
            <h5>
                <?php

                $query = "SELECT * FROM usuarios WHERE carnet = '$carnet'";
                $result = $con->query($query);
                if ($result->num_rows > 0) {
                    // User exists, redirect to gestionEspecialidad.html
                    $row = $result->fetch_assoc();

                    $nombreUsuario = $row['nombre'];
                    echo $nombreUsuario;
                } else {
                    // User not registered, display a message
                    echo "Usuario no registradou";
                }
                ?>
            </h5>


            <!-- <input type="text" id="asegurado" value="Nombre del Asegurado" readonly> -->
            <br><br>

            <!-- Especialidad (ya seleccionada previamente) -->
            <label for="especialidad">Especialidad:</label>
            <input type="text" id="especialidad" value="Especialidad" readonly><br><br>

            <!-- Médico (ya seleccionado previamente) -->
            <label for="medico">Médico:</label>
            <input type="text" id="medico" value="Nombre del Médico" readonly><br><br>

            <!-- Día y turno (preseleccionados) -->
            <label for="dia">Día:</label>
            <input type="text" id="dia" value="LUNES 21-08-2023" readonly><br><br>


        </form>

        <div id="lista">
            <!-- Lista de horarios -->
        <h2>Seleccione un horario:</h2>
            
            <button id = "elegirhora" onclick="elegirhora('1', '08:00 AM')">1 - 08:00 AM</button>
            <button id = "elegirhora" onclick="elegirhora('2', '08:30 AM')">2 - 08:30 AM</button>
            <button id = "elegirhora" onclick="elegirhora('3', '09:00 AM')">3 - 09:00 AM</button>
            <button id = "elegirhora" onclick="elegirhora('4', '09:30 AM')">4 - 09:30 AM</button>
            <button id = "elegirhora" onclick="elegirhora('5', '10:00 AM')">5 - 10:00 AM</button>
            <button id = "elegirhora" onclick="elegirhora('6', '10:30 AM')">6 - 10:30 AM</button>
            <button id = "elegirhora" onclick="elegirhora('7', '11:00 AM')">7 - 11:00 AM</button>
            <button id = "elegirhora" onclick="elegirhora('8', '11:30 AM')">8 - 11:30 AM</button>
            <button id = "elegirhora" onclick="elegirhora('9', '12:00 PM')">9 - 12:00 PM</button>
        </div>

    </div>

   


    <script>
        // Recuperar la especialidad y la fecha almacenadas en sessionStorage
        const especialidadElegida = sessionStorage.getItem('especialidadElegida');
        const fechaElegida = sessionStorage.getItem('fechaElegida');
        const doctorElegido = sessionStorage.getItem('doctorElegido');


        // Asignar los valores recuperados a los campos correspondientes
        document.getElementById('especialidad').value = especialidadElegida;
        document.getElementById('dia').value = fechaElegida;
        document.getElementById('medico').value = doctorElegido;

        // Puedes mostrar el nombre del médico y otros detalles aquí si los tienes



        function mostrarNotificacion() {
            // Redirigir directamente a ficha.html
            window.location.href = "xd.html";
        }


        function elegirhora(ficha, hora) {
            // Guardar el número de ficha y la hora elegida en sessionStorage
            sessionStorage.setItem('fichaElegida', ficha);
            sessionStorage.setItem('horaElegida', hora);

            // Dirigir al usuario a la pantalla de ficha médica
            window.location.href = 'ficha.html';
        }

    </script>

</body>

</html>