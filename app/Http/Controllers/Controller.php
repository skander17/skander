<?php

namespace App\Http\Controllers;

use Core\Validator\Validator;
use Core\Views\View;

class Controller extends View
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
            return json_encode($response);
		}

        /**
         * @param string $uri
         */
        public function redirect($uri){
           return header('location: ' . $uri);
        }

        public function view($view, $data = []){
            return View::render($view,$data);
        }
	}