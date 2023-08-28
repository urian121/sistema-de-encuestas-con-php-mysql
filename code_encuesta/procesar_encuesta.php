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
    $titulo_encuesta = ucfirst($_POST['titulo_encuesta']);
    $tipo_encuesta   = $_POST['tipo_encuesta'];
    $SqlInsert = ("INSERT INTO tbl_encuestas(
        code_encuesta,
        titulo_encuesta,
        tipo_encuesta
        )
        VALUES(
        '" . $code_encuesta . "',
        '" . $titulo_encuesta . "',
        '" . $tipo_encuesta . "'
        )");
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

    echo "<script type='text/javascript'>
    window.location.href = '../tu_encuesta.php?encuesta=" . $code_encuesta . "&msj=success';
    </script>";
    exit;

    exit;
}
