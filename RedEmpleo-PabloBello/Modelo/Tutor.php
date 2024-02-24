<?php
    class Tutor {
        private $dni;
        private $clave;
        private $nombre;
        private $apellidos;
        private $email;
        private $estudiosTutoria;

        public function __construct($dni, $clave, $nombre, $apellidos, $email, $estudiosTutoria) {
            $this->setDni($dni);
            $this->setClave($clave);
            $this->setNombre($nombre);
            $this->setApellidos($apellidos);
            $this->setEmail($email);
            $this->setEstudiosTutoria($estudiosTutoria);
        }
        
        public function getDni() {
            return $this->dni;
        }
        public function setDni($dni) {
            $this->dni = $dni;
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
        
        public function getApellidos() {
            return $this->apellidos;
        }
        public function setApellidos($apellidos) {
            $this->apellidos = $apellidos;
        }
        
        public function getEmail() {
            return $this->email;
        }
        public function setEmail($email) {
            $this->email = $email;
        }
        
        public function getEstudiosTutoria() {
            return $this->estudiosTutoria;
        }
        public function setEstudiosTutoria($estudiosTutoria) {
            $this->estudiosTutoria = $estudiosTutoria;
        }
        
        public function __toString() {
            return "dni: " . $this->getDni() . "<br>" .
                "clave: " . $this->getClave() . "<br>" .
                "nombre: " . $this->getNombre() . "<br>" .
                "apellidos: " . $this->getApellidos() . "<br>" .
                "email: " . $this->getEmail() . "<br>" .
                "estudiosTutoria: " . $this->getEstudiosTutoria();
        }
    }
?>