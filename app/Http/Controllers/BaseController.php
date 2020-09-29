<?php


namespace App\Http\Controllers;


use App\Models\Model;

class BaseController extends Controller
{
    protected $model;
    protected $name;

    function __construct($model = null)
    {
        $this->model = ($this->model instanceof Model) ? $this->model : $model;
    }
}