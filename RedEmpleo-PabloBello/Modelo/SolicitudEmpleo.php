<?php
    class SolicitudEmpleo {
        private $id;
        private $empresaSolicitante;
        private $perfilProfesional;
        private $experiencia;
        private $posibilidadViajar;
        private $residenciaFavorita;
        private $descripcion;
        private $activa;

        public function __construct($id, $empresaSolicitante, $perfilProfesional, $experiencia, $posibilidadViajar, $residenciaFavorita, $descripcion, $activa) {
            $this->setId($id);
            $this->setEmpresaSolicitante($empresaSolicitante);
            $this->setPerfilProfesional($perfilProfesional);
            $this->setExperiencia($experiencia);
            $this->setPosibilidadViajar($posibilidadViajar);
            $this->setResidenciaFavorita($residenciaFavorita);
            $this->setDescripcion($descripcion);
            $this->setActiva($activa);
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

        public function getPerfilProfesional() {
            return $this->perfilProfesional;
        }
        public function setPerfilProfesional($perfilProfesional) {
            $this->perfilProfesional = $perfilProfesional;
        }

        public function getExperiencia() {
            return $this->experiencia;
        }
        public function setExperiencia($experiencia) {
            $this->experiencia = $experiencia;
        }

        public function getPosibilidadViajar() {
            return $this->posibilidadViajar;
        }
        public function setPosibilidadViajar($posibilidadViajar) {
            $this->posibilidadViajar = $posibilidadViajar;
        }

        public function getResidenciaFavorita() {
            return $this->residenciaFavorita;
        }
        public function setResidenciaFavorita($residenciaFavorita) {
            $this->residenciaFavorita = $residenciaFavorita;
        }

        public function getDescripcion() {
            return $this->descripcion;
        }
        public function setDescripcion($descripcion) {
            $this->descripcion = $descripcion;
        }

        public function getActiva() {
            return $this->activa;
        }
        public function setActiva($activa) {
            $this->activa = $activa;
        }

        public function __toString() {
            return "id: " . $this->getId() . "<br>" .
                "empresaSolicitante: " . $this->getEmpresaSolicitante() . "<br>" .
                "perfilProfesional: " . $this->getPerfilProfesional() . "<br>" .
                "experiencia: " . $this->getExperiencia() . "<br>" .
                "posibilidadViajar: " . $this->getPosibilidadViajar() . "<br>" .
                "residenciaFavorita: " . $this->getResidenciaFavorita() . "<br>" .
                "descripcion: " . $this->getDescripcion() . "<br>" .
                "activa: " . $this->getActiva();
        }
    }
?>