<?php

namespace App\Http\Controllers;

use App\Exceptions\TokenException;
use App\Models\Token;
use Illuminate\Cookie\CookieJar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use \Illuminate\Support\Facades\Cookie;


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

class TokenController extends Controller
{
    public function __invoke()
    {
        return 'tokens';
    }

    public function create($user)
    {
        $headers = array('alg'=>'HS256','typ'=>'JWT');
        $token = new Token();
        $token->user_id = $user->id;
        $token->access = generate_jwt($headers, json_encode($user->name . ' ' . $user->email), $user->name . env('SECRET_ACCESS'));
        $token->refresh = generate_jwt($headers, json_encode($user->name . ' ' . $user->email), $user->email . env('SECRET_REFRESH'));
    
        $token->save();

        return $token;
    }

    public function show($user_id)
    {
        try{
            $token = DB::table('tokens')->where('user_id', $user_id)->first();
        } catch(TokenException $exception) {
            return $exception->getMessage();
        }

        return $token;
    }

    public function update(Request $request)
    {
        $token = TokenController::show($request->user_id);
        $user = UserController::show($request->user_id);

        $headers = array('alg'=>'HS256','typ'=>'JWT');
        if ($token) {
            $token->user_id = response()->json($request->user_id);
            $token->access = generate_jwt($headers, json_encode($user->name . ' ' . $user->email), $user->name . env('SECRET_ACCESS'));
            $token->refresh = generate_jwt($headers, json_encode($user->name . ' ' . $user->email), $user->email . env('SECRET_REFRESH'));
        }
        $token->save();

        return $token;
    }

    public function destroy(Request $request)
    {
        $token = Token::find($request->id);
        $token->delete();
        return $token;
    }
}
