<?php
require_once("../directorios/dirs.php");
session_start();
session_destroy();

if (isset($_GET["token"])) {
  if ($_GET["token"] === "expiracion") {
    header("Location:" . CHILD_ROOT_PATH . "usuario/login/?token=" . $_GET["token"]);
    exit();
  } else if ($_GET["token"] === "hackeado") {
    header("Location:" . CHILD_ROOT_PATH . "usuario/login/?token=" . $_GET["token"]);
    exit();
  }
} else {
  header("Location:" . CHILD_ROOT_PATH . "usuario/login");
  exit();
}