<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    use HttpResponses;

    public function store(Request $request)
    {

        if(Auth::attempt($request->only('email','password'))){
            return $this->response('success',200,[
                'token' => $request->user()->createToken('invoice')->plainTextToken,
            ]);
        }
        return $this->error('unauthorized',200);
    }

    public function destroy(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return $this->response('Token Revoked',200);
    }
}
