<?php

namespace App\Http\Controllers;

use App\Http\Resources\Supplier\Supplier as SupplierResource;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Gate;

class SupplierController extends Controller
{
    public static $imageExtensions = ['jpeg', 'jpeg', 'png', 'gif', 'webp'];
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (Gate::denies("access_supplier")) return abort(401);

        if ($request->showData) {
            return Supplier::all();
        }
        $column = $request->column;
        $dir = $request->dir == true ? 'desc' : 'asc';
        $length = $request->length;
        $page = $request->page;
        $search = $request->search;
        $query = Supplier::orderBy('created_at', 'desc');
        if ($column) {
            $query = Supplier::orderBy($column, $dir);
        }
        if ($search) {
            $query = $query->where('supplier_code', 'like', '%' . $search . '%')
                ->orWhere('company_name', 'like', '%' . $search . '%')
                ->orWhere('contact_fname', 'like', '%' . $search . '%')
                ->orWhere('contact_lname', 'like', '%' . $search . '%')
                ->orWhere('address', 'like', '%' . $search . '%')
                ->orWhere('email', 'like', '%' . $search . '%')
                ->orWhere('phone', 'like', '%' . $search . '%');
        }
        $query = $query->paginate($length);
        return SupplierResource::collection($query);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (Gate::denies("create_supplier")) return abort(401);

        if ($request->logo) {
            $validator = $request->validate([
                'company_name' => 'required',
                'address' => 'required',
                'city' => 'required',
                'country' => 'required',
                'contact_fname' => 'required',
                'contact_lname' => 'required',
                'phone' => 'required',
                'email' => 'required|email',
                'logo' => 'required|image'
            ]);
            $supplier_code = substr($request->supplier_code, 0, 7);
            if ($request->autogenerate == 'true') {
                $supplier_code = strtoupper(substr(md5(microtime()), rand(0, 26), 2)) . substr(md5(microtime()), rand(0, 26), 5);
            }
            $validator['supplier_code'] = $supplier_code;
            $validator['user_id'] = 1;
            $supplier = Supplier::create($validator);
            $name = $validator['logo']->getClientOriginalName();
            $extension = $validator['logo']->getClientOriginalExtension();
            $type = $this->getType($extension);
            $validator['logo']->storeAs('users/' . $supplier->user_id . '/suppliers/' . $supplier->id . '/' . $type . '/', $name);
            $validator['logo'] = asset('storage/users/' . $supplier->user_id . '/suppliers/' . $supplier->id . '/' . $type . '/' . $name);;
            $supplier->update(['logo' => $validator['logo']]);
            return response()->json(['message' => 'Successful create supplier.']);
        }
        $validator = $this->validate($request, ['company_name' => 'required']);
        Supplier::create([
            'company_name' => $validator['company_name'],
            'user_id' => 1
        ]);
        return response()->json(['message' => 'Successful create supplier.']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function show(Supplier $supplier)
    {
        return $supplier;
        if (Gate::denies("view_supplier")) return abort(401);
        return response()->json(['data' => 'something']);
        // $supplier = Supplier::where('user_id', $userID)->get();
        // return response()->json(['data' => $supplier]);
    }

    public function getType($type)
    {
        if (in_array($type, self::$imageExtensions)) {
            return 'image';
        }
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $supplier)
    {
        if (Gate::denies("edit_supplier") && Gate::denies('delete_user')) return abort(401);
        $validator = $request->validate([
            'company_name' => 'required',
            'address' => 'required',
            'city' => 'required',
            'country' => 'required',
            'contact_fname' => 'required',
            'contact_lname' => 'required',
            'phone' => 'required',
            'email' => 'required|email',
            'logo' => 'required'
        ]);
        $supplier1 = Supplier::where('supplier_code', $supplier)->first();
        if (is_file($validator['logo'])) {
            $name = $validator['logo']->getClientOriginalName();
            $extension = $validator['logo']->getClientOriginalExtension();
            $type = $this->getType($extension);

            if (!File::exists(storage_path('app/public/users/' . $supplier1->user_id . '/suppliers/' . $supplier1->id . '/' . $type . '/' . $name))) {
                $validator['logo']->storeAs('users/' . $supplier1->user_id . '/suppliers/' . $supplier1->id . '/' . $type . '/', $name);
            }
            $validator['logo'] = asset('storage/users/' . $supplier1->user_id . '/suppliers/' . $supplier1->id . '/' . $type . '/' . $name);;
        }
        $supplier1->update($validator);
        return response()->json(['message' => 'Successful update supplier.', 'supplier' => $supplier1]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $supplier)
    {
        if (Gate::denies("delete_supplier") && Gate::denies("delete_user")) return abort(401);
        $sup = Supplier::where('supplier_code', $supplier)->first();
        $sup->user->removeRole('supplier');
        File::delete(storage_path('app/users/suppliers/' . $sup->user_id . ''));
        $sup->delete();
        return response()->json(['message' => 'Successful delete item.']);
    }
}
