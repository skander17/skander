<?php

	namespace App\Http\Controllers;


    use App\Models\Users;
    use Core\Request;
    use Core\Validator\ValidatorException as ValidatorExceptionAlias;


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
		    $users = $this->model->getAll();
            return $this->view("admin/usuarios",["usuarios"=>$users]);
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
            $validations = [];//$this->validator($request->all(),$rules,$messages);
            if (count($validations)>0){
                return $this->json($validations,422);
            }
            $user =  $this->model->create($request->all());
            return $this->index($request);
        }
        /**
         * @param Request $request
         * @return string
         * @throws ValidatorExceptionAlias
         */
        public function update(Request $request)
        {
            $validations = [];//$this->validator($request->all(),$rules,$messages);
            if (count($validations)>0){
                return $this->json($validations,422);
            }
            $user =  $this->model->update($request->all(),["id"=>$request->params['id']]);
            return $this->index($request);
        }

        /**
         * @param Request $request
         * @return string
         */
        public function destroy(Request $request)
        {
            $user =  $this->model->delete(["id"=>$request->params['id']]);
            return $this->index($request);
        }

	}
