function procesarVotacion(
  buttonElement,
  code_encuesta,
  solicitar_nombre_participante
) {
  let respuesta_valida = true;
  /**
   * Verificar cookies
   */
  if (!verificarCookieHaVotado()) {
    console.log("caso 1, La cookies indica que ya voto");
    mostrarAlerta("tu voto ya ha sido registrado. Gracias por participar");
    respuesta_valida = false;
  }

  if (!checkProxy()) {
    console.log("Esta pc esta usando VPN, no puede votar");
    mostrarAlerta(
      "No puedes participar en la votación mientras estés utilizando una VPN. Por favor, accede a la encuesta sin activar una VPN"
    );
    respuesta_valida = false;
  }

  /**
   * Validar que haya seleccionado al menos una opcion
   */
  if (!validarSeleccionRadio()) {
    console.log("caso 3, debe seleccionar una opcion");
    respuesta_valida = false;
  }

  /**
   * Validar User Agents
   */
  if (!validarUserAgent()) {
    respuesta_valida = false;
    console.log("caso 5");
    //https://www.youtube.com/watch?v=sFLGexOP_IU
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

    var opcionSeleccionada = opciones[0];
    //  var preguntaId = opcionSeleccionada.getAttribute("id");
    var opcion = opcionSeleccionada.getAttribute("data-opcion");

    let ruta = "code_encuesta/acciones_encuesta.php";
    let dataString = `accion=registarVotacion&code_encuesta=${code_encuesta}&respuesta_encuesta=${opcion}&nombre_votante=${votante}`;
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
          crearCookieHaVotado(2);
          // crearCookieHaVotado(1440); //1 dia en minutos 1440
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
 * Crear cookies
 */
function crearCookieHaVotado(minutes) {
  var date = new Date();
  date.setTime(date.getTime() + minutes * 60 * 1000); // Duración en minutos
  document.cookie =
    "ha_votado=true; expires=" + date.toUTCString() + "; path=/";
}

/**
 * Función para verificar si la cookie 'ha_votado' existe
 */
function verificarCookieHaVotado() {
  return document.cookie.indexOf("ha_votado=true") !== -1;
}

/**
 * Vericar por User Agents
 */
function validarUserAgent() {
  var userAgent = navigator.userAgent.toLowerCase();
  console.log(userAgent);

  // Verificar si el User-Agent contiene información específica
  if (
    userAgent.indexOf("firefox") !== -1 ||
    userAgent.indexOf("chrome") !== -1 ||
    userAgent.indexOf("safari") !== -1 ||
    userAgent.indexOf("edge") !== -1 ||
    userAgent.indexOf("opera") !== -1 ||
    userAgent.indexOf("brave") !== -1
  ) {
    console.log("Acceso permitido");
    return true;
  } else {
    console.log("Navegador desconocido o no compatible");
    return false;
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

// Uso de la función para verificar si la IP es un proxy
async function checkProxy() {
  const result = await isproxyip();
  console.log(result);
  console.log("Esta pc tiene VPN");
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

  buttonElement.innerHTML = "Votar <i class='bi bi-arrow-right-circle'></i>";

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
/**
 * Alerta personalizada
 */
function mostrarAlerta(mensaje) {
  // Obtiene la referencia al elemento div con la clase 'btnsFlexbox'
  var targetDiv = document.querySelector(".btnsFlexbox");

  // Define el contenido HTML de la alerta con el mensaje personalizado
  var contenidoHTML = `
    <div class="alert alert-danger" role="alert">
      <i class="bi bi-exclamation-triangle"></i>
      <strong>Lo sentimos,</strong>
      ${mensaje}
    </div>
  `;

  // Establece el contenido HTML en el elemento div de destino
  targetDiv.innerHTML = contenidoHTML;

  // Programa la eliminación de la alerta después de 5 segundos
  setTimeout(() => {
    var miAlert = document.querySelector(".alert.alert-danger");
    if (miAlert) {
      miAlert.remove();
    }
  }, 5000);
}
