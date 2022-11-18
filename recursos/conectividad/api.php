<?php

session_start();
include("../directorios/dirs.php");
include(MODEL_PATH . "UsuarioModelo.php");
header('Content-Type: application/json; charset=utf-8');

switch ($_SERVER["REQUEST_METHOD"]) {
    case "POST":
        comprobarUsuario();
        break;
    default:
        break;
}

function comprobarUsuario()
{
    $modelo = new UsuarioModelo();
    $data = json_decode(file_get_contents('php://input'), true);
    if (count($data) === 3) {
        if (!empty($data["email"]) && !empty($data["password"]) && !empty($data["metodo"])) {
            if ($data["metodo"] === "mostrar") {
                $usuarioMostrar = $modelo->mostrarUsuario($data["email"], md5($data["password"]), 2);
                if ($usuarioMostrar) {
                    $_SESSION["usuario"] = $data["email"];
                    $_SESSION["token"] = bin2hex(random_bytes(32));
                    $_SESSION["expiracion_token"] = time() + 60 * 120; // 2h desde ahora
                    echo json_encode(array("exito" => "Iniciando sesion...", "token" => $_SESSION["token"]));
                } else {
                    echo json_encode(array("error" => "Error, datos erroneos"));
                }
            } else if ($data["metodo"] === "registrar") {
                $usuarioRegistrar = $modelo->mostrarUsuario($data["email"], md5($data["password"]), 1);
                if ($usuarioRegistrar) {
                    echo json_encode(array("error" => "Error, el usuario ya existe"));
                } else {
                    $correoEnviado = $modelo->enviarCorreo($data["email"], $data["password"]);
                    if ($correoEnviado) {
                        $usuarioRegistrado = $modelo->registrarUsuario(0, $data["email"], md5($data["password"]), date("Y-m-d"));
                        if ($usuarioRegistrado != 0) {
                            echo json_encode(array("exito" => "El usuario ha sido registrado, comprueba tu correo. Volviendo a la pagina principal......"));
                        } else {
                            echo json_encode(array("error" => "El usuario ha sido registrado, pero no ha sido insertado. Volviendo a la pagina principal......"));
                        }
                    } else {
                        echo json_encode(array("error" => "Error, el usuario no se ha podido registrar"));
                    }
                }
            }
        }
    }
}