<!DOCTYPE html>
<html lang="en">
<?php include('includes/head.html'); ?>
<link rel="stylesheet" href="assets/css/my_custom.css">
<link rel="stylesheet" href="assets/css//picnic.min.css">
<style>
    .miniprofile {
        border-radius: 50%;
        margin: 0 auto;
        width: 40%;
        padding-bottom: 40%;
    }
</style>

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
                                    <select name="tipo_encuesta" class="form-control" onchange="filtar_tipo_encuesta(this.value)">
                                        <option value="Seleccion multiple">Selecci&oacute;n m&uacute;ltiple</option>
                                        <option value="Encuesta de imagen">Encuesta de imagen</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row mt-3" id="opciones_encuesta_general">
                                <div class="col-md-12">
                                    <label for="Opciones de respuesta">Opciones de respuesta</label>
                                    <input type="text" name="encuesta[]" class="form-control" placeholder="Opción 1" required />
                                </div>
                                <div class="col-md-12 mt-3 mb-3">
                                    <input type="text" name="encuesta[]" class="form-control" placeholder="Opción 2" required />
                                </div>

                                <div id="nuevasOpciones"></div>
                                <div class="col-md-6 mt-3">
                                    <button type="button" class="btn btn-primary" onclick="agregarOpcion()">
                                        <i class="bi bi-plus"></i>
                                        Añadir opción
                                    </button>
                                </div>
                            </div>

                            <div id="encuesta_img" class="row mt-4" style="display: none;">
                                <div class="col-md-12 text-center">
                                    <p><strong> Opciones de respuesta </strong>
                                        <hr>
                                    </p>
                                </div>
                                <div class="col-md-6 text-center">
                                    <span>Cargar imagen</span>
                                    <label class="dropimage miniprofile">
                                        <input type="file" name="encuesta[]" required accept="image/*" alt="Imagen-encuesta">
                                    </label>
                                    <input type="text" name="encuesta[]" class="form-control mt-1" placeholder="Opción 1" required />
                                </div>
                                <div class="col-md-6 text-center">
                                    <span>Cargar imagen</span>
                                    <label class="dropimage miniprofile">
                                        <input type="file" name="encuesta[]" required accept="image/*" alt="Imagen-encuesta">
                                    </label>
                                    <input type="text" name="encuesta[]" class="form-control mt-1" placeholder="Opción 2" required />
                                </div>
                                <div class="row" id="nuevasOpcionesImg"></div>

                                <div class="col-md-6 mt-3" id="content_btn_img">
                                    <button type="button" class="btn btn-primary" onclick="agregarOpcionImgs()">
                                        <i class="bi bi-plus"></i>
                                        Añadir opción
                                    </button>
                                </div>
                            </div>



                            <div id="encuesta_img" class="row mt-3">
                                <div class="d-flex justify-content-between mt-3 mb-3">
                                    <div class="col-md-6">
                                        <label for="fecha_finalizacion" class="form-label">Fijar la fecha de finalización</label>
                                        <input type="datetime-local" name="fecha_finalizacion" class="form-control" required />
                                        <div x-show="error"> </div>
                                    </div>
                                </div>

                                <div class="col-md-12 text-center mt-3">
                                    <span><strong>Ajustes</strong> (opcional)</span>
                                    <hr>
                                </div>

                                <div class="col-md-7">
                                    <div class="form-check form-switch">
                                        <input type="checkbox" name="solicitar_nombre_participante" id="solicitar_nombre_participante" class="form-check-input" style="margin-left: -1.2em; border-radius: 10px !important;" value="1">
                                        <label class="form-check-label checkbox_encuesta" for="solicitar_nombre_participante" style="font-size: 14px;">Solicitar los nombres de los participantes</label>
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <label for="visibilidad_resultados" class="form-label">Visibilidad de los resultados</label>
                                    <select name="visibilidad_resultados" class="form-control">
                                        <option value="Siempre publico">Siempre p&uacute;plico</option>
                                        <option value="Público después del plazo">Público después del plazo</option>
                                    </select>
                                </div>

                                <div class="col-md-12 mb-2">
                                    <div class="form-check form-switch">
                                        <input name="permitir_comentarios" id="permitir_comentarios" class="form-check-input" type="checkbox" style="margin-left: -1.2em; border-radius: 10px !important;" value="1">
                                        <label class="form-check-label checkbox_encuesta" for="permitir_comentarios" style="font-size: 14px;">Permitir comentarios</label>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-2 mt-2">
                                    <label for="duplicados_de_voz" class="form-label">Comprobación de duplicados de voz</label>
                                    <select name="duplicados_de_voz" class="form-control">
                                        <option value="none">Ninguno</option>
                                        <option value="Sesion del navegador">Sesión del navegador</option>
                                        <option value="Direccion IP" selected>Dirección IP</option>
                                        <option value="Un voto por cuenta de usuario">Un voto por cuenta de usuario</option>
                                        <option value="Solo por invitacion">Sólo por invitación</option>
                                    </select>
                                </div>

                                <div class="d-grid gap-2 mt-3">
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
    <script>
        const filtar_tipo_encuesta = (option) => {
            if (option == "Seleccion multiple") {
                document.querySelector("#opciones_encuesta_general").style.display = "flex";
                document.querySelector("#encuesta_img").style.display = "none";

                document.querySelector("#nuevasOpcionesImg").innerHTML = "";
            } else {
                document.querySelector("#opciones_encuesta_general").style.display = "none";
                document.querySelector("#encuesta_img").style.display = "flex";

                document.querySelector("#nuevasOpciones").innerHTML = "";
            }
        }


        document.addEventListener("DOMContentLoaded", function() {
            [].forEach.call(document.querySelectorAll('.dropimage'), function(img) {
                img.onchange = function(e) {
                    var inputfile = this,
                        reader = new FileReader();
                    reader.onloadend = function() {
                        inputfile.style['background-image'] = 'url(' + reader.result + ')';
                    }
                    reader.readAsDataURL(e.target.files[0]);
                }
            });
        })
    </script>

</body>

</html>