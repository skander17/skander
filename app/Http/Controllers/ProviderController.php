<?php


namespace App\Http\Controllers;



use App\Models\Provider;
use Core\Request\Request;

class ProviderController extends BaseController
{
    public function __construct()
    {
        parent::__construct(new Provider());
    }


    /**
     * @param Request $request
     * @return string
     */
    public function index(Request $request)
    {
        $data['proveedores'] = $this->model->getAll();
        $data['action'] = $request->params['action'] ?? 'listar';
        if ($data['action'] == 'editar'){
            $data['proveedor'] = $this->model->find($request->params['id']);
        }else{
            $data['proveedor'] = $this->model->cleanObject($this->model->identifier()->getColumns());
        }
        return $this->view("admin/providers",$data);
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
        if ($request->has('id')){
            $provider =  $this->model->destroy($request->id);
        }
        return $this->index($request);
    }
}