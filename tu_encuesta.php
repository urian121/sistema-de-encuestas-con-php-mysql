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
    include('includes/header.html');
    /**
     * Verificando si esta presente el codigo de la encuesta
     */
    if (isset($_POST['encuesta'])) {
        $code_encuesta = $_POST['encuesta'];
    } elseif (isset($_GET['encuesta'])) {
        $code_encuesta = $_GET['encuesta'];
    } else {
        header("Location: index.php");
        exit;
    }
    /**
     * Verificando si esta presente el codigo de la encuesta
     */
    include('code_encuesta/acciones_encuesta.php');
    $URL_actual = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    $resultadoDetalleEncuesta = obtenerEncuesta($con, $code_encuesta);
    $resultadoPreguntas = obtenerPreguntas($con, $code_encuesta);
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


                <div class="row justify-content-md-center">
                    <div class="col-md-10 box_shadox">
                        <h3 class="text-center mt-3 mb-5">
                            <strong>
                                <?php echo $resultadoDetalleEncuesta['titulo_encuesta']; ?>
                            </strong>
                            <hr>
                        </h3>


                        <div class="mb-5" style="width: 80%; margin:0 auto;">
                            <div>Elige una respuesta:</div>
                            <?php
                            while ($row = mysqli_fetch_assoc($resultadoPreguntas)) { ?>
                                <div class="form-check" id="<?php echo $row['id_pregunta']; ?>" style="padding: 5px 20px;">
                                    <input class="form-check-input" type="radio" name="flexRadioDefault" data-opcion="<?php echo $row['opcion_encuesta'];  ?>" id=" <?php echo $row['id_pregunta']; ?>">
                                    <label class="form-check-label" style="padding: 5px 0px;" for="<?php echo $row['id_pregunta']; ?>">
                                        <?php echo $row['opcion_encuesta'];  ?>
                                    </label>
                                </div>
                            <?php   } ?>
                            <hr>
                            <div class="form-group btnsFlexbox">
                                <button class="btn btn-primary mt-4" onclick="procesarVotacion(this, '<?php echo $resultadoDetalleEncuesta['code_encuesta']; ?>')">
                                    Votar
                                    <i class="bi bi-arrow-right-circle"></i>
                                </button>
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
            </div>
        </section>
    </main>




    <?php include('includes/js.html'); ?>
    <script src="code_encuesta/js/encuesta.js"></script>
</body>

</html>