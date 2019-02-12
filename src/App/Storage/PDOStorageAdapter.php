<?php

namespace App\Storage {

    use App\CustomExceptions\NotImplementedException;
    use App\CustomExceptions\StorageAdapterException;
    use App\Models\Model;
    use PDO;
    use PDOException;

    class PDOStorageAdapter implements IStorageAdapter
    {

        private $pdo;

        public function __construct(PDO $pdo)
        {
            $this->pdo = $pdo;
        }

        public function find(int $id, $modelClass) : Model
        {
            $newModel = new $modelClass;

            if (!is_subclass_of($newModel, Model::class)) {
                throw new StorageAdapterException('You must supply a class name for a class that extends Model');
            }

            $tableName = $newModel->getTableName();

            $statement = $this->pdo->prepare('select * from :table where id = :id');
            try {
                $statement->execute([
                    'table' =>  $tableName,
                    'id'    =>  $id
                ]);

                $data = $statement->fetch();
            } catch (PDOException $e) {
                throw new StorageAdapterException("There was a problem reading from the Database.", 0, $e);
            }

            $newModel->assignFields($data);

            return $newModel;
        }

        public function save(Model $model) : bool
        {
            $tableName = $model->getTableName();
            $updateStrings = [];

            foreach ($model as $key => $value) {

                if (is_string($value) || is_numeric($value) && $key != 'id') { // For now, we only support strings and numbers
                    $updateStrings[$key] = $value;
                }
            }

            if (is_null($model->getId())) {
                $stringQuery = $this::getUpdateQueryString($updateStrings, $model->getId());

                $statement = $this->pdo->prepare($stringQuery);

                $updateStrings['table'] = $tableName;
                $result = $statement->execute($updateStrings);

                if ($result) {
                    return true;
                }
            }

            $stringQuery = $this::getInsertQueryString($updateStrings);
            $statement = $this->pdo->prepare($stringQuery);

            $updateStrings['table'] = $tableName;
            $result = $statement->execute($updateStrings);

            if ($result) {
                $model->setId($this->pdo->lastInsertId());
                return true;
            }
        }

        public function delete(int $id, $modelClass) : bool
        {
            // TODO: Implement delete() method.
            throw new NotImplementedException('Method not implemented');
        }

        private static function getUpdateQueryString($updateStrings, $id) {

            $stringQuery = 'update :table set (';
            $firstFlag = true;

            foreach ($updateStrings as $key => $value) {

                if (!$firstFlag) {
                    $stringQuery .= ', ';
                } else {
                    $firstFlag = false;
                }
                $stringQuery .= "$key = :$key";
            }

            $stringQuery .= ") where id = $id";

            return $stringQuery;
        }

        private static function getInsertQueryString($updateStrings) {

            $stringQuery = 'update :table set (';
            $firstFlag = true;

            foreach ($updateStrings as $key => $value) {

                if (!$firstFlag) {
                    $stringQuery .= ', ';
                } else {
                    $firstFlag = false;
                }
                $stringQuery .= "$key";
            }

            $stringQuery .= ') values (';

            foreach ($updateStrings as $key => $value) {
                if (!$firstFlag) {
                    $stringQuery .= ', ';
                } else {
                    $firstFlag = false;
                }
                $stringQuery .= ":$key";
            }

            $stringQuery .= ')';

            return $stringQuery;
        }
    }
}