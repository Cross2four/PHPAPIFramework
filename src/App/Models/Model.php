<?php

namespace App\Models {

    use App\CustomExceptions\DataModelConfigException;

    abstract class Model
    {
        protected $table = '';
        protected $id;

        public function __construct()
        {
            if ($this->table == '') {
                throw new DataModelConfigException("You must set a value for the protected class field \"table\" in your model class");
            }
        }

        public function getTableName()
        {
            return $this->table;
        }

        public function assignFields($data)
        {
            foreach ($data as $key => $value) {
                if (property_exists(get_class($this), $key)) {
                    $this->$key = $value;
                } else {
                    throw new DataModelConfigException("Your Model does not have the field: $key");
                }
            }
        }

        public function setId($newId)
        {
            if (isset($this->id)) {
                return;
            }
            $this->id = $newId;
        }

        public function getId() : int
        {
            return $this->id;
        }
    }
}