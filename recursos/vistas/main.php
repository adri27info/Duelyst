<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Duelyst</title>
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
  <link rel="stylesheet" href="<?= CHILD_ROOT_PATH ?>utilidades/assets/css/estilos.css" />
  <script type="module" src="<?= CHILD_ROOT_PATH ?>utilidades/assets/js/main.js" defer></script>
</head>

<body>
  <div class="contenedorMain">
    <div class="contenedorModal" id="contenedorModal">
      <div class="modal" id="modal"></div>
    </div>
    <header>
      <h3> <?= "Bienvenido: " . $_SESSION['usuario'] ?> </h3>
      <div class="logout">
        <a href="<?= CHILD_ROOT_PATH ?>recursos/logout/cerrarSesion.php">Cerrar sesion</a>
        <span class="material-symbols-outlined">
          logout
        </span>
      </div>
    </header>
    <?php
    if (isset($parrafo)) echo $parrafo;
    ?>
    <section class="main">
      <div class="contenedorJuego" id="contenedorJuego">
        <form action="<?= CHILD_ROOT_PATH ?>usuario/juego" method="post" class="formularioJuego">
          <input type="hidden" name="token" id="token" value="<?= $_SESSION["token"]; ?>">
          <input type="submit" value="JUGAR" class="btnJuegoSubmit">
        </form>
        <button type="button" id="btnOpciones">OPCIONES</button>
        <button type="button" id="btnFondos">FONDOS</button>
      </div>
    </section>
  </div>
</body>

</html>