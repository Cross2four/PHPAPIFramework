<?php

namespace App\Storage {

    use PDO;

    class PDOStorageAdapterFactory implements IStorageAdapterFactory
    {

        public function createStorageAdapter(PDO $pdo): IStorageAdapter
        {
            return new PDOStorageAdapter($pdo);
        }
    }
}