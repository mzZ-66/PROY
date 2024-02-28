export { validarDatos, obtenerSelect, toggleClave, preventDefaultFormulario };

let containerWrapper = document.getElementById('containerWrapper');
mostrarIndex();
function mostrarIndex() {
    containerWrapper.innerHTML = `
        <div class="container">
            <h1>Iniciar sesión</h1>
            <div class="container">
                <a id="loginAlumnos" class="boton">Acceso Alumnos</a>
                <a id="loginEmpresas" class="boton">Acceso Empresas</a>
            </div>
            <div class="container">
                <a id="loginTutores" class="boton">Acceso Tutores</a>
                <a id="loginAdmin" class="boton">Acceso Admin</a>
            </div>
        </div>
        <div class="container">
            <h1>Registro</h1>
            <div class="container flex-container-column">
                <a id="registroAlumnos" class="boton">Registro Alumnos</a>
                <a id="registroEmpresas" class="boton">Registro Empresas</a>
            </div>
        </div>
    `;

    let loginAlumnos = document.getElementById('loginAlumnos');
    let loginEmpresas = document.getElementById('loginEmpresas');
    let loginTutores = document.getElementById('loginTutores');
    let loginAdmin = document.getElementById('loginAdmin');
    let registroAlumnos = document.getElementById('registroAlumnos');
    let registroEmpresas = document.getElementById('registroEmpresas');
    
    loginAlumnos.addEventListener('click', () => {
        mostrarContainer();

        let formDiv = document.getElementById('formDiv');
        let tituloVentana = document.querySelector('.tituloVentana');
        tituloVentana.innerHTML = 'Inicia sesión como Alumno';

        formDiv.innerHTML = `
            <form class="formulario">
            <p><b>DNI</b></p>
            <input type="text" name="dni" class="inputTexto" autocomplete="username">
            <p><b>Clave</b></p>
            <div class="contrasenaDiv"> 
                <input type="password" name="clave" id="claveInput" class="inputTexto" maxlength="100" autocomplete="current-password">
                <a id="toggleButton" type="button" class="botonVolver">
                    <img src="https://www.svgrepo.com/show/509354/eye.svg" style="width: 1.5rem;" alt="toggleClave">
                </a>
            </div>
            <button class="boton">Log in</button>
            </form>
        `;

        let formulario = document.querySelector('.formulario');
        toggleClave();
        preventDefaultFormulario(formulario);

        let botonLogin = document.querySelector('.boton');
        botonLogin.addEventListener('click', () => login('c_loginAlumnos.php'));
    });
    loginEmpresas.addEventListener('click', () => {
        mostrarContainer();

        let formDiv = document.getElementById('formDiv');
        let tituloVentana = document.querySelector('.tituloVentana');
        tituloVentana.innerHTML = 'Inicia sesión como Empresa';

        formDiv.innerHTML = `
            <form class="formulario">
            <p><b>CIF</b></p>
            <input type="text" name="cif" class="inputTexto" autocomplete="username">
            <p><b>Clave</b></p>
            <div class="contrasenaDiv"> 
                <input type="password" name="clave" id="claveInput" class="inputTexto" maxlength="100" autocomplete="current-password">
                <a id="toggleButton" type="button" class="botonVolver">
                    <img src="https://www.svgrepo.com/show/509354/eye.svg" style="width: 1.5rem;" alt="toggleClave">
                </a>
            </div>
            <button class="boton">Log in</button>
            </form>
        `;

        let formulario = document.querySelector('.formulario');
        toggleClave();
        preventDefaultFormulario(formulario);

        let botonLogin = document.querySelector('.boton');
        botonLogin.addEventListener('click', () => login('c_loginEmpresas.php'));
    });
    loginTutores.addEventListener('click', () => {
        mostrarContainer();

        let formDiv = document.getElementById('formDiv');
        let tituloVentana = document.querySelector('.tituloVentana');
        tituloVentana.innerHTML = 'Inicia sesión como Tutor';

        formDiv.innerHTML = `
            <form class="formulario">
            <p><b>DNI</b></p>
            <input type="text" name="dni" class="inputTexto" autocomplete="username">
            <p><b>Clave</b></p>
            <div class="contrasenaDiv"> 
                <input type="password" name="clave" id="claveInput" class="inputTexto" maxlength="100" autocomplete="current-password">
                <a id="toggleButton" type="button" class="botonVolver">
                    <img src="https://www.svgrepo.com/show/509354/eye.svg" style="width: 1.5rem;" alt="toggleClave">
                </a>
            </div>
            <button class="boton">Log in</button>
            </form>
        `;

        let formulario = document.querySelector('.formulario');
        toggleClave();
        preventDefaultFormulario(formulario);

        let botonLogin = document.querySelector('.boton');
        botonLogin.addEventListener('click', () => login('c_loginTutores.php'));
    });
    loginAdmin.addEventListener('click', () => {
        mostrarContainer();

        let formDiv = document.getElementById('formDiv');
        let tituloVentana = document.querySelector('.tituloVentana');
        tituloVentana.innerHTML = 'Inicia sesión como Admin';

        formDiv.innerHTML = `
            <form class="formulario">
            <p><b>DNI</b></p>
            <input type="text" name="dni" class="inputTexto" autocomplete="username">
            <p><b>Clave</b></p>
            <div class="contrasenaDiv"> 
                <input type="password" name="clave" id="claveInput" class="inputTexto" maxlength="100" autocomplete="current-password">
                <a id="toggleButton" type="button" class="botonVolver">
                    <img src="https://www.svgrepo.com/show/509354/eye.svg" style="width: 1.5rem;" alt="toggleClave">
                </a>
            </div>
            <button class="boton">Log in</button>
            </form>
        `;

        let formulario = document.querySelector('.formulario');
        toggleClave();
        preventDefaultFormulario(formulario);

        let botonLogin = document.querySelector('.boton');
        botonLogin.addEventListener('click', () => login('c_loginAdmin.php'));
    });
    
    registroAlumnos.addEventListener('click', () => {
        mostrarContainer();

        let formDiv = document.getElementById('formDiv');
        let tituloVentana = document.querySelector('.tituloVentana');
        let notasForm = document.querySelector('.notasForm');

        tituloVentana.innerHTML = 'Crea una cuenta de Alumno';
        notasForm.innerHTML = 'Se comprobará que eres un alumno matriculado en el centro, y de que estás titulado.';

        formDiv.innerHTML = `
            <form class="formulario">
            <p><b>DNI</b></p>
            <input type="text" name="dni" id="dniInput" class="inputTexto" maxlength="9">
            <button class="boton">Registrarse</button>
            </form>
        `;

        let formulario = document.querySelector('.formulario');
        preventDefaultFormulario(formulario);

        let botonRegistrarse = document.querySelector('.boton');
        botonRegistrarse.addEventListener('click', () => {
            let datosFormulario = new FormData(formulario);

            if (!validarDni(datosFormulario.get('dni'))) {
                return;
            }

            let requestOptions = {
                method: 'POST',
                body: datosFormulario
            };
            document.getElementById('loading').style.display = 'flex';
            fetch('../Controlador/c_comprobarAlumnos.php', requestOptions)
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
                        let claveUsuario = generarClave(); // genero la clave y la guardo en una variable para poder luego validar el formulario correctamente
                        let containerVariable = document.querySelector('#containerVariable');
                        containerVariable.innerHTML = `
                            <p class="notasForm">Puedes modificar tus datos, si así lo necesitas.</p>
                            <form class="formulario">
                                <p><b>DNI:</b> ${data.datosAlumno.dni}</p>
                                <input type="text" name="dni" maxlength="9" class="inputTexto">
                                <p><b>Clave:</b> ${claveUsuario}</p>
                                <div class="contrasenaDiv">
                                    <input type="password" name="clave" maxlength="100" id="claveInput" class="inputTexto">
                                    <a id="toggleButton" type="button" class="botonVolver">
                                        <img src="https://www.svgrepo.com/show/509354/eye.svg" style="width: 1.5rem;" alt="toggleClave">
                                    </a>
                                </div>
                                <p><b>Nombre:</b> ${data.datosAlumno.nombre}</p>
                                <input type="text" name="nombre" class="inputTexto">
                                <p><b>Apellidos:</b> ${data.datosAlumno.apellidos}</p>
                                <input type="text" name="apellidos" class="inputTexto">
                                <p><b>Email:</b> ${data.datosAlumno.email}</p>
                                <input type="email" name="email" class="inputTexto">
                                <p><b>Estudios cursados en el centro:</b></p>
                                <select name="estudiosSelect" class="inputTexto">
                                    <option value="" disabled selected>Selecciona una opción</option>
                                </select>
                                <p><b>(Opcional) Otros estudios:</b></p>
                                <textarea name="estudiosExternos" placeholder="Especifica el nivel y especialidad"></textarea>
                                <p><b>Disponibilidad para trabajar:</b></p>
                                <div class="radioContainer">
                                    <div class="radio">
                                        <input id="disponibleSi" name="disponibilidad" type="radio" value="1" checked>
                                        <label for="disponibleSi" class="radio-label">Si</label>
                                    </div>
                                    <div class="radio">
                                        <input id="disponibleNo" name="disponibilidad" type="radio" value="0">
                                        <label for="disponibleNo" class="radio-label">No</label>
                                    </div>
                                </div>

                                <button class="boton">Registrarse</button>
                            </form>
                        `;

                        let formulario = document.querySelector('.formulario');
                        obtenerSelect('c_obtenerEstudios.php', 'estudiosSelect', 'nombre', 'id');
                        toggleClave();
                        preventDefaultFormulario(formulario);

                        let botonRegistrarse = document.querySelector('.boton');
                        botonRegistrarse.addEventListener('click', () => {
                            let datosFormulario = new FormData(formulario);
                            comprobarDatos(datosFormulario, 'alumno', data.datosAlumno, claveUsuario);
                            if (!validarDatos(datosFormulario)) {
                                return;
                            }
                            let estudiosSelect = datosFormulario.get('estudiosSelect');
                            if (!estudiosSelect) {
                                toastr.error('Elige tus estudios cursados');
                                return false;
                            }
                            registrarFetch('c_registroAlumnos.php', datosFormulario);
                        });
                    }
                })
                .catch(error => {
                    document.getElementById('loading').style.display = 'none';
                    console.log('Error en la solicitud:', error.message);
                });
        });
    });
    registroEmpresas.addEventListener('click', () => {
        mostrarContainer();

        let formDiv = document.getElementById('formDiv');
        let tituloVentana = document.querySelector('.tituloVentana');
        let claveEmpresa = generarClave(); // genero la clave y la guardo en una variable para poder luego validar el formulario correctamente

        tituloVentana.innerHTML = 'Crea una cuenta de Empresa';
        formDiv.innerHTML = `
            <p class="notasForm">Puedes modificar tu clave, si no, se establecerá la generada por defecto.</p>
            <form class="formulario">
                <p><b>CIF (5 caracteres numéricos)</b></p>
                <input type="text" name="cif" maxlength="5" class="inputTexto">
                <p><b>Clave:</b> ${claveEmpresa}</p>
                <div class="contrasenaDiv">
                    <input type="password" name="clave" maxlength="100" id="claveInput" class="inputTexto">
                    <a id="toggleButton" type="button" class="botonVolver">
                        <img src="https://www.svgrepo.com/show/509354/eye.svg" style="width: 1.5rem;" alt="toggleClave">
                    </a>
                </div>
                <p><b>Nombre de la empresa</b></p>
                <input type="text" name="nombreEmpresa" class="inputTexto">
                <p><b>Email</b></p>
                <input type="email" name="email" class="inputTexto">

                <button class="boton">Registrarse</button>
            </form>
        `;

        let formulario = document.querySelector('.formulario');
        toggleClave();
        preventDefaultFormulario(formulario);

        let botonRegistrarse = document.querySelector('.boton');
        botonRegistrarse.addEventListener('click', () => {
            let datosFormulario = new FormData(formulario);
            if(comprobarDatos(datosFormulario, 'empresa', null, claveEmpresa)) {
                return;
            }
            if (!validarDatos(datosFormulario)) {
                return;
            }
            registrarFetch('c_registroEmpresas.php', datosFormulario);
        });
    });
}

