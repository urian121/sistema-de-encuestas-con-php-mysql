<!DOCTYPE html>
<html lang="es">
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
    <title>Crear una encuesta con PHP y MySQL</title>
</head>

<body>

    <section class="contact">
        <div class="container">
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

                        <div class="row mt-3" id="opciones_encuesta_general"> </div>

                        <div id="encuesta_img" class="row mt-4"> </div>

                        <div class="row mt-3">
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

                            <div class="col-md-6">
                                <div class="form-check form-switch">
                                    <input type="checkbox" name="solicitar_nombre_participante" id="solicitar_nombre_participante" class="form-check-input" style="margin-left: -1.2em; border-radius: 10px !important;" value="1">
                                    <label class="form-check-label checkbox_encuesta" for="solicitar_nombre_participante" style="font-size: 14px;">Solicitar el nombre del participante</label>
                                </div>
                            </div>

                            <div class="col-md-6 mb-2">
                                <div class="form-check form-switch">
                                    <input name="permitir_comentarios" id="permitir_comentarios" class="form-check-input" type="checkbox" style="margin-left: -1.2em; border-radius: 10px !important;" value="1">
                                    <label class="form-check-label checkbox_encuesta" for="permitir_comentarios" style="font-size: 14px;">Permitir comentarios</label>
                                </div>
                            </div>

                            <div class="col-md-6 mb-2">
                                <div class="form-check form-switch">
                                    <input name="seguridad_cookies" id="seguridad_cookies" checked class="form-check-input" checked type="checkbox" style="margin-left: -1.2em; border-radius: 10px !important;" value="1">
                                    <label class="form-check-label checkbox_encuesta" for="seguridad_cookies" style="font-size: 14px;">Seguridad por Cookies</label>
                                </div>
                            </div>

                            <div class="col-md-6 mb-2">
                                <div class="form-check form-switch">
                                    <input name="seguridad_user_agents" id="seguridad_user_agents" checked class="form-check-input" type="checkbox" style="margin-left: -1.2em; border-radius: 10px !important;" value="1">
                                    <label class="form-check-label checkbox_encuesta" for="seguridad_user_agents" style="font-size: 14px;">Seguridad por User Agents</label>
                                </div>
                            </div>

                            <div class="col-md-6 mb-2">
                                <div class="form-check form-switch">
                                    <input name="validar_vpn" id="validar_vpn" class="form-check-input" type="checkbox" checked style="margin-left: -1.2em; border-radius: 10px !important;" value="1">
                                    <label class="form-check-label checkbox_encuesta" for="validar_vpn" style="font-size: 14px;">Validar por VPN</label>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label for="visibilidad_resultados" class="form-label">Visibilidad de los resultados</label>
                                <select name="visibilidad_resultados" class="form-control">
                                    <option value="Siempre publico">Siempre p&uacute;plico</option>
                                    <option value="Público después del plazo">Público después del plazo</option>
                                </select>
                            </div>

                            <div class="col-md-6 mb-2 mt-2">
                                <label for="duplicados_de_voz" class="form-label">Comprobación de duplicados de voz</label>
                                <select name="duplicados_de_voz" class="form-control">
                                    <option value="Direccion IP" selected>Dirección IP</option>
                                    <option value="Multiples Votos">Multiples Votos</option>
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


    <?php include('includes/js.html'); ?>
    <script src="code_encuesta/js/encuesta.js"></script>

</body>

</html>