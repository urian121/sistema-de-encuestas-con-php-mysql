<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
include('connBD.php');


function generarCodigoAleatorio($longitud = 20)
{
    $caracteres = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $codigo = '';
    for ($i = 0; $i < $longitud; $i++) {
        $indiceAleatorio = rand(0, strlen($caracteres) - 1);
        $codigo .= $caracteres[$indiceAleatorio];
    }
    return $codigo;
}
$code_encuesta = generarCodigoAleatorio();


if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $targetDirectory = "../fotos_encuestas/";

    if (!file_exists($targetDirectory)) {
        mkdir($targetDirectory, 0755, true);
    }

    if (isset($_FILES['encuesta'])) {
        $uploadedFiles = $_FILES['encuesta'];
        // Recorremos todas las imágenes cargadas
        foreach ($uploadedFiles['tmp_name'] as $key => $tmp_name) {
            $originalFilename = $uploadedFiles['name'][$key];
            $tmpFilePath = $uploadedFiles['tmp_name'][$key];

            $extension = pathinfo($originalFilename, PATHINFO_EXTENSION);
            $newFilename = uniqid() . '.' . $extension;

            $newFilePath = $targetDirectory . $newFilename;

            // Movemos la imagen al directorio destino
            move_uploaded_file($tmpFilePath, $newFilePath);

            // Aquí puedes realizar cualquier procesamiento adicional que necesites con la imagen
        }
    }

    /*
    $permitirComentarios = isset($_POST["permitir_comentarios"]) ? 1 : 0;
    $solicitar_nombre_participante = isset($_POST["solicitar_nombre_participante"]) ? 1 : 0;
    $titulo_encuesta = ucfirst($_POST['titulo_encuesta']);
    $tipo_encuesta = $_POST['tipo_encuesta'];
    $visibilidad_resultados = $_POST['visibilidad_resultados'];
    $duplicados_de_voz = $_POST['duplicados_de_voz'];
    // Convertir el formato de fecha
    $fecha_finalizacion = isset($_POST["fecha_finalizacion"]) ? $_POST["fecha_finalizacion"] : '';
    $fecha_finalizacion_formateada = date("Y-m-d H:i:s", strtotime($fecha_finalizacion));

    $SqlInsert = "INSERT INTO tbl_encuestas (
            code_encuesta,
            titulo_encuesta,
            tipo_encuesta,
            permitir_comentarios,
            solicitar_nombre_participante,
            visibilidad_resultados,
            duplicados_de_voz,
            fecha_finalizacion
        ) VALUES (
            '$code_encuesta',
            '$titulo_encuesta',
            '$tipo_encuesta',
            '$permitirComentarios',
            '$solicitar_nombre_participante',
            '$visibilidad_resultados',
            '$duplicados_de_voz',
            '$fecha_finalizacion_formateada'
        )";
    $resulInsert = mysqli_query($con, $SqlInsert);

    if (!$resulInsert) {
        echo "Error en la consulta SQL: " . mysqli_error($con);
    } else {
        $opcionesRespuesta = $_POST['encuesta'];
        foreach ($opcionesRespuesta as $option) {
            $SqlInsertOption = ("INSERT INTO tbl_opciones_encuesta(
                code_encuesta,
                opcion_encuesta
                )
            VALUES(
                '" . $code_encuesta . "',
                '" . ucfirst($option) . "'
            )");
            $resulInsertOption = mysqli_query($con, $SqlInsertOption);
        }
    }
    */

    /*
    echo "<script type='text/javascript'>
    window.location.href = '../tu_encuesta.php?encuesta=" . $code_encuesta . "&msj=success';
    </script>";
    exit;
    */
}
