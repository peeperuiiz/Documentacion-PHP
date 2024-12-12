<?php

    // CLASE USUARIOS
    class usuarios{
        // VARIABLES
        private $nombre;
        private $t_inicio;
        private $t_final;

        // CONSTRUCTOR
        public function __construct($n, $tI, $tF = null){
            $this->nombre = $n;
            $this->t_inicio = $tI;
            $this->t_final = $tF;
        }

        // GETTER & SETTER
        public function __get($n){
            return $this->$n;
        }

        public function __get($tI){
            return $this->$tI;
        }

        public function __get($tF){
            return $this->$tF;
        }

        public function __set($tF){
            $this->t_final = $tF;
        }
    }



    // CLASE PREGUNTAS
    class preguntas{
        // VARIABLES
        private $id;
        private $pregunta;
        private $respuesta;

        // CONSTRUCTOR
        public function __construct($i, $p, $r){
            $this->id = $i;
            $this->pregunta = $p;
            $this->respuesta = $r;
        }
    }



    // CLASE RANKING
    class ranking{
        // VARIABLES
        private $id;
        private $usuario;
        private $tiempo;

        // CONSTRUCTOR
        public function __construct($i, $u, $t){
            $this->id = $i;
            $this->usuario = $u;
            $this->tiempo = $t;
        }
    }

?>