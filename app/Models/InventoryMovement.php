<?php


namespace App\Models;


class InventoryMovement extends Model
{

    protected $table = "movimiento_inventario";
    protected $primaryKey = "id_movimiento";
    protected $columns = ["id_movimiento","cantidad","usuario","tipo","id_inventario"];
    protected $alias = ["id_movimiento"=>"Id Movimiento","nombre_prod"=>"Nombre Producto","nombre_cate"=>"Categoría",
        "cantidad"=>"Cantidad de Operación", "nombre_tipo"=>"Tipo de Operación","nombre_usuario" => "Registrador"];

    public function getAll(){
        return $this->rawQuery("
            SELECT *,productos.id as id_producto, usuarios.nombre as nombre_usuario, inventario.cantidad as inventario_cantidad,
             movimiento_inventario.cantidad as cantidad_movimiento 
            FROM movimiento_inventario
                LEFT JOIN inventario ON movimiento_inventario.id_inventario=inventario.id
                LEFT JOIN usuarios ON movimiento_inventario.usuario=usuarios.id
                LEFT JOIN tipo_movimiento ON movimiento_inventario.tipo=tipo_movimiento.id_tipo
                LEFT JOIN productos ON inventario.id_producto=productos.id
                LEFT JOIN categorias ON productos.id_cate=categorias.id
                ORDER BY id_movimiento DESC 
        ");
    }

    public function getMovement($id){
        $movimiento =  $this->rawQuery("
            SELECT *,productos.id as id_producto, usuarios.nombre as nombre_usuario
            FROM movimiento_inventario
                LEFT JOIN inventario ON movimiento_inventario.id_inventario=inventario.id
                LEFT JOIN usuarios ON movimiento_inventario.usuario=usuarios.id
                LEFT JOIN tipo_movimiento ON movimiento_inventario.tipo=tipo_movimiento.id_tipo
                LEFT JOIN productos ON inventario.id_producto=productos.id
                LEFT JOIN categorias ON productos.id_cate=categorias.id
                WHERE id_movimiento = ?                
        ",[$id]);

        return count($movimiento) > 0 ? (object) $movimiento[0] : null;

    }

    public function getTypes(){
        return $this->rawQuery("
            SELECT * FROM tipo_movimiento
        ");
    }
}