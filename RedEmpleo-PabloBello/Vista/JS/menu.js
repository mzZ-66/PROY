import { validarDatos, obtenerSelect, toggleClave, preventDefaultFormulario } from './login.js';

let tipoUsuario = '';
document.getElementById('loading').style.display = 'flex';
document.addEventListener("DOMContentLoaded", function() { // obtengo el tipo de usuario que está logueado
    fetch('../Controlador/obtenerTipoUsuario.php', { method: 'POST' })
    .then(response => {
        document.getElementById('loading').style.display = 'none';
        if (!response.ok) {
            throw new Error('La solicitud no fue exitosa');
        }
        return response.json();
    })
    .then(data => {
        if (data.tipoUsuario) {
            tipoUsuario = data.tipoUsuario;
            console.log('Tipo de usuario:', tipoUsuario);
            mostrarMenu();
        } else {
            console.log(data.error);
            window.location.href = './';
        }
    })
    .catch(error => {
        document.getElementById('loading').style.display = 'none';
        console.log('Error en la solicitud:', error.message);
    });
});
let containerWrapper = document.getElementById('containerWrapper');
function mostrarMenu() {
    containerWrapper.innerHTML = '';
    switch (tipoUsuario) {
        case 'alumno':
            containerWrapper.innerHTML = `
                <div class="menu-wrapper">
                    <!-- <div class="menu-item">
                        <img src="" alt="Icono 1">
                        <p>Opción 1</p>
                    </div>
                    <div class="menu-item">
                        <img src="" alt="Icono 2">
                        <p>Opción 2</p>
                    </div> -->
                    <div class="menu-item" id="perfilBoton">
                        <img src="https://www.svgrepo.com/show/495590/profile-circle.svg" alt="Perfil">
                        <p>Perfil</p>
                    </div>
                </div>
            `;
            let perfilBotonAlumno = document.getElementById("perfilBoton");
            perfilBotonAlumno.addEventListener("click", mostrarPerfil);
            break;
        case 'empresa':
            containerWrapper.innerHTML = `
                <div class="menu-wrapper">
                    <div class="menu-item" id="hacerSolicitudBoton">
                        <img src="https://www.svgrepo.com/show/435935/request-new.svg" alt="Hacer solicitud">
                        <p>Hacer solicitud</p>
                    </div>
                    <div class="menu-item" id="contratarBoton">
                        <img src="https://www.svgrepo.com/show/435934/request-approval.svg" alt="Contratar">
                        <p>Contratar</p>
                    </div>
                    <div class="menu-item" id="solicitarAlumnosFctBoton">
                        <img src="https://www.svgrepo.com/show/483647/student-person.svg" alt="Solicitar alumnos FCT">
                        <p>Solicitar alumnos (FCT)</p>
                    </div>
                    <div class="menu-item" id="perfilBoton">
                        <img src="https://www.svgrepo.com/show/495590/profile-circle.svg" alt="Perfil">
                        <p>Perfil</p>
                    </div>
                </div>
            `;

            let hacerSolicitudBoton = document.getElementById("hacerSolicitudBoton");
            hacerSolicitudBoton.addEventListener("click", hacerSolicitud);

            let contratarBoton = document.getElementById("contratarBoton");
            contratarBoton.addEventListener("click", contratar);

            let solicitarAlumnosFctBoton = document.getElementById("solicitarAlumnosFctBoton");
            solicitarAlumnosFctBoton.addEventListener("click", solicitarAlumnosFct);

            let perfilBotonEmpresa = document.getElementById("perfilBoton");
            perfilBotonEmpresa.addEventListener("click", mostrarPerfil);
            break;
        case 'tutor':
            containerWrapper.innerHTML = `
                <div class="menu-wrapper">
                    <div class="menu-item" id="verPeticionesFct">
                        <img src="https://www.svgrepo.com/show/435937/request-send.svg" alt="Ver peticiones FCT">
                        <p>Ver peticiones FCT</p>
                    </div>
                    <div class="menu-item" id="asignarFct">
                        <img src="https://www.svgrepo.com/show/435934/request-approval.svg" alt="Asignar peticiones FCT">
                        <p>Asignar peticiones FCT</p>
                    </div>
                    <div class="menu-item" id="perfilBoton">
                        <img src="https://www.svgrepo.com/show/495590/profile-circle.svg" alt="Perfil">
                        <p>Perfil</p>
                    </div>
                </div>
            `;

            let verPeticionesFctBoton = document.getElementById("verPeticionesFct");
            verPeticionesFctBoton.addEventListener("click", verPeticionesFct);
            
            let asignarFctBoton = document.getElementById("asignarFct");
            asignarFctBoton.addEventListener("click", asignarFct);

            let perfilBotonTutor = document.getElementById("perfilBoton");
            perfilBotonTutor.addEventListener("click", mostrarPerfil);
            
            break;
        case 'admin':
            containerWrapper.innerHTML = `
                <div class="menu-wrapper">
                    <div class="menu-item" id="verListados">
                        <img src="https://www.svgrepo.com/show/532198/list-ul-alt.svg" alt="Ver listados">
                        <p>Ver listados</p>
                    </div>
                    <div class="menu-item" id="filtrarPorPerfil">
                        <img src="https://www.svgrepo.com/show/532169/filter.svg" alt="Filtrar por perfil">
                        <p>Filtrar por perfil</p>
                    </div>
                    <div class="menu-item" id="perfilBoton">
                        <img src="https://www.svgrepo.com/show/495590/profile-circle.svg" alt="Perfil">
                        <p>Perfil</p>
                    </div>
                </div>
            `;

            let verListadosBoton = document.getElementById("verListados");
            verListadosBoton.addEventListener("click", verListados);
            
            let filtrarPorPerfilBoton = document.getElementById("filtrarPorPerfil");
            filtrarPorPerfilBoton.addEventListener("click", filtrarPorPerfil);

            let perfilBotonAdmin = document.getElementById("perfilBoton");
            perfilBotonAdmin.addEventListener("click", mostrarPerfil);

            break;
    }
}

