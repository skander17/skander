<?php


namespace App\Models;


class Sale extends Model
{
    protected $table = "ventas";
    protected $primaryKey = "id_ventas";
    protected $columns = ["id_ventas","monto_total","recibo","tipo_pago","recerencia","fecha","cliente"];
}