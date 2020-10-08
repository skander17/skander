<?php

	namespace App\Http\Controllers;


    use App\Models\Users;
    use Core\Request\Request;
    use Core\Validator\ValidatorException;


    class UserController extends BaseController
	{
	    public function __construct()
        {
            parent::__construct(new Users());
        }

        /**
         * @param Request $request
         * @return string
         */
        public function index(Request $request)
        {
            $data = [];
            $data['action'] = $request->params['action'] ?? 'listar';
            $data['usuarios'] = $this->model->list();
            $data['usuario']  = ($data['action'] == 'editar')
                ?$this->model->find($request->params['id']) : $data['usuario'] = $this->model->cleanObject() ;
            return $this->view("admin/usuarios",$data);
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
            $rules =  [
                "email"=>"required|email"
            ];
            $messages = [
                "email.required" => "El Email es obligatorio"
            ];
            $user = false;
            $data = [];
            try {
                $validations = $this->validator($request->all(), $rules, $messages);
            } catch (ValidatorException $e) {
                $validations = ["Error interno al validar"];
            }
            if (count($validations) > 0){
                $data['errors'] = $validations;
                $data['action'] = "crear";
            }else{
                $user =  $this->model->create($request->all());
            }
            return ($user) ?  $this->index($request) : $this->view("admin/usuarios",$data);
        }
        /**
         * @param Request $request
         * @return string
         */
        public function update(Request $request)
        {
            $rules =  [
                "email"=>"email"
            ];
            $messages = [
                "email" => "El Email es obligatorio"
            ];
            $updated = false;
            try {
                $validations = $this->validator($request->all(), $rules, $messages);
            } catch (ValidatorException $e) {
                echo $e->getMessage();
                $validations = ["Error interno al validar"];
            }
            if (count($validations) > 0){
                $data['errors'] = $validations;
                $data['action'] = "editar";
            }else{
                $updated =  $this->model->update($request->all(),["id"=>$request->id]);
            }
            $data['usuario'] = (object) $request->body;
            return ($updated) ?  $this->index($request) : $this->view("admin/usuarios",$data);
        }

        /**
         * @param Request $request
         * @return string
         */
        public function destroy(Request $request)
        {
            if ($request->has("id")){
                $user =  $this->model->delete(["id"=>$request->id]);
            }
            return $this->index($request);
        }

	}
