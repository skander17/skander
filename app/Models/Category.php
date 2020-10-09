<?php


namespace App\Models;


class Category extends Model
{
        protected $table = "categorias";
        protected $columns = ["id","code_cate","nombre_cate","descripcion_cate"];
}