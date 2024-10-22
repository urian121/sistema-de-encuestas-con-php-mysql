function procesarVotacion(
  buttonElement,
  code_encuesta,
  solicitar_nombre_participante,
  miArrayOptiones
) {
  let respuesta_valida = true;

  /**
   * Validar que haya seleccionado al menos una opcion
   */
  if (!validarSeleccionRadio()) {
    console.log("caso 3, debe seleccionar una opcion");
    respuesta_valida = false;
  }

  let votante = "";
  if (solicitar_nombre_participante == "1") {
    votante = document.querySelector("#nombre_votante").value;
    if (votante == "") {
      alertDanger_encuesta("Debe escribir su nombre");
      return;
    }
  }

  /**
   * Procesar el formulario ya que ha pasado todas las validaciones
   */
  if (respuesta_valida) {
    buttonElement.innerHTML =
      "Enviando encuesta... <i class='bi bi-arrow-right-circle'></i>";

    let valor_option = document.querySelectorAll('input[type="radio"]:checked');
    let opcionSeleccionada = valor_option[0];
    let opcion = opcionSeleccionada.getAttribute("data-opcion");

    let ruta = "code_encuesta/acciones_encuesta.php";
    let dataString = `accion=registarVotacion&code_encuesta=${code_encuesta}&respuesta_encuesta=${opcion}&nombre_votante=${votante}&miArrayOptiones=${miArrayOptiones}`;
    axios
      .post(ruta, dataString)
      .then((response) => {
        resp = response.data.respuesta;
        if (resp == "ya voto") {
          alertDanger_encuesta("Ya ha participado en esta encuesta");
          limpiarVotacion(buttonElement, solicitar_nombre_participante);
          console.log("ya voto");
        } else if (resp == "ok") {
          alertSuccess_encuesta("La votaci&oacute;n fue un exito");
          limpiarVotacion(buttonElement, solicitar_nombre_participante);
          setTimeout(function () {
            $("#exampleModal").modal("show");
          }, 500);
          buttonElement.innerHTML = "Votar";
          crearCookieHaVotado();
        } else {
          console.log(response.data.respuesta);
        }
      })
      .catch((error) => {
        console.error("Error al realizar la petición: ", error);
      });
    return false;
  }
}

/**
 * Validar que se haya seleccionado una opcion en la encuesta
 */
function validarSeleccionRadio() {
  let opciones = document.querySelectorAll('input[type="radio"]:checked');
  if (opciones.length === 0) {
    alertDanger_encuesta("Debe seleccionar una opción antes de votar");
    return false;
  }
  return true;
}

/**
 * obtener la ip del votante
 */
async function getPublicIPAddress() {
  try {
    const response = await fetch("https://api64.ipify.org/?format=json");
    if (!response.ok) {
      throw new Error("Error al obtener la dirección IP pública");
    }
    const data = await response.json();
    return data.ip;
  } catch (error) {
    console.error("Error:", error);
    return null;
  }
}

/**
 * Limpiar formulario de votacion
 */
function limpiarVotacion(buttonElement, solicitar_nombre_participante) {
  if (solicitar_nombre_participante == "1") {
    document.querySelector("#nombre_votante").value = "";
  }
  buttonElement.remove();
  let radios = document.querySelectorAll('input[type="radio"]');
  radios.forEach((radio) => {
    radio.checked = false;
  });
}

function alertDanger_encuesta(msj) {
  const alertHTML = `
<div class="alert alert-danger" role="alert">
  <i class="bi bi-exclamation-triangle"></i>
  ${msj}
</div>
`;

  const divContenedor = document.querySelector(".btnsFlexbox");
  divContenedor.insertAdjacentHTML("beforebegin", alertHTML);

  const mensajeAlerta = divContenedor.previousElementSibling;

  setTimeout(() => {
    if (mensajeAlerta) {
      mensajeAlerta.remove();
    }
  }, 5000);
}

function alertSuccess_encuesta(msj) {
  const alertHTML = `
<div class="alert alert-success" role="alert">
  <i class="bi bi-check2-circle"></i>
  ${msj}
</div>
`;

  const divContenedor = document.querySelector(".btnsFlexbox");
  divContenedor.insertAdjacentHTML("beforebegin", alertHTML);

  const mensajeAlerta = divContenedor.previousElementSibling;

  setTimeout(() => {
    if (mensajeAlerta) {
      mensajeAlerta.remove();
    }
  }, 5000);
}

