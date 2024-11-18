<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EJEMPLO POO PHP</title>
</head>
<body>
    <?php
        if(isset($_POST["btt"])){                                                                                           //CONTROLAMOS QUE EL USUARIO HAYA INTRODUCIDO LOS DATOS PARA EJECUTAR EL CÓDIGO

            class animal{                                                                                                   //CREAMOS LA CLASE ANIMAL
                public $nombre;                                                                                             //DEFINIMOS SUS VARIABLES
                public $color;
                public $fNac;


                public function __construct($n, $c, $f){                                                                    //DEFINIMOS EL CONSTRUCTOR
                    $this->nombre = $n;
                    $this->color = $c;
                    $this->fNac = $f;
                }

                public function setNombre($n){                                                                              //CREAMOS LOS SETTER DE CADA VARIABLE
                    $this->nombre = $n;
                }

                public function setColor($c){
                    $this->color = $c;
                }

                public function setFNac($f){
                    $this->fNac = $f;
                }

                public function edadAnimal(){                                                                               //CREAMOS UNA FUNCIÓN POR LA CUAL SACAMOS LA EDAD APROXIMADA DEL ANIMAL
                    $segFecha = strtotime($this->fNac);
                    $segActual = time();

                    $anioFecha = getdate($segFecha);
                    $anioActual = getdate($segActual);

                    $edad = $anioActual["year"] - $anioFecha["year"];

                    return $edad;
                }

                public function __toString(){                                                                               //DEFINIMOS EL TOSTRING
                    $str = "El animal ".$this->nombre." de color ".$this->color." nació el día ".$this->fNac;
                    return $str;
                }
            }

            $animal = new animal($_POST["nom"], $_POST["color"], $_POST["fNac"]);                                           //CREAMOS AL ANIMAL E IMPRIMIMOS PARA COMPROBAR QUE TODO FUNCIONA

            echo $animal."<br>";
            echo $animal->edadAnimal()." años";

            //TANTO __constructor COMO __toString SON "MÉTODOS MÁGICOS" A LOS CUALES NO ES NECESARIO REFERENCIARLOS PARA PODER USARLOS

        }else{
    ?>

    <form action="#" method="post">
        <label for="nom">Introduce el nombre del animal</label>
        <br>
        <input type="text" name="nom">
        <br>
        <label for="color">Introduce su color</label>
        <br>
        <input type="text" name="color">
        <br>
        <label for="fNac">Introduce su fecha de nacimiento</label>
        <br>
        <input type="date" name="fNac">
        <br>
        <input type="submit" value="Enviar" name="btt">
    </form>

    <?php
        }
    ?>
</body>
</html>