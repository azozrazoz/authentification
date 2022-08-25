<?php

namespace App\Http\Controllers;

use App\Exceptions\TokenException;
use App\Models\Token;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class TokenController extends Controller
{
    public function __invoke()
    {
        return 'tokens';
    }

    public function create(Request $request)
    {
        $token = new Token();

        $token->user_id = $request->user_id;
        $token->access = $request->access;
        $token->refresh = $request->refresh;
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

    public function update(Request $request, $id)
    {
        $token = Token::find($request->id);

        $token->user_id = $request->user_id;
        $token->access = $request->access;
        $token->refresh = $request->refresh;
        $token->save();

        return $token;
    }

    public function destroy(Request $request)
    {
        $token = Token::find($request->id);
        $token->delete();
        return Redirect::to('token');
    }
}
