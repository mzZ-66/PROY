<?php
    class Aviso {
        private $id;
        private $email;
        private $fecha;

        public function __construct($id, $email, $fecha) {
            $this->setId($id);
            $this->setEmail($email);
            $this->setFecha($fecha);
        }
        
        public function getId() {
            return $this->id;
        }
        public function setId($id) {
            $this->id = $id;
        }

        public function getEmail() {
            return $this->email;
        }
        public function setEmail($email) {
            $this->email = $email;
        }

        public function getFecha() {
            return $this->fecha;
        }
        public function setFecha($fecha) {
            $this->fecha = $fecha;
        }
        public function __toString() {
            return "ID: " . $this->getId() . "<br>" .
                "Email: " . $this->getEmail() . "<br>" .
                "Fecha: " . $this->getFecha() . "<br>";
        }
    }
?>