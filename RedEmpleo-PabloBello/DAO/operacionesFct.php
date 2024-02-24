<?php
    include_once("conexionDB.php");
    class operacionesFct {
        private $conexion;
        public function __construct() {
            $conexion = new conexionDB();
            $this->conexion = $conexion->getConexion();
        }

        function registrarFct($fct) {
            $alumno = $fct->getAlumno();
            $empresa = $fct->getEmpresa();
            $modalidadFct = $fct->getModalidadFct();

            $consulta = $this->conexion->prepare("INSERT INTO fct (alumno, empresa, modalidadFct) VALUES (?, ?, ?)");
            $consulta->bind_param("sis", $alumno, $empresa, $modalidadFct);
            $consulta->execute();

            // asigno el id obtenido de la BD al objeto para que sea correcto
            $idAsignado = $this->conexion->insert_id;
            $fct->setId($idAsignado);

            $consulta->close(); // importante cerrar la consulta, ya que se van a usar DAOs diferentes en el mismo controlador
        }

        function comprobarFctPorAlumno($alumnos) {
            $alumnosNoEncontrados = array();
        
            foreach ($alumnos as $alumno) {
                $dni = $alumno['dni'];
                $consulta = $this->conexion->prepare("SELECT * FROM fct WHERE alumno = ?");
                $consulta->bind_param("s", $dni);
                $consulta->execute();
                $resultado = $consulta->get_result();
        
                if ($resultado->num_rows == 0) {
                    $alumnosNoEncontrados[] = array('dni' => $dni);
                }
        
                $consulta->close();
            }
        
            return $alumnosNoEncontrados;
        }
    }
?>
