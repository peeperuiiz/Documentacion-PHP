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
        
        for ($i = 0; $i < count($ids); $i++) { 
            
            $consulta = "select pregunta from preguntas where id = ?;";
            $sentencia = $conexion->prepare($consulta);
            
            $sentencia->bind_param("i",$ids[$i]);
            
            $sentencia->bind_result($pregunta);
            $sentencia->execute();
            
            while($sentencia->fetch()){
                $preguntas[] = $pregunta;
            }
            
            $sentencia->close();
            
        }
        
        $cont = 0;
        $Spre = implode("-", $preguntas);
        $Sids = implode("-", $ids);

        if(isset($_POST["btt2"])){
            $preguntas = explode("-", $_POST["preguntas"]);
            $ids = explode("-", $_POST["ids"]);


            $consulta = "select respuesta from preguntas where id = ?";
            $sentencia = $conexion->prepare($consulta);

            $sentencia->bind_param("i", $ids[$cont]);

            $sentencia->bind_result($resp);
            $sentencia->execute();
            
            $respuesta;

            while($sentencia->fetch()){
                $respuesta = $resp;
            }

            $sentencia->close();

            echo $respuesta;

            if(str_contains($respuesta, "/")){

                $respuestas = array();
                $respuestas = explode("/", $respuesta);

                for ($i = 0; $i < count($respuestas); $i++) { 
                    if(strcmp(strtolower($_POST["respuesta"]), $respuestas[$i]) == 0){
                        $cont++;
                        echo "Correcto!";
                    }
                }
                
            }else{

                if(strcmp(strtolower($_POST["respuesta"]), $respuesta) == 0){
                    $cont++;
                    echo "Correcto!";
                }
                
            }

        }else{

    ?>

        <form action="#" method="post">
            <label for="respuesta"><?php echo $preguntas[$cont] ?></label>
            <input type="text" name="respuesta">
            <input type="hidden" name="preguntas" value="<?php echo $Spre ?>">
            <input type="hidden" name="ids" value="<?php echo $Sids ?>">
            <input type="hidden" name="cont" value="<?php echo $cont ?>">
            <input type="submit" value="Responder" name="btt2">
        </form>

    <?php
        }
    ?>

</body>
</html>