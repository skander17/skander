<?php


namespace App\Http\Controllers;


use App\Models\Client;
use Core\Request\Request;

class ClientController extends BaseController
{
    public function __construct()
    {
        parent::__construct(new Client());
    }

    /**
     * @param Request $request
     * @return string
     */
    public function index(Request $request)
    {
        $clientes = $this->model->list();
        return $this->view("admin/clients",$clientes);
    }
    /**
     * @param Request $request
     * @return string
     */
    public function show(Request $request)
    {
        $users = (!empty($request->params['id'])) ? $this->model->find($request->params['id']) : null;
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
        $user =  $this->model->delete(["id"=>$request->id]);
        return $this->index($request);
    }

}