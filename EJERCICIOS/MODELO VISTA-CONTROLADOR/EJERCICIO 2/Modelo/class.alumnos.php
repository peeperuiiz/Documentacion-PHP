<?php

    class alumno{
        private $con;

        public function __construct(){
            require_once('./class.bd.php');

            $this->con = new bd();
        }

        public function listarAlumnos($modulo, $curso){
            $sentencia = "select id, nombre from alumnos, alu_asig, asignaturas where alumno = alumnos.id and asignatura = asignaturas.id and modulo = ? and curso = ?";

            $consulta = $this->con->prepare($sentencia);
            $consulta->bind_params("si", $modulo, $curso);
            $consulta->bind_result($id, $nombre);
            $consulta->execute();

            $alumnos = array();

            while($consulta->fetch()){
                array_push($alumnos, [$id, $nombre]);
            }

            $consulta->close();

            return $alumnos;
        }
    }

?>