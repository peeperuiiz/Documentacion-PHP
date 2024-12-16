<?php
    class Conexion {
        public $conexion;

        public function __construct() {
            $this->conexion = new mysqli("localhost", "root", "", "practica");
            if ($this->conexion->connect_error) {
                die("Error de conexión: " . $this->conexion->connect_error);
            }
        }

        public function __destruct() {
            $this->conexion->close();
        }
    }

    class Preguntas {
        public $conexion;

        public function __construct() {
            $this->conexion = new Conexion();
        }

        public function obtenerPreguntaPorId($id) {
            $consulta = "select pregunta, respuesta from preguntas where id = ?";
            $sentencia = $this->conexion->conexion->prepare($consulta);
            $sentencia->bind_param("i", $id);
            $sentencia->execute();
            $sentencia->bind_result($pregunta, $respuesta);
            $resultado = null;
            while ($sentencia->fetch()) {
                $resultado = [$pregunta, $respuesta];
            }
            $sentencia->close();
            return $resultado;
        }

        public function obtenerPreguntaRandom() {
            $consulta = "select id, pregunta from preguntas order by rand() limit 1";
            $sentencia = $this->conexion->conexion->prepare($consulta);
            $sentencia->execute();
            $sentencia->bind_result($id, $pregunta);
            $resultado = null;
            while ($sentencia->fetch()) {
                $resultado = [$id, $pregunta];
            }
            $sentencia->close();
            return $resultado;
        }
    }

    class Ranking {
        public $conexion;

        public function __construct() {
            $this->conexion = new Conexion();
        }

        public function actualizarTiempoFinal($usuario, $tFinal) {
            $consulta = "update usuarios set t_final = ? where nom = ?";
            $sentencia = $this->conexion->conexion->prepare($consulta);
            $sentencia->bind_param("is", $tFinal, $usuario);
            $sentencia->execute();
            $sentencia->close();
        }

        public function insertarRanking($usuario, $tiempo) {
            $consulta = "insert into ranking (usuario, tiempo) values (?, ?)";
            $sentencia = $this->conexion->conexion->prepare($consulta);
            $sentencia->bind_param("si", $usuario, $tiempo);
            $sentencia->execute();
            $sentencia->close();
        }

        public function obtenerRanking() {
            $consulta = "select usuario, tiempo from ranking order by tiempo asc";
            $resultado = $this->conexion->conexion->query($consulta);
            $ranking = [];
            while ($fila = $resultado->fetch_assoc()) {
                $ranking[] = $fila;
            }
            return $ranking;
        }
    }
?>