let inic = 2;
const agregarOpcion = () => {
  inic++;

  $("#nuevasOpciones").append(`
  <div class="col-md-12" id="opcion_${inic}">
    <input type="text" name="opciones_encuesta[]" class="form-control" placeholder="Opción ${inic}" />
    <button type="button" class="btn btn-warning mt-2 mb-2" onclick="borrarOption('${inic}');"
        style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;">
        <i class="bi bi-trash3-fill"></i>
        Eliminar
    </button>
  </div>
`);
};

let inicio = 2;
const agregarOpcionImgs = () => {
  inicio++;

  $("#nuevasOpcionesImg").append(`
    <div class="col-md-6 text-center" id="opcion_${inicio}">
        <span>Cargar imagen</span>
        <label class="dropimage miniprofile">
            <input type="file" name="encuesta_file[]" required accept="image/*" alt="Imagen-encuesta">
        </label>
        <input type="text" name="opciones_encuesta[]" class="form-control mt-1" placeholder="Opción ${inicio}"  required />
      <div style="float: left;">
        <button type="button" class="btn btn-warning mt-2 mb-2" onclick="borrarOption('${inicio}');"
          style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;">
          <i class="bi bi-trash3-fill"></i>
          Eliminar
        </button>
      </div>
    </div>
    `);
  iniciarVistaPreviaImagenes();
};

function crear_encuesta_optiones_generales() {
  $("#opciones_encuesta_general").append(`
          <div class="col-md-12">
              <label for="Opciones de respuesta">Opciones de respuesta</label>
              <input type="text" name="opciones_encuesta[]" class="form-control" placeholder="Opción 1" required />
          </div>
          <div class="col-md-12 mt-3 mb-3">
              <input type="text" name="opciones_encuesta[]" class="form-control" placeholder="Opción 2" required />
          </div>
          <div id="nuevasOpciones"></div>
          <div class="col-md-6 mt-3">
              <button type="button" class="btn btn-primary" onclick="agregarOpcion()">
                  <i class="bi bi-plus"></i>
                  Añadir opción
              </button>
          </div>
    `);
}

function crear_encuesta_imagen() {
  $("#encuesta_img").append(`
         <div class="col-md-12 text-center">
              <p><strong> Opciones de respuesta </strong>
                  <hr>
              </p>
          </div>
          <div class="col-md-6 text-center">
              <span>Cargar imagen</span>
              <label class="dropimage miniprofile">
                  <input type="file" name="encuesta_file[]" required accept="image/*" alt="Imagen-encuesta">
              </label>
              <input type="text" name="opciones_encuesta[]" class="form-control mt-1" placeholder="Opción 1" required />
          </div>
          <div class="col-md-6 text-center">
              <span>Cargar imagen</span>
              <label class="dropimage miniprofile">
                  <input type="file" name="encuesta_file[]" required accept="image/*" alt="Imagen-encuesta">
              </label>
              <input type="text" name="opciones_encuesta[]" class="form-control mt-1" placeholder="Opción 2" required />
          </div>
          <div class="row" id="nuevasOpcionesImg"></div>

          <div class="col-md-6 mt-3" id="content_btn_img">
              <button type="button" class="btn btn-primary" onclick="agregarOpcionImgs()">
                  <i class="bi bi-plus"></i>
                  Añadir opción
              </button>
          </div>
    `);

  iniciarVistaPreviaImagenes();
}

function iniciarVistaPreviaImagenes() {
  [].forEach.call(document.querySelectorAll(".dropimage"), function (img) {
    img.onchange = function (e) {
      var inputfile = this,
        reader = new FileReader();
      reader.onloadend = function () {
        inputfile.style["background-image"] = "url(" + reader.result + ")";
      };
      reader.readAsDataURL(e.target.files[0]);
    };
  });
}

/**
 * Borrar option
 */
const borrarOption = (opcionId) => {
  const opcion = document.querySelector(`#opcion_${opcionId}`);
  if (opcion) {
    opcion.remove();
  }
};

const filtar_tipo_encuesta = (option) => {
  if (option == "Seleccion multiple") {
    document.querySelector("#opciones_encuesta_general").style.display = "flex";
    document.querySelector("#encuesta_img").innerHTML = "";
    crear_encuesta_optiones_generales();
  } else {
    crear_encuesta_imagen();

    document.querySelector("#opciones_encuesta_general").innerHTML = "";
    let nuevasOpciones = document.querySelector("#nuevasOpciones");
    if (nuevasOpciones) {
      nuevasOpciones.innerHTML = "";
    }
  }
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
let inputs = document.querySelectorAll("input[type='text']");
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

addEventListener("DOMContentLoaded", (event) => {
  let elemento = document.querySelector("#opciones_encuesta_general");
  if (elemento) {
    elemento.innerHTML = `   
          <div class="col-md-12">
              <label for="Opciones de respuesta">Opciones de respuesta</label>
              <input type="text" name="opciones_encuesta[]" class="form-control" placeholder="Opción 1" required />
          </div>
          <div class="col-md-12 mt-3 mb-3">
              <input type="text" name="opciones_encuesta[]" class="form-control" placeholder="Opción 2" required />
          </div>
          <div id="nuevasOpciones"></div>
          <div class="col-md-6 mt-3">
              <button type="button" class="btn btn-primary" onclick="agregarOpcion()">
                  <i class="bi bi-plus"></i>
                  Añadir opción
              </button>
          </div>`;
  }
});
