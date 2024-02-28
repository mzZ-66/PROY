<?php
    class Alumno {
        private $dni;
        private $clave;
        private $nombre;
        private $apellidos;
        private $email;
        private $disponibilidad;
        private $ultimoAcceso;
        private $estudiosExternos;


        public function __construct($dni, $clave, $nombre, $apellidos, $email, $disponibilidad, $ultimoAcceso, $estudiosExternos) {
            $this->setDni($dni);
            $this->setClave($clave);
            $this->setNombre($nombre);
            $this->setApellidos($apellidos);
            $this->setEmail($email);
            $this->setDisponibilidad($disponibilidad);
            $this->setUltimoAcceso($ultimoAcceso);
            $this->setEstudiosExternos($estudiosExternos);
        }
        
        public function getDNi() {
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

        public function getDisponibilidad() {
            return $this->disponibilidad;
        }
        public function setDisponibilidad($disponibilidad) {
            $this->disponibilidad = $disponibilidad;
        }

        public function getUltimoAcceso() {
            return $this->ultimoAcceso;
        }
        public function setUltimoAcceso($ultimoAcceso) {
            $this->ultimoAcceso = $ultimoAcceso;
        }

        public function getEstudiosExternos() {
            return $this->estudiosExternos;
        }
        public function setEstudiosExternos($estudiosExternos) {
            $this->estudiosExternos = $estudiosExternos;
        }
        public function __toString() {
            return "DNI: " . $this->getDni() . "<br>" .
                "Clave: " . $this->getClave() . "<br>" .
                "Nombre: " . $this->getNombre() . "<br>" .
                "Apellidos: " . $this->getApellidos() . "<br>" .
                "Email: " . $this->getEmail() . "<br>" .
                "Disponibilidad: " . $this->getDisponibilidad() . "<br>" .
                "UltimoAcceso: " . $this->getUltimoAcceso() . "<br>" .
                "EstudiosExternos: " . $this->getEstudiosExternos() . "<br>";
        }
    }
?>