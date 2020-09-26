<?php

namespace App\Models;

use Core\Connection;


	class Model extends Connection
	{
        protected  $table;
        protected  $primaryKey = 'id';
        protected  $columns = [];
        private $first = false;
        private $all = false;


        /**
         * @return string
         */
        public function sayHello(){
            return "a simple message from model";
        }

        /**
         * @return array
         */

        public function getAll(){
            $conn = $this->getConnection();
            $select = implode(",", $this->columns);
            $query = $conn->prepare("SELECT $select FROM $this->table");
            //$query->bindValue(1, $this->table,PDO::PARAM_STR);
            $query->execute();
            return $query->fetchAll();
        }
        /**
         * @param  int $id
         * @return object|null
         */
        public function find($id){
            $conn = $this->getConnection();
            $select = implode(",", $this->columns);
            $query = $conn->prepare("SELECT $select FROM  $this->table WHERE $this->primaryKey=? LIMIT 1");
            //$query->bindValue(1, $this->primaryKey,PDO::PARAM_STR);
            $query->bindValue(1, $id);
            $query->execute();
            $record = $query->fetchAll();
            return count($record)>0 ? (object) $record[0] : null;
        }
        public function getFill($data){
            return array_intersect_key($data, array_flip($this->columns));
        }
        /**
         * @param  array $data
         * @return object|null
         */
        public function create(array $data){
            if (empty($data)){
                return null;
            }
            $data =  $this->getFill($data);
            $columns = array_keys($data);
            $values = array_values($data);
            $conn = $this->getConnection();
            $fields = implode(',', $columns);
            $bind_values = implode(',', array_fill(0, count($columns), '?'));
            $query = $conn->prepare("INSERT INTO $this->table ($fields) VALUES ($bind_values) RETURNING id");
            foreach ($values as $key => $value){
                $query->bindValue(($key+1), $value);
            }
            $query->execute();
            $record = $query->fetchAll();
            $id =  count($record)>0 ? $record[0]->id : null;
            return !empty($id) ? $this->find($id) : null;
        }

        /**
         * @param array $data
         * @param array $wheres
         * @return object|null
         */
        public function update(array $data,array $wheres){
            if (empty($data)){
                return null;
            }
            $data =  $this->getFill($data);
            $set_update ="";
            $i=0;
            foreach ($data as $key => $value){
                $set_update .= ($i!==0) ? ",$key = ?" : "$key = ?";
                $i++;
            }
        }

        public function rawQuery($query,$binParams = []){
            $conn = $this->getConnection();
            $query = $conn->prepare($query);
            foreach ($binParams as $key => $value){
                $query->bindValue(($key+1), $value);
            }
            $query->execute();
            return $query->fetchAll();
        }

        public function hash($password) : string {
            return password_hash($password, PASSWORD_BCRYPT);
        }
        public function checkHash(string $password, string $hash) : bool {
            return password_verify($password, $hash);
        }
	}