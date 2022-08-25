<?php

namespace App\Http\Controllers;

use App\Models\Token;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

function generate_jwt($headers, $payload, $secret = 'secret') {
    $headers_encoded = base64url_encode(json_encode($headers));
    
    $payload_encoded = base64url_encode(json_encode($payload));
    
    $signature = hash_hmac('SHA256', "$headers_encoded.$payload_encoded", $secret, true);
    $signature_encoded = base64url_encode($signature);
    
    $jwt = "$headers_encoded.$payload_encoded.$signature_encoded";
    
    return $jwt;
}

function base64url_encode($str) {
    return rtrim(strtr(base64_encode($str), '+/', '-_'), '=');
}

class UserController extends Controller
{
    public function __invoke()
    {
        return 'users';
    }

    public function index()
    {
        $users = User::all();

        return $users;
    }

    public function create(Request $request)
    {
        $user = new User();

        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->password = $request->password;
        $user->save();


        $headers = array('alg'=>'HS256','typ'=>'JWT');
        $token = new Token();
        $token->user_id = response()->json($user->id);
        $token->access = generate_jwt($headers, $user->id, env('SECRET_ACCESS'));
        $token->refresh = generate_jwt($headers, $user->id, env('SECRET_REFRESH'));
        $token->save();

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
