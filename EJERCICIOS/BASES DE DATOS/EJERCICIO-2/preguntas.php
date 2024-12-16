<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kahoot Vegano</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php
    include_once 'clases.php';

    $cont = isset($_POST["cont"]) ? $_POST["cont"] : 0;
    $idPreguntaRespondida = isset($_POST["idPregunta"])
        ? explode(",", $_POST["idPregunta"])
        : [];
    $usuario = isset($_POST["n"]) ? $_POST["n"] : "anonimo";
    $preguntas = new Preguntas();
    $ranking = new Ranking();
    
    if ($cont < 5) {
        if (isset($_POST["respuesta"])) {
            $idActual = end($idPreguntaRespondida);
            $preguntaActual = $preguntas->obtenerPreguntaPorId($idActual);
    
            if (strtolower($_POST["respuesta"]) == strtolower($preguntaActual[1])) {
                $cont++;
                echo "<h2>Correcto!</h2>";
            } else {
                echo "<h2>Incorrecto. La respuesta era: " . $preguntaActual[1] . "</h2>";
            }
        }
    
        do {
            $preguntaRandom = $preguntas->obtenerPreguntaRandom();
        } while (in_array($preguntaRandom[0], $idPreguntaRespondida));
    
        $idPreguntaRespondida[] = $preguntaRandom[0];
        $idPreguntaRespondidaString = implode(",", $idPreguntaRespondida);

    ?>

        <form action="#" method="post">
            <label for="respuesta"><?php echo $preguntaRandom[1]; ?></label>
            <input type="text" name="respuesta" required>
            <input type="hidden" name="idPregunta" value="<?php echo $idPreguntaRespondidaString; ?>">
            <input type="hidden" name="cont" value="<?php echo $cont; ?>">
            <input type="hidden" name="n" value="<?php echo $_POST["n"]; ?>">
            <input type="submit" value="Responder">
        </form>

    <?php

        } else {
            $tFinal = round(microtime(true) * 1000); // Tiempo en milisegundos
        
            // Actualizar tiempo final del usuario en la tabla usuarios
            $ranking->actualizarTiempoFinal($usuario, $tFinal);
        
            // Calcular tiempo total (t_final - t_inicio)
            $consulta = "select t_inicio, t_final from usuarios where nom = ?";
            $sentencia = $ranking->conexion->conexion->prepare($consulta);
            $sentencia->bind_param("s", $usuario);
            $sentencia->execute();
            $sentencia->bind_result($tInicio, $tFinal);
            $sentencia->fetch();
            $sentencia->close();
        
            $tiempoTotal = $tFinal - $tInicio; // Tiempo total en milisegundos
        
            // Insertar en el ranking
            $ranking->insertarRanking($_POST["n"], $tiempoTotal);
        
            echo "<h1>Has completado todas las preguntas!</h1>";
            echo "<h2>Tiempo total: " . ($tiempoTotal / 1000) . " segundos</h2>";

            header("Location: ranking.php");
        }
    ?>

</body>
</html>