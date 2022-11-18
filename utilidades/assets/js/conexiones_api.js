const textoLogin = document.getElementById("textoLogin");
const textoRegistro = document.getElementById("textoRegistro");
const btnSubmit = document.getElementById("btnSubmit");
const btnRegistrar = document.getElementById("btnRegistrar");
const token = document.getElementById("token");
let link = "/apps/php/Duelyst/recursos/conectividad/api.php";

async function mostrarUsuario(email, password, form) {
  let formulario = document.getElementById(form);
  try {
    const res = await fetch(link, {
      method: "POST",
      headers: { "Content-type": "application/json; charset=utf-8" },
      body: JSON.stringify({
        email: email,
        password: password,
        metodo: "mostrar",
      }),
    });
    if (res.status === 200) {
      const data = await res.json();
      if (Object.keys(data).includes("exito")) {
        textoLogin.textContent = data.exito;
        token.value = data.token;
        btnSubmit.disabled = true;
        btnSubmit.style.cursor = "not-allowed";
        setTimeout(function () {
          formulario.submit();
        }, 2500);
      } else {
        textoLogin.textContent = data.error;
      }
    }
  } catch (error) {
    console.log(error);
  }
}

async function registrarUsuario(email, password, form) {
  try {
    const res = await fetch(link, {
      method: "POST",
      headers: { "Content-type": "application/json; charset=utf-8" },
      body: JSON.stringify({
        email: email,
        password: password,
        metodo: "registrar",
      }),
    });
    if (res.status === 200) {
      const data = await res.json();
      if (Object.keys(data).includes("error")) {
        textoRegistro.textContent = data.error;
      } else {
        textoRegistro.textContent = data.exito;
        btnRegistrar.disabled = true;
        btnRegistrar.style.cursor = "not-allowed";
        setTimeout(function () {
          window.location.href = "/apps/php/Duelyst/usuario/login";
        }, 2500);
      }
    }
  } catch (error) {
    console.log(error);
  }
}

export { mostrarUsuario, registrarUsuario };
