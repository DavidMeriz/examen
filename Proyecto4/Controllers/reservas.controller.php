<?php
require_once('../Models/cls_reservas.model.php');
$reservas = new Clase_Reservas;
switch ($_GET["op"]) {
    case 'todos':
        $datos = array(); //defino un arreglo
        $datos = $reservas->todos(); //llamo al modelo de usuarios e invoco al procedimiento todos y almaceno en una variable
        while ($fila = mysqli_fetch_assoc($datos)) { //recorro el arreglo de datos
            $todos[] = $fila;
        }
        echo json_encode($todos); //devuelvo el arreglo en formato json
        break;
    case "uno":
        $ID_reserva  = $_POST["ID_reserva "]; //defino una variable para almacenar el id del usuario, la variable se obtiene mediante POST
        $datos = array(); //defino un arreglo
        $datos = $reservas->uno($ID_reserva ); //llamo al modelo de usuarios e invoco al procedimiento uno y almaceno en una variable
        $uno = mysqli_fetch_assoc($datos); //recorro el arreglo de datos
        echo json_encode($uno); //devuelvo el arreglo en formato json
        break;
    case 'insertar':
        $ID_hotel  = $_POST["ID_hotel "];
        $ID_cliente  = $_POST["ID_cliente "];
        $Fecha_entrada  = $_POST["Fecha_entrada "];
        $Fecha_salida  = $_POST["Fecha_salida "];

        $datos = array(); //defino un arreglo
        $datos = $reservas->insertar($ID_hotel, $ID_cliente, $Fecha_entrada, $Fecha_salida); //llamo al modelo de usuarios e invoco al procedimiento insertar
        echo json_encode($datos); //devuelvo el arreglo en formato json
        break;
    case 'actualizar':
        $ID_reserva  = $_POST["ID_reserva "];
        $ID_cliente  = $_POST["ID_cliente "];
        $Fecha_entrada  = $_POST["Fecha_entrada "];
        $Fecha_salida  = $_POST["Fecha_salida "];
        $datos = array(); //defino un arreglo
        $datos = $reservas->actualizar( $ID_reserva, $ID_hotel, $ID_cliente, $Fecha_entrada, $Fecha_salida); //llamo al modelo de usuarios e invoco al procedimiento actual
        echo json_encode($datos); //devuelvo el arreglo en formato json
        break;
    case 'eliminar':
        $ID_reserva  = $_POST["ID_reserva "]; //defino una variable para almacenar el id del usuario, la variable se obtiene mediante POST
        $datos = array(); //defino un arreglo
        $datos = $reservas->eliminar($ID_reserva ); //llamo al modelo de usuarios e invoco al procedimiento uno y almaceno en una variable
        echo json_encode($datos); //devuelvo el arreglo en formato json
        break;
}
