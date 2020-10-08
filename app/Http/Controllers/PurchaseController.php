<?php


namespace App\Http\Controllers;


use App\Models\Purchase;
use Core\Request\Request;

class PurchaseController extends BaseController
{
    public function __construct()
    {
        parent::__construct(New Purchase());
    }

    public function index(Request $request){
        $data['compras'] = $this->model->list();
        return $this->view('purchase',$data);
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
        $user =  $this->model->create($request->all());
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
        $user =  $this->model->delete($request->id);
        return $this->index($request);
    }
}