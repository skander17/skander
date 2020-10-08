<?php


namespace App\Http\Controllers;


use App\Models\Model;
use Core\Request\Request;

class BaseController extends Controller
{
    protected $model;
    protected $name;
    //protected $index_view;

    function __construct($model = null)
    {
        $this->model = ($this->model instanceof Model) ? $this->model : $model;
    }
    //Cuando estudien POO implementan ésto, es un CRUD ya listo, sólo te copiar y pegar
    /**
     * @param Request $request
     * @return string

    public function index(Request $request)
    {
        $data[$this->name] = $this->model->getAll();
        return $this->view($this->index_view,$data);
    }*/
    /**
     * @param Request $request
     * @return string

    public function show(Request $request)
    {
        $record = (!empty($request->params['id'])) ? $this->model->find($request->params['id']) : null;
        if (empty($users)){
            return $this->json(["message"=>"$this->name not Exist","status"=>404],404);
        }
        return $this->json(["usuario"=>$users]);
    } */

    /**
     * @param Request $request
     * @return string

    public function store(Request $request)
    {
        $new =  $this->model->create($request->all());
        return $this->index($request);
    }     */
    /**
     * @param Request $request
     * @return string

    public function update(Request $request)
    {
        $updated = $this->model->update($request->all(),["id"=>$request->id]);
        return $this->index($request);
    }     */

    /**
     * @param Request $request
     * @return string

    public function destroy(Request $request)
    {
        $deleted =  $this->model->delete($request->id);
        return $this->index($request);
    }     */
}