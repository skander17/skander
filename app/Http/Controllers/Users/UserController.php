<?php

	namespace App\Http\Controllers\Users;

    use App\Controllers\Controller;
    use App\Models\Users;
    use Core\Request;
    use Core\Validator\ValidatorException as ValidatorExceptionAlias;


    class UserController extends Controller
	{
	    public function __construct()
        {
            parent::__construct(new Users());
        }

        /**
         * @param Request $request
         * @return string
         */
        public function index(Request $request): string
        {
		    $users = (!empty($request->body['id'])) ? $this->model->find(1) : $this->model->getAll();
            return $this->json($users,200);
		}

        /**
         * @param Request $request
         * @return string
         * @throws ValidatorExceptionAlias
         */
        public function store(Request $request): string
        {
            $rules =  [
                "nickname"=>"required",
                "email"=>"required|email"
            ];
            $messages = [
                "nickname.required" => "El Nickname es obligatorio",
                "email.required" => "El Email es obligatorio"
            ];
            $validations = $this->validator($request->all(),$rules,$messages);
            if (count($validations)>0){
                return $this->json($validations,422);
            }
            $user =  $this->model->create($request->all());
            return $this->json(["message"=>"Usuario creado con éxito","user"=>$user],201);
        }

        /**
         * @param Request $request
         * @return string
         */
        public function test_view(Request $request): string
        {
		    $users = $this->model->getAll();
			return $this->view("test",["users"=>$users,"count"=>count($users)]);
		}


	}
