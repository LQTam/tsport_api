<?php

namespace App\Http\Controllers;

use App\Http\Resources\Category\CategoryCollection;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->showData) {
            return new CategoryCollection(Category::with('cateChildren')->get());
        }
        if ($request->category_name && $request->type) {
            $categories = Category::select('categories.*')->join('sub_categories as sc', 'sc.category_id', '=', 'categories.id')
                ->where('categories.slug', $request->type)
                ->where('sc.slug', '=', $request->category_name)
                ->with('cateChildren')->get();
            return new CategoryCollection($categories);
        }
        $length = $request->itemsPerPage | $request->length;
        $sortBy = $request->sortBy;
        $sortDesc = $request->sortDesc;
        $query = null;
        $searchValue = $request->search;
        if ($sortBy && $sortDesc) {
            $query = Category::orderBy($sortBy[0], $sortDesc[0] == 'true' ? 'asc' : 'desc');
            if ($searchValue) {
                $query->where(function ($query) use ($searchValue) {
                    $query->where('id', 'like', '%' . $searchValue . '%')
                        ->orWhere('email', 'like', '%' . $searchValue . '%')
                        ->orWhere('parent_id', 'like', '%' . $searchValue . '%');
                });
            }
            return new CategoryCollection($query->paginate($length));
        }
        $query = Category::orderBy('created_at', 'desc');
        if ($searchValue) {
            $query->where(function ($query) use ($searchValue) {
                $query->where('id', 'like', '%' . $searchValue . '%')
                    ->orWhere('name', 'like', '%' . $searchValue . '%')
                    ->orWhere('parent_id', 'like', '%' . $searchValue . '%');
            });
        }
        $data = $query->paginate($length);
        return new CategoryCollection($data);
    }

    public function fetchAll()
    {
        if (Gate::denies('access_category')) return abort(401);
        $data = Category::with('cateChildren')->get();
        $res = [];
        foreach ($data as $key => $c) {
            $d = [];
            $d['parent_id'] = $c->id;
            $d['name'] = $c->name;
            $group = [];
            foreach ($c->cateChildren as $key => $child) {
                if ($child->parent_id == null) {
                    array_push($group, $child);
                }
            }
            $d['group'] = $group;
            // $group-
            foreach ($group as $key => $gr) {
                // $res['children'] = $gr->descendants;
                $gr->descendants;
                // $d['children'] = $gr->descendants;
                // array_push($d,$gr->descendants);
            }
            array_push($res, $d);
        }
        return $res;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = $request->validate([
            'name' => 'required',
        ]);

        if ($request->parent == 1) {
            rand(1, 8) > 5 ? $parent_id = 8 : $parent_id = 1;
        } else if ($request->parent == 2) {
            rand(13, 20) > 15 ? $parent_id = 20 : $parent_id = 13;
        } else
            $parent_id = 25;

        SubCategory::create([
            'category_id' => $request->parent, 'name' => $validator['name'], 'description' => $request->description,
            'slug' => \Illuminate\Support\Str::slug($validator['name']),
            'parent_id' => $parent_id
        ]);
        return response()->json(['message' => "Successful create category."]);
    }

    public function storeCate(Request $request)
    {
        if (Gate::denies('create_category')) return abort(401);
        if ($request->parent_name) {
            Category::create(['name' => $request->parent_name, 'slug' => \Illuminate\Support\Str::slug($request->parent_name)]);
        }
        if ($request->group_id) {
            $data = [
                'name' => $request->name,
                'category_id' => $request->parent_id,
                'parent_id' => $request->group_id,
                'slug' => \Illuminate\Support\Str::slug($request->name)
            ];
            SubCategory::create($data);
        }
        return response()->json(['message' => 'Successful create item.']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        if(Gate::denies('edit_category')) return abort(401);
        $validator = $request->validate([
            'name' => 'required',
        ]);
        $category->update(['name' => $validator['name']]);
        return response()->json(['message' => "Successful update item."]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        if(Gate::denies('delete_category')) return abort(401);
        $category->delete();
        return response()->json(['message' => "Successful delete item."]);
    }
}
