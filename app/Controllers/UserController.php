<?php

namespace App\Controllers;

use App\Models\User;
use PHPFramework\Pagination;

class UserController extends BaseController
{
    public function register()
    {
//        try {
//            db()->beginTransaction();
//            db()->query('insert into phones (user_id, phone) values(?,?)', [21, 19111]);
//            db()->query('insert into users (name, email, password) values(?,?,?)', ['User 21', 'user21@mail.com', 9111]);
//            db()->commit();
//        } catch (\PDOException $e) {
//            db()->rollBack();
//            dump($e);
//        }

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
            $model->attributes['password'] = password_hash
            ($model->attributes['password'], PASSWORD_DEFAULT);
            if ($id = $model->save())  {
                session()->setFlash('success', 'Thanks for registration. Your ID: ' . $id);
            } else {
                session()->setFlash('error', 'Error registration');
            };
        }
        response()->redirect('/register');
    }

    public function login()
    {
        return view('user/login', [
            'title' => 'Login page'
        ]);
    }

    public function index()
    {
        $users_cnt = db()->query("select count(*) from users")->getColumn();
        $limit = PAGINATION_SETTINGS['perPage'];
        $pagination = new Pagination($users_cnt);

        $users = db()->query("select * from users limit $limit offset {$pagination->getOffset()}")->get();
        return view('user/index', [
            'title' => 'Users',
            'users' => $users,
            'pagination' => $pagination,
        ]);
    }
}