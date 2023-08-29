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
});
