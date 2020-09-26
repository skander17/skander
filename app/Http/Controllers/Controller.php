<?php

namespace App\Http\Controllers;

use App\Models\Model;
use Core\Validator\Validator;

    class Controller
	{
	    use Validator;

		protected $model;
		function __construct($model = null)
		{
			$this->model = ($this->model instanceof Model) ? $this->model : $model;
		}


		public function json($response,$code=200)
		{
			header("content-type: application/json", null, $code);
            return json_encode($response);
		}

		public function view($name,$arguments=[])
		{
		    if (!$this->viewExist($name)){
		        return $this->importView("not_found", $arguments);
            }
		    return $this->importView($name, $arguments);

		}

		public function importView($name,$arguments){
            ob_start();
            extract($arguments);
            include ROOT_PATH . "helpers.php";
            $resource = RESOURCE_PATH . "/views/{$name}.php";
            include $resource;
            $result = ob_get_contents();
            ob_end_clean();
            return $result;
        }

		public function viewExist($name){
            $resource = RESOURCE_PATH . "/views/{$name}.php";
		    return file_exists($resource);
        }

        public function redirect(string $uri){
            header('location: ' . $uri);
        }
	}