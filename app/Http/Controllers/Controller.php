<?php

namespace App\Http\Controllers;

use Core\Validator\Validator;

    class Controller
	{
	    use Validator;


        /**
         * @param $response
         * @param int $code
         * @return false|string
         */
        public function json($response, $code=200)
		{
			header("content-type: application/json", null, $code);
            return json_encode($response) ?: "";
		}

        /**
         * @param $name
         * @param array $arguments
         * @return false|string
         */
        public function view($name, $arguments=[])
		{
		    if (!$this->viewExist($name)){
		        return $this->importView("not_found", $arguments);
            }
		    return $this->importView($name, $arguments);

		}

        /**
         * @param $name
         * @param $arguments
         * @return false|string
         */
        public function importView($name, $arguments){
            ob_start();
            extract($arguments);
            include ROOT_PATH . "helpers.php";
            $resource = RESOURCE_PATH . "/views/{$name}.php";
            include $resource;
            $result = ob_get_contents();
            ob_end_clean();
            return $result;
        }

        /**
         * @param $name
         * @return bool
         */
        public function viewExist($name){
            $resource = RESOURCE_PATH . "/views/{$name}.php";
		    return file_exists($resource);
        }

        /**
         * @param string $uri
         */
        public function redirect(string $uri){
           return header('location: ' . $uri);
        }
	}