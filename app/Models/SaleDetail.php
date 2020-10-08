<?php


namespace App\Models;


class SaleDetail extends Model
{
    protected $table = "det_ventas";
    protected $primaryKey = "id";
    protected $columns = ["id","id_venta","producto","cantidad","id_movimiento"];
}