function mostrarContainer() {
    containerWrapper.innerHTML = `
        <div class="container">
            <a class="botonVolver"><img src="https://cdn.iconscout.com/icon/free/png-512/free-back-arrow-1767515-1502579.png?f=webp&w=256" alt="Volver"></a>
            <h1 class="tituloVentana"></h1>
            <div id="containerVariable"></div>
        </div>
    `;
    let botonVolver = document.querySelector('.botonVolver');
    botonVolver.addEventListener('click', mostrarMenu);
}

function generarCodigo() {
    let caracteres = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
    let codigo = '';
    for (let i = 0; i < 6; i++) {
        codigo += caracteres.charAt(Math.floor(Math.random() * caracteres.length));
    }
    return codigo;
}

function cambiarClave(controlador) {
    mostrarContainer();
    let tituloVentana = document.querySelector('.tituloVentana');
    tituloVentana.innerHTML = 'Cambio de clave';

    let containerVariable = document.getElementById('containerVariable');
    containerVariable.innerHTML = `
        <p style="margin-bottom: 1rem;">Se te ha enviado un código de cambio de clave por e-mail.</p>
        <form class="formulario">
            <p><strong>Introduce tu código:</strong></p>
            <input type="text" name="codigoEmailUsuario" class="inputTexto">
            <p><strong>Nueva clave</strong></p>
            <div class="contrasenaDiv">
                <input type="password" name="nuevaClave" id="claveInput" class="inputTexto" maxlength="100" required autocomplete="current-password">
                <a id="toggleButton" type="button" class="botonVolver">
                    <img src="https://www.svgrepo.com/show/509354/eye.svg" style="width: 1.5rem;" alt="toggleClave">
                </a>
            </div>
        </form>
        <button id="cambiarClaveBtn" class="boton">Cambiar clave</button>
    `;
    toggleClave();
    document.getElementById('loading').style.display = 'flex';

    // envia el codigo por email
    let codigoEmail = generarCodigo();
    let data = { codigoEmail: codigoEmail };
    let requestOptions = {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(data)
    };
    fetch('../Controlador/c_enviarCodigoClave.php', requestOptions)
        .then(response => {
            document.getElementById('loading').style.display = 'none';
            if (!response.ok) {
                throw new Error('La solicitud no fue exitosa');
            }
            return response.json();
        })
        .then(data => {
            if (data.error) {
                toastr.error(data.error);
            } else {
                console.log(data.mensaje);
            }
        })
        .catch(error => {
            document.getElementById('loading').style.display = 'none';
            console.log('Error en la solicitud:', error.message);
    });

    // comprueba que el codigo es correcto y cambia la clave 
    let cambiarClaveBtn = document.getElementById('cambiarClaveBtn');
    cambiarClaveBtn.addEventListener('click', () => {
        let formulario = document.querySelector('.formulario');
        let datosFormulario = new FormData(formulario);
        datosFormulario.append('codigoEmail', codigoEmail);
        let requestOptions = {
            method: 'POST',
            body: datosFormulario
        };
        document.getElementById('loading').style.display = 'flex';
        fetch(`../Controlador/${controlador}`, requestOptions)
            .then(response => {
                document.getElementById('loading').style.display = 'none';
                if (!response.ok) {
                    throw new Error('La solicitud no fue exitosa');
                }
                return response.json();
            })
            .then(data => {
                if (data.error) {
                    toastr.error(data.error);
                }
                if(data.mensaje) {
                    containerVariable.innerHTML = `
                    <p class="notasForm" style="margin-bottom: 1rem;">La clave ha sido cambiada correctamente.</p>
                    <a href="menu.html" class="boton">Volver al menú</a>
                `;
                }
            })
            .catch(error => {
                document.getElementById('loading').style.display = 'none';
                console.log('Error en la solicitud:', error.message);
        });
    });
}

