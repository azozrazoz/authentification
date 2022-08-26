<?php

namespace App\Http\Controllers;

use App\Models\Token;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;


class UserController extends Controller
{
    public function __invoke()
    {
        $this->middleware('token');
        return 'users';
    }

    public function index()
    {
        $users = User::all();

        return $users;
    }

    public function create(Request $request)
    {
        $this->middleware('token');
        $user = new User();

        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->password = $request->password;
        $user->save();


        // $headers = array('alg'=>'HS256','typ'=>'JWT');
        // $token = new Token();
        // $token->user_id = response()->json($user->id);
        // $token->access = generate_jwt($headers, $user->id, env('SECRET_ACCESS'));
        // $token->refresh = generate_jwt($headers, $user->id, env('SECRET_REFRESH'));
        // $token->save();

        // $token = TokenController::create($user);

        return $user;
    }

    public function store(Request $request)
    {
        $user = new User();

        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->password = $request->password;
        $user->save();

        return $user;
    }

    public function show($id)
    {
        $user = User::findOrFail($id);
        return $user;
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);

        return $user;
    }

    public function update(Request $request)
    {
        $user = User::find($request->id);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->password = $request->password;
        $user->save();

        return $user;
    }

    public function destroy(Request $request)
    {
        $user = User::find($request->id);
        $user->delete();
        return Redirect::to('api/user');
    }
}
