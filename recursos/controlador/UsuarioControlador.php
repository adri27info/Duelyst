<?php

include(MODEL_PATH . "UsuarioModelo.php");

class UsuarioControlador
{
    static function login()
    {
        if (isset($_SESSION["usuario"])) {
            header("Location:" . CHILD_ROOT_PATH . "usuario/main");
            exit();
        }
        require_once("recursos/vistas/login.php");
    }

    static function main()
    {
        if (!isset($_SESSION["usuario"]) || !isset($_SESSION["token"]) || !isset($_SESSION["expiracion_token"])) {
            header("Location:" . CHILD_ROOT_PATH . "usuario/errorAcceso");
            exit();
        }
        if (!empty($_POST) && $_SESSION["token"] === $_POST["token"] || isset($_SESSION["token"])) {
            if (time() > $_SESSION["expiracion_token"]) {
                header("Location:" . CHILD_ROOT_PATH . "recursos/logout/cerrarSesion.php?token=expiracion");
                exit();
            }
        }
        if (!empty($_GET)) {
            $parrafo = "";
            if (isset($_GET["partida_error"])) {
                if ($_GET["partida_error"] === "false") {
                    $parrafo = "<p class='parrafoPartida'> Error, no se ha podido ejecutar la partida </p>";
                    unset($_SESSION["partida_error"]);
                }
            } else if (isset($_GET["datos"]) && $_GET["datos"] != "") {
                $modelo = new UsuarioModelo();
                $datos = explode(",", $_GET["datos"]);
                if (count($datos) === 2) {
                    $partidaActualizada = $modelo->actualizarPartida($datos[0], $datos[1]);
                    if ($partidaActualizada != 0) {
                        $parrafo = "<p class='parrafoPartida'> Gracias por jugar, la partida se ha actualizado correctamente </p>";
                    } else {
                        $parrafo = "<p class='parrafoPartida'> Gracias por jugar pero la partida no se ha actualizado correctamente </p>";
                    }
                } else {
                    $parrafo = "<p class='parrafoPartida'> Gracias por jugar pero la partida no se ha actualizado correctamente </p>";
                }
            }
        }
        require_once("recursos/vistas/main.php");
    }

    static function juego()
    {
        if (!isset($_SESSION["usuario"]) || empty($_POST)) {
            header("Location:" . CHILD_ROOT_PATH . "usuario/errorAcceso");
            exit();
        }
        if (!empty($_POST) && isset($_POST["token"])) {
            if ($_POST["token"] !== $_SESSION["token"]) {
                header("Location:" . CHILD_ROOT_PATH . "recursos/logout/cerrarSesion.php?token=hackeado");
                exit();
            }
        }
        $modelo = new UsuarioModelo();
        $partidaInsertada = $modelo->registrarPartida(0, substr(sha1(time()), 0, 20), "empate");
        $juego = $modelo->registrarJuego(
            $modelo->mostrarUsuario($_SESSION["usuario"], "", 1)->id_usuario,
            $modelo->mostrarUltimaPartidaRegistrada()->id_partida
        );
        $heroes = $modelo->mostrarHeroesAleatorios();
        $partidaExistente = $modelo->persistenciaPartida(
            $modelo->mostrarUltimaPartidaRegistrada()->id_partida,
            $heroes[0]->id_heroe,
            $heroes[1]->id_heroe
        );
        $datosPartidaInsertada = $modelo->mostrarUltimaPartidaRegistrada();
        if (($partidaInsertada === 0 || $partidaInsertada === false) || ($juego === 0 || $juego === false) || (!$heroes) ||
            (!$datosPartidaInsertada) || (!$partidaExistente)
        ) {
            $_SESSION["partida_error"] = "false";
        } else {
            $idPartida = $datosPartidaInsertada->id_partida . " ";
            $estadoPartida = $datosPartidaInsertada->estado_partida . " ";
        }
        if (isset($_SESSION["partida_error"])) {
            header("Location:" . CHILD_ROOT_PATH . "usuario/main/?partida_error=false");
            exit();
        }
        require_once("recursos/vistas/juego.php");
    }

    static function errorAcceso()
    {
        require_once("recursos/vistas/error_acceso.php");
    }

    static function errorBusqueda()
    {
        require_once("recursos/vistas/error_pagina.php");
    }

    static function exitConnection()
    {
        $modelo = new UsuarioModelo();
        $modelo->closeConnection();
    }
}