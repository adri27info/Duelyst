import * as api from "./conexiones_api.js";
import * as sonido from "./sonido.js";
const formulario = document.getElementById("formulario");
const formularioRegistro = document.getElementById("formularioRegistro");
const correo = formulario.correo;
const password = formulario.password;
const correo_registro = formularioRegistro.correo_registro;
const password_registro = formularioRegistro.password_registro;
const inputs = document.getElementsByTagName("input");
const expresiones = {
  correo: /^\w+([.-_+]?\w+)*@\w+([.-]?\w+)*(\.\w{2,10})+$/,
  password: /^[a-zA-Z0-9_/,.]{4,20}$/,
};
const expresionesRegistro = {
  correo_registro: /^\w+([.-_+]?\w+)*@\w+([.-]?\w+)*(\.\w{2,10})+$/,
  password_registro: /^[a-zA-Z0-9_/,.]{4,20}$/,
};
const validaciones = {
  correo: false,
  password: false,
};
const validacionesRegistro = {
  correo_registro: false,
  password_registro: false,
};
const btnModal = document.getElementById("btnModal");
const contenedorModal = document.getElementById("contenedorModal");

btnModal.addEventListener("click", abrirModal);

formularioRegistro.addEventListener("submit", (e) => {
  e.preventDefault();
  enviarFormulario(e);
});

formulario.addEventListener("submit", (e) => {
  e.preventDefault();
  enviarFormulario(e);
});

function enviarFormulario(e) {
  let id = e.target.id;
  if (id === "formulario") {
    reutilizarFormularios(
      "mostrarUsuario",
      correo.value,
      password.value,
      "formulario",
      document.querySelectorAll("#formulario div"),
      validaciones
    );
  } else if (id === "formularioRegistro") {
    reutilizarFormularios(
      "registrarUsuario",
      correo_registro.value,
      password_registro.value,
      "formularioRegistro",
      document.querySelectorAll("#formularioRegistro div"),
      validacionesRegistro
    );
  }
}

function asignarEventosInputs() {
  limpiarInputs();
  for (let index = 0; index < inputs.length; index++) {
    if (inputs[index].type === "text" || inputs[index].type === "password") {
      inputs[index].addEventListener("blur", validarFormulario);
      inputs[index].addEventListener("keyup", validarFormulario);
    }
  }
}

function validarFormulario(e) {
  switch (e.target.id) {
    case "correo":
      validarCampo(correo.value, expresiones.correo, "error_correo", "correo");
      break;
    case "password":
      validarCampo(
        password.value,
        expresiones.password,
        "error_password",
        "password"
      );
      break;
    case "correo_registro":
      validarCampo(
        correo_registro.value,
        expresionesRegistro.correo_registro,
        "error_correo_registro",
        "correo_registro"
      );
      break;
    case "password_registro":
      validarCampo(
        password_registro.value,
        expresionesRegistro.password_registro,
        "error_password_registro",
        "password_registro"
      );
      break;
    default:
      break;
  }
}

function validarCampo(valor, expresion, textoSpan, nombre) {
  let contenedorSpan = document.getElementById(textoSpan).parentNode;
  let padreContenedorSpan = contenedorSpan.parentNode;
  if (!expresion.test(valor)) {
    contenedorSpan.classList.remove("ocultar");
    padreContenedorSpan.id === "formulario"
      ? (validaciones[nombre] = false)
      : (validacionesRegistro[nombre] = false);
  } else {
    contenedorSpan.classList.add("ocultar");
    padreContenedorSpan.id === "formulario"
      ? (validaciones[nombre] = true)
      : (validacionesRegistro[nombre] = true);
  }
}

function reutilizarFormularios(
  metodo,
  param1Form,
  param2Form,
  nombreForm,
  valorContenedores,
  bucle
) {
  let contador = 0;
  let contenedores = valorContenedores;
  for (let key in bucle) {
    if (bucle[key] === true) {
      contador++;
    }
  }
  if (contador === 2) {
    if (metodo === "mostrarUsuario") {
      api.mostrarUsuario(param1Form, param2Form, nombreForm);
    } else {
      api.registrarUsuario(param1Form, param2Form, nombreForm);
    }
  } else {
    contenedores.forEach((element) => {
      let contenedor = element.classList[0];
      for (let iterator in bucle) {
        if (bucle[iterator] === false) {
          let cadena = "contenedor" + iterator;
          if (cadena === contenedor.toLocaleLowerCase())
            element.classList.remove("ocultar");
        }
      }
    });
  }
}

function limpiarInputs() {
  correo.value = "";
  password.value = "";
  correo_registro.value = "";
  password_registro.value = "";
}

function abrirModal() {
  configuracionAbrirModalRegistro();
  funcionalidadBotonCerrarModalRegistro();
}

function configuracionAbrirModalRegistro() {
  sonido.reproducirSonidoAbrir();
  contenedorModal.classList.add("modal-open");
}

function funcionalidadBotonCerrarModalRegistro() {
  let btnCerrar = document.getElementById("btnCerrar");
  btnCerrar.addEventListener("click", cerrarModal);
}

function cerrarModal() {
  sonido.reproducirSonidoCerrar();
  contenedorModal.classList.remove("modal-open");
}

asignarEventosInputs();
