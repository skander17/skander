<?php


namespace App\Models;


class PurchaseDetail extends Model
{
    protected $table = "det_compras";
    protected $primaryKey = "id_compra";
    protected $columns = ["id_compra","producto","cantidad","id_movimiento"];

    public function find($id)
    {
        $record = $this->rawQuery(
          "SELECT * FROM det_compras 
                        JOIN productos ON det_compras.producto=productos.id
                        WHERE det_compras.id=?",[$id]
        );
        return count($record) > 0 ? $record[0] : null;
    }
}