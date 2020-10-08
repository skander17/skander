<?php


namespace App\Http\Controllers;


use App\Models\InventoryMovement;

class MovementController extends BaseController
{
    public function __construct($model = null){
        parent::__construct(new InventoryMovement());
    }

    public function index(){
        $data['movimientos'] = $this->model->list();

        return $this->view("/admin/movimientos",$data);
    }
}