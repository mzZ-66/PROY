<?php
    include_once("conexionDB.php");
    class operacionesEmpresa {
        private $conexion;
        public function __construct() {
            $conexion = new conexionDB();
            $this->conexion = $conexion->getConexion();
        }

        function registrarEmpresa($nuevaEmpresa) {
            $cif = $nuevaEmpresa->getCif();
            $clave = password_hash($nuevaEmpresa->getClave(), PASSWORD_DEFAULT);
            $nombre = $nuevaEmpresa->getNombre();
            $email = $nuevaEmpresa->getEmail();
            $ultimaPeticion = $nuevaEmpresa->getUltimaPeticion();
            $empleadora = $nuevaEmpresa->getEmpleadora();
            $activo = $nuevaEmpresa->getActivo();

            $consulta = $this->conexion->prepare("INSERT INTO empresa (cif, clave, nombre, email, ultimaPeticion, empleadora, activo) VALUES (?, ?, ?, ?, ?, ?, ?)");
            $consulta->bind_param("issssii", $cif, $clave, $nombre, $email, $ultimaPeticion, $empleadora, $activo);
            $consulta->execute();

            // al ya estar creada la empresa, debo iniciar la sesión y guardar sus datos en una variable de sesión
            if (session_status() == PHP_SESSION_NONE) {
                session_start();
            }
            $_SESSION['empresa'] = [
                'cif' => $cif,
                'clave' => $clave,
                'nombre' => $nombre,
                'email' => $email,
                'ultimaPeticion' => $ultimaPeticion,
                'empleadora' => $empleadora,
                'activo' => $activo
            ];
            $_SESSION['tipoUsuario'] = "empresa";
        }

        function loginEmpresa($cif, $clave) {
            $consulta = $this->conexion->prepare("SELECT * FROM empresa WHERE cif = ?;");
            $consulta->bind_param("s", $cif);
            $consulta->execute();
            $resultado = $consulta->get_result();
            if ($resultado->num_rows == 0) {
                throw new Exception("El CIF de la empresa no está registrado en RedEmpleo");
            }
            $empresa = $resultado->fetch_assoc();
            if (password_verify($clave, $empresa['clave'])) {
                // cuando la empresa esta logueada, guardo sus datos en la sesión
                if (session_status() == PHP_SESSION_NONE) {
                    session_start();
                }
                $_SESSION['empresa'] = [
                    'cif' => $empresa['cif'],
                    'clave' => $empresa['clave'],
                    'nombre' => $empresa['nombre'],
                    'email' => $empresa['email'],
                    'ultimaPeticion' => $empresa['ultimaPeticion'],
                    'empleadora' => $empresa['empleadora'],
                    'activo' => $empresa['activo']
                ];
                $_SESSION['tipoUsuario'] = "empresa";
                return $_SESSION['empresa'];
            } else {
                throw new Exception("La contraseña introducida es incorrecta.");
            }
        }

        function cambiarClave($cif, $nuevaClave) {
            $nuevaClaveHash = password_hash($nuevaClave, PASSWORD_DEFAULT);
        
            $consulta = $this->conexion->prepare("UPDATE empresa SET clave = ? WHERE cif = ?;");
            $consulta->bind_param("si", $nuevaClaveHash, $cif);
            if (!$consulta->execute()) {
                throw new Exception("Error al cambiar la clave: " . $this->conexion->error);
            }
        }

        public function actualizarUltimaPeticion($cif) {
            $consulta = $this->conexion->prepare("UPDATE empresa SET ultimaPeticion = NOW() WHERE cif = ?;");
            $consulta->bind_param('s', $cif);
            $consulta->execute();
            $consulta->close();
        }

        function actualizarEmpleadora($cif, $empleadora) {
            $consulta = $this->conexion->prepare("UPDATE empresa SET empleadora = ? WHERE cif = ?;");
            $consulta->bind_param('ii', $empleadora, $cif);
            $consulta->execute();
            $consulta->close();
        }

        function obtenerEmpresas() {
            $consulta = $this->conexion->prepare("SELECT * FROM empresa;");
            $consulta->execute();
            $resultado = $consulta->get_result();
            $empresas = [];
            while ($empresa = $resultado->fetch_assoc()) {
                $empresas[] = $empresa;
            }
            return $empresas;
        }

        function obtenerEmpresaPorCif($cif) {
            $consulta = $this->conexion->prepare("SELECT * FROM empresa WHERE cif = ?;");
            $consulta->bind_param("s", $cif);
            $consulta->execute();
            $resultado = $consulta->get_result();
            if ($resultado->num_rows == 0) {
                throw new Exception("No se ha encontrado ninguna empresa con el CIF proporcionado.");
            }
            return $resultado->fetch_assoc();
        }

        public function obtenerEmpresasPorIdEstudios($idEstudios) {
            $consulta = $this->conexion->prepare("
                SELECT empresa.*, NULL as nAlumnosPorEstudios
                FROM empresa 
                JOIN solicitudempleo ON empresa.cif = solicitudempleo.empresaSolicitante 
                WHERE solicitudempleo.perfilProfesional = ? 
                UNION 
                SELECT empresa.*, solicitudfct.nAlumnosPorEstudios 
                FROM empresa 
                JOIN solicitudfct ON empresa.cif = solicitudfct.empresaSolicitante
            ");
            $consulta->bind_param("i", $idEstudios);
            $consulta->execute();
            $resultado = $consulta->get_result();
            $empresas = [];
            while ($fila = $resultado->fetch_assoc()) {
                if (isset($fila['nAlumnosPorEstudios'])) {
                    $nAlumnosPorEstudios = unserialize($fila['nAlumnosPorEstudios']);
                    if (isset($nAlumnosPorEstudios[$idEstudios]) && $nAlumnosPorEstudios[$idEstudios] > 0) {
                        unset($fila['nAlumnosPorEstudios']);
                        $empresas[$fila['cif']] = $fila;
                    }
                } else {
                    $empresas[$fila['cif']] = $fila;
                }
            }
            $consulta->close();
        
            if (empty($empresas)) {
                throw new Exception('No se encontraron empresas para los estudios proporcionados.');
            }
        
            return array_values($empresas);
        }

        public function obtenerEmpresasInactivas() {
            $consulta = $this->conexion->prepare("SELECT * FROM empresa WHERE ultimaPeticion < DATE_SUB(NOW(), INTERVAL 6 MONTH);");
            $consulta->execute();
            $resultado = $consulta->get_result();
            $empresasInactivas = [];
            while ($empresa = $resultado->fetch_assoc()) {
                $empresasInactivas[] = $empresa;
            }
            return $empresasInactivas;
        }

        public function estaDeBaja($cif) {
            $consulta = $this->conexion->prepare("SELECT * FROM empresa WHERE cif = ?;");
            $consulta->bind_param("i", $cif);
            $consulta->execute();
            $resultado = $consulta->get_result();
            $empresa = $resultado->fetch_assoc();
            if ($empresa['activo'] == 0) {
                throw new Exception("La empresa especificada está de baja");
            }
        }

        public function borrarAvisoSiLoEsta($cif) {
            $consulta = $this->conexion->prepare("DELETE FROM aviso WHERE email = (SELECT email FROM empresa WHERE cif = ?);");
            $consulta->bind_param("s", $cif);
            $consulta->execute();
        }

        public function darDebajaEmpresaPorEmail($email) {
            $consulta = $this->conexion->prepare("UPDATE empresa SET activo = 0 WHERE email = ?;");
            $consulta->bind_param("s", $email);
            $consulta->execute();
        }

        public function isActivo($cif) {
            $consulta = $this->conexion->prepare("SELECT activo FROM empresa WHERE cif = ?;");
            $consulta->bind_param("i", $cif);
            $consulta->execute();
            $resultado = $consulta->get_result();
            $empresa = $resultado->fetch_assoc();
            if ($empresa['activo'] == 0) {
                return false;
            } else return true;
        }
    }
?>