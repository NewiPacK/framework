<?php

namespace App\Controllers;

use App\Models\User;
use Illuminate\Database\Capsule\Manager as Capsule;

class UserController extends BaseController
{
    public function register()
    {
//        Capsule::enableQueryLog();
//        $user = User::query()->with('phones')->find(5);
//        dump($user);
//        dump($user->phones);
//
//        dump(Capsule::getQueryLog());

//        $users = db()->query('select * from users where id > ?', [5])->get();
//        dump($users);
//
//        $users = db()->query('select * from users where id > ?', [5])->getAssoc('email');
//        dump($users);

//        $users = db()->query('select * from users where id = ?', [5])->getOne();
//        dump($users);

//        dump(db()->query('select count(*) from users')->getColumn());

//        $users = db()->findAll('users');
//        dump($users);

//        $user = db()->findOne('users', 5);
//        dump($user);

//        $user = db()->findOrFail('users', 5);
//        dump($user);

//        db()->query('insert into phones (user_id, phone) values (?, ?)', [5, 8111]);
//        dump(db()->getInsertId());

//        db()->query('delete from phones where id > ?', [9]);
//        dump(db()->rowCount());

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