<?php
    class Contrato {
        private $id;
        private $empleado;
        private $empresa;
        private $tipoContrato;
        private $fechaContrato;

        public function __construct($id, $empleado, $empresa, $tipoContrato, $fechaContrato) {
            $this->setId($id);
            $this->setEmpleado($empleado);
            $this->setEmpresa($empresa);
            $this->setTipoContrato($tipoContrato);
            $this->setFechaContrato($fechaContrato);
        }

        public function getId() {
            return $this->id;
        }
        public function setId($id) {
            $this->id = $id;
        }

        public function getEmpleado() {
            return $this->empleado;
        }
        public function setEmpleado($empleado) {
            $this->empleado = $empleado;
        }

        public function getEmpresa() {
            return $this->empresa;
        }
        public function setEmpresa($empresa) {
            $this->empresa = $empresa;
        }

        public function getTipoContrato() {
            return $this->tipoContrato;
        }
        public function setTipoContrato($tipoContrato) {
            $this->tipoContrato = $tipoContrato;
        }

        public function getFechaContrato() {
            return $this->fechaContrato;
        }
        public function setFechaContrato($fechaContrato) {
            $this->fechaContrato = $fechaContrato;
        }

        public function __toString() {
            return "id: " . $this->getId() . "<br>" .
                "empleado: " . $this->getEmpleado() . "<br>" .
                "empresa: " . $this->getEmpresa() . "<br>" .
                "tipoContrato: " . $this->getTipoContrato() . "<br>" .
                "fechaContrato: " . $this->getFechaContrato();
        }
    }
?>