function comprobarCamposVacios(formulario) {
    let elementos = formulario.querySelectorAll('input, textarea, select');
    for (let elemento of elementos) {
        if (elemento.type === 'radio') {
            let nombre = elemento.name;
            let seleccionado = formulario.querySelector(`input[name="${nombre}"]:checked`);
            if (!seleccionado) {
                toastr.error(`El campo ${nombre} no puede estar vacío`);
                return false;
            }
        } else if (elemento.type !== 'button' && !elemento.value) {
            toastr.error(`El campo ${elemento.name} no puede estar vacío`);
            return false;
        }
    }
    return true;
}

function enviarForm(formulario, controlador, contenido) {
    if (!comprobarCamposVacios(formulario)) {
        return;
    }
    
    let datosFormulario = new FormData(formulario);

    if(!validarDatos(datosFormulario)) {
        return;
    }

    let requestOptions = {
        method: 'POST',
        body: datosFormulario
    };
    document.getElementById('loading').style.display = 'flex';
    fetch(`../Controlador/${controlador}`, requestOptions)
        .then(response => {
            document.getElementById('loading').style.display = 'none';
            if (!response.ok) {
                throw new Error('La solicitud no fue exitosa');
            }
            return response.json();
        })
        .then(data => {
            if (data.mensaje) {
                console.log(data.mensaje);
                containerVariable.innerHTML = contenido;
            } else {
                toastr.error(data.error);
            }
        })
        .catch(error => {
            document.getElementById('loading').style.display = 'none';
            console.log('Error en la solicitud:', error.message);
        });
}

function enviarFormYObtenerDatos(formulario, controlador) {
    let formData = new FormData(formulario);

    return fetch(`../Controlador/${controlador}`, {
        method: 'POST',
        body: formData
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('La solicitud no fue exitosa');
        }
        return response.json();
    })
    .then(data => {
        return data;
    })
    .catch(error => {
        console.error('Error:', error);
    });
}

function hacerSolicitud() {
    mostrarContainer();

    let tituloVentana = document.querySelector('.tituloVentana');
    tituloVentana.innerHTML = 'Crear solicitud de empleo';

    let containerVariable = document.getElementById('containerVariable');
    containerVariable.innerHTML = `
        <p class="notasForm">Introduce los datos de la solicitud.</p>
        <form class="formulario">
            <p><b>Estudios requeridos:</b></p>
            <select name="estudiosSelect" class="inputTexto">
                <option value="" disabled selected>Selecciona una opción</option>
            </select>
            <p><b>Experiencia:</b></p>
            <select name="experiencia" class="inputTexto">
                <option value="" disabled selected>Selecciona una opción</option>
                <option value="Sin experiencia">Sin experiencia</option>
                <option value="Menos de 1 año">Menos de 1 año</option>
                <option value="1-3 años">1-3 años</option>
                <option value="3-5 años">3-5 años</option>
                <option value="Más de 5 años">Más de 5 años</option>
            </select>
            <p><b>Posibilidad de viajar:</b></p>
            <div class="radioContainer">
                <div class="radio">
                    <input id="viajarSi" name="posibilidadViajar" type="radio" value="1" checked>
                    <label for="viajarSi" class="radio-label">Si</label>
                </div>
                <div class="radio">
                    <input id="viajarNo" name="posibilidadViajar" type="radio" value="0">
                    <label for="viajarNo" class="radio-label">No</label>
                </div>
            </div>
            <p><b>Residencia de preferencia:</b></p>
            <input type="text" name="residenciaFavorita" class="inputTexto" placeholder="Ej. Albacete">
            <p><b>Descripción:</b></p>
            <textarea name="descripcion" placeholder="Escribe una descripción"></textarea>

            <button class="boton">Crear solicitud</button>
        </form>
    `;

    let formulario = document.querySelector('.formulario');
    preventDefaultFormulario(formulario);
    obtenerSelect('c_obtenerEstudios.php', 'estudiosSelect', 'nombre', 'id');

    let contenido = `
        <p class="notasForm">Solicitud creada correctamente. Se ha notificado a los alumnos compatibles.</p>
        <a href="menu.html" class="boton">Volver al menú</a>
    `;

    let botonCrearSolicitud = document.querySelector('.boton');
    botonCrearSolicitud.addEventListener('click', () => enviarForm(formulario, 'c_crearSolicitudEmpleo.php', contenido));
}

