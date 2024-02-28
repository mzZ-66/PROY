<?php
    include_once("conexionDB.php");
    class operacionesAlumno_estudios {
        private $conexion;
        public function __construct() {
            $conexion = new conexionDB();
            $this->conexion = $conexion->getConexion();
        }

        public function registrarAlumno_estudios($alumno_estudios) {
            $dni = $alumno_estudios->getAlumno();
            $idEstudio = $alumno_estudios->getEstudios();

            $consulta = $this->conexion->prepare("INSERT INTO alumno_estudios (alumno, estudios) VALUES (?, ?)");
            $consulta->bind_param("si", $dni, $idEstudio);
            $consulta->execute();
        }
    }
?>