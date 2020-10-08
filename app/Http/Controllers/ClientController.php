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
        $data['clientes'] = $this->model->list();
        $data['action'] = $request->params['action'] ?? 'listar';
        $data['cliente'] = ($data['action'] == 'editar')
            ? $this->model->find($request->params['id'])
            :$this->model->cleanObject($this->model->identifier()->getColumns());
        return $this->view("admin/clients",$data);
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
        $user =  $this->model->destroy($request->id);
        return $this->index($request);
    }

}