function contratar() {
    mostrarContainer();

    let tituloVentana = document.querySelector('.tituloVentana');
    tituloVentana.innerHTML = 'Contratar a un alumno';

    let containerVariable = document.getElementById('containerVariable');
    containerVariable.innerHTML = `
        <p class="notasForm">Introduce la información del contrato.</p>
        <form class="formulario">
            <p><b>DNI</b></p>
            <input type="text" name="dni" id="dniInput" class="inputTexto" maxlength="9">
            <p><b>Tipo de contrato</b></p>
            <select name="tipoContrato" id="tipoContratoInput" class="inputTexto">
                <option value="" disabled selected>Selecciona una opción</option>
                <option value="indefinido">Contrato indefinido</option>
                <option value="temporal">Contrato temporal</option>
            </select>
            <p><b>Selecciona la solicitud a desactivar</b></p>
            <select name="solicitud" id="solicitudInput" class="inputTexto">
                <option value="" disabled selected>Selecciona una opción</option>
            </select>

            <button class="boton">Contratar</button>
        </form>
    `;

    let formulario = document.querySelector('.formulario');
    preventDefaultFormulario(formulario);
    obtenerSelect('c_obtenerSolicitudesEmpleo.php', 'solicitud', 'descripcion', 'id'); // obtengo las solicitudes activas

    let contenido = `
        <p class="notasForm">Contrato creado correctamente. Se ha notificado al alumno.</p>
        <a href="menu.html" class="boton">Volver al menú</a>
    `;

    let botonContratar = document.querySelector('.boton');
    botonContratar.addEventListener('click', () => enviarForm(formulario, 'c_crearContrato.php', contenido));
}

function solicitarAlumnosFct() {
    mostrarContainer();

    let tituloVentana = document.querySelector('.tituloVentana');
    tituloVentana.innerHTML = 'Solicitar alumnos FCT';

    let containerVariable = document.getElementById('containerVariable');
    containerVariable.innerHTML = `
        <p class="notasForm">Elige los parámetros de la solicitud FCT.</p>
        <form id="solicitudFctForm" class="formulario">
            <div id="inputsEstudios"></div>

            <p><b>Modalidad FCT</b></p>
            <select name="fctSelect" class="inputTexto">
                <option value="" disabled selected>Selecciona una opción</option>
                <option value="normal">Normal</option>
                <option value="dual">Dual</option>
                <option value="dualTec">DualTec</option>
            </select>

            <button class="boton">Solicitar</button>
        </form>
    `;

    let formulario = document.querySelector('.formulario');
    preventDefaultFormulario(formulario);

    document.getElementById('loading').style.display = 'flex';
    fetch('../Controlador/c_obtenerEstudios.php')
        .then(response => {
            document.getElementById('loading').style.display = 'none';
            if (!response.ok) {
                throw new Error('La solicitud no fue exitosa');
            }
            return response.json();
        })
        .then(data => {
            if (data.campos && data.campos.length > 0) {
                let inputsEstudios = document.getElementById('inputsEstudios');
                data.campos.forEach(estudio => {
                    inputsEstudios.innerHTML += `
                        <p><b>${estudio.nombre}</b></p>
                        <input type="number" name="numAlumnos[${estudio.id}]" class="inputTexto" placeholder="Número de alumnos">
                    `;
                });
            } else {
                containerVariable.innerHTML = `
                    <p class="notasForm">No se encontraron estudios en la base de datos.</p>
                    <a href="menu.html" class="boton">Volver al menú</a>
                `;
            }
        })
        .catch(error => {
            document.getElementById('loading').style.display = 'none';
            console.log('Error en la solicitud:', error.message);
        });
        
    let contenido = `
        <p class="notasForm">Solicitud de alumnos FCT creada correctamente.</p>
        <a href="menu.html" class="boton">Volver al menú</a>
    `;

    let botonSolicitarFct = document.querySelector('.boton');
    botonSolicitarFct.addEventListener('click', () => enviarForm(formulario, 'c_crearSolicitudFct.php', contenido));
}

function verPeticionesFct() {
    document.getElementById('loading').style.display = 'flex';
    fetch('../Controlador/c_obtenerSolicitudesFct.php')
        .then(response => {
            document.getElementById('loading').style.display = 'none';
            if (!response.ok) {
                throw new Error('La solicitud no fue exitosa');
            }
            return response.json();
        })
        .then(data => {
            mostrarContainer();

            let tituloVentana = document.querySelector('.tituloVentana');
            tituloVentana.innerHTML = 'Peticiones FCT';

            containerVariable.innerHTML = `
                <table>
                    <tr>
                        <th>Empresa (CIF)</th>
                        <th>Nº Alumnos</th>
                        <th>Modalidad FCT</th>
                        <th>Plazas disponibles</th>
                    </tr>
                    ${data.campos.map(item => `
                        <tr>
                            <td>${item.empresaSolicitante}</td>
                            <td>${item.nAlumnosPorEstudios}</td>
                            <td>${item.modalidadFct}</td>
                            <td>${item.nAlumnosPorEstudiosRestante}</td>
                        </tr>
                    `).join('')}
                </table>
            `;
        })
        .catch(error => {
            document.getElementById('loading').style.display = 'none';
            console.log('Error en la solicitud:', error.message);
        });
}

