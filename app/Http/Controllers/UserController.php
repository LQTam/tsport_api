<?php

namespace App\Http\Controllers;

use App\Http\Resources\User\User as UserResource;
use App\Http\Resources\User\UserCollection;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(Request $request)
    {
        if (Gate::denies('access_user')) {
            return abort(401);
        }
        $columns = ['id', 'email', 'created_at'];
        $length = $request->itemsPerPage | $request->length;
        $sortBy = $request->sortBy;
        $sortDesc = $request->sortDesc;
        $query = null;
        $searchValue = $request->search;
        $role_name = $request->role_name;
        if ($sortBy && $sortDesc) {
            $query = User::orderBy($sortBy[0], $sortDesc[0] == 'true' ? 'asc' : 'desc');
            if ($searchValue) {
                $query->where(function ($query) use ($searchValue) {
                    $query->where('id', 'like', '%' . $searchValue . '%')
                        ->orWhere('email', 'like', '%' . $searchValue . '%')
                        ->orWhere('created_at', 'like', '%' . $searchValue . '%');
                });
            }
            if ($role_name) {
                $query->select('users.*')->join('model_has_roles as mr', 'users.id', '=', 'mr.model_id')
                    ->join('roles as r', 'r.id', '=', 'mr.role_id')
                    ->where('r.name', $role_name);
            }
            return new UserCollection($query->paginate($length));
        }
        $query = User::with('roles')->orderBy('users.created_at', 'desc');
        if ($searchValue) {
            $query->where(function ($query) use ($searchValue) {
                $query->where('id', 'like', '%' . $searchValue . '%')
                    ->orWhere('email', 'like', '%' . $searchValue . '%')
                    ->orWhere('created_at', 'like', '%' . $searchValue . '%');
            });
        }
        if ($role_name) {
            $query->select('users.*')->join('model_has_roles as mr', 'users.id', '=', 'mr.model_id')
                ->join('roles as r', 'r.id', '=', 'mr.role_id')
                ->where('r.name', $role_name);
        }
        $users = $query->paginate($length);
        return new UserCollection($users);
    }
    public function show(User $user)
    {
        if (Gate::denies('view_user')) {
            return abort(401);
        }
        if (auth('api')->user()->supplier) $user->load('supplier');
        else $user->load('profile');
        return new UserResource($user);
    }
    public function store(Request $request)
    {
        if (Gate::denies('create_user')) return abort(401);
        $credentials = $request->all();
        $credentials['password'] = Hash::make($credentials['password']);
        $user = User::create($credentials);
        $roleIDs = [];
        $cus = null;
        foreach ($request->role as $key => $value) {
            array_push($roleIDs, $value['id']);
            if (array_search('supplier', $value)) {
                $supplier_code =  strtoupper(substr(md5(microtime()), rand(0, 26), 2)) . substr(md5(microtime()), rand(0, 26), 5);
                $user->supplier()->create(['email' => $user->email, 'contact_fname' => $user->name, 'supplier_code' => $supplier_code]);
            }
        }
        $makh =  strtoupper(substr(md5(microtime()), rand(0, 26), 2)) . substr(md5(microtime()), rand(0, 26), 5);
        $user->customer()->create(['email' => $user->email, 'contact_fname' => $user->name, 'makh' => $makh]);
        array_push($roleIDs, 4);
        $user->syncRoles($roleIDs);
        return new UserResource($user);
    }
    public function update(Request $request, User $user)
    {
        if (Gate::denies('edit_user')) return abort(401);
        $credentials = $request->all();
//if($user->id !== 1){

        $user->update($credentials);
        $roles = $request->input('role', []);
        $rolesID = [];

        foreach ($roles as $key => $value) {
            array_push($rolesID, $value['id']);

            if (array_search('supplier', $value)) {
                if (!$user->supplier) {
                    $user->supplier()->create([
                        'contact_fname' => $user->name,
                        'email' => $user->email,
                        'supplier_code' =>  strtoupper(substr(md5(microtime()), rand(0, 26), 2)) . substr(md5(microtime()), rand(0, 26), 5),
                    ]);
                }
            }
        }
        if (!$user->customer) {
            $user->customer()->create([
                'contact_fname' => $user->name,
                'email' => $user->email,
                'makh' =>  strtoupper(substr(md5(microtime()), rand(0, 26), 2)) . substr(md5(microtime()), rand(0, 26), 5),
            ]);
        }
        $user->syncRoles($rolesID);
        return new UserResource($user);
//}
//else {
//return response()->json(['message'=>'You could not update super admin.'],401);
//}
    }

    public function destroy(User $user)
    {
        if (Gate::denies('delete_user')) {
            return abort(401);
        }
if($user->id !== 1){
        $user->syncRoles([]);
        $user->delete();
        return response()->json("Successfully delete.");
}
else{
return response()->json(['message' => 'Your could not delete super admin account.'],401);
}
    }
}
