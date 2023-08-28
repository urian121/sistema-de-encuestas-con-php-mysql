<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">
          La votaci&oacute;n fue un exito
        </h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p class="text-center thank_voto">
          Gracias por participar en esta encuesta. Echa un vistazo a los
          resultados o comparte esta encuesta con otros.
        </p>
      </div>
      <div class="modal-footer">
        <a href="resultados_encuesta.php?encuesta=<?php echo $code_encuesta; ?>" class="btn btn-primary mt-4">
          <i class="bi bi-bar-chart-fill"></i>
          Resultados
        </a>
        <input type="url" value=" <?php echo $URL_actual; ?>" id="textoParaCopiar" hidden />
        <button class="btn btn-primary mt-4" onclick="copiarTexto()">
          <i class="bi bi-share-fill"></i>
          Copiar link para compartir
        </button>
      </div>
    </div>
  </div>
</div>