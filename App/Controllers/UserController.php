<?php

namespace App\Controllers;
use App\Models\User;
use TestTask\Validation\Validator;
use TestTask\Database\Managers\MySQLManager;
use TestTask\Database\DB;



class UserController extends Controller
{


    public function index()
    {
        return view('register.user');
    }


    public function create()
    {
        return view('register.user');
    }

    public function store()
    {
        //$this->db->connect(); 
        $validator = new Validator();
          
        $validator->setRules([
            'name' => 'required|alnum|between:8,32',
            'username' => 'required|alnum|between:8,32|unique:users,username',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|alnum|between:8,32|confirmed',
            'password_confirmation' => 'required|alnum|between:8,16'
        ]);

        $validator->setAliases([
            'password_confirmation' => 'Password confirmation'
        ]);
        $validator->make(request()->all());

        if (!$validator->passes()) {
            app()->session->setFlash('errors', $validator->errors());
            app()->session->setFlash('old', request()->all());

            return back();
        }

        User::create([
            'id'=>request('id'),
            'name' => request('name'),
            'username' => request('username'),         
            'email' => request('email'),
            'password' => bcrypt(request('password'))
        ]);
        // var_dump($product, $product->books, $product->dvds, $product->furnitures);
        // die();
         app()->session->setFlash('success', 'Registered sucessfully :D');
     

         return back();
    }

     // var_dump('submitted');

    }
