<?php


namespace App\Http\Controllers;


use App\Models\Users;
use Core\Request\Request;

class AuthController extends BaseController
{
    public function __construct()
    {
        parent::__construct(new Users());
    }

    public function auth(Request $request)
    {
        session_start();
        if (!isset($_SESSION['usuario'])){
            return false;
        }
        $session = $_SESSION['usuario'];

        $user = $this->model->rawQuery("SELECT * FROM usuarios WHERE id = ? AND status = ?",[$session,1]);
        return (count($user)>0);
    }
    public function home(Request $request){
        if ($this->auth($request)) {
            $this->redirect('/admin/dashboard');
        } else {
            $this->redirect('login');
        }
    }

    /**
     * @param Request $request
     * @return string
     */
    public function login(Request $request)
    {
        $errores= "";
        $res= null;
        if(isset($request->body['email']) && isset($request->body['pass'])){
            $usuario = $_POST['email'];
            $pass = $_POST['pass'];
            $val_user = $this->model->rawQuery("SELECT * FROM usuarios WHERE status = ? AND email = ? AND password = ? LIMIT 1",[1,$usuario,$pass]);
            if (count($val_user)==0){
                $errores .='<div class="alert alert-danger mt-3 text-center"><strong class=" display-1"><i class="far fa-exclamation-triangle"></i><br>Error</strong> <br>Correo o clave incorrecta.</div>';
            }
            $res = $val_user[0];

            if ($res){
                session_start();
                $_SESSION['usuario'] = $res['id'];
                $this->redirect('/admin/dashboard');
            }
        }
        $data = [
            "errores"=>$errores
        ];
        return $this->view("login",$data);
    }
    /**
     * @param Request $request
     */
    public function logout(Request $request)
    {
        session_start();
        session_destroy();
        $_SESSION['usuario'] = null;
        $this->redirect('/login');
    }

    public function unauthorized(Request $request){
        return $this->view("unauthorized");
    }
}