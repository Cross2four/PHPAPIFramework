<?php

namespace App\Storage {

    use PDO;

    interface IStorageAdapterFactory
    {
        public function createStorageAdapter(PDO $pdo): IStorageAdapter;
    }
}