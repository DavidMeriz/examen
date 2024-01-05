<?php
require_once('../Models/cls_reservas.model.php');
$reservas = new Clase_Reservas;
switch ($_GET["op"]) {
    case 'todos':
        $datos = array();
        $datos = $reservas->todos();
        while ($fila = mysqli_fetch_assoc($datos)) {
            $todos[] = $fila;
        }
        echo json_encode($todos);
        break;
    case "uno":
        $ID_reserva = $_POST["ID_reserva"];
        $datos = array();
        $datos = $reservas->uno($ID_reserva);
        $uno = mysqli_fetch_assoc($datos);
        echo json_encode($uno);
        break;
    case 'insertar':
        $ID_hotel = $_POST["ID_hotel"];
        $Fecha_entrada = $_POST["Fecha_entrada"];
        $Fecha_salida = $_POST["Fecha_salida"];

        $datos = array();
        $datos = $reservas->insertar($ID_hotel, $Fecha_entrada, $Fecha_salida);
        echo json_encode($datos);
        break;
    case 'actualizar':
        $ID_reserva = $_POST["ID_reserva"];
        $ID_hotel = $_POST["ID_hotel"];
        $Fecha_entrada = $_POST["Fecha_entrada"];
        $Fecha_salida = $_POST["Fecha_salida"];
        $datos = array();
        $datos = $reservas->actualizar($ID_reserva, $ID_hotel, $Fecha_entrada, $Fecha_salida);
        echo json_encode($datos);
        break;
    case 'eliminar':
        $ID_reserva = $_POST["ID_reserva"];
        $datos = array();
        $datos = $reservas->eliminar($ID_reserva);
        echo json_encode($datos);
        break;
}
?>
