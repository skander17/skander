<?php


namespace App\Models;


class Inventory extends Model
{
    protected $table = "inventario";
    protected $primaryKey = "id";
    protected $columns = ["id","code","id_producto","cantidad"];
    protected $alias = ["id"=>"Id","code"=>"Codigo","nombre_prod"=>"Nombre Producto","nombre_cate"=>"Categoría",
        "cantidad"=>"Stock","disponible"=>"Disponible"];


    public function getAll(){
        return $this->rawQuery("
            SELECT * from inventario 
            LEFT JOIN productos ON inventario.id_producto=productos.id
            LEFT JOIN categorias ON categorias.id = productos.id_cate
        ");
    }

    public function getInventoryByProduct($id_producto){
        $inventario = $this->rawQuery("
            SELECT * FROM inventario WHERE id_producto = ?
        ",[$id_producto]);
        return count($inventario)>0 ? $inventario[0] : null;
    }

    public function updateQuantity($id,$type,$quantity)
    {
        $type = intval($type);
       $inventory= $this->find($id);
       if ($type == 1){
           $quantity = intval($inventory->cantidad )+ intval($quantity);
       }elseif(in_array(intval($type),[2,3,4])){
           $quantity = intval($inventory->cantidad ) - intval($quantity);
       }
        return $this->update(["cantidad"=>$quantity],["id"=>$id]);
    }
}