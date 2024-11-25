<?php

    class articulo{
        private $nombre;
        private $precio;

        public function __construct($n, $p){
            $this->nombre = $n;
            $this->precio = $p;
        }

        public function __toString(){
            $str = "Nombre: ".$this->nombre."<br> Precio:".$this->precio."&euro; <br>";
            return $str;
        }

        public function getPrecio(){
            return $this->precio; 
        }

        public function setPrecio($p){
            if(is_float($p)){
                $this->precio = $p; 
            }
        }
    }

?>