function mostrarContainer() {
    containerWrapper.innerHTML = `
        <div class="container">
            <a class="botonVolver"><img src="https://cdn.iconscout.com/icon/free/png-512/free-back-arrow-1767515-1502579.png?f=webp&w=256" alt="Volver"></a>
            <h1 class="tituloVentana"></h1>
            <div id="containerVariable">
                <p class="notasForm"></p>
                <div id="formDiv"></div>
            </div>
        </div>
    `;
    let botonVolver = document.querySelector('.botonVolver');
    botonVolver.addEventListener('click', mostrarIndex);
}

function generarClave() {
    let caracteres = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
    let clave = '';
    for (let i = 0; i < 10; i++) {
        clave += caracteres.charAt(Math.floor(Math.random() * caracteres.length));
    }
    return clave;
}

function toggleClave() {
    let mostrarContraseña = false;
    let toggleButton = document.getElementById('toggleButton');
    let passwordInput = document.getElementById('claveInput');

    toggleButton.addEventListener('click', () => {
        mostrarContraseña = !mostrarContraseña;
        if (mostrarContraseña) {
            passwordInput.setAttribute('type', 'text');
        } else {
            passwordInput.setAttribute('type', 'password');
        }
    });
}

function preventDefaultFormulario(formulario) {
    formulario.addEventListener('submit', function (event) {
        event.preventDefault();
    });
}

