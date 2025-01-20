<?php

    function mostrar(){
        require_once('../Modelo/class.asignaturas.php');
        session_start();

        $asig = new asignatura();
        $modulos = $asig->listarModulos();

        require_once('../Vista/inicio.php');
    }

    function seleccionar(){
        require_once('../Modelo/class.alumnos.php');

        $alum = new alumno();
        $alumnos = $alum->listarAlumnos($_SESSION["mod"], $_SESSION["curso"]);

        require_once('../Vista/inicio.php');
    }

    function enviar(){
        require_once('../Modelo/class.asignaturas.php');
        session_start();

        $asig = new asignatura();
        $notas = $asig->listarNotas($_SESSION["alu"], $_SESSION["mod"], $_SESSION["curso"]);

        require_once('../Vista/notas.php');
    }

    function actualizar(){
        require_once('../Modelo/class.asignaturas.php');
        session_start();

        $asig = new asignatura();
        $asig->actualizarNota();

        require_once('../Vista/notas.php');
    }

    function volver(){}

    if(isset($_REQUEST["action"])){
        $action = strtolower($_REQUEST["action"]);
        $action();
    }else{
        mostrar();
    }

?>