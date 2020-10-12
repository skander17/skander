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

        $user = $this->model->rawQuery("SELECT * FROM usuarios WHERE id = ? AND status = ? AND rol IN (1,2,3)",[$session,1]);
        return (count($user)>0);
    }

    public function home(Request $request){
        if ($this->auth($request)) {
            $this->redirect('/admin/estadisticas');
        } else {
            return $this->view("login");
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
            $val_user = $this->model->rawQuery("SELECT * FROM usuarios WHERE email = ? AND password = ? LIMIT 1",[$usuario,$pass]);
            if (count($val_user)==0){
                $errores .='<div class="alert alert-danger mt-3 text-center"><i class="far fa-exclamation-triangle mx-5"></i><br>Error: Correo o clave incorrecta.</div>';
            }elseif($val_user[0]['status'] <> 1){
                $errores .='
                <div class="alert alert-danger text-center">
                    <i class="fas fa-exclamation-triangle mx-4"></i>Error: Usuario bloqueado
                </div>';
                $val_user = [];
            }
            $res = count($val_user) > 0 ? $val_user[0] : null;

            if ($res){
                session_start();
                $_SESSION['usuario'] = $res['id'];
                $this->redirect('/admin/estadisticas');
            }
        }
        $data = [
            "errores"=>$errores
        ];
        return $this->view("/login",$data);
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