function asignarFct() {
    mostrarContainer();

    let tituloVentana = document.querySelector('.tituloVentana');
    tituloVentana.innerHTML = 'Asignar alumno a una FCT';

    let containerVariable = document.getElementById('containerVariable');
    containerVariable.innerHTML = `
        <p class="notasForm">Introduce la información de la FCT.</p>
        <p><u>Solo se muestran los alumnos no asignados</u></p>
        <p class="notasForm"><u>y las empresas con peticiones con plazas libres.</u></p>
        <form class="formulario">

            <p><b>DNI</b></p>
            <select name="dniSelect" class="inputTexto">
                <option value="" disabled selected>Selecciona una opción</option>
            </select>

            <p><b>CIF empresa</b></p>
            <select name="cifSelect" class="inputTexto">
                <option value="" disabled selected>Selecciona una opción</option>
            </select>

            <p><b>Modalidad FCT</b></p>
            <select name="fctSelect" class="inputTexto">
                <option value="" disabled selected>Selecciona una opción</option>
                <option value="normal">Normal</option>
                <option value="dual">Dual</option>
                <option value="dualTec">DualTec</option>
            </select>

            <button class="boton">Asignar</button>
        </form>
    `;

    let formulario = document.querySelector('.formulario');
    preventDefaultFormulario(formulario);
    obtenerSelect('c_obtenerAlumnosPorTutor.php', 'dniSelect', 'dni', 'dni'); // obtengo los alumnos del tutor
    obtenerSelect('c_obtenerSolicitudesFct.php', 'cifSelect', 'empresaSolicitante', 'empresaSolicitante'); // obtengo las empresas que tienen solicitudes FCT con alumnos que el tutor puede asignar

    let contenido = `
        <p class="notasForm">Alumno asignado correctamente. Se han almacenado los datos.</p>
        <a href="menu.html" class="boton">Volver al menú</a>
    `;

    let botonContratar = document.querySelector('.boton');
    botonContratar.addEventListener('click', () => enviarForm(formulario, 'c_asignarFct.php', contenido));
}

function verListados() {
    mostrarContainer();

    let tituloVentana = document.querySelector('.tituloVentana');
    tituloVentana.innerHTML = 'Ver listados';

    let containerVariable = document.getElementById('containerVariable');
    containerVariable.innerHTML = `
        <div class="button-wrapper">
            <button id="listadoAlumnos" class="boton">Listado de alumnos</button>
            <button id="listadoEmpresas" class="boton">Listado de empresas</button>
        </div>
    `;
    let listadoAlumnosBoton = document.getElementById('listadoAlumnos');
    listadoAlumnosBoton.addEventListener('click', () => {
        mostrarContainer();
        let containerVariable = document.getElementById('containerVariable'); // se selecciona otra vez ya que el container se ha borrado
        containerVariable.innerHTML = `
            <p class="notasForm">Introduce un alumno a buscar.</p>
            <form class="formulario">
                <p><b>DNI</b></p>
                <select name="dniSelect" class="inputTexto" required>
                    <option value="" disabled selected>Selecciona una opción</option>
                </select>
                <button class="boton">Buscar</button>
            </form>
        `;
        let formulario = document.querySelector('.formulario');
        preventDefaultFormulario(formulario);
        obtenerSelect('c_obtenerAlumnos.php', 'dniSelect', 'dni', 'dni');
        
        let botonBuscar = document.querySelector('.boton');
        botonBuscar.addEventListener('click', () => {
            enviarFormYObtenerDatos(formulario, 'c_obtenerAlumnoPorDni.php')
            .then(data => {
                containerVariable.innerHTML = `
                <h1 class="tituloVentana">Datos de alumno</h1>
                    <table>
                        <tr>
                            <th>DNI</th>
                            <th>Nombre</th>
                            <th>Apellidos</th>
                            <th>Email</th>
                            <th>Disponibilidad</th>
                            <th>Último Acceso</th>
                            <th>Estudios en Centro</th>
                            <th>Estudios Externos</th>
                        </tr>
                        <tr>
                            <td>${data.alumno.dni}</td>
                            <td>${data.alumno.nombre}</td>
                            <td>${data.alumno.apellidos}</td>
                            <td>${data.alumno.email}</td>
                            <td>${data.alumno.disponibilidad}</td>
                            <td>${data.alumno.ultimoAcceso}</td>
                            <td>${data.alumno.estudiosCentro}</td>
                            <td>${data.alumno.estudiosExternos}</td>
                        </tr>
                    </table>
                `;
            });
        });
    });

    let listadoEmpresasBoton = document.getElementById('listadoEmpresas');
    listadoEmpresasBoton.addEventListener('click', () => {
        mostrarContainer();
        let containerVariable = document.getElementById('containerVariable'); // se selecciona otra vez ya que el container se ha borrado
        containerVariable.innerHTML = `
            <p class="notasForm">Introduce una empresa a buscar.</p>
            <form class="formulario">
                <p><b>CIF</b></p>
                <select name="cifSelect" class="inputTexto" required>
                    <option value="" disabled selected>Selecciona una opción</option>
                </select>
                <button class="boton">Buscar</button>
            </form>
        `;
        let formulario = document.querySelector('.formulario');
        preventDefaultFormulario(formulario);
        obtenerSelect('c_obtenerEmpresas.php', 'cifSelect', 'cif', 'cif');
        
        let botonBuscar = document.querySelector('.boton');
        botonBuscar.addEventListener('click', () => {
            // Limpiar el contenedor
            containerVariable.innerHTML = '';
        
            enviarFormYObtenerDatos(formulario, 'c_obtenerEmpresaPorCif.php')
            .then(data => {
                containerVariable.append(document.createElement('p').textContent = 'Información de la empresa');
                let tablaEmpresa = document.createElement('table');
                tablaEmpresa.innerHTML = `
                    <tr>
                        <th>CIF</th>
                        <th>Nombre</th>
                        <th>Email</th>
                        <th>Última Petición</th>
                        <th>¿Es empleadora?</th>
                    </tr>
                    <tr>
                        <td>${data.empresa.cif}</td>
                        <td>${data.empresa.nombre}</td>
                        <td>${data.empresa.email}</td>
                        <td>${data.empresa.ultimaPeticion}</td>
                        <td>${data.empresa.empleadora}</td>
                    </tr>
                `;
                tablaEmpresa.style.width = '100%'; // Añadir estilos a la tabla
                tablaEmpresa.style.marginBottom = '1rem'; // Añadir espacio debajo de la tabla
                containerVariable.appendChild(tablaEmpresa);
            });
        
            enviarFormYObtenerDatos(formulario, 'c_obtenerContratosPorEmpresa.php')
            .then(data => {
                containerVariable.append(document.createElement('p').textContent = 'Contratos realizados');
                let tablaContratos = document.createElement('table');
                tablaContratos.innerHTML = `
                    <tr>
                        <th>ID</th>
                        <th>DNI empleado</th>
                        <th>CIF empresa</th>
                        <th>Tipo de contrato</th>
                        <th>Fecha de contratación</th>
                    </tr>
                    ${data.contratos.map(contract => `
                        <tr>
                            <td>${contract.id}</td>
                            <td>${contract.empleado}</td>
                            <td>${contract.empresa}</td>
                            <td>${contract.tipoContrato}</td>
                            <td>${contract.fechaContrato}</td>
                        </tr>
                    `).join('')}
                `;
                tablaContratos.style.width = '100%'; // Añadir estilos a la tabla
                tablaContratos.style.marginBottom = '1rem'; // Añadir espacio debajo de la tabla
                containerVariable.appendChild(tablaContratos);
            });
        });
    });
}

