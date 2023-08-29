let inic = 2;
const agregarOpcion = () => {
  inic++;

  $("#nuevasOpciones").append(`
  <div class="col-md-12" id="opcion_${inic}">
    <input type="text" name="encuesta[]" class="form-control" placeholder="Opción ${inic}" />
    <button type="button" class="btn btn-warning mt-2 mb-2" onclick="borrarOption('${inic}');"
        style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;">
        <i class="bi bi-trash3-fill"></i>
        Eliminar
    </button>
  </div>
`);
};

/**
 * Borrar option
 */
const borrarOption = (valor) => {
  $("#opcion_" + valor).remove();
};

function dateTimePicker(config) {
  return {
    datetime: null,
    error: null,
    init() {
      if (config.unixtime) {
        this.epochToDatetime(config.unixtime);
      }
      this.setDateTime();
    },
    epochToDatetime(epoch) {
      this.datetime = dayjs(epoch * 1000).format("YYYY-MM-DDTHH:mm");
    },
    setDateTime() {
      this.error = null;
      if (!this.datetime) {
        this.poll.pollConfig.deadlineAt = null;
        return;
      }

      const date = new Date(this.datetime);
      const now = new Date();

      if (date.getTime() < now.getTime() - 120000) {
        this.error = "Seleccione una fecha en el futuro.";
        return;
      }

      this.poll.pollConfig.deadlineAt = Math.round(date.getTime() / 1000);
    },
  };
}

/**
 * Funcion para copiar link de encuesta
 */
function copiarTexto() {
  var texto = document.getElementById("textoParaCopiar").value;
  navigator.clipboard
    .writeText(texto)
    .then(() => {
      alertSuccess("Link copiado!");
    })
    .catch((error) => {
      console.error("Error al copiar el texto: ", error);
    });
}

/**
 * Procesar la votacion
 */
function procesarVotacion(buttonElement, code_encuesta) {
  var opciones = document.querySelectorAll('input[type="radio"]:checked');
  if (opciones.length === 0) {
    alertDanger("Debe seleccionar una opción antes de votar");
    return;
  }

  buttonElement.innerHTML =
    "Enviando encuesta... <i class='bi bi-arrow-right-circle'></i>";

  var opcionSeleccionada = opciones[0];
  //  var preguntaId = opcionSeleccionada.getAttribute("id");
  var opcion = opcionSeleccionada.getAttribute("data-opcion");

  let ruta = "code_encuesta/acciones_encuesta.php";
  let dataString = `accion=registarVotacion&code_encuesta=${code_encuesta}&respuesta_encuesta=${opcion}`;
  axios
    .post(ruta, dataString)
    .then((response) => {
      resp = response.data.respuesta;
      if (resp == "ya voto") {
        alertDanger("Ya ha participado en esta encuesta");
        console.log("ya voto");
      } else if (resp == "ok") {
        alertSuccess("La votaci&oacute;n fue un exito");
        setTimeout(function () {
          buttonElement.innerHTML =
            "Votar <i class='bi bi-arrow-right-circle'></i>";
          $("#exampleModal").modal("show");
        }, 1000);
      } else {
        console.log(response.data.respuesta);
      }
    })
    .catch((error) => {
      console.error("Error al realizar la petición: ", error);
    });
  return false;
}

function alertDanger(msj) {
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

/**
 * Funcion para retornar una alerta tipo success
 */
function alertSuccess(msj) {
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
 *
 */
// Obtener una lista de todos los inputs en la página
let inputs = document.querySelectorAll("input");
if (inputs.length > 0) {
  // Iterar a través de la lista de inputs
  inputs.forEach(function (input) {
    // Agregar un evento para detectar cuando el usuario escriba en el input
    input.addEventListener("input", function () {
      // Obtener el valor del input
      var inputValue = input.value;

      // Verificar si el valor no está vacío
      if (inputValue.length > 0) {
        // Convertir la primera letra a mayúscula y concatenar el resto del texto
        var capitalizedValue =
          inputValue.charAt(0).toUpperCase() + inputValue.slice(1);

        // Establecer el valor modificado de nuevo en el input
        input.value = capitalizedValue;
      }
    });
  });
}

/**
 * Verificar si existe alguna alerta alert-success
 */
if (document.querySelector(".alert-success")) {
  setTimeout(function () {
    document.querySelector(".alert-success").remove();
  }, 5000);
}
