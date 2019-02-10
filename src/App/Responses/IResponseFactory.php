<?php

namespace App\Responses {

    interface IResponseFactory
    {
        public function getResponseObject($type) : IResponse;
    }
}