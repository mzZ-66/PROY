<?php
    class SolicitudFct {
        private $id;
        private $empresaSolicitante;
        private $nAlumnosPorEstudios;
        private $modalidadFct;
        private $nAlumnosPorEstudiosRestante;
        
        public function __construct($id, $empresaSolicitante, $nAlumnosPorEstudios, $modalidadFct, $nAlumnosPorEstudiosRestante) {
            $this->setId($id);
            $this->setEmpresaSolicitante($empresaSolicitante);
            $this->setNAlumnosPorEstudios($nAlumnosPorEstudios);
            $this->setModalidadFct($modalidadFct);
            $this->setNAlumnosPorEstudiosRestante($nAlumnosPorEstudiosRestante);
        }

        public function getId() {
            return $this->id;
        }
        public function setId($id) {
            $this->id = $id;
        }

        public function getEmpresaSolicitante() {
            return $this->empresaSolicitante;
        }
        public function setEmpresaSolicitante($empresaSolicitante) {
            $this->empresaSolicitante = $empresaSolicitante;
        }
        
        public function getNAlumnosPorEstudios() {
            return $this->nAlumnosPorEstudios;
        }
        public function setNAlumnosPorEstudios($nAlumnosPorEstudios) {
            $this->nAlumnosPorEstudios = $nAlumnosPorEstudios;
        }

        public function getModalidadFct() {
            return $this->modalidadFct;
        }
        public function setModalidadFct($modalidadFct) {
            $this->modalidadFct = $modalidadFct;
        }

        public function getNAlumnosPorEstudiosRestante() {
            return $this->nAlumnosPorEstudiosRestante;
        }
        public function setNAlumnosPorEstudiosRestante($nAlumnosPorEstudiosRestante) {
            $this->nAlumnosPorEstudiosRestante = $nAlumnosPorEstudiosRestante;
        }

        public function __toString() {
            return "id: " . $this->getId() . "<br>" .
                "empresaSolicitante: " . $this->getEmpresaSolicitante() . "<br>" .
                "nAlumnosPorEstudios: " . $this->getNAlumnosPorEstudios() . "<br>" .
                "modalidadFct: " . $this->getModalidadFct() . "<br>" .
                "nAlumnosPorEstudiosRestante: " . $this->getNAlumnosPorEstudiosRestante();
        }
    }
?>