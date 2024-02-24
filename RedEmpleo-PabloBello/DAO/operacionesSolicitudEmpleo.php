<?php
    include_once("conexionDB.php");
    class operacionesSolicitudEmpleo {
        private $conexion;
        public function __construct() {
            $conexion = new conexionDB();
            $this->conexion = $conexion->getConexion();
        }
        
        function registrarSolicitudEmpleo($solicitud) {
            $empresaSolicitante = $solicitud->getEmpresaSolicitante();
            $perfilProfesional = $solicitud->getPerfilProfesional();
            $experiencia = $solicitud->getExperiencia();
            $posibilidadViajar = $solicitud->getPosibilidadViajar();
            $residenciaFavorita = $solicitud->getResidenciaFavorita();
            $descripcion = $solicitud->getDescripcion();
            $activa = $solicitud->getActiva();

            $consulta = $this->conexion->prepare("INSERT INTO solicitudempleo (empresaSolicitante, perfilProfesional, experiencia, posibilidadViajar, residenciaFavorita, descripcion, activa) VALUES (?, ?, ?, ?, ?, ?, ?)");
            $consulta->bind_param("iisissi", $empresaSolicitante, $perfilProfesional, $experiencia, $posibilidadViajar, $residenciaFavorita, $descripcion, $activa);
            $consulta->execute();

            // asigno el id obtenido de la BD al objeto para que sea correcto
            $idAsignado = $this->conexion->insert_id;
            $solicitud->setId($idAsignado);

            $consulta->close(); // importante cerrar la consulta, ya que se van a usar DAOs diferentes en el mismo controlador
        }

        public function obtenerSolicitudesEmpleo() {
            $consulta = $this->conexion->prepare("SELECT id, descripcion FROM solicitudempleo WHERE activa = 1");
            $consulta->execute();
            $resultado = $consulta->get_result();
            $solicitudes = [];
            while ($fila = $resultado->fetch_assoc()) {
                $solicitudes[] = $fila;
            }
            return $solicitudes;
        }

        function actualizarActiva($id, $activa) {
            $consulta = $this->conexion->prepare("UPDATE solicitudempleo SET activa = ? WHERE id = ?");
            $consulta->bind_param("ii", $activa, $id);
            $consulta->execute();
            $consulta->close();
        }
    }
?>