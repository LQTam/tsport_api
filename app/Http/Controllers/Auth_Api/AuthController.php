<?php

namespace App\Http\Controllers\Auth_Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void

     */
    public function __construct()
    {
        $this->middleware('jwt', ['except' => ['login']]);
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login()
    {
        $credentials = request(['email', 'password']);

        if (!$token = auth('api')->attempt($credentials)) {
            return response()->json(['error' => 'Emaill or password not valid.'], 401);
        }
        return $this->respondWithToken($token);
    }


    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me(Request $request)
    {
        $loads = [];
        $user = auth('api')->user();
        if ($user->hasRole('customer')) {
            array_push($loads, 'customer');
            $user['avatarLink'] = asset('storage/customers/' . $user->id . '/');
        }
        if ($user->hasRole('supplier')) {
            array_push($loads, 'supplier');
            $user['logoLink'] = asset('storage/suppliers/' . $user->id . '/');
        }
        $user['userAvatarLink'] = asset('storage/users/' . $user->id . '/image/');
        return response()->json($user->load($loads));
    }

    public function update(Request $request, User $user)
    {
        if (Gate::denies('edit_user')) return abort(401);
        if ($request->oldPsw) {
            $validator = $this->validate($request, [
                'name' => 'required',
                'oldPsw' => 'required',
                'newPsw' => 'required|same:passwordConfirmation',
            ]);
            if (Hash::check($validator['oldPsw'], $user->password)) {
                $user->update(['name' => $validator['name'], 'password' => Hash::make($validator['newPsw'])]);
                $user['supplier'] = $user->supplier;
                $user['role_name'] = $user->roles->pluck('name');
                return response()->json(['message' => 'Successful update info!', 'user' => $user]);
            } else {
                return response()->json(
                    ['error' => 'Old password not matched.'],
                    422
                );
            }
        }
        $validator = $this->validate($request, [
            'name' => 'required'
        ]);
        $user->update(['name' => $validator['name']]);
        if ($request->avatar) {
            $file = $request->avatar;
            $name = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $extension = $file->getClientOriginalExtension();
            $type = 'image';
            $path = $file->storeAs('users/' . $user->id . '/' . $type . '/', $name . '.' . $extension);
            Log::warning("DJKASHD", ['path' => $path, 'RunHere']);
            $user->profile()->updateOrCreate(['contact_fname' => $user->name, 'avatar' => $path], ['avatar' => $path]);
            $user['userAvatarLink'] = $user->profile->avatar;
        }
        $loads = [];
        if ($user->hasRole('customer')) {
            array_push($loads, 'customer');
            $user['avatarCustLink'] = asset('storage/customers/' . $user->id . '/');
        }
        if ($user->hasRole('supplier')) {
            array_push($loads, 'supplier');
            $user['logoSuplLink'] = asset('storage/suppliers/' . $user->id . '/');
        }
        $user->load($loads);
        return response()->json(['message' => 'Successful update info.!', 'user' => $user]);
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        // auth('api')->user()->token()->revoke();
        $cookie = Cookie::forget('_token');
        auth('api')->logout();


        return response()->json(['message' => 'Successfully logged out'])->withCookie($cookie);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth('api')->refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        $cookie = $this->getCookieDetails($token);
        $user = auth('api')->user();

        $user['supplier'] = $user->supplier;
        $user['role_name'] = $user->roles->pluck('name');
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'user' => $user,
            'expires_in' => auth('api')->factory()->getTTL() * 60
            // 'expires_in' => auth('api')->factory()->getTTL()
        ])
            ->cookie($cookie['name'], $cookie['value'], $cookie['minutes'], $cookie['path'], $cookie['domain'], $cookie['secure'], $cookie['httponly'], $cookie['samesite']);
    }

    private function getCookieDetails($token)
    {
        return [
            'name' => '_token',
            'value' => $token,
            'minutes' => 1440,
            'path' => null,
            'domain' => null,
            // 'secure' => true, // for production
            'secure' => null, // for localhost
            'httponly' => true,
            'samesite' => false,
        ];
    }

    public function guard()
    {
        return auth()->guard('api');
    }
}
