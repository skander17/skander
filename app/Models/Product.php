<?php


namespace App\Models;


class Product extends Model
{
    protected  $table = "productos";
    protected  $columns = ["id", "nombre_prod","id_cate", "precio_v","precio_c","disponible"];
    protected  $alias = ["id"=>"Id", "nombre_prod"=>"Nombre Producto","descripcion_cate"=>"Categoria",
        "precio_v"=>"Precio Venta", "precio_c"=>"Precio Compra","disponible"=>"Disponible","cantidad"=>"Stock"];

    public function getAll()
    {
        return $this->rawQuery("
            SELECT productos.*, categorias.nombre_cate,code_cate,descripcion_cate,inventario.cantidad
             FROM productos 
             LEFT JOIN categorias ON categorias.id = productos.id_cate
             LEFT JOIN inventario ON inventario.id_producto = productos.id
        ");
    }
    public static function get($id){
        return (new self())->find($id);
    }
}