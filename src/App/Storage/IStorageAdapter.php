<?php

namespace App\Storage {

    use App\Models\Model;

    interface IStorageAdapter
    {
        public function find(int $id, $modelClass) : Model;
        public function save(Model $model) : bool;
        public function delete(int $id, $modelClass) : bool;
    }
}