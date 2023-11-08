document.addEventListener("DOMContentLoaded", function () {
  const checkboxContainers = document.querySelectorAll(".checkboxContainer");
  checkboxContainers.forEach(function (checkboxContainer) {
    const label = checkboxContainer.querySelector(".form-check-label");
    const checkbox = label.querySelector(".form-check-input");

    label.addEventListener("click", function (event) {
      if (event.target !== checkbox) {
        checkbox.checked = !checkbox.checked;
      }
    });
  });

  /**
   * Mostrar alerta luego de que la encuesta fue registrada correctamente
   */
  function getParameterByName(name, url) {
    if (!url) url = window.location.href;
    name = name.replace(/[\[\]]/g, "\\$&");
    var regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)"),
      results = regex.exec(url);
    if (!results) return null;
    if (!results[2]) return "";
    return decodeURIComponent(results[2].replace(/\+/g, " "));
  }

  // Verificar si la URL contiene "msj=success"
  var mensaje = getParameterByName("msj");
  if (mensaje === "success") {
    // Crear la alerta
    var alerta = document.createElement("div");
    alerta.className = "alert alert-success";
    alerta.role = "alert";
    alerta.innerHTML =
      '<i class="bi bi-check2-circle"></i><strong>Felicitaciones,</strong> tu encuesta fue creada correctamente.';

    // Mostrar la alerta en el contenedor
    var contenedor = document.querySelector("#resp_notification");
    contenedor.appendChild(alerta);

    // Ocultar la alerta después de 8 segundos
    setTimeout(function () {
      alerta.style.display = "none";
    }, 8000);
  }
});
