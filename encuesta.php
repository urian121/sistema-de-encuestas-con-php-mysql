<!DOCTYPE html>
<html lang="en">
<?php include('includes/head.html'); ?>
<link rel="stylesheet" href="assets/css/my_custom.css">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear una encuesta</title>
</head>

<body>
    <?php include('includes/header.html'); ?>

    <main id="main mt-5 mb-5">
        <section id="contact" class="contact mt-5">
            <div class="container" data-aos="fade-up">
                <header class="section-header">
                    <p>Crear una encuesta</p>
                    <h2 class="mt-2">Rellene los siguientes campos para crear su encuesta.</h2>
                    <hr>
                </header>

                <div class="row justify-content-md-center">
                    <div class="col-md-8 box_shadox">
                        <form action="code_encuesta/procesar_encuesta.php" class="php-email-form" method="POST" autocomplete="off" enctype="multipart/form-data">
                            <div class="row gy-4">
                                <div class="col-md-12">
                                    <label for="titulo_encuesta" class="form-label">Título de la encuesta</label>
                                    <input type="text" name="titulo_encuesta" class="form-control" required />
                                </div>

                                <div class="col-md-12">
                                    <label for="tipo_encuesta" class="form-label">Tipo de encuesta</label>
                                    <select name="tipo_encuesta" class="form-control">
                                        <option value="Seleccion multiple">Selecci&oacute;n m&uacute;ltiple</option>
                                        <option value="Encuesta de imagen">Encuesta de imagen</option>
                                    </select>
                                </div>

                                <div class="col-md-12">
                                    <label for="Opciones de respuesta">Opciones de respuesta</label>
                                    <input type="text" name="encuesta[]" class="form-control" placeholder="Opción 1" />
                                </div>
                                <div class="col-md-12">
                                    <input type="text" name="encuesta[]" class="form-control" placeholder="Opción 2" />
                                </div>

                                <div id="nuevasOpciones"></div>

                                <div class="col-md-6">
                                    <button type="button" class="btn btn-primary" onclick="agregarOpcion()">
                                        <i class="bi bi-plus"></i>
                                        Añadir opción
                                    </button>
                                </div>
                                <hr>
                                <span>Ajustes</span>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" style="margin-left: -1.2em; border-radius: 10px !important;" role="switch">
                                    <label class="form-check-label checkbox_encuesta" for="flexSwitchCheckChecked">Solicitar los nombres de los participantes</label>
                                </div>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" style="margin-left: -1.2em; border-radius: 10px !important;" role="switch">
                                    <label class="form-check-label checkbox_encuesta" for="flexSwitchCheckChecked">Fijar la fecha de finalización</label>
                                </div>
                                <div class="col-md-12">
                                    <label for="fecha_finalizacion" class="form-label">Fijar la fecha de finalización</label>
                                    <input type="datetime-local" name="fecha_finalizacion" class="form-control" @blur="setDateTime()" />
                                    <div x-show="error"> </div>
                                </div>
                                <div class="col-md-12">
                                    <label for="tipo_encuesta" class="form-label">Visibilidad de los resultados</label>
                                    <select name="visibilidad_resultados" class="form-control">
                                        <option value="Siempre publico">Siempre p&uacute;plico</option>
                                        <option value="Público después del plazo">Público después del plazo</option>
                                    </select>
                                </div>

                                <div class="d-grid gap-2">
                                    <button class="btn btn-primary" type="submit">
                                        Crear mi encuesta
                                        <i class="bi bi-arrow-right-circle"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </main>





    <?php include('includes/footer.html'); ?>
    <?php include('includes/js.html'); ?>
    <script src="code_encuesta/js/encuesta.js"></script>
</body>

</html>