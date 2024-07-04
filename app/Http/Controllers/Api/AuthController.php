<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ApiLoginRequest;
use App\Http\Requests\Api\LoginUserRequest;
use Illuminate\Http\Request;
use App\Traits\ApiRespones;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    use ApiRespones;

    public function login(LoginUserRequest $request) {
        $request->validated($request->all());

        if (!Auth::attempt($request->only('email', 'password'))) {
            return $this->error('Invalid credentials', 401);
        }

        $user = User::firstWhere('email', $request->email);

        return $this->ok(
            'Authenticated',
            [
                'token' => $user->createToken(
                    'API token for' . $user->email,
                    ['*'],
                    now()->addMonth())->plainTextToken
            ]
        );
    }

    public function logout(Request $request) {
        $request->user()->currentAccessToken()->delete();

        return $this->ok('');
    }

    /*public function login(ApiLoginRequest $request) {
        return $this->ok($request->get('email'));
    }

    public function register() {
        return $this->ok('register');
    }*/
}
