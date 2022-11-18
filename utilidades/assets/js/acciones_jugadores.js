import * as juego from "./juego.js";
const cartaEnemigo = document.getElementById("tablero_carta_enemigo_logo");
const cartaAmigo = document.getElementById("tablero_carta_amigo_logo");
const textoVidaEnemigo = document.getElementById("texto_vida_enemigo");
const textoVidaAmigo = document.getElementById("texto_vida_amigo");
let vidaEnemiga = document.getElementById("tablero_header_enemigo_vida");
let vidaAmigo = document.getElementById("tablero_header_amigo_vida");
let condicion;

/* ---------------- ATAQUE -  AMIGO ---------------- */

function ataqueAmigo() {
  juego.configuracionAtaque();
  animacionAtaqueJugador("amigo");
  golpeoJugador(juego.amigo);
  setTimeout(() => {
    cartaAmigo.classList.remove("ataque_amigo");
    establecerEventosCartaJugador("amigo", false);
  }, 2000);
  setTimeout(accionEnemigo, 2000);
}

/* ---------------- DEFENSA - AMIGO ---------------- */

function defensaAmigo() {
  reducirAtaqueJugadorMitad(true);
  juego.configuracionDefensa();
  animacionDefensaJugador("amigo");
  bloqueoJugador("amigo");
  setTimeout(() => {
    cartaAmigo.classList.remove("defensa_amigo");
    establecerEventosCartaJugador("amigo", false);
  }, 2000);
  setTimeout(accionEnemigo, 2000);
}

/* ---------------- ATAQUE - ENEMIGO ---------------- */

function ataqueEnemigo() {
  juego.configuracionAtaque();
  animacionAtaqueJugador("enemigo");
  golpeoJugador(juego.enemigo);
  setTimeout(() => {
    cartaEnemigo.classList.remove("ataque_enemigo");
  }, 2000);
}

/* ---------------- DEFENSA - ENEMIGO ---------------- */

function defensaEnemigo() {
  reducirAtaqueJugadorMitad(true);
  juego.configuracionDefensa();
  animacionDefensaJugador("enemigo");
  bloqueoJugador("enemigo");
  setTimeout(() => {
    cartaEnemigo.classList.remove("defensa_enemigo");
  }, 2000);
}

/* ---------------- ACCIONES - JUGADORES ---------------- */

function animacionAtaqueJugador(jugador) {
  if (jugador === "amigo") {
    cartaAmigo.classList.add("ataque_amigo");
    establecerEventosCartaJugador("amigo", true);
  } else if (jugador === "enemigo") {
    cartaEnemigo.classList.add("ataque_enemigo");
  }
}

function golpeoJugador(jugador) {
  if (jugador === juego.amigo) {
    if (obtenerCondicionAtaque()) {
      if (Math.ceil(juego.amigo.ataque / 2) >= juego.enemigo.vida) {
        alert("Has ganado, enhorabuena");
        window.location.href =
          "/apps/php/Duelyst/usuario/main/?datos=" +
          juego.obtenerDatosJuego("ganada");
      } else {
        juego.enemigo.vida = Math.floor(
          juego.enemigo.vida - juego.amigo.ataque / 2
        );
        condicion = false;
      }
    } else {
      if (juego.amigo.ataque >= juego.enemigo.vida) {
        alert("Has ganado, enhorabuena");
        window.location.href =
          "/apps/php/Duelyst/usuario/main/?datos=" +
          juego.obtenerDatosJuego("ganada");
      } else {
        juego.enemigo.vida = juego.enemigo.vida - juego.amigo.ataque;
      }
    }
    textoVidaEnemigo.textContent = juego.enemigo.vida + " - HP";
    for (
      let index = vidaEnemiga.children.length - 1;
      index >= juego.enemigo.vida;
      index--
    ) {
      vidaEnemiga.removeChild(vidaEnemiga.children[index]);
    }
  } else if (jugador === juego.enemigo) {
    if (obtenerCondicionAtaque()) {
      if (Math.ceil(juego.enemigo.ataque / 2) >= juego.amigo.vida) {
        alert("El enemigo, ha ganado");
        window.location.href =
          "/apps/php/Duelyst/usuario/main/?datos=" +
          juego.obtenerDatosJuego("perdida");
      } else {
        juego.amigo.vida = Math.floor(
          juego.amigo.vida - juego.enemigo.ataque / 2
        );
        condicion = false;
      }
    } else {
      if (juego.enemigo.ataque >= juego.amigo.vida) {
        alert("El enemigo, ha ganado");
        window.location.href =
          "/apps/php/Duelyst/usuario/main/?datos=" +
          juego.obtenerDatosJuego("perdida");
      } else {
        juego.amigo.vida = juego.amigo.vida - juego.enemigo.ataque;
      }
    }
    textoVidaAmigo.textContent = juego.amigo.vida + " - HP";
    for (
      let index = vidaAmigo.children.length - 1;
      index >= juego.amigo.vida;
      index--
    ) {
      vidaAmigo.removeChild(vidaAmigo.children[index]);
    }
  }
}

function establecerEventosCartaJugador(jugador, param = true) {
  if (jugador === "amigo") {
    if (param) cartaAmigo.style.pointerEvents = "none";
    else cartaAmigo.style.pointerEvents = "auto";
  }
}

function animacionDefensaJugador(jugador) {
  if (jugador === "amigo") {
    cartaAmigo.classList.add("defensa_amigo");
    establecerEventosCartaJugador("amigo", true);
  } else if (jugador === "enemigo") {
    cartaEnemigo.classList.add("defensa_enemigo");
  }
}

function bloqueoJugador(jugador) {
  if (jugador === "amigo") {
    if (juego.amigo.defensa <= juego.amigo.mana) {
      juego.amigo.mana = juego.amigo.mana - juego.amigo.defensa;
      document.getElementById("mana_amigo").textContent = juego.amigo.mana;
    } else {
      document
        .getElementById("tablero_header_amigo_mana")
        .classList.add("bloquear_mana_amigo");
    }
  } else if (jugador === "enemigo") {
    if (juego.enemigo.defensa <= juego.enemigo.mana) {
      juego.enemigo.mana = juego.enemigo.mana - juego.enemigo.defensa;
      document.getElementById("mana_enemigo").textContent = juego.enemigo.mana;
    } else {
      document
        .getElementById("tablero_header_enemigo_mana")
        .classList.add("bloquear_mana_enemigo");
    }
  }
}

function accionEnemigo() {
  if (Math.floor(Math.random() * 2) + 1 === 1) ataqueEnemigo();
  else defensaEnemigo();
}

function reducirAtaqueJugadorMitad(param = "") {
  if (param === true) condicion = true;
  else condicion = false;
}

function obtenerCondicionAtaque() {
  return condicion;
}

export { ataqueAmigo, defensaAmigo };
