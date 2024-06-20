function showInicio() {
    var content = document.getElementById('content');
    content.innerHTML = `
        <div class="nosotros-container">
        <h2>Iniciar Sesión</h2>
        <form id="loginForm" action="verificar_usuario.php" method="post">
            <label for="carnet">Carnet:</label>
            <input type="text" id="carnet" name="carnet" placeholder="Numero de carnet" required  >
            <label for="password">Contraseña:</label>
            <input type="password" id="password" name="password" placeholder="Contraseña" required>
            <div class="button-container">
                <button type="button" onclick="limpiarFormulario()">Limpiar</button>
                <button type="button" onclick="cancelar()">Cancelar</button>
                <button type="submit" onclick="ingresar()">Ingresar</button >
            </div>
        </form>
        </div>
    `;
}

function showNosotros() {
    var content = document.getElementById('content');
    content.innerHTML = `
        <div class="nosotros-container">
            <h2>Nosotros</h2>
            <p>Nosotros somos una clínica destinada a proporcionar atención médica de alta calidad a todos nuestros pacientes. Nuestro equipo de profesionales está comprometido con el bienestar y la salud de nuestra comunidad.</p>
            <img src="img/doctores.jpg" alt="" class="imagen">
        </div>
    `;
}
function showAfiliacion() {
    var content = document.getElementById('content');
    content.innerHTML = `
        <div class="nosotros-container">
            <h2>Afiliacion</h2>
            <ul class="custom-list">
            <li>Formulario AVC-04 llenado, sellado y firmado por el empleador y el trabajador (excluyendo la casilla Nª 4).</li>
            <li>Formulario AVC-05 (carnet de asegurado sin llenar).</li>
            <li>Certificado de Nacimiento del trabajador (actual computarizado) emitido por SERECI.</li>
            <li>Cédula de Identidad (adjuntar fotocopia si son varias afiliaciones, afiliaciones masivas).</li>
            <li>Papeleta de Pago vigente, (en caso de reciente ingreso al trabajo debe presentar Memorándum de Designación, Contrato de trabajo y/o Planilla de Salarios sellado por Cotizaciones.</li>
            <li>Examen Pre ocupacional o la boleta de depósito de 100 bolivianos.</li>
            <li>Nota. - Si es reingreso, no es necesario el certificado de nacimiento, si no cambió de empleador y no cuenta con más de un año de cesantía, no es necesario el examen pre ocupacional.</li>
</ul>

        </div>
    `;
}
function showPresentaciones() {
    var content = document.getElementById('content');
    content.innerHTML = `
        <div class="nosotros-container">
            <h2>Presentaciones</h2>
            </div>
    `;
}
function showEstudiantes() {
    var content = document.getElementById('content');
    content.innerHTML = `
        <div class="nosotros-container">
            <h2>Estudiantes</h2>
            <li> Espinoza Cava Chelsea Melany</li>
            <li> Perez Torres Jhoyce Roxana</li>
            <li> Saravia Grass Rafael Alejandro   </li>
        </div>
    `;
}
function showNosotros() {
    var content = document.getElementById('content');
    content.innerHTML = `
        <div class="nosotros-container">
            <h2>Nosotros</h2>
            <p>Nosotros somos una clínica destinada a proporcionar atención médica de alta calidad a todos nuestros pacientes. Nuestro equipo de profesionales está comprometido con el bienestar y la salud de nuestra comunidad.</p>
        </div>
    `;
}

function limpiarFormulario() {
    document.getElementById('loginForm').reset();
}

