<?php

class Reserva
{
    public static function listarPistasReserva()
    {
        $sql = "SELECT t.id AS tarifa, p.id AS pista, tp.nombre, p.num_pista, t.hora_inicio, t.hora_fin, t.precio FROM tarifa t
        INNER JOIN tipo_pista tp ON t.id_tipo_pista = tp.id
        INNER JOIN pista p ON tp.id = p.id_tipo_pista";
        $con = new Conexion(Config::$mvc_bd_hostname, Config::$mvc_bd_usuario, Config::$mvc_bd_clave, Config::$mvc_bd_nombre);
        $resultado = $con->ejecutarConsulta($sql);
        $con->cerrarConexion();
        return $resultado;
    }

    public static function listarPistasReservaPaginadas($pagina)
    {
        $pagina = $pagina * 10 - 10;
        $sql = "SELECT t.id AS tarifa, p.id AS pista, tp.nombre, p.num_pista, t.hora_inicio, t.hora_fin, t.precio FROM tarifa t
        INNER JOIN tipo_pista tp ON t.id_tipo_pista = tp.id
        INNER JOIN pista p ON tp.id = p.id_tipo_pista
        LIMIT $pagina,10";
        $con = new Conexion(Config::$mvc_bd_hostname, Config::$mvc_bd_usuario, Config::$mvc_bd_clave, Config::$mvc_bd_nombre);
        $resultado = $con->ejecutarConsulta($sql);
        $con->cerrarConexion();
        return $resultado;
    }

    public static function listarReservasFiltradas($tipoPista,$numPista)
    {
        $sql = "SELECT t.id AS tarifa, p.id AS pista, tp.nombre, p.num_pista, t.hora_inicio, t.hora_fin, t.precio FROM tarifa t
        INNER JOIN tipo_pista tp ON t.id_tipo_pista = tp.id
        INNER JOIN pista p ON tp.id = p.id_tipo_pista
        WHERE tp.nombre = '$tipoPista'
        AND p.num_pista = $numPista";
        $con = new Conexion(Config::$mvc_bd_hostname, Config::$mvc_bd_usuario, Config::$mvc_bd_clave, Config::$mvc_bd_nombre);
        $resultado = $con->ejecutarConsulta($sql);
        $con->cerrarConexion();
        return $resultado;
    }

    public static function listarReservasFiltradasPaginadas($tipoPista,$numPista,$pagina)
    {
        $pagina = $pagina * 10 - 10;
        $sql = "SELECT t.id AS tarifa, p.id AS pista, tp.nombre, p.num_pista, t.hora_inicio, t.hora_fin, t.precio FROM tarifa t
        INNER JOIN tipo_pista tp ON t.id_tipo_pista = tp.id
        INNER JOIN pista p ON tp.id = p.id_tipo_pista
        WHERE tp.nombre = '$tipoPista'
        AND p.num_pista = $numPista
        LIMIT $pagina,10";
        $con = new Conexion(Config::$mvc_bd_hostname, Config::$mvc_bd_usuario, Config::$mvc_bd_clave, Config::$mvc_bd_nombre);
        $resultado = $con->ejecutarConsulta($sql);
        $con->cerrarConexion();
        return $resultado;
    }

    public static function reservarPista($usuario,$pista,$tarifa,$fecha)
    {
        $sql = "INSERT INTO reserva (usuario,id_pista,id_tarifa,fecha)
        VALUES ('$usuario',$pista,$tarifa,'$fecha')";
        $con = new Conexion(Config::$mvc_bd_hostname, Config::$mvc_bd_usuario, Config::$mvc_bd_clave, Config::$mvc_bd_nombre);
        $resultado = $con->ejecutarNoConsulta($sql);
        $con->cerrarConexion();
        return $resultado;
    }

    public static function listarReservasHechas($fecha)
    {
        $sql = "SELECT r.id, tp.nombre, r.usuario, p.num_pista, r.fecha, t.hora_inicio, t.hora_fin, r.id_tarifa FROM reserva r
        INNER JOIN tarifa t ON r.id_tarifa = t.id
        INNER JOIN pista p ON r.id_pista = p.id
        INNER JOIN tipo_pista tp ON p.id_tipo_pista = tp.id
        WHERE r.fecha = '$fecha'";
        $con = new Conexion(Config::$mvc_bd_hostname, Config::$mvc_bd_usuario, Config::$mvc_bd_clave, Config::$mvc_bd_nombre);
        $resultado = $con->ejecutarConsulta($sql);
        $con->cerrarConexion();
        return $resultado;
    }

