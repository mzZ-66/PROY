<?php
    class Fct {
        private $id;
        private $alumno;
        private $empresa;
        private $modalidadFct;

        public function __construct($id, $alumno, $empresa, $modalidadFct) {
            $this->setId($id);
            $this->setAlumno($alumno);
            $this->setEmpresa($empresa);
            $this->setModalidadFct($modalidadFct);
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

        public function getEmpresa() {
            return $this->empresa;
        }
        public function setEmpresa($empresa) {
            $this->empresa = $empresa;
        }

        public function getModalidadFct() {
            return $this->modalidadFct;
        }
        public function setModalidadFct($modalidadFct) {
            $this->modalidadFct = $modalidadFct;
        }

        public function toString() {
            return "ID: " . $this->getId() . ", Alumno: " . $this->getAlumno() . ", Empresa: " . $this->getEmpresa() . ", Modalidad FCT: " . $this->getModalidadFct();
        }
    }
?>