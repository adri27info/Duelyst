<?php

require_once(CONTROLLER_PATH . "UsuarioControlador.php");

class Router
{
  private $controlador;
  private $metodo;

  public function __construct()
  {
    $this->metodosRouter();
  }

  public function metodosRouter()
  {
    //Esta aplicacion esta basada en rutas como esta -> controlador/metodo_controlador
    $url = explode("/", URL_ROUTER);
    //Si no se pasa controlador, el controlador por defecto sera Usuario
    $this->controlador = empty($url[1]) ? "UsuarioControlador" : $url[1] . "Controlador";
    //Si no se pasa metodo, el metodo por defecto sera login
    $this->metodo = empty($url[2]) ? "login" : $url[2];
  }

  public function ejecutar()
  {
    if (class_exists($this->controlador)) {
      $controlador = new $this->controlador();
      $metodo  = $this->metodo;
      if (method_exists(UsuarioControlador::class, $metodo)) {
        if (isset($_GET["token"])) {
          $controlador->$metodo($_GET["token"]);
        } else if (isset($_GET["partida_error"])) {
          $controlador->$metodo($_GET["partida_error"]);
        } else if (isset($_GET["datos"])) {
          $controlador->$metodo($_GET["datos"]);
        } else {
          $controlador->$metodo();
        }
      } else {
        UsuarioControlador::errorBusqueda();
      }
    } else {
      UsuarioControlador::errorBusqueda();
    }
    UsuarioControlador::exitConnection();
  }
}