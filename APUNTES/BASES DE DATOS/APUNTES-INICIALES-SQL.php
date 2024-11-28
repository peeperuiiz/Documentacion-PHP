<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de sesión</title>
</head>
<body>
    <?php
    if(isset($_POST["btt"])){
        if($_POST["con"] == $_POST["con1"] && strlen($_POST["con"]) >= 8 && strlen($_POST["con"]) <= 20){           //COMPROBAMOS LA CONTRASEÑA
            $bd = new mysqli('localhost', 'root', '', 'ejercicio1');                                                //CONEXIÓN A BASE DE DATOS
            $existe = $bd->query('select nombre from usuarios where nombre = "'.$_POST["nom"].'";');                //GUARDAMOS EN UNA VARIABLE EL RESULTADO DE LA CONSULTA

            if($existe->num_rows == 1){                                                                             //SI EXISTE EL USUARIO LO HACEMOS INICIAR SESIÓN 
                echo "El nombre de usuario ya existe";

                ?>
                    <form action="#" method="post">
                        <label for="">Inicia sesión</label>
                        <input type="text" name="nom2" placeholder="Nombre de usuario">
                        <input type="text" name="con2" placeholder="Contraseña">
                        <input type="submit" value="Enviar" name="btt2">
                    </form>
                <?php

            }else{                                                                                                  //SI NO EXISTE LO INSERTAMOS A LA BASE DE DATOS
                $bd->query('insert into usuarios values("'.$_POST["nom"].'", "'.$_POST["con"].'");');
            }
        }else{                                                                                                      //EN CASO DE QUE LA CONTRASEÑA NO CUMPLA LOS REQUISITOS REINICIAMOS EL FORMULARIO
            echo "Incorrecto";
            header("refresh: 2s; EJERCICIOSQL1.php");
        }
    }else{
    ?>

    <form action="#" method="post">
        <label for="nom">Introduce tu nombre de usuario</label>
        <br>
        <input type="text" name="nom">
        <br>
        <label for="con">Introduce tu contraseña</label>
        <br>
        <input type="text" name="con">
        <br>
        <label for="con1">Vuelve a introducir tu contraseña</label>
        <br>
        <input type="text" name="con1">
        <br>
        <input type="submit" value="Enviar" name="btt">
    </form>

    <?php
    }

    if(isset($_POST["btt2"])){
        echo "Sesión iniciada con éxito";
    }
    ?>
</body>
</html>