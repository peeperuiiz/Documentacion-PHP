<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EJERCICIOS</title>
</head>
<body>
    <?php
        // - CREA UNA CLASE DE VEHÍCULOS LA CUAL TENGA LAS VARIABLES NOMBRE, TIPO Y PESO, ADEMÁS CREA EL CONSTRUCTOR, GETTER&SETTER Y TOSTRING.
        // TAMBIÉN CREA UN FORMULARIO DONDE SE LE PIDA AL USUARIO LA INFORMACIÓN DE DOS VEHÍCULOS. 
        // EL DOCUMENTO DEBERÁ COMPROBAR, SI SON DEL MISMO TIPO->MOSTRARÁ EL QUE PESE MÁS, SI ADEMÁS PESAN LO MISMO SE INDICARÁ CON UN MENSAJE.
        // SI SON DE DISTINTO TIPO DEBERÁ INDICAR AL USUARIO QUE NO SE PUEDEN COMPARAR. (LOS VALORES DE TIPO SOLO PUEDEN SER C(CAMIÓN), M(MOTO), T(TURISMO))
        if(isset($_POST["btt"])){

            class vehiculo{                                                                                                                 //CREAMOS LA CLASE SI SE HA RELLENADO EL FORMULARIO
                private $nombre;
                private $tipo;
                private $peso;
                
                //CONSTRUCTOR
                public function __construct($n, $t, $p){
                    $this->nombre = $n;
                    $this->tipo = $t;
                    $this->peso = $p;
                }
                
                //SETTER
                public function __set($nom, $n){                                                                                            //OTRA MANERA DE CREA GETTER&SETTER MÁS PRÁCTICA
                    $this->$nom = $n;
                }
                
                //GETTER
                public function __get($nom){
                    return $this->$nom;
                }
                
                //TOSTRING
                public function __toString(){
                    $str = "El nombre del vehículo es ".$this->nombre.", es de tipo ".$this->tipo." y pesa ".$this->peso." toneladas";
                    return $str;
                }
            }

            $v1 = new vehiculo($_POST["nom1"], $_POST["tip1"], $_POST["pes1"]);                                                             //CREAMOS LOS OBJETOS DE LAS CLASES
            $v2 = new vehiculo($_POST["nom2"], $_POST["tip2"], $_POST["pes2"]);

            if($v1->__get("tipo") == $v2->__get("tipo")){                                                                                   //DEFINIMOS LAS CONDICIONES DEL EJERCICIO 
                if($v1->__get("peso") > $v2->__get("peso")){
                    echo $v1;
                }elseif($v1->__get("peso") == $v2->__get("peso")){
                    echo "Los vehículos tienen el mismo peso";
                }else{
                    echo $v2;
                }
            }else{
                echo "Los vehículos no son del mismo tipo";
                header("refresh: 2; RELACION1_9.php");
            }
        }else{
    ?>

    <form action="#" method="post">                                                                                                         <!-- CREAMOS EL FORMULARIO -->
        <h1>Vehículo 1</h1>
        <br>
        <label for="nom1">Introduce el nombre del vehículo</label>
        <br>
        <input type="text" name="nom1">
        <br>
        <label for="tip1">Introduce el tipo del vehículo</label>
        <br>
        <span>C</span><input type="radio" name="tip1" value="C">
        <span>M</span><input type="radio" name="tip1" value="M">
        <span>T</span><input type="radio" name="tip1" value="T">
        <br>
        <label for="pes1">Introduce el peso del vehículo</label>
        <br>
        <input type="text" name="pes1">
        <br>
        <h1>Vehículo 2</h1>
        <br>
        <label for="nom2">Introduce el nombre del vehículo</label>
        <br>
        <input type="text" name="nom2">
        <br>
        <label for="tip2">Introduce el tipo del vehículo</label>
        <br>
        <span>C</span><input type="radio" name="tip2" value="C">
        <span>M</span><input type="radio" name="tip2" value="M">
        <span>T</span><input type="radio" name="tip2" value="T">
        <br>
        <label for="pes2">Introduce el peso del vehículo</label>
        <br>
        <input type="text" name="pes2">
        <br>
        <input type="submit" value="Enviar" name="btt">
    </form>

    <?php
        }
    ?>
</body>
</html>