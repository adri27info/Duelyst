import * as sonido from "./sonido.js";
import * as accionJugador from "./acciones_jugadores.js";
const tableroJuego = document.getElementsByClassName("tablero_juego")[0];
const modalJuego = document.getElementById("modalJuego");
const imagenAtaque = document.getElementById(
  "tablero_carta_amigo_logo_imagen_ataque"
);
const imagenDefensa = document.getElementById(
  "tablero_carta_amigo_logo_imagen_defensa"
);
let contenedorModalJuego = document.getElementById("contenedorModalJuego");
let enemigo = {
  ataque: parseInt(document.getElementById("ataque_enemigo").textContent),
  defensa: parseInt(document.getElementById("defensa_enemigo").textContent),
  vida: parseInt(
    document.getElementById("tablero_header_enemigo_vida").children.length
  ),
  mana: parseInt(document.getElementById("mana_enemigo").textContent),
};
let amigo = {
  ataque: parseInt(document.getElementById("ataque_amigo").textContent),
  defensa: parseInt(document.getElementById("defensa_amigo").textContent),
  vida: parseInt(
    document.getElementById("tablero_header_amigo_vida").children.length
  ),
  mana: parseInt(document.getElementById("mana_amigo").textContent),
};
imagenAtaque.addEventListener("click", accionJugador.ataqueAmigo);
imagenDefensa.addEventListener("click", accionJugador.defensaAmigo);

/* ---------------- GENERALES - JUEGO ---------------- */

function obtenerDatosJuego(estado_partida = "") {
  let dataJuego = document.getElementById("dataJuego");
  let clasesDataJuego = dataJuego.classList;
  let objDataJuego = [];
  clasesDataJuego.forEach((element) => {
    if (estado_partida !== "") {
      if (element.includes("empate")) element = estado_partida;
    }
    objDataJuego.push(element);
  });
  return objDataJuego;
}

function obtenerCancionTablero() {
  if (tableroJuego.classList[1] === "true") {
    reproducirCancionTablero();
  }
}

function obtenerImagenTablero() {
  let imagenTablero = tableroJuego.id.replace("tablero_juego_", "");
  asignarEstilosTablero(imagenTablero);
}

function asignarEstilosTablero(imagen) {
  tableroJuego.style.width = "100%";
  tableroJuego.style.minHeight = "100vh";
  tableroJuego.style.backgroundImage =
    "url('/apps/php/Duelyst/utilidades/assets/images/fondos/" + imagen + "')";
  tableroJuego.style.backgroundSize = "cover";
  tableroJuego.style.backgroundRepeat = "no-repeat";
  tableroJuego.style.backgroundPosition = "center";
  comprobarReglas();
}

function comprobarReglas() {
  let btnModalJuego = document.getElementById("btnModalJuego");
  if (btnModalJuego !== null) {
    btnModalJuego.addEventListener("click", abrirModalJuego);
  }
}

function abrirModalJuego() {
  configuracionAbrirModalJuego();
  if (modalJuego.children.length === 2) modalJuego.innerHTML = "";
  modalJuego.innerHTML += `
  <div class="cerrar">
    <span class="material-symbols-outlined" id="btnCerrar"> close </span>
  </div>
  <div class="reglasJuego">
    <h3>Reglas</h3>
    <div class="datosReglas">
      <span> 1: Cada jugador empieza siempre con 20 de vida y 50 de mana.</span>
      <span> 2: El mana se gastara y se ira reduciendo siempre que el jugador se defienda. </span>
      <span> 3: El mana gastado se gastara dependiendo de la defensa del heroe.</span>
      <span> 4: Cuando el usuario se defienda, el ataque del enemigo se reducira en 1/2 si es que ataca.</span>
      <span> 5: El primer jugador que derrote a el heroe contricante del enemigo, ganara la partida.</span>
    </div>
  </div>`;
  funcionalidadBotonCerrarModalJuego();
}

function funcionalidadBotonCerrarModalJuego() {
  let btnCerrar = document.getElementById("btnCerrar");
  btnCerrar.addEventListener("click", configuracionCerrarModalJuego);
}

function configuracionAbrirModalJuego() {
  sonido.reproducirSonidoAbrir();
  contenedorModalJuego.classList.add("modal-open");
}

function configuracionCerrarModalJuego() {
  sonido.reproducirSonidoCerrar();
  contenedorModalJuego.classList.remove("modal-open");
}

function reproducirCancionTablero() {
  sonido.reproducirCancionJuego();
}

function configuracionAtaque() {
  sonido.reproducirSonidoAtaque();
}

function configuracionDefensa() {
  sonido.reproducirSonidoDefensa();
}

obtenerImagenTablero();
obtenerCancionTablero();
obtenerDatosJuego();

export {
  enemigo,
  amigo,
  obtenerDatosJuego,
  configuracionAtaque,
  configuracionDefensa,
};
