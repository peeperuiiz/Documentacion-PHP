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
    
    if(isset($_POST["btt"])){
        
        $conexion = new mysqli("localhost", "root", "", "practica");

        $consulta = "insert into usuarios (nom, t_inicio) values (?,?);";
        $sentencia = $conexion->prepare($consulta);

        $t_inicio = time();
        $nom = $_POST["nom"];

        try{
            $sentencia->bind_param("si", $_POST["nom"], $t_inicio);
            $sentencia->execute();
            $sentencia->close();
            header("Location: preguntas.php");
        }catch(Exception $e){
            echo "El nombre ya está en uso";
            header("Refresh: 2; login.php");
        }
    }else{
    
    ?>

    <form action="#" method="post">
        <label for="nom">Introduce tu nombre de usuario</label>
        <br>
        <input type="text" name="nom" require>
        <br>
        <input type="submit" value="Enviar" name= "btt">
        <input type="hidden" name="n" value="<?php echo $nom; ?>">
    </form>

    <?php
    }
    ?>
</body>
</html>