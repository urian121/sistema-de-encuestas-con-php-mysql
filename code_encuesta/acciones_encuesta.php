 <?php
    include('connBD.php');
    /**
     * Validar si existe el codigo correcto en la url
     */
    function validarEncuestaCode($con, $code_encuesta)
    {
        $code_encuesta = mysqli_real_escape_string($con, $code_encuesta);
        $sql = "SELECT * FROM tbl_encuestas WHERE code_encuesta = '{$code_encuesta}'";
        $result = mysqli_query($con, $sql);
        if (mysqli_num_rows($result) > 0) {
            return true;
        } else {
            return false;
        }
    }


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
                    e.seguridad_cookies,
                    e.seguridad_user_agents,
                    e.validar_vpn,
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
        $sqlRespuestas = ("SELECT 
                o.id_pregunta, 
                o.opcion_encuesta,
                o.imagen_encuesta, 
            IFNULL(COUNT(r.respuesta_encuesta), 0) AS total_respuestas
            FROM tbl_opciones_encuesta AS o
            LEFT JOIN tbl_respuestas_encuestas AS r 
            ON o.code_encuesta = r.code_encuesta
            AND o.opcion_encuesta = r.respuesta_encuesta
            WHERE o.code_encuesta ='$code_encuesta'
            GROUP BY o.id_pregunta, o.opcion_encuesta
            ORDER BY total_respuestas desc");
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
                o.imagen_encuesta,
            IFNULL(COUNT(r.respuesta_encuesta), 0) AS total_respuestas
            FROM tbl_opciones_encuesta AS o
            LEFT JOIN tbl_respuestas_encuestas AS r 
            ON o.code_encuesta = r.code_encuesta 
            AND o.opcion_encuesta = r.respuesta_encuesta
            WHERE o.code_encuesta ='$code_encuesta'
            GROUP BY o.id_pregunta, o.opcion_encuesta
            ORDER BY total_respuestas desc;");
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
        $sqlComentario = ("SELECT 
            DATE_FORMAT(created_at, '%d de %b %h:%i %p') AS fecha_coment,
                code_encuesta_comentario,
                nombre_votante_comentario,
                comentario_encuesta
            FROM tbl_comentarios_encuesta WHERE code_encuesta_comentario='" . $code_encuesta . "'");
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
            $miArrayOptiones = $_POST['miArrayOptiones'];

            $userAgent = $_SERVER['HTTP_USER_AGENT'];
            $SqlInsert = ("INSERT INTO tbl_respuestas_encuestas(
                code_encuesta,
                respuesta_encuesta,
                nombre_votante,
                ip_votacion,
                user_agent
                )
            VALUES(
                '" . $code_encuesta . "',
                '" . $respuesta_encuesta . "',
                '" . $nombre_votante . "',
                '" . $ip . "',
                '" . $userAgent . "'
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

    /**
     * Verificar si esta activa la encuesta por seguridad_user_agents
     */
    function verificar_validacion_por_user_agente($con, $code_encuesta)
    {
        $sqlEncuesta = "SELECT seguridad_user_agents FROM tbl_encuestas WHERE code_encuesta='$code_encuesta' LIMIT 1";
        $queryEncuesta = mysqli_query($con, $sqlEncuesta);

        // Comprobar si la consulta se ejecutó con éxito
        if (!$queryEncuesta) {
            die("Error en la consulta: " . mysqli_error($con));
        }

        // Obtener el resultado de la consulta
        $encuesta = mysqli_fetch_assoc($queryEncuesta);

        // Comprobar si la encuesta requiere validación por User-Agent
        if ($encuesta['seguridad_user_agents'] == 1) {
            return true; // Requiere validación por User-Agent
        } else {
            return false; // No requiere validación por User-Agent
        }
    }

    /**
     * Validar si existe User Agents en BD
     */
    function verificar_user_agents($con, $code_encuesta)
    {
        if (verificar_validacion_por_user_agente($con, $code_encuesta)) {
            $userAgent = $_SERVER['HTTP_USER_AGENT'];
            $sql = ("SELECT user_agent FROM tbl_respuestas_encuestas WHERE user_agent = '{$userAgent}' AND code_encuesta = '{$code_encuesta}'");
            $result = mysqli_query($con, $sql);
            if (mysqli_num_rows($result) > 0) {
                return 1;
            } else {
                return 0;
            }
        } else {
            return 0;
        }
    }
