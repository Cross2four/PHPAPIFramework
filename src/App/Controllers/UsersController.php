<?php

namespace App\Controllers {

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

            return $this->respond($data);
        }
    }
}