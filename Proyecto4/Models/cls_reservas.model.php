<?php
require_once('cls_conexion.model.php');

class Clase_Reservas
{
    public function todos()
    {
        try {
            $con = new Clase_Conectar_Base_Datos();
            $con = $con->ProcedimientoConectar();
            $cadena = "SELECT 
                reservas.ID_reserva,
                hoteles.Nombre AS Hotel,
                reservas.Fecha_entrada,
                reservas.Fecha_salida
            FROM reservas
            INNER JOIN hoteles ON reservas.ID_hotel = hoteles.ID_hotel;";
            $result = mysqli_query($con, $cadena);
            return $result;
        } catch (Throwable $th) {
            return $th->getMessage();
        } finally {
            $con->close();
        }
    }
    
    public function uno($ID_reserva)
    {
        try {
            $con = new Clase_Conectar_Base_Datos();
            $con = $con->ProcedimientoConectar();
            $cadena = "SELECT * FROM `reservas` WHERE ID_reserva = $ID_reserva";
            $result = mysqli_query($con, $cadena);
            return $result;
        } catch (Throwable $th) {
            return $th->getMessage();
        } finally {
            $con->close();
        }
    }

    public function insertar($ID_hotel, $Fecha_entrada, $Fecha_salida)
    {
        try {
            $con = new Clase_Conectar_Base_Datos();
            $con = $con->ProcedimientoConectar();
            $cadena = "INSERT INTO `reservas`(ID_hotel, `Fecha_entrada`, `Fecha_salida`) VALUES ($ID_hotel, '$Fecha_entrada', '$Fecha_salida')";
            $result = mysqli_query($con, $cadena);
            return 'ok';
        } catch (Throwable $th) {
            return $th->getMessage();
        } finally {
            $con->close();
        }
    }

    public function actualizar($ID_reserva, $ID_hotel, $Fecha_entrada, $Fecha_salida)
    {
        try {
            $con = new Clase_Conectar_Base_Datos();
            $con = $con->ProcedimientoConectar();
            $cadena = "UPDATE `reservas` SET ID_hotel = $ID_hotel, `Fecha_entrada` = '$Fecha_entrada', `Fecha_salida` = '$Fecha_salida' WHERE `ID_reserva` = '$ID_reserva'";
            $result = mysqli_query($con, $cadena);
            return "ok";
        } catch (Throwable $th) {
            return $th->getMessage();
        } finally {
            $con->close();
        }
    }

    public function eliminar($ID_reserva)
    {
        try {
            $con = new Clase_Conectar_Base_Datos();
            $con = $con->ProcedimientoConectar();
            $cadena = "DELETE FROM reservas WHERE ID_reserva = $ID_reserva";
            $result = mysqli_query($con, $cadena);
            return "ok";
        } catch (Throwable $th) {
            return $th->getMessage();
        } finally {
            $con->close();
        }
    }
}
