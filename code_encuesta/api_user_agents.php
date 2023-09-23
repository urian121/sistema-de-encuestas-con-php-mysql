<?php
header("Access-Control-Allow-Origin: *");
include('connBD.php');

$sqlData   = ("SELECT user_agent FROM tb_user_agents");
$querySQL  = mysqli_query($con, $sqlData);
$totalData = mysqli_num_rows($querySQL);

$datos_dias = array();
while ($fila_data = mysqli_fetch_array($querySQL)) {
    $datos_dias[] = $fila_data;
}

// Devolver los datos en formato JSON
header("Content-type: application/json");
echo json_encode($datos_dias);