/**
 * Alerta personalizada
 */
function mostrarAlerta(mensaje) {
  // Obtiene una referencia al elemento de destino con la clase específica
  var elementoObjetivo = document.querySelector(".btnsFlexbox");

  if (elementoObjetivo) {
    // Define el contenido HTML de la alerta con el mensaje personalizado
    var contenidoHTML = `
      <div class="alert alert-danger" role="alert">
        <i class="bi bi-exclamation-triangle"></i>
        <strong>Lo sentimos,</strong>
        ${mensaje}
      </div>
    `;

    // Inserta la alerta como el primer elemento hijo del elemento de destino
    elementoObjetivo.insertAdjacentHTML("beforebegin", contenidoHTML);

    // Programa la eliminación de la alerta después de 5 segundos
    setTimeout(() => {
      var miAlert = document.querySelector(".alert.alert-danger");
      if (miAlert) {
        miAlert.remove();
      }
    }, 10000);
  }
}

/**
 * DOMContentLoaded
 */
addEventListener("DOMContentLoaded", (event) => {
  /**
   * Validando si el usuario esta coinectado por VPN
   */
  main_verificarProxy();

  /**
   * Validar si el usuario tiene la cookies de que ya ha votados
   */
  if (verificarCookieHaVotado()) {
    console.log("La cookie 'ha_votado' existe...");
    alertDanger_encuesta(
      "Lo sentimos, tu voto ya ha sido registrado. Gracias por participar."
    );
  } else {
    console.log("La cookie 'ha_votado' no existe.");
  }
});

/**
 * Función para verificar si la cookie 'ha_votado' existe
 */
function verificarCookieHaVotado() {
  if (
    document.cookie.split("; ").some((cookie) => cookie === "ha_votado=true")
  ) {
    let btn_votar = document.querySelector(".btn_votar");
    if (btn_votar) {
      btn_votar.remove();
    }
    console.log("existe la cookies");
    return true;
  }
  console.log("No existe la cookies");
  return false;
}

/**
 * Crear cookies
 */
function crearCookieHaVotado() {
  var ahora = new Date();
  ahora.setTime(ahora.getTime() + 24 * 60 * 60 * 1000); // 1 día en milisegundos
  // Crea la cookie 'ha_votado' con valor 'true' y fecha de expiración
  document.cookie =
    "ha_votado=true; expires=" + ahora.toUTCString() + "; path=/";
  console.log("Cookie creada con duración de un día");
}

// Uso de la función para verificar si la IP es un proxy
async function checkProxy() {
  const result = await isproxyip();
  console.log("***", result);
  return result; // Retorna el resultado obtenido de isproxyip()
}

async function main_verificarProxy() {
  if (await checkProxy()) {
    console.log("Esta PC está usando VPN, no puede votar");
    mostrarAlerta(
      "No puedes participar en la votación mientras estés utilizando una VPN. Por favor, accede a la encuesta sin activar una VPN."
    );
    let btn_votar = document.querySelector(".btn_votar");
    if (btn_votar) {
      btn_votar.remove();
    }
  } else {
    console.log("La PC no está usando VPN, puede votar.");
    // Continúa con el flujo normal de votación si no se detecta una VPN
  }
}
/**
 * Validar votacion por VPN
 */
async function isproxyip() {
  if (window.location.pathname.includes("wp-cron.php")) {
    return false;
  }

  const api_key = "eqpO5je9q97vJNMpTZAI3i9eKSBIGjSJUoo5nM7I6VLFw8qHfw";
  const publicIp = await getPublicIPAddress(); // Obtener la dirección IP pública

  if (!publicIp) {
    console.error("No se pudo obtener la dirección IP pública.");
    return false;
  }

  const ip = encodeURIComponent(publicIp); // Utilizar la dirección IP pública
  const api_url = `https://api.isproxyip.com/v1/check.php?key=${api_key}&ip=${ip}`;

  try {
    const response = await fetch(api_url);

    if (response.ok) {
      const data = await response.text();
      if (data === "Y") {
        // IP es un proxy
        return true;
      } else {
        return false;
      }
    } else {
      throw new Error("Error en la solicitud a la API");
    }
  } catch (error) {
    console.error(error);
    return false;
  }
}