function obtenerSelect(controlador, nombreSelect, textCampo, valueCampo) {
    fetch(`../Controlador/${controlador}`)
    .then(response => {
        if (!response.ok) {
            throw new Error('La solicitud no fue exitosa');
        }
        return response.json();
    })
    .then(data => {
        if (data.campos != null) {
            let selectElement = document.querySelector(`select[name="${nombreSelect}"]`);
            data.campos.forEach(campo => {
                let option = document.createElement('option');
                option.text = campo[textCampo];
                option.value = campo[valueCampo];
                selectElement.appendChild(option);
            });
        }
    })
    .catch(error => console.log('Error:', error));
}

// comprueba que los datos del formulario no estén vacíos, y si lo están, los rellena con los datos actuales, dependiendo del tipo de registro
function comprobarDatos(datosFormulario, tipoCuenta, datosActuales, claveUsuario) {
    const camposAlumno = ['dni', 'nombre', 'apellidos', 'email'];
    const camposEmpresa = ['cif', 'nombreEmpresa', 'email'];
    const camposTutor = ['dni', 'nombre', 'apellidos', 'email', 'estudiosSelect'];

    let campos;
    switch (tipoCuenta) {
        case 'alumno':
            campos = camposAlumno;
            break;
        case 'empresa':
            campos = camposEmpresa;
            break;
        case 'tutor':
            campos = camposTutor;
            break;
        default:
            campos = [];
    }

    for (let campo of campos) {
        if (!datosFormulario.get(campo)) {
            if (tipoCuenta === 'alumno' && datosActuales && datosActuales[campo]) {
                datosFormulario.set(campo, datosActuales[campo]);
            } else if (tipoCuenta === 'empresa') {
                toastr.error(`El campo ${campo} no puede estar vacío para una cuenta de empresa.`);
                return true;
            } else if (tipoCuenta === 'tutor') {
                toastr.error(`El campo ${campo} no puede estar vacío para una cuenta de tutor.`);
                return true;
            }
        }
    }
    if (!datosFormulario.get('clave')) {
        datosFormulario.set('clave', claveUsuario);
    }
}

