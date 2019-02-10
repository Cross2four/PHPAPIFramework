<?php

namespace App\Controllers {

    use App\Storage\IStorageAdapter;
    use App\Storage\IStorageAdapterFactory;
    use App\Storage\PDOStorageAdapterFactory;

    abstract class Controller
    {
        protected $adapter;

        public function __construct()
        {
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
    }
}