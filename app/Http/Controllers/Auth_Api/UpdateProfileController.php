<?php

namespace App\Http\Controllers\Auth_Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\User\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class UpdateProfileController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, User $user)
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
}
