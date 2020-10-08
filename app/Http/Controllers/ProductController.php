<?php


namespace App\Http\Controllers;


use App\Models\Category;
use App\Models\Product;
use Core\Request\Request;

class ProductController extends BaseController
{
    public function __construct()
    {
        parent::__construct(new Product());
    }

    /**
     * @param Request $request
     * @return string
     */
    public function index(Request $request)
    {
        $data['productos'] = $this->model->getAll();
        $data['action'] = $request->params['action'] ?? 'listar';
        $data['categorias'] = (new Category())->getAll();
        if ($data['action'] == 'editar'){
            $data['producto'] = $this->model->find($request->params['id']);
        }else{
            $data['producto'] = $this->model->cleanObject();
        }
        return $this->view("admin/products",$data);
    }
    /**
     * @param Request $request
     * @return string
     */
    public function show(Request $request)
    {
        $users = (!empty($request->params['id'])) ? $this->model->find($request->params['id']) : null;
        if (empty($users)){
            return $this->json(["message"=>"Product not Exist","status"=>404],404);
        }
        return $this->json(["usuario"=>$users]);
    }

    /**
     * @param Request $request
     * @return string
     */
    public function store(Request $request)
    {
        $data =  $request->all();
        if (empty($data['id_cate'])){
            $data['id_cate'] = null;
        }
        $data['disponible'] = isset($data['disponible']) ? 1 : 0;
        $product = $this->model->create($data);
        return $this->index($request);
    }
    /**
     * @param Request $request
     * @return string
     */
    public function update(Request $request)
    {
        $data =  $request->all();
        if (empty($data['id_cate'])){
            $data['id_cate'] = null;
        }
        $data['disponible'] = isset($data['disponible']) ? 1 : 0;
        $updated = $this->model->update($data,["id"=>$request->id]);
        return $this->index($request);
    }

    /**
     * @param Request $request
     * @return string
     */
    public function destroy(Request $request)
    {
        $deleted =  $this->model->delete(["id"=>$request->id]);
        return $this->index($request);
    }
}