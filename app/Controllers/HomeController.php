<?php

namespace App\Controllers;

class HomeController
{
    public function index()
    {
        return view('test', ['name' => 'Jhon2', 'age' => 35]);
//        app()->view->render('test', ['name' => 'Jhon', 'age' => 35]);
        return 'Test page';
    }

    public function contact()
    {
        return 'Contact page';
    }
}
