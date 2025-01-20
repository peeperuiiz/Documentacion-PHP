<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Escuela Arte Granada, EAG.</title>
</head>
<body>
    <form action="" method="post">
        <label for="mod">Selecciona un módulo</label>
        <select name="mod">
            <?php

                for($i = 0; $i < count($modulos); $i++){
                    echo "<option value = \"".$modulos[$i]."\">".$modulos[$i]."</option>";
                }

            ?>
        </select>
        <label for="curso">Selecciona un curso</label>
        <select name="curso">
            <option value="1">1º</option>
            <option value="2">2º</option>
        </select>
        <input type="submit" value="Seleccionar" name="action">
    </form>

    <?php
    
        if(isset($alumnos)){
            echo "<form action="" method=\"post\">";
            echo "<table><th></th><th>Alumnos</th>";
            
            for ($i = 0; $i < count($alumnos); $i++) { 
                echo "<tr><td><input type=\"radio\" name=\"alu\" value=\"".$alumnos[$i][0]."\"></td><td>".$alumnos[$i][1]."</td></tr>";
            }
            
            
            echo "</table><br>";
            echo "<input type=\"submit\" value=\"Enviar\" name=\"action\">";
            echo "</form>";
        }else{
            echo "<p style=\"color: red\">No hay alumnos matriculados en este curso</p>"
        }
    
    ?>
</body>
</html>