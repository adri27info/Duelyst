<?php

include(CONNECTION_PATH . "conexion.php");

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require MAILER_PATH . 'src/Exception.php';
require  MAILER_PATH . 'src/PHPMailer.php';
require MAILER_PATH . 'src/SMTP.php';

class UsuarioModelo
{

    function mostrarUsuario($email, $password, $numParametros = 0)
    {
        $sql = "";
        if ($numParametros === 1) {
            $sql = "SELECT * FROM usuarios where email = :email";
        } else if ($numParametros === 2) {
            $sql = "SELECT * FROM usuarios where email = :email and password = :password";
        }
        try {
            $query = BD::crearConexion()->prepare($sql);
            $query->bindParam(':email', $email);
            if ($numParametros === 2) $query->bindParam(':password', $password);
            $query->execute();
            $usuario = $query->fetch();
            return $usuario;
        } catch (PDOException $exception) {
            echo $exception->getMessage();
            die("[-] Error, al realizar la busqueda del usuario");
        }
    }
    function mostrarUltimaPartidaRegistrada()
    {
        try {
            $query = BD::crearConexion()->query("select * from partida order by id_partida desc limit 1;");
            return $query->fetch();
        } catch (PDOException $exception) {
            echo $exception->getMessage();
            die("[-] Error, al mostrar la ultima partida registrada");
        }
    }
    function mostrarHeroesAleatorios()
    {
        try {
            $query = BD::crearConexion()->query("select * from heroes order by rand() limit 2");
            return $query->fetchAll();
        } catch (PDOException $exception) {
            echo $exception->getMessage();
            die("[-] Error, al mostrar los heroes aleatorios");
        }
    }
    function registrarUsuario($id_usuario, $email, $password, $fecha_registro)
    {
        try {
            $query = BD::crearConexion()->prepare("INSERT INTO usuarios(id_usuario, email, password, fecha_registro) VALUES (:id_usuario, :email, :password, :fecha_registro)");
            $query->bindParam(':id_usuario', $id_usuario);
            $query->bindParam(':email', $email);
            $query->bindParam(':password', $password);
            $query->bindParam(':fecha_registro', $fecha_registro);
            return $query->execute();
        } catch (PDOException $exception) {
            echo $exception->getMessage();
            die("[-] Error, al realizar la insercion del usuario");
        }
    }
    function registrarPartida($id_partida, $serial_partida, $estado_partida)
    {
        try {
            $query = BD::crearConexion()->prepare("INSERT INTO partida(id_partida, serial_partida, estado_partida)  VALUES (:id_partida, :serial_partida, :estado_partida)");
            $query->bindParam(':id_partida', $id_partida);
            $query->bindParam(':serial_partida', $serial_partida);
            $query->bindParam(':estado_partida', $estado_partida);
            return $query->execute();
        } catch (PDOException $exception) {
            echo $exception->getMessage();
            die("[-] Error, al realizar la insercion de la partida");
        }
    }
    function registrarJuego($id_usuario, $id_partida)
    {
        try {
            $query = BD::crearConexion()->prepare("INSERT INTO jugar(id_usuario, id_partida)  VALUES (:id_usuario, :id_partida)");
            $query->bindParam(':id_usuario', $id_usuario);
            $query->bindParam(':id_partida', $id_partida);
            return $query->execute();
        } catch (PDOException $exception) {
            echo $exception->getMessage();
            die("[-] Error, al realizar la insercion del juego");
        }
    }
    function persistenciaPartida($id_partida, $id_heroe_enemigo, $id_heroe_amigo)
    {
        try {
            $query = BD::crearConexion()->prepare("INSERT INTO existir(id_partida, id_heroe_enemigo, id_heroe_amigo)  VALUES (:id_partida, :id_heroe_enemigo, :id_heroe_amigo)");
            $query->bindParam(':id_partida', $id_partida);
            $query->bindParam(':id_heroe_enemigo', $id_heroe_enemigo);
            $query->bindParam(':id_heroe_amigo', $id_heroe_amigo);
            return $query->execute();
        } catch (PDOException $exception) {
            echo $exception->getMessage();
            die("[-] Error, al persistir la partida");
        }
    }
    function actualizarPartida($id_partida, $estado_partida)
    {
        try {
            $query = BD::crearConexion()->prepare("update partida set estado_partida = :estado_partida where id_partida = :id_partida");
            $query->bindParam(':id_partida', $id_partida);
            $query->bindParam(':estado_partida', $estado_partida);
            $query->execute();
            return $query->rowCount();
        } catch (PDOException $exception) {
            echo $exception->getMessage();
            die("[-] Error, al realizar la actualizacion de la partida");
        }
    }
    function enviarCorreo($correo, $password)
    {
        $mail = new PHPMailer(true);
        try {
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = 'testduelyst@gmail.com';
            $mail->Password   = 'wcrbwffbbgwzezme';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
            $mail->Port       = 465;
            $mail->setFrom('testduelyst@gmail.com', 'Administrator');
            $mail->addAddress($correo);
            $mail->isHTML(true);
            $mail->Subject = 'Registro en Duelyst';
            $mail->Body    =
                '<!DOCTYPE html>
                <html lang="en">
                <head>
                    <meta charset="UTF-8" />
                    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
                    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
                    <title>Registro | Duelyst</title>
                </head>
                <body>
                    <h3>Gracias por registrarte ' . $correo . ', bienvenido a la familia. </h3> <br>
                    <span> <b> Tu password es la siguiente: ' . $password . ', vuelve siempre que quieras http://localhost/Duelyst/index.php. </b> </span>
                </body>
                </html>
            ';
            $mail->CharSet = "UTF-8";
            if ($mail->send()) {
                return true;
            }
        } catch (Exception $e) {
            return false;
        }
        return false;
    }

    function closeConnection()
    {
        BD::cerrarConexion();
    }
}