<?php
    include_once("conexionDB.php");
    class operacionesAlumno {
        private $conexion;
        public function __construct() {
            $conexion = new conexionDB();
            $this->conexion = $conexion->getConexion();
        }
        
        public function comprobarDni($dni) {
            $consulta = $this->conexion->prepare("SELECT * FROM registroalumnos WHERE dni = ?;");
            $consulta->bind_param('s', $dni);
            $consulta->execute();
            $resultado = $consulta->get_result();
            if ($resultado->num_rows === 0) {
                throw new Exception("El alumno especificado no está matriculado en el centro");
            }
            $alumno = $resultado->fetch_assoc();
            if ($alumno['titulado'] == '0') {
                throw new Exception("El alumno especificado no está titulado");
            }

            $consulta2 = $this->conexion->prepare("SELECT * FROM alumno WHERE dni = ?;");
            $consulta2->bind_param('s', $dni);
            $consulta2->execute();
            $resultado2 = $consulta2->get_result();
            if ($resultado2->num_rows > 0) {
                throw new Exception("El alumno especificado ya es miembro de RedEmpleo");
            }
        
            return $alumno;
        }

        function registrarAlumno($nuevoAlumno) {
            $dni = $nuevoAlumno->getDni();
            $clave = password_hash($nuevoAlumno->getClave(), PASSWORD_DEFAULT);
            $nombre = $nuevoAlumno->getNombre();
            $apellidos = $nuevoAlumno->getApellidos();
            $email = $nuevoAlumno->getEmail();
            $disponibilidad = $nuevoAlumno->getDisponibilidad();
            $ultimoAcceso = $nuevoAlumno->getUltimoAcceso();
            $estudiosCentro = $nuevoAlumno->getEstudiosCentro();
            $estudiosExternos = $nuevoAlumno->getEstudiosExternos();

            $consulta = $this->conexion->prepare("INSERT INTO alumno (dni, clave, nombre, apellidos, email, disponibilidad, ultimoAcceso, estudiosCentro, estudiosExternos) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $consulta->bind_param("sssssisis", $dni, $clave, $nombre, $apellidos, $email, $disponibilidad, $ultimoAcceso, $estudiosCentro, $estudiosExternos);
            $consulta->execute();

            // al ya estar creado el usuario, debo iniciar la sesión y guardar sus datos en una variable de sesión
            if (session_status() == PHP_SESSION_NONE) {
                session_start();
            }
            $_SESSION['alumno'] = [
                'dni' => $dni,
                'clave' => $clave,
                'nombre' => $nombre,
                'apellidos' => $apellidos,
                'email' => $email,
                'disponibilidad' => $disponibilidad,
                'ultimoAcceso' => $ultimoAcceso,
                'estudiosCentro' => $estudiosCentro,
                'estudiosExternos' => $estudiosExternos
            ];
            $_SESSION['tipoUsuario'] = "alumno";
        }

        function loginAlumno($dni, $clave) {
            $consulta = $this->conexion->prepare("SELECT * FROM alumno WHERE dni = ?;");
            $consulta->bind_param("s", $dni);
            $consulta->execute();
            $resultado = $consulta->get_result();
            if ($resultado->num_rows == 0) {
                throw new Exception("El DNI del alumno no está registrado en RedEmpleo");
            }
            $alumno = $resultado->fetch_assoc();
            if (password_verify($clave, $alumno['clave'])) {
                // cuando se loguea, actualizo su ultimo acceso
                $consulta = $this->conexion->prepare("UPDATE alumno SET ultimoAcceso = NOW() WHERE dni = ?;");
                $consulta->bind_param("s", $dni);
                $consulta->execute();
        
                // y guardo sus datos en la sesión
                if (session_status() == PHP_SESSION_NONE) {
                    session_start();
                }
                $_SESSION['alumno'] = [
                    'dni' => $alumno['dni'],
                    'clave' => $alumno['clave'],
                    'nombre' => $alumno['nombre'],
                    'apellidos' => $alumno['apellidos'],
                    'email' => $alumno['email'],
                    'disponibilidad' => $alumno['disponibilidad'],
                    'ultimoAcceso' => $alumno['ultimoAcceso'],
                    'estudiosCentro' => $alumno['estudiosCentro'],
                    'estudiosExternos' => $alumno['estudiosExternos'],
                ];
                $_SESSION['tipoUsuario'] = "alumno";
                return $_SESSION['alumno'];
            } else {
                throw new Exception("La contraseña introducida es incorrecta.");
            }
        }

        function actualizarDisponibilidad($dniAlumno, $dispNueva) {
            $consulta = $this->conexion->prepare("UPDATE alumno SET disponibilidad = ? WHERE dni = ?;");
            $consulta->bind_param("is", $dispNueva, $dniAlumno);
            if (!$consulta->execute()) {
                throw new Exception("Error al actualizar la disponibilidad: " . $this->conexion->error);
            }
        
            if (session_status() == PHP_SESSION_NONE) {
                session_start();
            }
            $_SESSION['alumno']['disponibilidad'] = $dispNueva;
        }

        function cambiarClave($dni, $nuevaClave) {
            $nuevaClaveHash = password_hash($nuevaClave, PASSWORD_DEFAULT);
        
            $consulta = $this->conexion->prepare("UPDATE alumno SET clave = ? WHERE dni = ?;");
            $consulta->bind_param("ss", $nuevaClaveHash, $dni);
            if (!$consulta->execute()) {
                throw new Exception("Error al cambiar la clave: " . $this->conexion->error);
            }
        }

        function obtenerEstudioExternos($dni) {
            $consulta = $this->conexion->prepare("SELECT estudiosExternos FROM alumno WHERE dni = ?;");
            $consulta->bind_param("s", $dni);
            $consulta->execute();
            $resultado = $consulta->get_result();

            if ($resultado->num_rows > 0) {
                $fila = $resultado->fetch_assoc();
                return $fila['estudiosExternos'];
            } else {
                throw new Exception("No se encontró un alumno con el DNI proporcionado");
            }
        }

        function actualizarEstudiosExternos($dni, $estudiosExternos) {
            $consulta = $this->conexion->prepare("UPDATE alumno SET estudiosExternos = ? WHERE dni = ?;");
            $consulta->bind_param("ss", $estudiosExternos, $dni);
            if (!$consulta->execute()) {
                throw new Exception("Error al actualizar los estudios externos: " . $this->conexion->error);
            }
        }

        public function obtenerAlumnosDisponibles($perfilProfesional, $disponibilidad) {
            $consulta = $this->conexion->prepare("SELECT * FROM alumno WHERE estudiosCentro = ? AND disponibilidad = ?;");
            $consulta->bind_param('ii', $perfilProfesional, $disponibilidad);
            $consulta->execute();
            $resultado = $consulta->get_result();
            $alumnos = [];
            while ($fila = $resultado->fetch_assoc()) {
                $alumnos[] = $fila;
            }
            $consulta->close(); // importante cerrar la consulta, ya que se van a usar DAOs diferentes en el mismo controlador
            return $alumnos;
        }

        public function obtenerAlumnoPorDni($dni) {
            $consulta = $this->conexion->prepare("SELECT * FROM alumno WHERE dni = ?;");
            $consulta->bind_param("s", $dni);
            $consulta->execute();
            $resultado = $consulta->get_result();
            $alumno = $resultado->fetch_assoc();
            $consulta->close();
            return $alumno;
        }

        public function obtenerAlumnosPorIdEstudios($idEstudios) {
            $consulta = $this->conexion->prepare("SELECT * FROM alumno WHERE estudiosCentro = ?;");
            $consulta->bind_param("i", $idEstudios);
            $consulta->execute();
            $resultado = $consulta->get_result();
            $alumnos = [];
            while ($fila = $resultado->fetch_assoc()) {
                $alumnos[] = $fila;
            }
            $consulta->close();
            if (empty($alumnos)) {
                throw new Exception('No se encontraron alumnos para los estudios proporcionados.');
            }
            return $alumnos;
        }

        public function obtenerAlumnos() {
            $consulta = $this->conexion->prepare("SELECT * FROM alumno;");
            $consulta->execute();
            $resultado = $consulta->get_result();
            $alumnos = [];
            while ($fila = $resultado->fetch_assoc()) {
                $alumnos[] = $fila;
            }
            $consulta->close();
            return $alumnos;
        }

        // compruebo si ha pasado 1 año desde el ultimo accesso
        public function obtenerAlumnosInactivos() {
            $consulta = $this->conexion->prepare("SELECT * FROM alumno WHERE ultimoAcceso < DATE_SUB(NOW(), INTERVAL 1 YEAR);");
            $consulta->execute();
            $resultado = $consulta->get_result();
            $alumnosInactivos = [];
            while ($alumno = $resultado->fetch_assoc()) {
                $alumnosInactivos[] = $alumno;
            }
            return $alumnosInactivos;
        }
    }
?>