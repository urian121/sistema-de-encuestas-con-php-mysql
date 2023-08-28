 <?php
    ini_set('display_errors', 1);
    error_reporting(E_ALL);

    include('connBD.php');

    function obtenerEncuesta($con, $code_encuesta)
    {
        $sqlEncuesta = "SELECT
                    e.code_encuesta,
                    e.titulo_encuesta
                FROM tbl_encuestas AS e
                WHERE e.code_encuesta ='" . mysqli_real_escape_string($con, $code_encuesta) . "'";
        $queryEncuesta = mysqli_query($con, $sqlEncuesta);
        if (!$queryEncuesta) {
            return false;
        }
        $data = mysqli_fetch_assoc($queryEncuesta);
        mysqli_free_result($queryEncuesta);
        return $data;
    }


    function obtenerResultadosEncuesta($con, $code_encuesta)
    {
        $sqlRespuestas = ("SELECT o.opcion_encuesta, IFNULL(COUNT(r.respuesta_encuesta), 0) AS total_respuestas
                    FROM tbl_opciones_encuesta AS o
                    LEFT JOIN tbl_respuestas_encuestas AS r ON o.code_encuesta = r.code_encuesta AND o.opcion_encuesta = r.respuesta_encuesta
                    WHERE o.code_encuesta ='" . $code_encuesta . "'
                    GROUP BY o.opcion_encuesta");
        $queryRespuesta = mysqli_query($con, $sqlRespuestas);
        if (!$queryRespuesta) {
            return false;
        }
        return $queryRespuesta;
    }


    function obtenerPreguntas($con, $code_encuesta)
    {
        $sqlPreguntas = ("SELECT
            o.id_pregunta,
            o.opcion_encuesta
        FROM tbl_opciones_encuesta AS o
        WHERE
            o.code_encuesta ='" . $code_encuesta . "'");
        $queryPreguntas = mysqli_query($con, $sqlPreguntas);
        if (!$queryPreguntas) {
            return false;
        }
        return $queryPreguntas;
    }


    /**
     * Funcion que recibe el voto
     */
    if (isset($_POST["accion"]) && $_POST["accion"] == "registarVotacion") {
        /**
         * Verificando si ya se ha realizado una votacion desde esta IP y para esta encuesta en particular
         */
        $ip = obtenerDireccionIPReal();
        $code_encuesta = isset($_POST['code_encuesta']) ? $_POST['code_encuesta'] : $_GET['code_encuesta'];
        //if (verificar_votacion_ip($con, $ip, $code_encuesta)) {
        if (!verificar_votacion_ip($con, $ip, $code_encuesta)) {
            $respuesta_encuesta = isset($_POST['respuesta_encuesta']) ? $_POST['respuesta_encuesta'] : $_GET['respuesta_encuesta'];
            $SqlInsert = ("INSERT INTO tbl_respuestas_encuestas(
                code_encuesta,
                respuesta_encuesta,
                ip_votacion
                )
            VALUES(
                '" . $code_encuesta . "',
                '" . $respuesta_encuesta . "',
                '" . $ip . "'
                )");
            $resulInsert = mysqli_query($con, $SqlInsert);
            if (!$resulInsert) {
                header('Content-type: application/json; charset=utf-8');
                echo json_encode(array("respuesta" => "error"));
                exit();
            } else {
                header('Content-type: application/json; charset=utf-8');
                echo json_encode(array("respuesta" => "ok"));
                exit();
            }
        } else {
            header('Content-type: application/json; charset=utf-8');
            echo json_encode(array("respuesta" => "ya voto"));
            exit();
        }
    }

    function verificar_votacion_ip($con, $ip, $code_encuesta)
    {
        $sql = "SELECT ip_votacion FROM tbl_respuestas_encuestas WHERE ip_votacion = '" . $ip . "' AND code_encuesta = '" . $code_encuesta . "'";
        $result = mysqli_query($con, $sql);
        if (mysqli_num_rows($result) > 0) {
            return true;
        } else {
            return false;
        }
    }

    function obtenerDireccionIPReal()
    {
        if (!empty($_SERVER['HTTP_CLIENT_IP']) && validate_ip($_SERVER['HTTP_CLIENT_IP'])) {
            return $_SERVER['HTTP_CLIENT_IP'];
        }

        if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            if (strpos($_SERVER['HTTP_X_FORWARDED_FOR'], ',') !== false) {
                $iplist = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);

                foreach ($iplist as $ip) {
                    if (validate_ip($ip))
                        return $ip;
                }
            } else {

                if (validate_ip($_SERVER['HTTP_X_FORWARDED_FOR']))

                    return $_SERVER['HTTP_X_FORWARDED_FOR'];
            }
        }

        if (!empty($_SERVER['HTTP_X_FORWARDED']) && validate_ip($_SERVER['HTTP_X_FORWARDED']))
            return $_SERVER['HTTP_X_FORWARDED'];
        if (!empty($_SERVER['HTTP_X_CLUSTER_CLIENT_IP']) && validate_ip($_SERVER['HTTP_X_CLUSTER_CLIENT_IP']))
            return $_SERVER['HTTP_X_CLUSTER_CLIENT_IP'];
        if (!empty($_SERVER['HTTP_FORWARDED_FOR']) && validate_ip($_SERVER['HTTP_FORWARDED_FOR']))
            return $_SERVER['HTTP_FORWARDED_FOR'];
        if (!empty($_SERVER['HTTP_FORWARDED']) && validate_ip($_SERVER['HTTP_FORWARDED']))
            return $_SERVER['HTTP_FORWARDED'];
        return $_SERVER['REMOTE_ADDR'];
    }


    function validate_ip($ip)
    {
        if (strtolower($ip) === 'unknown')
            return false;
        $ip = ip2long($ip);
        if ($ip !== false && $ip !== -1) {
            $ip = sprintf('%u', $ip);
            if ($ip >= 0 && $ip <= 50331647) return false;
            if ($ip >= 167772160 && $ip <= 184549375) return false;
            if ($ip >= 2130706432 && $ip <= 2147483647) return false;
            if ($ip >= 2851995648 && $ip <= 2852061183) return false;
            if ($ip >= 2886729728 && $ip <= 2887778303) return false;
            if ($ip >= 3221225984 && $ip <= 3221226239) return false;
            if ($ip >= 3232235520 && $ip <= 3232301055) return false;
            if ($ip >= 4294967040) return false;
        }
        return true;
    }
