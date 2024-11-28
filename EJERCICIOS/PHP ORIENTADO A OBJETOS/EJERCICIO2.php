<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EJERCICIO-2</title>
</head>
<body>
    
    <?php
    if(isset($_POST["btt"])){
        class imagen{
            private $src;
            private $border;
            private $ruta_img;

            public function __construct($s, $r, $b = 0){
                if(file_exists($r)){
                    $this->ruta_img = $r;
                    $this->src = $r.$s;
                }
            $this->border = $b;
            }

            public function __toString(){
                $str = "<img src=\"".$this->src."\" border=\"".$this->border."\"/>";
                return $str;
            }
        }

        $img = new imagen($_POST["src"], $_POST["ruta"], $_POST["borde"]);

        echo $img;
    }else{
    ?>

    <form action="#" method="post">
        <label for="src">Introduce el nombre de la imagen. (example.png)</label>
        <br>
        <input type="text" name="src" required>
        <br>
        <label for="ruta">Introduce la ruta en la que se encuentra la imagen. (./example/)</label>
        <br>
        <input type="text" name="ruta" required>
        <br>
        <label for="borde">Introduce el tamaño del borde en pixeles</label>
        <br>
        <input type="number" name="borde">
        <br>
        <input type="submit" value="Enviar" name="btt">
    </form>

    <?php
    }
    ?>
</body>
</html>