<?php

    class asignatura{
        private $con;

        public function __construct(){
            require_once('class.bd.php');

            $this->con = new bd();
        }

        public function listarModulos(){
            $sentencia = "select modulo from asignaturas";

            $consulta = $this->con->prepare($sentencia);
            $consulta->bind_result($modulo);
            $consulta->execute();

            $modulos = array();

            while($consulta->fetch()){
                array_push($modulos, [$modulo]);
            }

            $consulta->close();

            return $modulos;
        }

        public function listarNotas($id, $modulo, $curso){
            $sentencia = "select alumnos.nombre, asignaturas.nombre, nota from alumnos, alu_asig, asignaturas where alumno = alumnos.id and asignatura = asignaturas.id and alumnos.id = ? and modulo = ? and curso = ?";

            $consulta = $this->con->prepare($sentencia);
            $consulta->bind_params("isi",$id, $modulo, $curso);
            $consulta->bind_result($nombre, $asig, $nota);
            $consulta->execute();

            $notas = array();

            while($consulta->fetch()){
                array_push($notas, [$nombre, $asig, $nota]);
            }

            $consulta->close();

            return $notas;
        }

        public function actualizarNotas($nota){
            $sentencia = "update table alu_asig set nota = ".$nota." where alumno = alumnos.id and asignatura = asignaturas.id and alumnos.id = ? and modulo = ? and curso = ?";
        }
    }

?>