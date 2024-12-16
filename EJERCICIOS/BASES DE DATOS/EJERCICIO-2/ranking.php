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

        $ranking = new Ranking();
        $usuarios = $ranking->obtenerRanking();

        if (count($usuarios) > 0) {
            echo "<h1>Ranking de Usuarios</h1>";
            echo "<table border='1'>";
            echo "<tr><th>Usuario</th><th>Tiempo (segundos)</th></tr>";
            foreach ($usuarios as $usuario) {
                echo "<tr><td>" . $usuario['usuario'] . "</td><td>" . ($usuario['tiempo'] / 1000) . "</td></tr>";
            }
            echo "</table>";
        } else {
            echo "<h2>No hay usuarios registrados en el ranking.</h2>";
        }
    ?>

</body>
</html>