function filtrarPorPerfil() {
    mostrarContainer();

    let tituloVentana = document.querySelector('.tituloVentana');
    tituloVentana.innerHTML = 'Filtrar por perfil';

    let containerVariable = document.getElementById('containerVariable');
    containerVariable.innerHTML = `
        <div class="button-wrapper">
            <button id="filtrarEmpresasPorEstudios" class="boton">Empresas Por Solicitud</button>
            <button id="filtrarAlumnosPorPerfil" class="boton">Alumnos por perfil</button>
        </div>
    `;
    let filtrarEmpresasPorEstudiosBoton = document.getElementById('filtrarEmpresasPorEstudios');
    filtrarEmpresasPorEstudiosBoton.addEventListener('click', () => {
        mostrarContainer();
        let containerVariable = document.getElementById('containerVariable'); // se selecciona otra vez ya que el container se ha borrado
        containerVariable.innerHTML = `
            <p class="notasForm">Introduce un estudio a buscar.</p>
            <form class="formulario">
                <p><b>Estudio</b></p>
                <select name="estudiosSelect" class="inputTexto" required>
                    <option value="" disabled selected>Selecciona una opción</option>
                </select>
                <button class="boton">Buscar</button>
            </form>
        `;
        let formulario = document.querySelector('.formulario');
        preventDefaultFormulario(formulario);
        obtenerSelect('c_obtenerEstudios.php', 'estudiosSelect', 'nombre', 'id');

        let botonBuscar = document.querySelector('.boton');
        botonBuscar.addEventListener('click', () => {
            enviarFormYObtenerDatos(formulario, 'c_obtenerEmpresasPorEstudio.php')
            .then(data => {
                // if (data.error) {
                //     toastr.error(data.error);
                //     return;
                // }
                containerVariable.innerHTML = `
                    <h1 class="tituloVentana">Resultado de la búsqueda</h1>
                    <table>
                        <tr>
                            <th>CIF</th>
                            <th>Nombre</th>
                            <th>Email</th>
                            <th>Última Petición</th>
                            <th>¿Es empleadora?</th>
                        </tr>
                        ${data.empresas.map(empresa => `
                            <tr>
                                <td>${empresa.cif}</td>
                                <td>${empresa.nombre}</td>
                                <td>${empresa.email}</td>
                                <td>${empresa.ultimaPeticion}</td>
                                <td>${empresa.empleadora}</td>
                            </tr>
                        `).join('')}
                    </table>
                `;
            });
        });
    });

    let filtrarAlumnosPorPerfilBoton = document.getElementById('filtrarAlumnosPorPerfil');
    filtrarAlumnosPorPerfilBoton.addEventListener('click', () => {
        mostrarContainer();
        let containerVariable = document.getElementById('containerVariable'); // se selecciona otra vez ya que el container se ha borrado
        containerVariable.innerHTML = `
            <p class="notasForm">Introduce un estudio a buscar.</p>
            <form class="formulario">
                <p><b>Estudio</b></p>
                <select name="estudiosSelect" class="inputTexto" required>
                    <option value="" disabled selected>Selecciona una opción</option>
                </select>
                <button class="boton">Buscar</button>
            </form>
        `;
        let formulario = document.querySelector('.formulario');
        preventDefaultFormulario(formulario);
        obtenerSelect('c_obtenerEstudios.php', 'estudiosSelect', 'nombre', 'id');

        let botonBuscar = document.querySelector('.boton');
        botonBuscar.addEventListener('click', () => {
            enviarFormYObtenerDatos(formulario, 'c_obtenerAlumnosPorEstudios.php')
            .then(data => {
                if (data.error) {
                    toastr.error(data.error);
                    return;
                }
                containerVariable.innerHTML = `
                    <h1 class="tituloVentana">Resultado de la búsqueda</h1>
                    <table>
                        <tr>
                            <th>DNI</th>
                            <th>Nombre</th>
                            <th>Apellidos</th>
                            <th>Email</th>
                            <th>Disponibilidad</th>
                            <th>Último Acceso</th>
                            <th>Estudios en Centro</th>
                            <th>Estudios Externos</th>
                        </tr>
                        ${data.alumnos.map(alumno => `
                            <tr>
                                <td>${alumno.dni}</td>
                                <td>${alumno.nombre}</td>
                                <td>${alumno.apellidos}</td>
                                <td>${alumno.email}</td>
                                <td>${alumno.disponibilidad}</td>
                                <td>${alumno.ultimoAcceso}</td>
                                <td>${alumno.estudiosCentro}</td>
                                <td>${alumno.estudiosExternos}</td>
                            </tr>
                        `).join('')}
                    </table>
                `;
            });
        });
    });
}