function validarDni(dni) {
    let nif = dni.trim();
    if (nif.length !== 9) {
        toastr.error("El DNI debe tener 9 caracteres.");
        return false;
    }
    let numero = nif.substring(0, 8);
    if (!/^\d+$/.test(numero)) {
        toastr.error("Los primeros 8 caracteres del DNI deben ser números.");
        return false;
    }
    let letra = nif.charAt(8).toUpperCase();
    if (!/^[A-Z]$/.test(letra)) {
        toastr.error("El último carácter del DNI debe ser una letra válida");
        return false;
    }
    let resto = numero % 23;
    let letras = ['T', 'R', 'W', 'A', 'G', 'M', 'Y', 'F', 'P', 'D', 'X', 'B', 'N', 'J', 'Z', 'S', 'Q', 'V', 'H', 'L', 'C', 'K', 'E', 'T'];
    let letraCorrecta = letras[resto];
    if (letra !== letraCorrecta) {
        toastr.error("La letra del DNI no es correcta.");
        return false;
    }

    return true;
}

function validarDatos(datosFormulario) {
    // dni
    if (datosFormulario.has('dni') && !validarDni(datosFormulario.get('dni'))) {
        return false;
    }

    // cif
    if (datosFormulario.has('cif')) {
        let cif = datosFormulario.get('cif');
        if (!/^\d{5}$/.test(cif)) {
            toastr.error("El CIF debe tener 5 caracteres numéricos.");
            return false;
        }
    }

    // email
    if (datosFormulario.has('email')) {
        let email = datosFormulario.get('email');
        let regexEmail = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
        if (email && !regexEmail.test(email)) {
            toastr.error('El email no tiene un formato válido');
            return false;
        }
    }

    // no verifico los estudios aqui por un bug de JS
    
    // nombre
    if (datosFormulario.has('nombre')) {
        let nombre = datosFormulario.get('nombre');
        if (!/^[a-zA-Z\sáéíóúÁÉÍÓÚ]+$/.test(nombre)) {
            toastr.error("El nombre solo puede contener letras y tildes.");
            return false;
        }
    }

    // apellidos
    if (datosFormulario.has('apellidos')) {
        let apellidos = datosFormulario.get('apellidos');
        if (!/^[a-zA-Z\sáéíóúÁÉÍÓÚ]+$/.test(apellidos)) {
            toastr.error("Los apellidos solo pueden contener letras y tildes.");
            return false;
        }
    }

    // clave
    if (datosFormulario.has('clave') && (datosFormulario.get('clave').trim() === '' || datosFormulario.get('clave') === null)) {
        toastr.error("La clave no puede estar vacía.");
        return false;
    }

    return true;
}

