<!DOCTYPE html>
<html lang="en">
<?php include('includes/head.html'); ?>
<link rel="stylesheet" href="assets/css/my_custom.css">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Llenar encuesta</title>
</head>

<body>
    <?php
    ini_set('display_errors', 1);
    error_reporting(E_ALL);
    include('includes/header.html');

    /**
     * Verificando si esta presente el codigo de la encuesta
     */
    include('code_encuesta/acciones_encuesta.php');
    $isSecure = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') || $_SERVER['SERVER_PORT'] == 443;
    $protocol = $isSecure ? 'https://' : 'http://';
    $host = $_SERVER['HTTP_HOST'];
    $URL_actual = $protocol . $host . $_SERVER['REQUEST_URI'];

    /**
     * Verificando si esta presente el codigo de la encuesta
     */
    if (isset($_GET['encuesta'])) {
        $code_encuesta = $_GET['encuesta'];
        if (!validarEncuestaCode($con, $code_encuesta)) {
            echo '<meta http-equiv="refresh" content="0;URL=https://encuestalocal.com/" />';
        }
    } else {
        header("Location: index.php");
        exit;
    }

    $resultadoDetalleEncuesta = obtenerEncuesta($con, $code_encuesta);
    $resultadoPreguntas = obtenerPreguntas($con, $code_encuesta);
    $respuestaComentarios = obtenerComentarios($con, $code_encuesta);
    $respuestaUserAgents = obtenerUserAgents($con, $code_encuesta);
    include('modal.php');
    ?>


    <main id="main mt-5 mb-5">
        <section id="contact" class="contact mt-5">
            <div class="container" data-aos="fade-up">
                <?php
                if (isset($_GET['msj']) && $_GET['msj'] === 'success') { ?>
                    <div class="alert alert-success" role="alert">
                        <i class="bi bi-check2-circle"></i>
                        <strong>Felicitaciones,</strong>
                        tu encuesta fue creada correctamente.
                    </div>
                <?php } ?>


                <div class="row justify-content-md-center mb-5">
                    <div class="col-md-10 box_shadox">
                        <h3 class="text-center mt-3 mb-5">
                            <strong>
                                <?php echo $resultadoDetalleEncuesta['titulo_encuesta']; ?>
                            </strong>
                            <p style="font-size: 12px;" id="date_created_at">La encuesta fue creada hace</p>
                            <hr>
                        </h3>


                        <div class="mb-5 mt-3" style="width: 90%; margin:0 auto;">
                            <h4 class="text-center mb-5">Elige una respuesta:</h4>
                            <?php
                            $contador = 0; // Inicializar el contador
                            while ($row = mysqli_fetch_assoc($resultadoPreguntas)) {
                                if ($row['imagen_encuesta'] != "") {
                                    $porcentajeVotaron = ($row['total_respuestas'] / 100) * 100;
                                    $contador++; // Incrementar el contador 
                            ?>
                                    <div class="answer cursor-pointer col-12 p-0 mb-0 mb-md-3 media_object_encuesta mb-5" id="<?php echo $row['id_pregunta']; ?>">
                                        <label class="mb-0 d-flex" style="padding: 0px 0px 0px 10px;">
                                            <div class="d-flex align-items-center mr-3 mr-md-4 flex-shrink-1">
                                                <div class="input">
                                                    <label class="form-check-label" style="padding: 5px 0px;" for="<?php echo $row['id_pregunta']; ?>">
                                                        <input class="form-check-input" type="radio" name="votar" data-opcion="<?php echo $row['opcion_encuesta']; ?>" id="<?php echo $row['id_pregunta']; ?>">
                                                    </label>
                                                </div>
                                            </div>

                                            <div class="d-flex flex-shrink-1 w-100" style="padding: 0px 0px 0px 15px;">
                                                <div class="align-self-center">
                                                    <h2 class="h5 mb-1"><?php echo $row['opcion_encuesta']; ?></h2>
                                                    <p class="mb-1 small answer-subtitle">
                                                        <span class="number-of-votes"><?php echo $row['total_respuestas']; ?> votos</span><span>, </span>
                                                        <span class="percentage-of-votes"><?php echo $porcentajeVotaron; ?>%</span>
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="flex-grow-1 w-50 d-flex align-items-center ml-3 ml-md-4 answer-image-wrapper position-relative">
                                                <img class="rounded w-100" src="fotos_encuestas/<?php echo $row['imagen_encuesta']; ?>" alt="<?php echo $row['opcion_encuesta']; ?>">
                                            </div>
                                        </label>
                                    </div>

                                <?php } else { ?>
                                    <div class="form-check checkboxContainer" id="<?php echo $row['id_pregunta']; ?>" style="padding: 5px 20px;">
                                        <label class="form-check-label" style="padding: 5px 0px;" for="<?php echo $row['id_pregunta']; ?>">
                                            <input type="radio" class="form-check-input" name="votar" id="<?php echo $row['id_pregunta']; ?>" data-opcion="<?php echo $row['opcion_encuesta']; ?>">
                                            <?php echo $row['opcion_encuesta'];  ?>
                                        </label>
                                    </div>
                                <?php   }
                            }

                            if ($resultadoDetalleEncuesta['solicitar_nombre_participante'] == "1") { ?>
                                <!--validando si hay que mostrar el campo nombre requerido --->
                                <div class="col-md-12 mb-4">
                                    <label for="nombre_votante">Nombre (requerido)</label>
                                    <input type="text" name="nombre_votante" id="nombre_votante" class="form-control" placeholder="Introduzca su nombre" required />
                                </div>
                            <?php }
                            //VALIDANDO COOKIES
                            if (isset($_COOKIE['ha_votado']) || ($respuestaUserAgents == '1')) {
                                echo ' 
                                <div class="alert alert-danger" role="alert">
                                    <i class="bi bi-exclamation-triangle"></i>
                                    <strong>Lo sentimos,</strong>
                                    tu voto ya ha sido registrado. Gracias por participar.
                                </div>';
                            } ?>

                            <hr>
                            <div class="form-group btnsFlexbox">
                                <?php
                                if (!isset($_COOKIE['ha_votado']) || ($respuestaUserAgents == '0')) { ?>
                                    <button class="btn btn-primary btn_votar mt-4" onclick="procesarVotacion(this, '<?php echo $resultadoDetalleEncuesta['code_encuesta']; ?>', '<?php echo $resultadoDetalleEncuesta['solicitar_nombre_participante']; ?>')">
                                        Votar
                                        <i class="bi bi-arrow-right-circle"></i>
                                    </button>
                                <?php } ?>
                                <a href="resultados_encuesta.php?encuesta=<?php echo $code_encuesta; ?>" class="btn btn-primary mt-4">
                                    <i class="bi bi-bar-chart-fill"></i>
                                    Resultados
                                </a>
                                <input type="url" value="<?php echo $URL_actual; ?>" id="textoParaCopiar" hidden>
                                <button class="btn btn-primary mt-4" onclick="copiarTexto()">
                                    <i class="bi bi-share-fill"></i>
                                    Copiar link para compartir
                                </button>
                            </div>

                        </div>
                    </div>
                </div>

                <!--comentarios--->
                <?php
                if ($resultadoDetalleEncuesta['permitir_comentarios'] == "1") { ?>
                    <div class="row justify-content-md-center mt-5">
                        <div class="col-md-10 box_shadox">
                            <h3 class="text-center mt-3 mb-5">
                                <i class="bi bi-chat-left-dots"></i>
                                <strong>
                                    Comentarios
                                </strong>
                                <hr>
                            </h3>
                            <section>
                                <?php
                                while ($coment = mysqli_fetch_assoc($respuestaComentarios)) { ?>
                                    <div class="media mb-2" style="padding: 0px 20px;">
                                        <div class="media-body">
                                            <h5 class="mt-0">
                                                <span style="background: #ccc; padding: 12px 4px 10px 10px; border-radius: 50%;">
                                                    <i class="bi bi-person" style="font-size: 30px;"></i>
                                                </span>
                                                <span style="padding: 0px 10px;">
                                                    <?php echo $coment['nombre_votante_comentario']; ?>
                                                </span>
                                            </h5>
                                            <p style="padding: 0px 60px;font-size: 13px;">
                                                <?php echo $coment['comentario_encuesta']; ?>
                                            </p>
                                            <span id="date_coment"><?php echo $coment['fecha_coment']; ?></span>
                                        </div>
                                    </div>
                                <?php } ?>
                                <div id="resp_comenten"></div>
                            </section>

                            <hr class="mt-4">
                            <form name="form_comentario" id="form_comentario" method="POST" autocomplete="off">
                                <input type="text" name="code_encuesta_comentario" id="code_encuesta_comentario" value="<?php echo $code_encuesta; ?>" hidden>
                                <div class="mb-5" style="width: 80%; margin:0 auto;">
                                    <div class="col-md-12 mb-4">
                                        <label for="nombre_votante_comentario">Nombre (requerido)</label>
                                        <input type="text" name="nombre_votante_comentario" id="nombre_votante_comentario" class="form-control" placeholder="Introduzca su nombre" required />
                                    </div>

                                    <div class="col-md-12">
                                        <label for="comentario_encuesta">Escribe tu comentario aqui</label>
                                        <textarea class="form-control" name="comentario_encuesta" id="comentario_encuesta" rows="3" required></textarea>
                                    </div>

                                    <div class="form-group btnsFlexbox">
                                        <button type="submit" class="btn btn-primary mt-4">
                                            Añadir un comentario
                                            <i class="bi bi-arrow-right-circle"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </section>
    </main>


    <a href="#" class="back-to-top d-flex align-items-center justify-content-center active">
        <i class="bi bi-arrow-up-short"> </i>
    </a>


    <?php include('includes/js.html'); ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <script src="code_encuesta/js/encuesta.js"></script>
    <script src="code_encuesta/js/scripts.js"></script>
    <script src="code_encuesta/js/process_encuesta.js"></script>
    <script>
        // Ejemplo de fecha obtenida desde tu formulario (debes ajustar esto según tu caso)
        var fechaCreacionString = "<?php echo $resultadoDetalleEncuesta['created_at']; ?>";
        var fechaFinalizacionString = "<?php echo $resultadoDetalleEncuesta['fecha_finalizacion']; ?>";

        // Convertir las fechas en objetos Date
        var fechaCreacion = new Date(fechaCreacionString);
        var fechaFinalizacion = new Date(fechaFinalizacionString);

        // Calcular la diferencia en milisegundos entre la fecha de creación y el momento actual
        var diferenciaMilisegundos = new Date() - fechaCreacion;

        // Calcular los componentes de tiempo transcurrido (días, horas, minutos, segundos)
        var diasTranscurridos = Math.floor(diferenciaMilisegundos / (1000 * 60 * 60 * 24));
        var horasTranscurridas = Math.floor((diferenciaMilisegundos % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        var minutosTranscurridos = Math.floor((diferenciaMilisegundos % (1000 * 60 * 60)) / (1000 * 60));
        var segundosTranscurridos = Math.floor((diferenciaMilisegundos % (1000 * 60)) / 1000);

        // Construir el mensaje con el tiempo transcurrido
        var mensajeTranscurrido = "La encuesta fue creada hace ";
        if (diasTranscurridos > 0) {
            mensajeTranscurrido += `${diasTranscurridos} días, `;
        }
        if (horasTranscurridas > 0 || diasTranscurridos > 0) {
            mensajeTranscurrido += `${horasTranscurridas} horas, `;
        }
        mensajeTranscurrido += `${minutosTranscurridos} minutos, ${segundosTranscurridos} segundos.`;

        // Calcular la diferencia en milisegundos entre la fecha de finalización y el momento actual
        var tiempoRestanteMilisegundos = fechaFinalizacion - new Date();

        // Calcular los componentes de tiempo restante (días, horas, minutos, segundos)
        var diasRestantes = Math.floor(tiempoRestanteMilisegundos / (1000 * 60 * 60 * 24));
        var horasRestantes = Math.floor((tiempoRestanteMilisegundos % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        var minutosRestantes = Math.floor((tiempoRestanteMilisegundos % (1000 * 60 * 60)) / (1000 * 60));
        var segundosRestantes = Math.floor((tiempoRestanteMilisegundos % (1000 * 60)) / 1000);

        // Construir el mensaje con el tiempo restante
        var mensajeRestante = "Tiempo restante: ";
        if (diasRestantes > 0) {
            mensajeRestante += `${diasRestantes} días, `;
        }
        if (horasRestantes > 0 || diasRestantes > 0) {
            mensajeRestante += `${horasRestantes} horas, `;
        }
        mensajeRestante += `${minutosRestantes} minutos, ${segundosRestantes} segundos.`;

        document.getElementById("date_created_at").innerHTML = mensajeTranscurrido + "<br>" + mensajeRestante;

        /**
         * fecha de comentarios
         */
    </script>

</body>

</html>