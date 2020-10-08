<?php


namespace Core\Interfaces;


interface ModelInterface
{
    public static function all();

    public static function find($primaryKey);

    public static function create(array $data);

    public static function update(array $data,array $wheres);

    public static function delete(array $wheres);
}