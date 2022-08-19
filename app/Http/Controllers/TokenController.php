<?php

namespace App\Http\Controllers;

use App\Exceptions\TokenException;
use App\Models\Token;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class TokenController extends Controller
{
    public function __invoke()
    {
        return 'tokens';
    }

    public function index()
    {
        $tokens = Token::all();

        return $tokens;
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

    public function store(Request $request)
    {
        $token = new Token();

        $token->user_id = $request->user_id;
        $token->access = $request->access;
        $token->refresh = $request->refresh;
        $token->save();

        return $token;
    }

    public function show($id)
    {
        try{
            $token = Token::findOrFail($id);
        } catch(TokenException $exception) {
            return $exception->getMessage();
        }
        return $token;
    }

    public function edit($id)
    {
        $token = Token::findOrFail($id);
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
