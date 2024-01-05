<?php
require_once('../Models/cls_clientes.model.php');
$clientes = new Clase_Clientes;
switch ($_GET["op"]) {
    case 'todos':
        $datos = array(); //defino un arreglo
        $datos = $clientes->todos(); //llamo al modelo de usuarios e invoco al procedimiento todos y almaceno en una variable
        while ($fila = mysqli_fetch_assoc($datos)) { //recorro el arreglo de datos
            $todos[] = $fila;
        }
        echo json_encode($todos); //devuelvo el arreglo en formato json
        break;
    case "uno":
        $ID_cliente  = $_POST["ID_cliente "]; //defino una variable para almacenar el id del usuario, la variable se obtiene mediante POST
        $datos = array(); //defino un arreglo
        $datos = $clientes->uno($ID_cliente ); //llamo al modelo de usuarios e invoco al procedimiento uno y almaceno en una variable
        $uno = mysqli_fetch_assoc($datos); //recorro el arreglo de datos
        echo json_encode($uno); //devuelvo el arreglo en formato json
        break;
    case 'insertar':
        $Nombre = $_POST["Nombre"];
        $Apellido   = $_POST["Apellido"];
        $datos = array(); //defino un arreglo
        $datos = $clientes->insertar($Nombre,$Apellido ); //llamo al modelo de usuarios e invoco al procedimiento insertar
        echo json_encode($datos); //devuelvo el arreglo en formato json
        break;
    case 'actualizar':
        $ID_cliente  = $_POST["ID_cliente "];
        $Nombre = $_POST["Nombre"];
        $Apellido   = $_POST["Apellido"];
        $datos = array(); //defino un arreglo
        $datos = $clientes->actualizar($ID_cliente , $Nombre, $Apellido); //llamo al modelo de usuarios e invoco al procedimiento actual
        echo json_encode($datos); //devuelvo el arreglo en formato json
        break;
    case 'eliminar':
        $ID_cliente  = $_POST["ID_cliente "]; //defino una variable para almacenar el id del usuario, la variable se obtiene mediante POST
        $datos = array(); //defino un arreglo
        $datos = $clientes->eliminar($ID_cliente ); //llamo al modelo de usuarios e invoco al procedimiento uno y almaceno en una variable
        echo json_encode($datos); //devuelvo el arreglo en formato json
        break;
}
