<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Escuela Arte Granada, EAG.</title>
</head>
<body>
    <?php
        echo "<form action="" method="post">";
        echo "<table><th>Notas de ".$notas[0][0]."</th><th></th>";

        for ($i = 0; $i < count($notas); $i++) { 
            echo "<tr><td>".$notas[$i][1]."</td><td><input type=\"text\" name=\"nota\" value=\"".$notas[$i][1]."\"</td></tr>";
        }

        echo "</table>";
        echo "<input type=\"submit\" value=\"Actualizar\" name = \"action\">";
        echo "<input type=\"submit\" value=\"Volver\" name = \"action\">"
        echo "</form>";
    ?>
</body>
</html>