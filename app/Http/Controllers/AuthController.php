<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use PhpParser\Node\Expr\FuncCall;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('token');   
    }

    public function login(Request $request) {
        // $usercon = new UserController();
        // $users = $usercon->index();

        // foreach ($users as $user) {
        //     if ($user->email != $request->email || $user->password != $request->password) {
        //         return Redirect()->to('not_found');
        //     }
        // }


        return view('login');
    }

    public function register(Request $request) {


        return view('register');
    }
}
