<?php


namespace App\Models;


class Coin extends Model
{
    protected $table = "monedas";
    protected $primaryKey = "id_monedas";
    protected $columns = ["id_monedas","nombre","simbolo","tasa_cambio"];
}