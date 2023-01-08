<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Duelyst</title>
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
  <link rel="stylesheet" href="<?= CHILD_ROOT_PATH ?>utilidades/assets/css/estilos.css" />
  <script type="module" src="<?= CHILD_ROOT_PATH ?>utilidades/assets/js/validaciones.js" defer></script>
</head>

<body>
  <div class="contenedorModal" id="contenedorModal">
    <div class="modal" id="modal">
      <div class="cerrar">
        <span class="material-symbols-outlined" id="btnCerrar"> close </span>
      </div>
      <div class="datosRegistro">
        <h2>Registrate</h2>
        <form action="<?= CHILD_ROOT_PATH ?>usuario/login" method="post" name="formularioRegistro"
          id="formularioRegistro">
          <label for="correo">Correo</label>
          <input type="text" name="correo_registro" id="correo_registro"
            placeholder="Introduce tu correo para registrarte" />
          <div class="contenedorCorreo_Registro ocultar" id="contenedorCorreo_Registro">
            <span class="material-symbols-outlined"> email </span>
            <span id="error_correo_registro" class="error_correo_registro">Error, debes introducir un correo
              que sea valido</span>
          </div>
          <label for="pass">Password</label>
          <input type="password" name="password_registro" id="password_registro"
            placeholder="Introduce tu password para registrarte" />
          <div class="contenedorPassword_Registro ocultar" id="contenedorPassword_Registro">
            <span class="material-symbols-outlined"> key </span>
            <span id="error_password_registro" class="error_password_registro">Error [-4, +20]. Debes
              introducir un minimo de 4 y un maximo de 20 caracteres</span>
          </div>
          <input type="submit" value="Registrar" name="btnRegistrar" id="btnRegistrar" />
          <div class="contenedorRegistro">
            <span id="textoRegistro"></span>
          </div>
        </form>
      </div>
    </div>
  </div>
  <div class="principal">
    <div class="principal_formulario">
      <div class="principal_formulario_datos">
        <h2>Bienvenido a Duelyst</h2>
        <form action="<?= CHILD_ROOT_PATH ?>usuario/main" method="post" name="formulario" id="formulario">
          <input type="text" name="correo" id="correo" placeholder="Introduce tu correo" />
          <div class="contenedorCorreo ocultar" id="contenedorCorreo">
            <span class="material-symbols-outlined"> email </span>
            <span id="error_correo" class="error_correo">Error, correo invalido</span>
          </div>
          <input type="password" name="password" id="password" placeholder="Introduce tu password" />
          <div class="contenedorPassword ocultar" id="contenedorPassword">
            <span class="material-symbols-outlined"> key </span>
            <span id="error_password" class="error_password">Error, contraseña invalida</span>
          </div>
          <input type="hidden" name="token" id="token">
          <input type="submit" value="Enviar" name="btnSubmit" id="btnSubmit" />
          <div class="contenedorLogin">
            <span id="textoLogin"></span>
          </div>
          <div class="registro">
            <span>¿Aún no tienes cuenta?</span>
            <button type="button" id="btnModal">Crear cuenta</button>
          </div>
          <?php
          if (!empty($_GET) && isset($_GET["token"])) {
            if ($_GET["token"] === "expiracion") {
              echo "<p class='parrafoToken'> El token ha expirado, vuelva a iniciar sesion</p>";
            } else if ($_GET["token"] === "hackeado") {
              echo "<p class='parrafoToken'> El token se ha intentado hackear, por lo cual se ha cerrado sesión</p>";
            }
          }
          ?>
        </form>
      </div>
    </div>
    <div class="principal_logo">
      <img src="<?= CHILD_ROOT_PATH ?>utilidades/assets/images/fondos/hero-img.jpg" alt="logo principal" />
    </div>
  </div>
</body>

</html>