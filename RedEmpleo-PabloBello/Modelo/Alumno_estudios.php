<?php
    class Alumno_estudios {
        private $id;
        private $alumno;
        private $estudios;

        public function __construct($id, $alumno, $estudios) {
            $this->setId($id);
            $this->setAlumno($alumno);
            $this->setEstudios($estudios);
        }
        
        public function getId() {
            return $this->id;
        }
        public function setId($id) {
            $this->id = $id;
        }

        public function getAlumno() {
            return $this->alumno;
        }
        public function setAlumno($alumno) {
            $this->alumno = $alumno;
        }

        public function getEstudios() {
            return $this->estudios;
        }
        public function setEstudios($estudios) {
            $this->estudios = $estudios;
        }
        public function __toString() {
            return "ID: " . $this->getId() . "<br>" .
                "Alumno: " . $this->getAlumno() . "<br>" .
                "Estudios: " . $this->getEstudios() . "<br>";
        }
    }
?>