<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EJERCICIO 1</title>
</head>
<body>
    
    <?php
    
    class clientes{
        private $bd;
        private $dni;
        private $nombre;
        private $edad;
        private $usuario;
        private $password;

        public function __construct($b, $d = "", $n = "", $e = 18, $u = "", $p = ""){
            $this->bd = $b;
            $this->dni = $d;
            $this->nombre = $n;
            $this->edad = $e;
            $this->usuario = $u;
            $this->password = $p;
        }

        public function __toString(){
            $str = $this->dni." ".$this->nombre." ".$this->edad." ".$this->usuario." ".$this->password."<br>";
            return $str; 
        }

        public function mostrarClientes(){
            $sentencia = "select * from cliente";
            $consulta = $this->bd->prepare($sentencia);
            $consulta->bind_result($d, $n, $e, $u, $p);
            $consulta->execute();

            while($consulta->fetch()){
                echo "$n : $d, $e, $u, $p <br>";
            }

            $consulta->close();
        }

        public function insertarCliente(){
            $sentencia "insert into cliente values(?, ?, ?, ?, ?)"; 
            $consulta = $this->bd->prepare($sentencia);
            $consulta->bind_param("ssiss", $this->dni, $this->nombre, $this->edad, $this->usuario, $this->password);
            $consulta->execute();

            if($consulta->affected_rows() == 1) echo "El cliente ha sido introducido correctamente";
            else echo "El cliente NO ha sido introducido";

            $consulta->close();
        }
    }



    class ventas{
        private $bd;
        private $cliente;
        private $producto;
        private $fecha;
        private $cantidad;
        private $estado;

        public function __construct($b, $cl = "", $p = "", $f = "", $ca = "", $e = null){
            $this->bd = $b;
            $this->cliente = $cl;
            $this->producto = $p;
            $this->fecha = $f;
            $this->cantidad = $ca;
            $this->estado = $e;
        }

        public function __toString(){
            $str = $this->cliente." ".$this->producto." ".$this->fecha." ".$this->cantidad." ".$this->estado."<br>";
            return $str;
        }

        public function mostrarVentas(){
            $sentencia = "select nombre, descripcion, fecha, cantidad, estado from cliente, producto, venta where cod = venta.producto and nif = venta.cliente";
            $consulta = $this->bd->prepare($sentencia);
            $consulta->bind_result($cl, $p, $f, $ca, $e);
            $consulta->execute();

            while($consulta->fetch()){
                echo "$cl -> $p, $f, $ca, $e <br>";
            }

            $consulta->close();
        }
    }

    // EJERCICIO 1
    // $bd = new mysqli("localhost", "root", "", "ejercicios-bd");
    // $bd->set_charset("utf8");
    // $cli = new clientes($bd);
    // $cli->mostrarClientes();

    // EJERCICIO 2
    // $bd = new mysqli("localhost", "root", "", "ejercicios-bd");
    // $bd->set_charset("utf8");
    // $ven = new ventas($bd);
    // $ven->mostrarVentas();

    // EJERCICIO 3
    ?>
    <form action="#" method="post">
        <label for="dni">Introduce el DNI del nuevo cliente</label>
        <br>
        <input type="text" name="dni" placeholder="DNI">
        <br>
        <label for="nom">Introduce el nombre del nuevo cliente</label>
        <br>
        <input type="text" name="nom" placeholder="Nombre">
        <br>
        <label for="edad">Introduce la edad del nuevo cliente</label>
        <br>
        <input type="number" name="edad" placeholder="edad">
        <br>
        <label for="usu">Introduce el nombre de usuario del nuevo cliente</label>
        <br>
        <input type="text" name="usu" placeholder="Nombre de usuario">
        <br>
        <label for="pass">Introduce la contraseña del nuevo cliente</label>
        <br>
        <input type="text" name="pass" placeholder="Contraseña">
        <br>
        <input type="submit" value="Enviar" name="btt">
    </form>
    <?php
    if(isset($_POST["btt"])){
        $bd = new mysqli("localhost", "root", "", "ejercicios-bd");
        $bd->set_charset("utf8");
        $cli = new clientes($bd, $_POST["dni"], $_POST["nom"], $_POST["edad"], $_POST["usu"], $_POST["pass"]);
        $cli->insertarCliente();
    }


    ?>

</body>
</html>