function cancelar() {
    alert('Acción de cancelar');
}
document.addEventListener('DOMContentLoaded', function() {
    const loginForm = document.getElementById('loginForm');
    const scheduleForm = document.getElementById('scheduleForm');
    const especialidadSelect = document.getElementById('especialidad');
    const medicoSelect = document.getElementById('medico');

    loginForm.addEventListener('submit', function(event) {
        event.preventDefault();
        const username = document.getElementById('username').value;
        const password = document.getElementById('password').value;

        if (username === 'usuario' && password === 'contraseña') {
            document.querySelector('.login-container').style.display = 'none';
            document.querySelector('.schedule-container').style.display = 'block';
            loadEspecialidades(); // Cargar lista de especialidades médicas disponibles
        } else {
            alert('Usuario o contraseña incorrectos');
        }
    });

    scheduleForm.addEventListener('submit', function(event) {
        event.preventDefault();
        const fecha = document.getElementById('fecha').value;
        const medicoId = medicoSelect.value;
        const horario = document.getElementById('horario').value;

        const turno = {
            pacienteId: '612e7bc2e2b1d437b8bc2000', // ID del paciente desde la base de datos (ejemplo estático)
            medicoId: medicoId,
            fecha: fecha,
            horario: horario
        };

       fetch('/api/turnos', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(turno)
        })
        .then(response => response.json())
        .then(data => {
            console.log('Turno registrado:', data);
            alert('Turno registrado correctamente');
        })
        .catch(error => {
            console.error('Error al registrar turno:', error);
            alert('Hubo un error al registrar el turno. Por favor, intenta nuevamente.');
        });
    });

    function loadEspecialidades() {
        fetch('/api/especialidades')
        .then(response => response.json())
        .then(especialidades => {
            especialidadSelect.innerHTML = '';
            especialidades.forEach(especialidad => {
                const option = document.createElement('option');
                option.value = especialidad._id;
                option.textContent = especialidad.nombre;
                especialidadSelect.appendChild(option);
            });

            especialidadSelect.addEventListener('change', loadMedicos);
        })
        .catch(error => {
            console.error('Error al cargar especialidades:', error);
        });
    }

    // Función para cargar la lista de médicos disponibles según la especialidad seleccionada
    function loadMedicos() {
        const especialidadId = especialidadSelect.value;
        fetch(`/api/medicos/${especialidadId}`)
        .then(response => response.json())
        .then(medicos => {
            medicoSelect.innerHTML = '';
            medicos.forEach(medico => {
                const option = document.createElement('option');
                option.value = medico._id;
                option.textContent = `${medico.nombre} ${medico.apellido}`;
                medicoSelect.appendChild(option);
            });
        })
        .catch(error => {
            console.error('Error al cargar médicos:', error);
        });
    }
});


// Retrieve information from sessionStorage
const patientName = sessionStorage.getItem("patientName");
const specialty = sessionStorage.getItem("especialidadElegida");
const doctor = sessionStorage.getItem("doctorElegido");
const day = sessionStorage.getItem("fechaElegida");
const consultorio = "2"; // Example: You can retrieve this from the server if needed
const direccion = "DTT0. 111 N 462 ESQ. LA PAZ"; // Example: You can retrieve this from the server if needed
const turno = "MAÑANA"; // Example: You can retrieve this from the server if needed
const horaPresentacion = sessionStorage.getItem("horaElegida");
const nroficha = sessionStorage.getItem("fichaElegida");

// Set values in the HTML document
document.getElementById("patientName").innerText = patientName;
document.getElementById("specialty").value = specialty;
document.getElementById("doctor").value = doctor;
document.getElementById("day").value = day;
document.getElementById("consultorio").value = consultorio;
document.getElementById("direccion").value = direccion;
document.getElementById("turno").value = turno;
document.getElementById("horaPresentacion").value = horaPresentacion;
document.getElementById("nroficha").value = nroficha;

// Function to trigger the print
function printFicha() {
  window.print();
}

function goToIndex() {
  window.location.href = "index.html";
}

function editFicha() {
  window.location.href = "gestionEspecialidad.php";
}


function limpiarFormulario() {
    document.getElementById('loginForm').reset();
}

function cancelar() {
    alert('Acción de cancelar');
    window.location.href = "index.html";
}

