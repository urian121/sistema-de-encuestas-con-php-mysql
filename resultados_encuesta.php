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


    include('code_encuesta/acciones_encuesta.php');

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
    $URL_actual = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    $resultadoDetalleEncuesta = obtenerEncuesta($con, $code_encuesta);
    $resultadoRespuestas = obtenerResultadosEncuesta($con, $code_encuesta);
    ?>


    <main id="main mt-5 mb-5">
        <section id="contact" class="contact mt-5">
            <div class="container" data-aos="fade-up">
                <div class="row justify-content-md-center">
                    <div class="col-md-10 box_shadox">
                        <h3 class="text-center mt-3 mb-5">
                            <strong>
                                <?php echo $resultadoDetalleEncuesta['titulo_encuesta']; ?>
                            </strong>
                            <hr>
                        </h3>


                        <div class="mb-5" style="width: 80%; margin:0 auto;">
                            <h5>Resultados de la votaci&oacute;n</h5>
                            <?php
                            $contador = 0; // Inicializar el contador
                            while ($row = mysqli_fetch_assoc($resultadoRespuestas)) {
                                $porcentajeVotaron = ($row['total_respuestas'] / 100) * 100;
                                $contador++; // Incrementar el contador 
                            ?>
                                <span id="<?php echo $row['id_pregunta']; ?>">
                                    <label class="mt-4" for="<?php echo $row['total_respuestas']; ?>" style="display: flex; justify-content: space-between;">
                                        <span><?php echo $row['opcion_encuesta']; ?></span>
                                        <span><?php echo $porcentajeVotaron; ?>% (<?php echo $row['total_respuestas']; ?> Votos)</span>
                                        <?php
                                        if ($row['imagen_encuesta'] != "") { ?>
                                            <img style="max-width: 100px;" class="rounded w-10" src="fotos_encuestas/<?php echo $row['imagen_encuesta']; ?>" alt="<?php echo $row['opcion_encuesta']; ?>">
                                        <?php } ?>
                                    </label>
                                    <div id="progre_<?php echo $contador; ?>">
                                        <div id="progress" class="progress" style="width:100%;">
                                            <div id="progress-bar" class="progress-bar bg-info text-dark" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width:0%;">
                                                <span id="texto"> </span>
                                            </div>
                                        </div>
                                    </div>
                                </span>
                            <?php   } ?>
                            <hr>


                            <div class="form-group btnsFlexbox">
                                <a href="resultados_encuesta.php?encuesta=<?php echo $code_encuesta; ?>" class="btn btn-primary mt-4">
                                    Actualizar resultados
                                    <i class="bi bi-arrow-right-circle"></i>
                                </a>
                                <a href="tu_encuesta.php?encuesta=<?php echo $code_encuesta; ?>" class="btn btn-primary mt-4" type="submit">
                                    <i class="bi bi-arrow-left-circle"></i>
                                    Ir a la encuesta
                                </a>
                                <input type="url" value=" <?php echo $URL_actual; ?>" id="textoParaCopiar" hidden>
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
    <script>
        function CargarBarra() {
            var increment = 1;
            for (var contador = 1; contador <= <?php echo $contador; ?>; contador++) {
                var pb = document.getElementById("progre_" + contador).querySelector("#progress-bar");
                var p = document.getElementById("progre_" + contador).querySelector("#progress");

                var pbw = parseInt(pb.style.width);
                var pw = parseInt(p.style.width);

                if (pbw >= pw) {
                    clearInterval(barraprogreso);
                    pb.setAttribute("class", "progress-bar bg-info text-dark");
                } else {
                    pbw += increment;
                    pb.style.width = pbw + "%";
                    pb.setAttribute("aria-valuenow", pbw);
                }

                var textElement = document.getElementById("progre_" + contador).querySelector("#texto");
                textElement.innerHTML = pbw + "%";
            }
        }

        var barraprogreso = setInterval(CargarBarra, 20);
    </script>
</body>

</html>