<?php

namespace App\Models;


	use Core\DB\DB;

    class Model extends DB
	{
        protected  $table;
        protected  $primaryKey = 'id';
        protected  $columns = [];


        /**
         * @return string
         */
        public function sayHello(){
            return "a simple message from model";
        }

        /**
         * @param array $extra
         * @return object
         */

        public function cleanObject($extra = []){
            $fill = array_merge($extra,$this->columns);
            return (object) array_combine($fill,(array_fill(0,count($fill),null)));
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
            $result= $query->fetchAll();
            $query->closeCursor();
            return $result;
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
            $query->closeCursor();
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
            $query = $conn->prepare("INSERT INTO $this->table ($fields) VALUES ($bind_values)");
            foreach ($values as $key => $value){
                $query->bindValue(($key+1), $value);
            }
            $query->execute();
            $last = $conn->prepare("SELECT LAST_INSERT_ID() as id;");
            $last->execute();
            $record = $last->fetchAll();
            $id =  count($record)>0 ? $record[0]['id'] : null;
            $query->closeCursor();
            return !empty($id) ? $this->find($id) : null;
        }

        /**
         * @param array $data
         * @param array $wheres
         * @return bool
         */
        public function update(array $data,array $wheres){
            if (empty($data)){
                return null;
            }
            $data =  $this->getFill($data);
            $set_update ="";
            $i=0;
            $result_wheres= "";
            $values = array_merge(array_values($data),array_values($wheres));
            foreach ($data as $key => $value){
                $set_update .= ($i!==0) ? ",$key = ?" : "$key = ?";
                $i++;
            }
            $i = 0;
            foreach ($wheres as $key => $value){
                $result_wheres .= ($i==0) ? "WHERE $key=?" : "AND $key=?";
            }
            $query = $this->getConnection()->prepare("
                UPDATE $this->table
                SET $set_update
                $result_wheres
            ");
            foreach ($values as $key => $value){
                $query->bindValue(($key+1), $value);
            }

            $result = $query->execute();
            $query->closeCursor();
            return !empty($result) ? $result : null;
        }

        public function delete(array $wheres){
            $i = 0;
            $result_wheres ="";
            foreach ($wheres as $key => $value){
                $result_wheres .= ($i==0) ? "WHERE $key=?" : "AND $key=?";
            }
            $query = $this->getConnection()->prepare("
                DELETE FROM $this->table $result_wheres
            ");
            $values = array_values($wheres);
            foreach ($values as $key => $value){
                $query->bindValue(($key+1), $value);
            }
            $result = $query->execute();
            $query->closeCursor();
            return !empty($result) ? $result : null;
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
        public function getColumns(){
            return $this->columns;
        }
    }