<?php

namespace App\Controllers;

use App\Models\User;
use Illuminate\Database\Capsule\Manager as Capsule;

class UserController extends BaseController
{
    public function register()
    {
        return view('user/register', [
            'title' => 'Register page',
        ]);
    }

    public function store()
    {
        $model = new User();
        $model->loadData();
        if (!$model->validate()) {
            session()->setFlash('error', 'Validation errors');
            session()->set('form_errors', $model->getErrors());
            session()->set('form_data', $model->attributes);
        } else {
            if ($model->save())  {
                session()->setFlash('success', 'Thanks for registration');
            } else {
                session()->setFlash('error', 'Error registration');
            };
//            session()->setFlash('info', 'Info message...');
        }
        response()->redirect('/register');
    }

    public function login()
    {
        return view('user/login', [
            'title' => 'Login page'
        ]);
    }
}