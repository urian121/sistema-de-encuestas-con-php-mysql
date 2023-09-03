 <?php
    ini_set('display_errors', 1);
    error_reporting(E_ALL);
    include('connBD.php');


    /**
     * Obtener encuesta por codigo encuesta
     */
    function obtenerEncuesta($con, $code_encuesta)
    {
        $sqlEncuesta = "SELECT
                    e.code_encuesta,
                    e.titulo_encuesta,
                    e.permitir_comentarios,
                    e.solicitar_nombre_participante,
                    e.permitir_comentarios,
                    e.created_at,
                    e.fecha_finalizacion
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


    /**
     * Obtener resultado de encuesta por codigo encuesta
     */
    function obtenerResultadosEncuesta($con, $code_encuesta)
    {
        $sqlRespuestas = ("SELECT o.id_pregunta, o.opcion_encuesta, IFNULL(COUNT(r.respuesta_encuesta), 0) AS total_respuestas
                    FROM tbl_opciones_encuesta AS o
                    LEFT JOIN tbl_respuestas_encuestas AS r ON o.code_encuesta = r.code_encuesta AND o.opcion_encuesta = r.respuesta_encuesta
                    WHERE o.code_encuesta ='" . $code_encuesta . "'
                    GROUP BY o.id_pregunta, o.opcion_encuesta");
        $queryRespuesta = mysqli_query($con, $sqlRespuestas);
        if (!$queryRespuesta) {
            return false;
        }
        return $queryRespuesta;
    }

    /**
     * Obtener opciones para la pregunta de la encuesta de acuerdo al codigo encuesta
     */
    function obtenerPreguntas($con, $code_encuesta)
    {
        $sqlPreguntas = ("SELECT
            o.id_pregunta,
            o.opcion_encuesta,
            o.imagen_encuesta
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
     * Obtener la lista de todos los comentarios de acuerdo a la encuesta
     */
    function obtenerComentarios($con, $code_encuesta)
    {
        $sqlComentario = ("SELECT *  FROM tbl_comentarios_encuesta WHERE code_encuesta_comentario='" . $code_encuesta . "'");
        $queryComentarios = mysqli_query($con, $sqlComentario);
        if (!$queryComentarios) {
            return false;
        }
        return $queryComentarios;
    }

    /**
     * Función para recibir el voto de la encuesta
     */
    if (isset($_POST["accion"]) && $_POST["accion"] == "registarVotacion") {
        /**
         * Verificando si ya se ha realizado una votacion desde esta IP y para esta encuesta en particular
         */
        $ip = serverIP();
        $code_encuesta = isset($_POST['code_encuesta']) ? $_POST['code_encuesta'] : $_GET['code_encuesta'];
        if (!verificar_votacion_ip($con, $ip, $code_encuesta)) {
            $respuesta_encuesta = isset($_POST['respuesta_encuesta']) ? $_POST['respuesta_encuesta'] : $_GET['respuesta_encuesta'];
            $nombre_votante = $_POST['nombre_votante'];
            $SqlInsert = ("INSERT INTO tbl_respuestas_encuestas(
                code_encuesta,
                respuesta_encuesta,
                nombre_votante,
                ip_votacion
                )
            VALUES(
                '" . $code_encuesta . "',
                '" . $respuesta_encuesta . "',
                '" . $nombre_votante . "',
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

    /**
     * Validar si el equipo ya ha votado en esta encuesta en particular
     */
    function verificar_votacion_ip($con, $ip, $code_encuesta)
    {
        $sql = ("SELECT ip_votacion FROM tbl_respuestas_encuestas WHERE ip_votacion = '{$ip}' AND code_encuesta = '{$code_encuesta}'");
        $result = mysqli_query($con, $sql);
        if (mysqli_num_rows($result) > 0) {
            return true;
        } else {
            return false;
        }
    }


    /**
     * Obtener la IP real
     */
    function obtenerIpUsuarioServer()
    {
        if (!empty($_SERVER['HTTP_CLIENT_IP']) && filter_var($_SERVER['HTTP_CLIENT_IP'], FILTER_VALIDATE_IP, FILTER_FLAG_IPV4 | FILTER_FLAG_IPV6) !== false) {
            return $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']) && filter_var($_SERVER['HTTP_X_FORWARDED_FOR'], FILTER_VALIDATE_IP, FILTER_FLAG_IPV4 | FILTER_FLAG_IPV6) !== false) {
            $ipList = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
            return trim($ipList[0]);
        } else {
            return $_SERVER['REMOTE_ADDR'];
        }
    }

    function obtenerIpRealAPI()
    {
        $ip = file_get_contents('https://api64.ipify.org?format=json');
        $ip_data = json_decode($ip, true);
        return $ip_data['ip'];
    }


    function serverIP()
    {
        $targetDomain = 'encuestalocal.com';
        if (isset($_SERVER['HTTP_HOST']) && $_SERVER['HTTP_HOST'] === $targetDomain) {
            return obtenerIpUsuarioServer();  // Llama a la función para el dominio objetivo
        } else {
            return obtenerIpRealAPI();  // Llama a la función para otros dominios
        }
    }
