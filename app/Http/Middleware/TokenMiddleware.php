<?php

namespace App\Http\Middleware;

use App\Http\Controllers\TokenController;
use App\Http\Controllers\UserController;
use App\Models\Token;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

function base64url_encode($str) {
    return rtrim(strtr(base64_encode($str), '+/', '-_'), '=');
}   

class TokenMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        // $tokenParts = explode('.', $request->access_token);
        // $header = base64_decode($tokenParts[0]);
        // $payload = base64_decode($tokenParts[1]);
        // $signature_provided = $tokenParts[2];
    
        // $expiration = json_decode($payload)->exp;
        // $is_token_expired = ($expiration - time()) < 0;
    
        // $base64_url_header = base64url_encode($header);
        // $base64_url_payload = base64url_encode($payload);
        // $signature = hash_hmac('SHA256', $base64_url_header . "." . $base64_url_payload, env('SECRET'), true);
        // $base64_url_signature = base64url_encode($signature);
    
        // $is_signature_valid = ($base64_url_signature === $signature_provided);
        
        // if ($is_token_expired || !$is_signature_valid) {
        //     return FALSE;
        // } else {
        //     return $next($request);
        // }    
        //->where('user_id', $request->id)->first()
            
        dd(Token::find($request->id));
        $token = Token::findOrFail($request->id);
        $access_token = $request->header('access_token');

        if ($token->access != $access_token) {
            return view('user_not_found');
        } 


        // $usercon = new UserController();
        // $users = $usercon->index();

        // foreach ($users as $user) {
        //     if ($user->email != $request->email || $user->password != $request->password) {
        //         return view('user_not_found');
        //     }
        // }

        return $next($request);    
    }    
}
