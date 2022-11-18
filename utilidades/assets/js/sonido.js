let audioMain;

function reproducirCancionMain(param) {
  if (param === false) {
    audioMain.pause();
    audioMain = undefined;
  } else {
    audioMain = new Audio(
      "/apps/php/Duelyst/utilidades/assets/sonidos/main_theme.mp3"
    );
    audioMain.play();
  }
}

function reproducirCancionJuego() {
  let audioJuego = new Audio(
    "/apps/php/Duelyst/utilidades/assets/sonidos/game_theme.mp3"
  );
  audioJuego.play();
}

function reproducirSonidoAbrir() {
  let sonidoOpen = new Audio(
    "/apps/php/Duelyst/utilidades/assets/sonidos/click_open.wav"
  );
  sonidoOpen.volume = 1;
  sonidoOpen.play();
}

function reproducirSonidoCerrar() {
  let sonidoClose = new Audio(
    "/apps/php/Duelyst/utilidades/assets/sonidos/click_close.wav"
  );
  sonidoClose.volume = 1;
  sonidoClose.play();
}

function reproducirSonidoAtaque() {
  let sonidoAtaque = new Audio(
    "/apps/php/Duelyst/utilidades/assets/sonidos/attack.wav"
  );
  sonidoAtaque.volume = 1;
  sonidoAtaque.play();
}

function reproducirSonidoDefensa() {
  let sonidoDefensa = new Audio(
    "/apps/php/Duelyst/utilidades/assets/sonidos/defense.mp3"
  );
  sonidoDefensa.volume = 1;
  sonidoDefensa.play();
}

export {
  reproducirCancionMain,
  reproducirCancionJuego,
  reproducirSonidoAbrir,
  reproducirSonidoCerrar,
  reproducirSonidoAtaque,
  reproducirSonidoDefensa,
};
