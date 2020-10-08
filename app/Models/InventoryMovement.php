<?php


namespace App\Models;


class InventoryMovement extends Model
{

    protected $table = "movimiento_inventario";
    protected $primaryKey = "id_movimiento";
    protected $columns = ["id_movimiento","usuario","tipo","id_inventario"];

    public function list(){
        return $this->getAll();
    }
}