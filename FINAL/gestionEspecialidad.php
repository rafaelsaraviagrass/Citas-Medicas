<?php
include 'conexion.php';
session_start();
$carnet=$_SESSION['carnet'];
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Interfaz de Reservas</title>
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: white;
            margin: 0;
            padding: 0;
        }
        h2 {
            background-color: #e0f0ff;
            padding: 10px;
            margin: 0;
            text-align: center;
        }

        h3 {
            background-color: #ffffff;
            padding: 10px;
            margin: 0;
            text-align: center;
        }

        p {
            text-align: center;
            margin: 20px 0;
            background-color: aliceblue;
        }
        
        .columna p {
            text-align: center;
            margin-top: 5px;
            color: #00aaff;
        }
        .columna {
            float: left;
            width: 50%;
            padding: 20px;
            box-sizing: border-box;
        }

        .row:after {
            content: "";
            display: table;
            clear: both;
        }

        button {
            background-color: white;
            border: 2px solid #00aaff;
            border-radius: 4px;
            color: #00aaff;
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
            width: 100%;
            transition: background-color 0.3s, color 0.3s;
        }

        button:hover {
            background-color: #00aaff;
            color: white;
        }
    </style>
</head>
<body>
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
                <li><a href="">FICHA EN LINEA</a></li>
        </ul>
    </nav>
    <h2>EMISION DE FICHA DE ATENCION MEDICA</h2>
    <h3>
        Nombre del asegurado: <?php
        
        $query = "SELECT * FROM usuarios WHERE carnet = '$carnet'";
        $result = $con->query($query);
        if ($result->num_rows > 0) {
            // User exists, redirect to gestionEspecialidad.html
            $row = $result->fetch_assoc();
            
            $nombreUsuario = $row['nombre'];
            echo  $nombreUsuario;
        } else {
            // User not registered, display a message
            echo "Usuario no registradoooooooooooo";
        }
?>

    </h3>

    <p>Fecha de la consulta: <input type="date" id="fechaConsulta"></p>
    <div>Elige la especialidad y el doctor para tu reserva</div>

    <div class="row">
        <div class="columna">
            <button onclick="elegirEspecialidad('CIRUGIA I', 'Dr. Ortega Moises')">CIRUGIA I - Dr. Ortega Moises</button>
            <button onclick="elegirEspecialidad('CIRUGIA II', 'Dr. Contreras Miranda Ebert')">CIRUGIA II - Dr. Contreras Miranda Ebert</button>
            <button onclick="elegirEspecialidad('DERMATOLOGIA I', 'Dr. Saavedra Serrano Norma')">DERMATOLOGIA I - Dr. Saavedra Serrano Norma</button>
            <button onclick="elegirEspecialidad('GASTROENTEROLOGIA', 'Dr. Canseco Oliva')">GASTROENTEROLOGIA - Dr. Canseco Oliva</button>
            <button onclick="elegirEspecialidad('GINECOLOGIA', 'Dr. Solis Rojas Vanessa')">GINECOLOGIA - Dr. Solis Rojas Vanessa</button>
            <button onclick="elegirEspecialidad('MEDICINA INTERNA I', 'Dr. Mayorga Hernan')">MEDICINA INTERNA I - Dr. Mayorga Hernan</button>
            <button onclick="elegirEspecialidad('MEDICINA INTERNA II', 'Dr. Conodri Guzman')">MEDICINA INTERNA II - Dr. Conodri Guzman</button>
            <button onclick="elegirEspecialidad('NEUROLOGIA', 'Dr. Pérez Julieta')">NEUROLOGIA - Dr. Pérez Julieta</button>
            <button onclick="elegirEspecialidad('MEDICINA GENERAL', 'Dr. Lopez Reyna')">MEDICINA GENERAL - Dr. Lopez Reyna</button>
        </div>
        <div class="columna">
            <button onclick="elegirEspecialidad('Especialidad 2', 'Dr. Jadue Efrain')">MEDICINA GENERAL III - Dr. Jadue Efrain</button>
            <button onclick="elegirEspecialidad('Especialidad 3', 'Dr. Condori Rocio')">MEDICINA GENERAL IV - Dr. Condori Rocio</button>
            <button onclick="elegirEspecialidad('Especialidad 4', 'Dr. Quiroga Federico')">ODONTOLOGIA I - Dr. Quiroga Federico</button>
            <button onclick="elegirEspecialidad('Especialidad 4', 'Dr. Cruz Faviola')">ODONTOLOGIA II - Dr. Cruz Faviola</button>
            <button onclick="elegirEspecialidad('Especialidad 4', 'Dr. Barja Paula')">ODONTOLOGIA III - Dr. Barja Paula</button>
            <button onclick="elegirEspecialidad('Especialidad 5', 'Dr. Ruiz Gonzalo')">OFTALMOLOGIA - Dr. Ruiz Gonzalo</button>
            <button onclick="elegirEspecialidad('Especialidad 6', 'Dr. Vizcarra Andres')">OTORRINOLARINGOLOGIA - Dr. Vizcarra Andres</button>
            <button onclick="elegirEspecialidad('Especialidad 7', 'Dr. Andrade Franz')">PEDIATRIA - Dr. Andrade Franz</button>
            <button onclick="elegirEspecialidad('Especialidad 8', 'Dr. Gumiel David')">TRAUMATOLOGIA - Dr. Gumiel David</button>
        </div>
    </div>
</body>
</html>

<script>
function elegirEspecialidad(especialidad, doctor) {
    const fechaConsulta = document.getElementById('fechaConsulta').value;

    if (!fechaConsulta) {
        alert('Por favor, seleccione una fecha de consulta antes de elegir una especialidad y doctor.');
        return;
    }

    sessionStorage.setItem('especialidadElegida', especialidad);
    sessionStorage.setItem('doctorElegido', doctor);
    sessionStorage.setItem('fechaElegida', fechaConsulta);

    // Dirigir al usuario a la pantalla de selección de horario.
    // Aquí estoy usando una página ficticia llamada "reservaHorario.html".
    // Tendrás que implementar esta página tú mismo
    window.location.href = 'gestionhorarios.php';
}

</script>