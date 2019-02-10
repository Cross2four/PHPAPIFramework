<?php

namespace App\Controllers {

    use App\Responses\ResponseFactory;
    use App\Responses\ResponseType;

    class UsersController extends Controller
    {
        public function index()
        {
            $data = [
                'users' => [
                    ['id' => 1, 'name' => 'Tobias'],
                    ['id' => 2, 'name' => 'Tom'],
                ]
            ]; // currently mocked

            $responseFactory = new ResponseFactory();
            $response = $responseFactory->getResponseObject(ResponseType::JSON);
            return $response->getResponse($data);
        }
    }
}