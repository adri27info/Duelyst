import * as main from "./main.js";
import * as sonido from "./sonido.js";

function funcionalidadCancionMain(e, cookie) {
  if (e === undefined) {
    if (cookie !== undefined) {
      sonido.reproducirCancionMain();
    }
  } else {
    if (e.target.checked === true) {
      main.crearCookieCancion();
      sonido.reproducirCancionMain();
    } else {
      main.crearCookieCancion(false);
      sonido.reproducirCancionMain(false);
    }
  }
}

export { funcionalidadCancionMain };
