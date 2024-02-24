<?php
    include_once("conexionDB.php");
    class operacionesSolicitudFct {
        private $conexion;
        public function __construct() {
            $conexion = new conexionDB();
            $this->conexion = $conexion->getConexion();
        }

        public function registrarSolicitudFct($solicitudFct) {
            $empresaSolicitante = $solicitudFct->getEmpresaSolicitante();
            $nAlumnosPorEstudios = $solicitudFct->getNAlumnosPorEstudios();
            $modalidadFct = $solicitudFct->getModalidadFct();
            $nAlumnosPorEstudiosRestante = $solicitudFct->getNAlumnosPorEstudiosRestante();


            $consulta = $this->conexion->prepare("INSERT INTO solicitudfct (empresaSolicitante, nAlumnosPorEstudios, modalidadFct, nAlumnosPorEstudiosRestante) VALUES (?, ?, ?, ?)");
            $consulta->bind_param("isss", $empresaSolicitante, $nAlumnosPorEstudios, $modalidadFct, $nAlumnosPorEstudiosRestante);
            $consulta->execute();

            // asigno el id obtenido de la BD al objeto para que sea correcto
            $idAsignado = $this->conexion->insert_id;
            $solicitudFct->setId($idAsignado);  

            $consulta->close(); // importante cerrar la consulta, ya que se van a usar DAOs diferentes en el mismo controlador
        }

        public function obtenerSolicitudesFctPorId($idEstudiosTutoria) {
            $consulta = $this->conexion->prepare("SELECT * FROM solicitudfct");
            $consulta->execute();
            $resultado = $consulta->get_result();
            $solicitudes = [];
            while ($fila = $resultado->fetch_assoc()) {
                $nAlumnosPorEstudios = unserialize($fila['nAlumnosPorEstudios']);
                $nAlumnosPorEstudiosRestante = unserialize($fila['nAlumnosPorEstudiosRestante']);
                // se comprueba que haya plazas disponibles en dicha petición para mostrarla en el select ni en la tabla
                if (isset($nAlumnosPorEstudiosRestante[$idEstudiosTutoria]) && $nAlumnosPorEstudiosRestante[$idEstudiosTutoria] != 0) {
                    $fila['nAlumnosPorEstudios'] = $nAlumnosPorEstudios[$idEstudiosTutoria];
                    $fila['nAlumnosPorEstudiosRestante'] = $nAlumnosPorEstudiosRestante[$idEstudiosTutoria];
                    $solicitudes[] = $fila;
                }
            }
            return $solicitudes;
        }

        public function restarAlumnoSolicitudFct($cif, $modalidadFct, $idEstudio) {
            $consulta = $this->conexion->prepare("SELECT nAlumnosPorEstudiosRestante FROM solicitudfct WHERE empresaSolicitante = ? AND modalidadFct = ?");
            $consulta->bind_param("is", $cif, $modalidadFct);
            $consulta->execute();
            $resultado = $consulta->get_result();
            if ($resultado->num_rows == 0) {
                throw new Exception("No hay FCT disponibles para esa modalidad");
            }
            $solicitud = $resultado->fetch_assoc();
            $nAlumnosPorEstudiosRestante = unserialize($solicitud['nAlumnosPorEstudiosRestante']);
            if (isset($nAlumnosPorEstudiosRestante[$idEstudio])) {
                $nAlumnosPorEstudiosRestante[$idEstudio] -= 1;
            }
            $consulta->close();
        
            $nAlumnosPorEstudiosRestanteSerialized = serialize($nAlumnosPorEstudiosRestante);
        
            $consulta = $this->conexion->prepare("UPDATE solicitudfct SET nAlumnosPorEstudiosRestante = ? WHERE empresaSolicitante = ? AND modalidadFct = ?");
            $consulta->bind_param("sss", $nAlumnosPorEstudiosRestanteSerialized, $cif, $modalidadFct);
            $consulta->execute();
            $consulta->close();
        }
    }
?>