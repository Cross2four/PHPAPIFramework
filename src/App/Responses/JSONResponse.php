<?php

namespace App\Responses {

    class JSONResponse implements IResponse
    {
        private $response;

        public function __construct()
        {
            $this->response = [];
            set_exception_handler([self::class, 'exceptionHandler']);
        }

        public function getResponse(array $array) : string
        {
            try {
                http_response_code(200);
                array_push($this->response, ['success' => true]);
                array_push($this->response, $array);
            } catch (\Exception $e) {
                http_response_code(500);
                array_push($this->response, ['success' => false]);
                array_push($this->response, ['exception' => $e->getTraceAsString()]);
            } finally {
                return json_encode($this->response);
            }
        }

        public static function exceptionHandler($e)
        {
            header('Content-Type: application/json');

            $response = [
                'error' => [
                    'code' => $e->getCode(),
                    'msg' => $e->getMessage()
                ]
            ];

            echo json_encode($response);
        }
    }
}