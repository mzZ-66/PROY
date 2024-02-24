<?php
    class conexionDB {
        private $conexion;
        public function __construct() {
            $this->conexion = new mysqli('localhost', 'root', '', 'bolsaempleopbv');
            $error = $this->conexion->connect_errno;
            $errorMessage = $this->conexion->connect_error;
            if ($error != null) {
                echo "<p>Error $error conectando a la base de datos: <br> $errorMessage </p><br>";
            } else {
                // echo "<p>Conexión realizada con éxito</p><br>";
            }
        }
        public function getConexion() {
            return $this->conexion;
        }
        public function setConexion($conexion) {
            $this->conexion = $conexion;
        }
    }
?>