// no contiene la lógica de la validación de los datos, solo la lógica de la petición fetch
function registrarFetch(controllerName, datosFormulario) {
    let requestOptions = {
        method: 'POST',
        body: datosFormulario
    };
    document.getElementById('loading').style.display = 'flex';
    fetch(`../Controlador/${controllerName}`, requestOptions)
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
                let containerVariable = document.querySelector('#containerVariable');
                let tituloVentana = document.querySelector('.tituloVentana');
                tituloVentana.innerHTML = 'Registro correcto';

                containerVariable.innerHTML = `
                    <p class="notasForm">Te has registrado correctamente. Se ha enviado un e-mail con tu clave.</p>
                    <a href="menu.html" class="boton">Acceder a RedEmpleo</a>
                `;
            } else if (data.error) {
                toastr.error(data.error);
            }
        })
        .catch(error => {
            document.getElementById('loading').style.display = 'none';
            console.log('Error en la solicitud:', error.message);
        });
}

function login(controlador) {
    let formulario = document.querySelector('.formulario');
    let datosFormulario = new FormData(formulario);

    if (!validarDatos(datosFormulario)) {
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
            if (data.avisoInactividad) {
                console.log(data.avisoInactividad);
            }
            if (data.error) {
                toastr.error(data.error);
                return;
            }
            if(data.mensaje) {
                window.location.href = 'menu.html';
            }
        })
        .catch(error => {
            document.getElementById('loading').style.display = 'none';
            console.log('Error en la solicitud:', error.message);
            if (error.line) console.log('Línea del error:', error.line);
            if (error.file) console.log('Archivo del error:', error.file);
        });
}