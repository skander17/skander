<?php


namespace App\Http\Controllers;



use Core\Request\Request;

class DashboardController extends BaseController
{
    public function index(Request $request){
        $data = [
            "proveedor"=>1,
            "clientes"=>1,
            "mercancia"=>1,
            "compras"=>1,
            "ventas"=>1,
            "usuarios"=>1
        ];
        return $this->view('admin/dashboard',$data);
    }
}