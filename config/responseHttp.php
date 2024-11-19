<?php

namespace App\Config;
use Illuminate\Http\JsonResponse;
class responseHttp {

    public static $message = array(
        'status' => '',
    );

    /**
     * Configura los encabezados HTTP para el acceso CORS.
     */
    final public static function headerHttpPro($method, $origin)
    {
        if (!isset($origin)) {
            die((ResponseHttp::status401('No tiene autorización para consumir esta API')));
        }

        $list = [
            'https://www.thunderclient.com/', 
            'http://localhost:3000', 
            'http://localhost:3001', 
            'dev'
        ];

        if (in_array($origin, $list)) {
            if ($method == 'OPTIONS') {
                header("Access-Control-Allow-Origin: $origin");
                header('Access-Control-Allow-Methods: GET, PUT, POST, PATCH, DELETE');
                header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Authorization"); 
                header('Access-Control-Allow-Credentials: true');
                exit(0);
            } else {
                header("Access-Control-Allow-Origin: $origin");
                header('Access-Control-Allow-Methods: GET, PUT, POST, PATCH, DELETE');
                header("Allow: GET, POST, OPTIONS, PUT, PATCH, DELETE");
                header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Authorization"); 
                header('Content-Type: application/json'); 
                header('Access-Control-Allow-Credentials: true');
            }
        } else {
            die(ResponseHttp::status401('No tiene autorización para consumir esta API'));
        }       
    }

    /**
     * Configura los encabezados HTTP para desarrollo.
     */
    final public static function headerHttpDev($method)
    {
        if ($method == 'OPTIONS') {
            exit(0);
        }

        header("Access-Control-Allow-Origin: *");
        header('Access-Control-Allow-Methods: GET, PUT, POST, PATCH, DELETE');
        header("Allow: GET, POST, OPTIONS, PUT, PATCH, DELETE");
        header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Authorization"); 
    }

    public static function status200($res): JsonResponse
    {
        http_response_code(200);
        self::$message['status'] = 'ok';
        self::$message[gettype($res) == 'string' ? 'message' : 'data'] = $res;
        return new JsonResponse(self::$message); // Cambiado a JsonResponse
    }

    public static function status201(string $res = 'Recurso creado'): JsonResponse
    {
        http_response_code(201);
        self::$message['status'] = 'ok';
        self::$message['message'] = $res;
        return new JsonResponse(self::$message); // Cambiado a JsonResponse
    }

    public static function status400(string $res = 'Solicitud enviada incompleta o en formato incorrecto'): JsonResponse
    {
        http_response_code(400);
        self::$message['status'] = 'error';
        self::$message['message'] = $res;
        return new JsonResponse(self::$message); // Cambiado a JsonResponse
    }

    public static function status401(string $res = 'No tiene privilegios para acceder al recurso solicitado'): JsonResponse
    {
        http_response_code(401);
        self::$message['status'] = 'error';
        self::$message['message'] = $res;
        return new JsonResponse(self::$message); // Cambiado a JsonResponse
    }

    public static function status404(string $res = 'Parece que estás perdido, por favor verifica la documentación'): JsonResponse
    {
        http_response_code(404);
        self::$message['status'] = 'error';
        self::$message['message'] = $res;
        return new JsonResponse(self::$message); // Cambiado a JsonResponse
    }

    public static function status500(string $res = 'Error interno del servidor'): JsonResponse
    {
        http_response_code(500);
        self::$message['status'] = 'error';
        self::$message['message'] = $res;
        return new JsonResponse(self::$message); // Cambiado a JsonResponse
    }
}