    public static function listarReservasHechasPaginadas($fecha,$pagina)
    {
        $pagina = $pagina * 10 - 10;
        $sql = "SELECT r.id, tp.nombre, r.usuario, p.num_pista, r.fecha, t.hora_inicio, t.hora_fin, r.id_tarifa FROM reserva r
        INNER JOIN tarifa t ON r.id_tarifa = t.id
        INNER JOIN pista p ON r.id_pista = p.id
        INNER JOIN tipo_pista tp ON p.id_tipo_pista = tp.id
        WHERE r.fecha = '$fecha'
        LIMIT $pagina,10";
        $con = new Conexion(Config::$mvc_bd_hostname, Config::$mvc_bd_usuario, Config::$mvc_bd_clave, Config::$mvc_bd_nombre);
        $resultado = $con->ejecutarConsulta($sql);
        $con->cerrarConexion();
        return $resultado;
    }

    public static function eliminarReserva($id)
    {
        $sql = "DELETE FROM reserva
        WHERE id = $id";
        $con = new Conexion(Config::$mvc_bd_hostname, Config::$mvc_bd_usuario, Config::$mvc_bd_clave, Config::$mvc_bd_nombre);
        $resultado = $con->ejecutarNoConsulta($sql);
        $con->cerrarConexion();
        return $resultado;
    }

    public static function enviarEmailReserva($usuario, $pista, $tarifa, $fecha, $email)
    {
        $mail = new PHPMailer\PHPMailer\PHPMailer(true);

        $param['pista'] = Pista::mostrarUnaPista($pista);
        $param['tarifa'] = Tarifa::mostrarUnaTarifa($tarifa);

        try {
            //Server settings
            $mail->SMTPDebug = 0;                      // Enable verbose debug output
            $mail->isSMTP();                                            // Send using SMTP
            $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
            $mail->Username   = 'marctennisclub@gmail.com';      //escribir email a enviar               // SMTP username
            $mail->Password   = 'passwordMTC21@';           //escribir contraseña                    // SMTP password
            $mail->SMTPSecure = 'tls';         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
            $mail->Port       = 587;                                  // TCP port to connect to

            //Recipients
            $mail->setFrom('marctennisclub@gmail.com', 'Marc Tennis Club');
            //  $mail->addAddress('tibofgr@gmail.com', 'Nombre');     // Add a recipient

            $mail->addAddress($email, $usuario);     //para que capture del formulario el email al que enviarlo
            //$mail->addAddress('mfornes@iesperemaria.com');               // Name is optional
            //$mail->addReplyTo('bb@', 'Correo de respuesta');
            //$mail->addCC('cc@example.com');
            //$mail->addBCC('bcc@example.com');

            // Attachments
            // $mail->addAttachment(__DIR__ . $var);         // Add attachments
            //$mail->addAttachment('image.jpg', 'new.jpg');    // Optional name

            // Content
            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = 'Reserva pista Marc Tennis Club';
            $mail->CharSet = 'UTF-8';
            $mail->Body = 'Estimado/a ' . $usuario . ', <br/>Has reservado la pista nº ' . $param['pista'][0]['num_pista'] . ' de ' . $param['pista'][0]['nombre'] . ' el día ' . $fecha . '.<br/>La hora de inicio es a las ' . $param['tarifa'][0]['hora_inicio'] . ' y la hora de fin es a las ' . $param['tarifa'][0]['hora_fin'] . '.<br/>El precio de la pista es de ' . $param['tarifa'][0]['precio'] . ' €';
            //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

            $mail->send();
            //echo '<h2 class="text-primary"><b>Entrada enviada!!</b></h2>';
            //$cadena = "?diaActual=". $dia."&sesionActual=" . $sesion . "&peliculaActual=" . $pelicula ;
            //   echo "<a href='../vista/indexComEntrada.php'><button class='btn-rClaro my-3'>COMPRAR MÁS ENTRADAS</button></a>";

        } catch (Exception $e) {
            echo "Mensaje NO enviado. Mailer Error: {$mail->ErrorInfo}";
        }
    }
}

?>