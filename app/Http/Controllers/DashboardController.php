<?php


namespace App\Http\Controllers;


use Core\Request;

class DashboardController extends Controller
{
    public function index(Request $request){
        session_start();
        $data = [
            "proveedor"=>1,
            "clientes"=>1,
            "mercancia"=>1,
            "compras"=>1,
            "ventas"=>1,
            "usuarios"=>1
        ];
        return $this->view('dashboard',$data);
    }
}