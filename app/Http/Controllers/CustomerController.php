<?php

namespace App\Http\Controllers;

use App\Http\Resources\Customer\CustomerResource;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Gate;

class CustomerController extends Controller
{
    public function index(Request $request)
    {
        if (Gate::denies("access_customer")) return abort(401);
        if ($request->showData) {
            return Customer::all();
        }
        $column = $request->column;
        $dir = $request->dir == true ? 'desc' : 'asc';
        if ($request->length) $length = $request->length;
        if ($request->itemsPerPage) $length = $request->itemsPerPage;
        $search = $request->search;
        $query = Customer::orderBy('created_at', 'desc');
        if ($column) {
            $query = Customer::orderBy($column, $dir);
        }
        if ($search) {
            $query = $query->where('makh', 'like', '%' . $search . '%')
                ->orWhere('contact_fname', 'like', '%' . $search . '%')
                ->orWhere('contact_lname', 'like', '%' . $search . '%')
                ->orWhere('address', 'like', '%' . $search . '%')
                ->orWhere('email', 'like', '%' . $search . '%')
                ->orWhere('phone', 'like', '%' . $search . '%');
        }
        $query = $query->paginate($length);
        return CustomerResource::collection($query);
    }

    public function update(Request $request, Customer $customer)
    {
        if (Gate::denies('edit_customer')) return abort(401);
        $validator = $this->validate($request, [
            'contact_fname' => 'required',
            'contact_lname' => 'required',
            'address' => 'required',
            'city' => 'required',
            'country' => 'required',
            'phone' => 'required',
            'avatar' => 'required',
            'email' => 'required|email'
        ]);

        $avatar = null;
        if (is_file($request->avatar)) {
            $file = $request->avatar;
            $name = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $extension = $file->getClientOriginalExtension();
            if (in_array(explode('/', $file->getMimeType())[1], ['jpg', 'jpeg', 'png', 'gif', 'webp'])) $type = 'image';
            $file->storeAs('customers/' . $customer->id . '/' . $type . '/', $name . '.' . $extension);
            $avatar = asset('storage/customers/' . $customer->id . '/' . $type . '/' . $name . '.' . $extension);
        }
        $customer->update([
            'contact_fname' => $validator['contact_fname'],
            'contact_lname' => $validator['contact_lname'],
            'address' => $validator['address'],
            'city' => $validator['city'],
            'country' => $validator['country'],
            'phone' => $validator['phone'],
            'email' => $validator['email'],
            'avatar' => $avatar ? $avatar : $customer->avatar
        ]);
        return response()->json(['message' => 'Successful update customer info.', 'customer' => $customer]);
    }

    public function update1(Request $request, $customer)
    {
        if (Gate::denies("edit_customer")) return abort(401);
        $validator = $request->validate([
            'address' => 'required',
            'city' => 'required',
            'country' => 'required',
            'contact_fname' => 'required',
            'contact_lname' => 'required',
            'phone' => 'required',
            'email' => 'required|email',
            'avatar' => 'required'
        ]);
        $customer1 = Customer::where('makh', $customer)->first();
        if (is_file($validator['avatar'])) {
            $name = $validator['avatar']->getClientOriginalName();
            $extension = $validator['avatar']->getClientOriginalExtension();
            $type = 'image';

            if (!File::exists(storage_path('app/public/customers/'  . $customer1->id . '/' . $type . '/' . $name))) {
                $validator['avatar']->storeAs('customers/' . $customer1->id . '/' . $type . '/', $name);
            }
            $validator['avatar'] = asset('storage/customers/' . $customer1->id . '/' . $type . '/' . $name);;
        }
        $customer1->update($validator);
        return response()->json(['message' => 'Successful update supplier.']);
    }

    public function destroy(Request $request, $customer)
    {
        if (Gate::denies("delete_customer")) return abort(401);
        $cus = Customer::where('makh', $customer)->first();
        $cus->user->removeRole('customer');
        File::delete(storage_path('app/customers/' . $cus->id . ''));
        $cus->delete();
        return response()->json(['message' => 'Successful delete item.']);
    }
}
