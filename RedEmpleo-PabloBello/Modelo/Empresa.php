<?php
    class Empresa {
        private $cif;
        private $clave;
        private $nombre;
        private $email;
        private $ultimaPeticion;
        private $empleadora;

        public function __construct($cif, $clave, $nombre, $email, $ultimaPeticion, $empleadora) {
            $this->setCif($cif);
            $this->setClave($clave);
            $this->setNombre($nombre);
            $this->setEmail($email);
            $this->setUltimaPeticion($ultimaPeticion);
            $this->setEmpleadora($empleadora);
        }

        public function getCif() {
            return $this->cif;
        }
        public function setCif($cif) {
            $this->cif = $cif;
        }

        public function getClave() {
            return $this->clave;
        }
        public function setClave($clave) {
            $this->clave = $clave;
        }

        public function getNombre() {
            return $this->nombre;
        }
        public function setNombre($nombre) {
            $this->nombre = $nombre;
        }

        public function getEmail() {
            return $this->email;
        }
        public function setEmail($email) {
            $this->email = $email;
        }

        public function getUltimaPeticion() {
            return $this->ultimaPeticion;
        }
        public function setUltimaPeticion($ultimaPeticion) {
            $this->ultimaPeticion = $ultimaPeticion;
        }

        public function getEmpleadora() {
            return $this->empleadora;
        }
        function setEmpleadora($empleadora) {
            $this->empleadora = $empleadora;
        }

        public function __toString() {
            return "cif: " . $this->getCif() . "<br>" .
                    "clave: " . $this->getClave() . "<br>" .
                    "nombre: " . $this->getNombre() . "<br>" .
                    "email: " . $this->getEmail() . "<br>" .
                    "ultimaPeticion: " . $this->getUltimaPeticion() . "<br>" .
                    "empleadora: " . $this->getEmpleadora() . "<br>";
        }
    }
?>