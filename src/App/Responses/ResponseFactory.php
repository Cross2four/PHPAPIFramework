<?php

namespace App\Responses {

    use InvalidArgumentException;

    class ResponseFactory
    {
        public static function getResponseObject($type): IResponse
        {
            switch ($type) {
                case ResponseType::JSON:
                    return new JSONResponse();
                    break;
                case ResponseType::XML:
                    return new XMLResponse();
                    break;
                default:
                    throw new InvalidArgumentException("Invalid Response type given");
                    break;
            }
        }
    }
}