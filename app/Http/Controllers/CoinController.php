<?php


namespace App\Http\Controllers;


use App\Models\Coin;
use Core\Request\Request;

class CoinController extends BaseController
{
    public $name = "Monedas";
    public function __construct()
    {
        parent::__construct(new Coin());
    }

    /**
     * @param Request $request
     * @return string
     */
    public function index(Request $request)
    {
        $data['monedas'] = $this->model->getAll();
        $data['action'] = $request->params['action'] ?? 'listar';
        if ($data['action'] == 'editar'){
            $data['moneda'] = $this->model->find($request->params['id']);
        }else{
            $data['moneda'] = $this->model->cleanObject();
        }
        return $this->view("admin/monedas",$data);
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
        $stored =  $this->model->create($request->all());
        return $this->index($request);
    }
    /**
     * @param Request $request
     * @return string
     */
    public function update(Request $request)
    {
        $updated = $this->model->update($request->all(),["id"=>$request->id]);
        return $this->index($request);
    }

    /**
     * @param Request $request
     * @return string
     */
    public function destroy(Request $request)
    {
        if ($request->has('id')){
            $deleted =  $this->model->delete(['id_monedas'=>$request->id]);
        }
        return $this->index($request);
    }
}