function mostrarPerfil() {
    mostrarContainer();

    let tituloVentana = document.querySelector('.tituloVentana');
    tituloVentana.innerHTML = 'Perfil';

    let containerVariable = document.getElementById('containerVariable');
    switch (tipoUsuario) {
        case 'alumno':
            containerVariable.innerHTML = `
                <div class="button-wrapper">
                    <button id="anadirEstudiosExternos" class="boton">Añadir estudios externos</button>
                    <button id="cambiarDisponibilidad" class="boton">Cambiar disponibilidad</button>
                    <button id="cambiarClave" class="boton">Cambiar clave</button>
                    <button id="cerrarSesion" class="boton botonRojo">Cerrar sesión</button>
                </div>
            `;
            let anadirEstudiosExternos = document.getElementById('anadirEstudiosExternos');
            anadirEstudiosExternos.addEventListener('click', () => {
                document.getElementById('loading').style.display = 'flex';
                fetch('../Controlador/c_obtenerEstudiosExternos.php', { method: 'POST' })
                    .then(response => {
                        document.getElementById('loading').style.display = 'none';
                        if (!response.ok) {
                            throw new Error('La solicitud no fue exitosa');
                        }
                        return response.json();
                    })
                    .then(data => {
                        if (data.error) {
                            console.log(data.error);
                        } else {
                            mostrarContainer();
                            let tituloVentana = document.querySelector('.tituloVentana');
                            tituloVentana.innerHTML = 'Añadir estudios externos';
                            let estudiosExternos = data.estudiosExternos || '';
                            let containerVariable = document.getElementById('containerVariable');
                            containerVariable.innerHTML = `
                                <p style="margin-bottom: 1rem;">Puedes editar tus estudios externos modificando este cuadro de texto.</p>
                                <form class="formulario">
                                    <textarea name="estudiosExternos">${estudiosExternos}</textarea>
                                </form>
                                <button id="guardarEstudiosExternos" class="boton">Guardar</button>
                            `;
                            let guardarEstudiosExternos = document.getElementById('guardarEstudiosExternos');
                            guardarEstudiosExternos.addEventListener('click', () => {
                                let formulario = document.querySelector('.formulario');
                                let datosFormulario = new FormData(formulario);
                                let requestOptions = {
                                    method: 'POST',
                                    body: datosFormulario
                                };
                                document.getElementById('loading').style.display = 'flex';
                                fetch('../Controlador/c_actualizarEstudiosExternos.php', requestOptions)
                                    .then(response => {
                                        document.getElementById('loading').style.display = 'none';
                                        if (!response.ok) {
                                            throw new Error('La solicitud no fue exitosa');
                                        }
                                        return response.json();
                                    })
                                    .then(data => {
                                        if (data.mensaje) {
                                            toastr.success(data.mensaje);
                                        } else {
                                            toastr.error(data.error);
                                        }
                                    })
                                    .catch(error => {
                                        document.getElementById('loading').style.display = 'none';
                                        console.log('Error en la solicitud:', error.message);
                                    });
                            });
                        }
                    })
                    .catch(error => {
                        document.getElementById('loading').style.display = 'none';
                        console.log('Error en la solicitud:', error.message);
                    });
            });

            let cambiarDisponibilidad = document.getElementById('cambiarDisponibilidad');
            cambiarDisponibilidad.addEventListener('click', () => {
                mostrarContainer();
                let tituloVentana = document.querySelector('.tituloVentana');
                tituloVentana.innerHTML = 'Disponibilidad actual';

                let containerVariable = document.getElementById('containerVariable');
                containerVariable.innerHTML = `
                    <form class="formulario">
                        <div class="radioContainer">
                            <div class="radio">
                                <input id="disponibleSi" name="disponibilidad" type="radio" value="1" checked>
                                <label for="disponibleSi" class="radio-label">Disponible</label>
                            </div>
                            <div class="radio">
                                <input id="disponibleNo" name="disponibilidad" type="radio" value="0">
                                <label for="disponibleNo" class="radio-label">No disponible</label>
                            </div>
                        </div>
                    </form>
                    <button id="actualizarDisponibilidad" class="boton">Guardar</button>
                `;

                let actualizarDisponibilidad = document.getElementById('actualizarDisponibilidad');
                actualizarDisponibilidad.addEventListener('click', () => {
                    let formulario = document.querySelector('.formulario');
                    let contenido = `
                        <p class="notasForm">Disponibilidad actualizada.</p>
                        <a href="menu.html" class="boton">Volver al menú</a>
                    `;
                    enviarForm(formulario, 'c_actualizarDisponibilidad.php', contenido);
                });
            });

            let cambiarClaveBotonAlumno = document.getElementById('cambiarClave');
            cambiarClaveBotonAlumno.addEventListener('click', () => cambiarClave('c_cambiarClaveAlumno.php'));

            let cerrarSesionBotonAlumno = document.getElementById('cerrarSesion');
            cerrarSesionBotonAlumno.addEventListener('click', cerrarSesion);
            break;
        case 'empresa':
            containerVariable.innerHTML = `
                <div class="button-wrapper">
                    <button id="cambiarClave" class="boton">Cambiar clave</button>
                    <button id="cerrarSesion" class="boton botonRojo">Cerrar sesión</button>
                </div>
            `;
            let cambiarClaveBotonEmpresa = document.getElementById('cambiarClave');
            cambiarClaveBotonEmpresa.addEventListener('click', () => cambiarClave('c_cambiarClaveEmpresa.php'));

            let cerrarSesionBotonEmpresa = document.getElementById('cerrarSesion');
            cerrarSesionBotonEmpresa.addEventListener('click', cerrarSesion);
            break;
        case 'tutor':
            containerVariable.innerHTML = `
                <div class="button-wrapper">
                    <button id="cambiarClave" class="boton">Cambiar clave</button>
                    <button id="cerrarSesion" class="boton botonRojo">Cerrar sesión</button>
                </div>
            `;
            let cambiarClaveBotonTutor = document.getElementById('cambiarClave');
            cambiarClaveBotonTutor.addEventListener('click', () => cambiarClave('c_cambiarClaveTutor.php'));

            let cerrarSesionBotonTutor = document.getElementById('cerrarSesion');
            cerrarSesionBotonTutor.addEventListener('click', cerrarSesion);
            break;
        case 'admin':
            containerVariable.innerHTML = `
                <div class="button-wrapper">
                    <button id="cerrarSesion" class="boton botonRojo">Cerrar sesión</button>
                </div>
            `;
            let cerrarSesionBotonAdmin = document.getElementById('cerrarSesion');
            cerrarSesionBotonAdmin.addEventListener('click', cerrarSesion);
            break;
    }
}

function cerrarSesion() {
    document.getElementById('loading').style.display = 'flex';
    fetch('../Controlador/cerrarSesion.php', { method: 'POST' })
    .then(response => {
        document.getElementById('loading').style.display = 'none';
        if (!response.ok) {
            throw new Error('La solicitud no fue exitosa');
        }
        return response.json();
    })
    .then(data => {
        console.log(data.mensaje);
        window.location.href = './';
    })
    .catch(error => {
        document.getElementById('loading').style.display = 'none';
        console.log('Error en la solicitud:', error.message);
    });
}