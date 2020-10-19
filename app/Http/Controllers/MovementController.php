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
    public $name = "Movimientos de Inventario";
    public function __construct($model = null){
        parent::__construct(new InventoryMovement());
        $this->inventario = new Inventory();
    }

    /**
     * @param Request $request
     * @return string
     */
    public function index(Request $request){
        $data['movimientos'] = $this->model->getAll();
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
            }else{
                $data['productos'] = $this->inventario->getAllExists();
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
            "cantidad"=>"required",
            "id_producto"=>"required",
            "tipo"=>"required"
        ];
        $messages = [
            "cantidad.required" => "La cantidad es obligatoria",
            "id_producto.required" => "Por favor seleccione un producto",
            "tipo.required" => "El tipo es requerido"
        ];
        $data = [];
        $post = $request->all();
        $movimiento = false;
        try {
            $validations = $this->validator($post, $rules, $messages);
        } catch (ValidatorException $e) {
            $validations = ["Error interno al validar"];
        }
        if (!empty($post['id_producto'])){
            $inventario = $this->inventario->getInventoryByProduct($post['id_producto']);
            if(intval($post['cantidad']) > intval($inventario['cantidad'])){
                $validations= ["La cantidad ingresada es mayor a la existente en stock"];
            }
        }
        if (count($validations) > 0){
            $data['productos'] = $this->inventario->getAllExists();
            $data['tipos'] = $this->model->getTypes();

            $data['errors'] = $validations;
            $data['action'] = "crear";
            //TODO se tiene que mandar como objeto, y la función request->all() devuelve un array. por eso se parsea con (object)
            //tener cuidado con ésto
            $data['movimiento'] = (object) $request->all();
            return $this->view("admin/movimientos",$data);
        }
        //se está cargando un producto
        $post['id_inventario'] = $inventario['id'];
        $post['usuario'] = Auth::currentUser()->id;
        $this->inventario->updateQuantity($inventario['id'],$post['tipo'],$post['cantidad']);
        $movimiento = $this->model->create($post);

        return ($movimiento) ?  $this->index($request)  : $this->view("admin/movimientos",$data);
    }
}