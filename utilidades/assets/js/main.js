import * as musica from "./musica.js";
import * as sonido from "./sonido.js";
const botonesContenedorJuego = document.querySelectorAll(
  "#contenedorJuego button"
);
const contenedorModal = document.getElementById("contenedorModal");
const modal = document.getElementById("modal");
let fechaExpiracionCookies = new Date("2030-12-25").toUTCString(),
  cookies,
  cookieEncontradaMusica,
  cookieEncontradaReglas,
  cookieEncontradaImagen,
  imagenesFondo;

botonesContenedorJuego.forEach((element) => {
  element.addEventListener("click", abrirModal);
});

function abrirModal(e) {
  switch (e.target.id) {
    case "btnOpciones":
      crearOpcionesModalMain();
      break;
    case "btnFondos":
      crearFondosModalMain();
      break;
    default:
      break;
  }
}

function crearOpcionesModalMain() {
  configuracionAbrirModalMain();
  if (modal.children.length === 2) modal.innerHTML = "";
  cookieEncontradaMusica = encontrarCookie("reproduccion_cancion");
  cookieEncontradaReglas = encontrarCookie("reglas");
  modal.innerHTML += `
  <div class='cerrar'>
    <span class='material-symbols-outlined' id='btnCerrar'> close </span>
  </div>
  <div class='datosOpciones' id='datosOpciones'>
    <div class='opciones'>
      <div class='opciones_musica'>
        <input type='checkbox' name='cbMusica' id='cbMusica' ${
          cookieEncontradaMusica !== undefined ? `checked` : ""
        }>
        <label for='cbMusica'> Activar/desactivar musica del juego</label><br>
      </div>
      <div class='opciones_reglas'>
        <input type='checkbox' name='cbReglas' id='cbReglas' ${
          cookieEncontradaReglas !== undefined ? `checked` : ""
        }>
        <label for='cbReglas'> Mostrar reglas dentro de la partida</label><br>
      </div>
    </div>
  </div>`;
  funcionalidadBotonMusica();
  funcionalidadBotonReglas();
  funcionalidadBotonCerrar();
}

function crearFondosModalMain() {
  configuracionAbrirModalMain();
  if (modal.children.length === 2) modal.innerHTML = "";
  cookieEncontradaImagen = encontrarCookie("imagenFondo");
  modal.innerHTML += `
  <div class='cerrar'>
    <span class='material-symbols-outlined' id='btnCerrar'> close </span>
  </div>
  <div class='datosFondos'>
    <h3>Selecciona un fondo para el campo de batalla </h3>
    <div class='imagen'>
      <img src='/apps/php/Duelyst/utilidades/assets/images/fondos/astral.jpg' alt='Astral' id='astral'>
    </div>
    <div class='imagen'>
      <img src='/apps/php/Duelyst/utilidades/assets/images/fondos/eoaalien.jpg' alt='Eoalien' id='eoaalien'>
    </div>
    <div class='imagen'>
      <img src='/apps/php/Duelyst/utilidades/assets/images/fondos/panight.jpg' alt='Panight' id='panight'>
    </div>
    <div class='imagen'>
      <img src='/apps/php/Duelyst/utilidades/assets/images/fondos/saiman.jpg' alt='Saiman' id='saiman'>
    </div>
  </div>`;
  funcionalidadImagenesFondo(cookieEncontradaImagen);
  funcionalidadBotonCerrar();
}

function funcionalidadBotonMusica() {
  let cbMusica = document.getElementById("cbMusica");
  cbMusica.addEventListener("click", musica.funcionalidadCancionMain);
}

function funcionalidadBotonReglas() {
  let cbReglas = document.getElementById("cbReglas");
  cbReglas.addEventListener("click", crearCookiesReglas);
}

function funcionalidadBotonCerrar() {
  let btnCerrar = document.getElementById("btnCerrar");
  btnCerrar.addEventListener("click", configuracionCerrarModalMain);
}

function funcionalidadImagenesFondo(clase) {
  imagenesFondo = document.querySelectorAll(".datosFondos img");
  imagenesFondo.forEach((element) => {
    if (clase !== undefined) {
      if (element.id === clase) {
        element.classList.add("imagen_activa");
      }
    }
    element.addEventListener("click", crearCookieImagenFondo);
  });
}

function crearCookiesReglas(e) {
  cookieEncontradaReglas = encontrarCookie("reglas");
  if (e.target.checked === true) {
    if (cookieEncontradaReglas === undefined) {
      document.cookie =
        "reglas=true;expires=" +
        fechaExpiracionCookies +
        "; path=/; SameSite=None; Secure";
    }
  } else {
    if (cookieEncontradaReglas !== undefined) {
      document.cookie =
        "reglas=;expires=Thu, 01 Jan 1970 00:00:01 GMT; path=/; SameSite=None; Secure";
    }
  }
}

function crearCookieImagenFondo(e) {
  imagenesFondo.forEach((element) => {
    if (element.classList.contains("imagen_activa")) {
      element.classList.remove("imagen_activa");
    }
  });
  e.target.classList.add("imagen_activa");
  document.cookie =
    "imagenFondo=" +
    e.target.id +
    ";expires=" +
    fechaExpiracionCookies +
    "; path=/; SameSite=None; Secure";
}

function crearCookieCancion(condicion = true) {
  cookieEncontradaMusica = encontrarCookie("reproduccion_cancion");
  if (condicion) {
    if (cookieEncontradaMusica === undefined) {
      document.cookie =
        "reproduccion_cancion=true;expires=" +
        fechaExpiracionCookies +
        "; path=/; SameSite=None; Secure";
    }
  } else {
    if (cookieEncontradaMusica !== undefined) {
      document.cookie =
        "reproduccion_cancion=;expires=Thu, 01 Jan 1970 00:00:01 GMT; path=/; SameSite=None; Secure";
    }
  }
}

function encontrarCookie(keyCookie) {
  cookies = document.cookie.split(";");
  for (let index = 0; index < cookies.length; index++) {
    cookies[index] = cookies[index].replace(" ", "");
    if (cookies[index].includes(keyCookie)) {
      return cookies[index].replace(keyCookie + "=", "");
    }
  }
  return undefined;
}

function configuracionAbrirModalMain() {
  sonido.reproducirSonidoAbrir();
  contenedorModal.classList.add("modal-open");
}

function configuracionCerrarModalMain() {
  sonido.reproducirSonidoCerrar();
  contenedorModal.classList.remove("modal-open");
}

musica.funcionalidadCancionMain(
  undefined,
  encontrarCookie("reproduccion_cancion")
);

export { crearCookieCancion };
