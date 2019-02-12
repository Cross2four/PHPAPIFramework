<?php

namespace App\Controllers {

    use App\Responses\IResponse;
    use App\Storage\PDOStorageAdapterFactory;
    use PDO;

    abstract class Controller
    {
        private $adapter;
        private $response;

        public function __construct(IResponse $response)
        {
            $this->response = $response;

            $dbConfig = config('database');

            if ($dbConfig->driver == 'mysql' && $dbConfig->db_module == 'pdo') {
                $pdo = new PDO(
                    $dbConfig->driver . ':host=' . $dbConfig->address . ';dbname=' . $dbConfig->database,
                    $dbConfig->username,
                    $dbConfig->password,
                    [
                        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
                    ]
                );

                $this->adapter = (new PDOStorageAdapterFactory())->createStorageAdapter($pdo);
            }

            // We could create another type of Storage Adapter here if we wanted that used another DB access method.
        }

        protected function respond(array $data)
        {
            return $this->response->getResponse($data);
        }

        protected function getAdapter()
        {
            return $this->adapter;
        }
    }
}