<?php


namespace App\Http\Controllers;


use App\Models\Category;
use App\Models\Inventory;
use App\Models\InventoryMovement;
use App\Models\Product;
use App\Services\Auth;
use Core\Request\Request;
use Core\Validator\ValidatorException;

class MovementController extends BaseController
{
    private $inventario;
    public function __construct($model = null){
        parent::__construct(new InventoryMovement());
        $this->inventario = new Inventory();
    }

    /**
     * @param Request $request
     * @return string
     */
    public function index(Request $request){
        $data['movimientos'] = $this->model->list();
        $data['tipos'] = $this->model->getTypes();
        $data['categorias'] = (new Category())->getAll();
        $data['movimiento'] = $this->model->cleanObject((new Product())->getColumns());
        $data['action'] = $request->params['action'] ?? 'listar';
        if ($data['action'] == 'editar'){
            $data['movimiento'] = $this->model->getMovement($request->params['id_movimiento']);
        }else{
            if ($request->has('producto_id') AND $request->has('tipo')){
                $data['movimiento'] = Product::get($request->producto_id);
                $data['movimiento']->id_producto = $request->producto_id;
                foreach ($this->model->cleanObject() as $key => $value){
                    $data['movimiento']->$key = $value;
                }
                $data['movimiento']->tipo = $request->tipo;
            }
        }
        return $this->view("/admin/movimientos",$data);
    }

    /**
     * @param Request $request
     * @return string
     */
    public function store(Request $request)
    {
        $rules =  [
            "cantidad"=>"required"
        ];
        $messages = [
            "cantidad.required" => "La cantidad es obligatoria"
        ];
        $data = [];
        $movimiento = false;
        try {
            $validations = $this->validator($request->all(), $rules, $messages);
        } catch (ValidatorException $e) {
            $validations = ["Error interno al validar"];
        }
        if (count($validations) > 0){
            $data['errors'] = $validations;
            $data['action'] = "crear";
            //TODO se tiene que mandar como objeto, y la función request->all() devuelve un array. por eso se parsea con (object)
            //TODO tener cuidado con ésto
            $data['movimiento'] = (object) $request->all();
        }else{
            $post = $request->all();
            $post['usuario'] = Auth::currentUser()->id;
            //se está cargando un producto
            if (isset($post['id_producto'])){
                $inventario = $this->inventario->getInventoryByProduct($post['id_producto']);
                $post['id_inventario'] = $inventario['id'];
                $this->inventario->updateQuantity($inventario['id'],$post['tipo'],$post['cantidad']);
            }
            $movimiento = $this->model->create($post);
        }
        return ($movimiento) ?  $this->index($request) : $this->view("admin/movimientos",$data);
    }
}