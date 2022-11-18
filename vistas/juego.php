<?php
if (isset($_COOKIE["imagenFondo"])) {
  $imagenFondo = $_COOKIE["imagenFondo"] . ".jpg";
} else {
  $imagenFondo = "astral.jpg";
}

if (isset($_COOKIE["reproduccion_cancion"])) {
  $cancion = $_COOKIE["reproduccion_cancion"];
} else {
  $cancion = "false";
}
?>
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
  <script type="module" src="<?= CHILD_ROOT_PATH ?>utilidades/assets/js/juego.js" defer></script>
</head>

<body>
  <section class="tablero_juego <?= $cancion ?>" id="tablero_juego_<?= $imagenFondo ?>">
    <?php
    if (isset($_COOKIE["reglas"])) {
      echo "<div class='reglas'>
        <span class='material-symbols-outlined' id='btnModalJuego'>
          gavel
        </span>
      </div>";
    }
    ?>
    <div class="contenedorModalJuego" id="contenedorModalJuego">
      <div class="modalJuego" id="modalJuego">
      </div>
    </div>
    <div class="tablero" id="tablero">

      <div class="tablero_header_enemigo">
        <div class="tablero_header_enemigo_imagen">
          <img src="<?= CHILD_ROOT_PATH ?>utilidades/assets/images/jugador/player02.png">
        </div>
        <div class="tablero_header_enemigo_vida" id="tablero_header_enemigo_vida">
          <?php
          for ($i = 1; $i <= $heroes[0]->vida_heroe; $i++) {
            echo "<div id=tablero_header_enemigo_vida$i></div>";
          }
          ?>
        </div>
        <div class="tablero_header_enemigo_mana" id="tablero_header_enemigo_mana">
          <div id="mana_enemigo"><?= $heroes[0]->mana_heroe  ?></div>
        </div>
      </div>

      <div class="tablero_vida_enemigo">
        <span id="texto_vida_enemigo">20 - HP</span>
      </div>

      <div class="tablero_carta_enemigo">
        <div class="tablero_carta_enemigo_logo" id="tablero_carta_enemigo_logo">
          <img src="<?= CHILD_ROOT_PATH ?>utilidades/assets/images/heroes/<?= $heroes[0]->ruta_heroe ?>">
          <div class="tablero_carta_enemigo_logo_ataque" id="tablero_carta_enemigo_logo_ataque">
            <span id="ataque_enemigo"><?= $heroes[0]->ataque_heroe ?></span>
          </div>
          <div class="tablero_carta_enemigo_logo_defensa" id="tablero_carta_enemigo_logo_defensa">
            <span id="defensa_enemigo"><?= $heroes[0]->defensa_heroe ?></span>
          </div>
          <div class="tablero_carta_enemigo_logo_nombre">
            <span>Enemigo</span>
          </div>
        </div>
      </div>

      <div class="tablero_carta_amigo">
        <div class="tablero_carta_amigo_logo" id="tablero_carta_amigo_logo">
          <img src="<?= CHILD_ROOT_PATH ?>utilidades/assets/images/heroes/<?= $heroes[1]->ruta_heroe ?>">
          <div class="tablero_carta_amigo_logo_ataque" id="tablero_carta_amigo_logo_ataque">
            <span id="ataque_amigo"><?= $heroes[1]->ataque_heroe ?></span>
          </div>
          <div class="tablero_carta_amigo_logo_defensa" id="tablero_carta_amigo_logo_defensa">
            <span id="defensa_amigo"><?= $heroes[1]->defensa_heroe ?></span>
          </div>
          <div class="tablero_carta_amigo_logo_nombre">
            <span> Jugador </span>
          </div>
          <div class="tablero_carta_amigo_logo_imagen_ataque" id="tablero_carta_amigo_logo_imagen_ataque">
            <img src="<?= CHILD_ROOT_PATH ?>utilidades/assets/images/jugador/attack.png">
          </div>
          <div class="tablero_carta_amigo_logo_imagen_defensa" id="tablero_carta_amigo_logo_imagen_defensa">
            <img src="<?= CHILD_ROOT_PATH ?>utilidades/assets/images/jugador/defense.png">
          </div>
        </div>
      </div>

      <div class="tablero_vida_amigo">
        <span id="texto_vida_amigo">20 - HP</span>
      </div>

      <div class="tablero_header_amigo">
        <div class="tablero_header_amigo_mana " id="tablero_header_amigo_mana">
          <div id="mana_amigo"> <?= $heroes[1]->mana_heroe;  ?></div>
        </div>
        <div class="tablero_header_amigo_vida" id="tablero_header_amigo_vida">
          <?php
          for ($i = 1; $i <= $heroes[1]->vida_heroe; $i++) {
            echo "<div id=tablero_header_amigo_vida$i> </div>";
          }
          ?>
        </div>
        <div class="tablero_header_amigo_imagen">
          <img src="<?= CHILD_ROOT_PATH ?>utilidades/assets/images/jugador/player01.png">
        </div>
      </div>

    </div>
  </section>
  <?php
  echo "<input type='hidden' id='dataJuego' class='" . $idPartida . $estadoPartida . "'>";
  ?>
</body>

</html>