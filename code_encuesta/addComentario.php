<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
include('connBD.php');
header('Content-type: application/json; charset=utf-8');

/**
 * funcion para registrar comentartios en la encuesta
 */

$code_encuesta_comentario = $_POST["code_encuesta_comentario"];
$nombre_votante_comentario = $_POST["nombre_votante_comentario"];
//$comentario_encuesta = htmlspecialchars($_POST["comentario_encuesta"]);
$comentario_encuesta = ($_POST["comentario_encuesta"]);

$SqlInsert = ("INSERT INTO tbl_comentarios_encuesta(
                    code_encuesta_comentario,
                    nombre_votante_comentario,
                    comentario_encuesta
                )
                VALUES(
                '" . $code_encuesta_comentario . "',
                '" . $nombre_votante_comentario . "',
                '" . $comentario_encuesta . "'
                )");
$resulInsert = mysqli_query($con, $SqlInsert);

if (!$resulInsert) {
    echo json_encode(array("respuesta" => "error"));
    exit();
} else {
    echo json_encode(array("respuesta" => "OK"));
    exit();
}
