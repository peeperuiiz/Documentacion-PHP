<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kahoot Vegano</title>
</head>
<body>
    <?php

    function arrayRandom(){
        $ids = [];
        while (count($ids) < 5) {
            $id = rand(1, 100);
            
            if (!in_array($id, $ids)) {
                $ids[] = $id;
            }
        }

        return $ids;
    }

    $conexion = new mysqli("localhost", "root", "", "practica");

    $ids = arrayRandom();
    $preguntas = [];

    foreach ($ids as $key => $value) {
        $consulta = "select pregunta from preguntas where id = ?";
        $sentencia = $conexion->prepare($consulta);

        $val = $value;
        $sentencia->bind_param($val);

        $sentencia->bind_result($pregunta);
        $sentencia->execute();

        $preguntas[] = $pregunta;
    }

    print_r($preguntas);
    
    ?>
</body>
</html>