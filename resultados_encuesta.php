<!DOCTYPE html>
<html lang="es">
<?php include('includes/head.html'); ?>
<link rel="stylesheet" href="assets/css/my_custom.css">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultado de la encuesta</title>
</head>

<body>
    <?php
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
            <div class="container">
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
                            $total_votos = 0; // Variable para almacenar el total de votos

                            // Calcular el total de votos
                            while ($row = mysqli_fetch_assoc($resultadoRespuestas)) {
                                $total_votos += $row['total_respuestas'];
                            }

                            // Resetear el puntero del resultado de la consulta
                            mysqli_data_seek($resultadoRespuestas, 0);

                            // Generar las barras de progreso
                            while ($row = mysqli_fetch_assoc($resultadoRespuestas)) {
                                // Calcular el porcentaje basado en el total de votos
                                $porcentajeVotaron = ($total_votos > 0) ? ($row['total_respuestas'] / $total_votos) * 100 : 0;
                                $porcentajeVotaronRedondeado = round($porcentajeVotaron); // Redondear el porcentaje

                                $contador++; // Incrementar el contador 
                            ?>
                                <span id="<?php echo $row['id_pregunta']; ?>">
                                    <label class="mt-4" for="<?php echo $row['total_respuestas']; ?>" style="display: flex; justify-content: space-between;">
                                        <span><?php echo $row['opcion_encuesta']; ?></span>
                                        <span><?php echo $porcentajeVotaronRedondeado; ?>% (<?php echo $row['total_respuestas']; ?> Votos)</span>
                                        <?php if ($row['imagen_encuesta'] != "") { ?>
                                            <img style="max-width: 100px;" class="rounded w-10" src="fotos_encuestas/<?php echo $row['imagen_encuesta']; ?>" alt="<?php echo $row['opcion_encuesta']; ?>">
                                        <?php } ?>
                                    </label>
                                    <div id="progre_<?php echo $contador; ?>">
                                        <div id="progress" class="progress" style="width:100%;">
                                            <div id="progress-bar" class="progress-bar bg-info text-dark" role="progressbar" aria-valuenow="<?php echo $porcentajeVotaronRedondeado; ?>" aria-valuemin="0" aria-valuemax="100" style="width:<?php echo $porcentajeVotaronRedondeado; ?>%;">
                                                <span id="texto"><?php echo $porcentajeVotaronRedondeado; ?>%</span>
                                            </div>
                                        </div>
                                    </div>
                                </span>
                            <?php
                            }
                            ?>

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
</body>

</html>