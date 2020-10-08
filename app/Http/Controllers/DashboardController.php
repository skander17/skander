<?php


namespace App\Http\Controllers;



use App\Models\Model;
use Core\Request\Request;

class DashboardController extends BaseController
{
    public function __construct($model = null)
    {
        parent::__construct(new Model());
    }

    public function index(Request $request){
        $proveedores = $this->model->rawQuery("SELECT COUNT(id) as total FROM proveedores;");
        $clientes = $this->model->rawQuery("SELECT COUNT(id) as total FROM clientes;");
        $productos = $this->model->rawQuery("SELECT COUNT(id) as total FROM productos;");
        $compras = $this->model->rawQuery("SELECT COUNT(id_compra) as total FROM compras;");
        $ventas = $this->model->rawQuery("SELECT COUNT(id_venta) as total FROM ventas;");
        $usuarios = $this->model->rawQuery("SELECT COUNT(id) as total FROM usuarios;");
        $data = [
            "proveedor"=>$proveedores[0]['total'],
            "clientes"=>$clientes[0]['total'],
            "mercancia"=>$productos[0]['total'],
            "compras"=>$compras[0]['total'],
            "ventas"=>$ventas[0]['total'],
            "usuarios"=>$usuarios[0]['total']
        ];
        return $this->view('admin/dashboard',$data);
    }
}