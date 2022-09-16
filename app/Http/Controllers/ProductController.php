<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\Product\Product as ProductResource;
use App\Http\Resources\Product\ProductCollection;
use App\Models\ColorProduct;
use App\Models\ColorSize;
use App\Models\Product;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Gate;

class ProductController extends Controller
{
    public static $image_ext = ['jpg', 'jpe', 'web', 'jpeg', 'png', 'gif'];
    public static $video_ext = ['mp4', 'mpeg'];

    public function getType($ext)
    {
        if (in_array($ext, self::$image_ext)) {
            return 'image';
        }

        if (in_array($ext, self::$video_ext)) {
            return 'video';
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (Gate::denies("access_product")) return abort(401);
        if ($request->showData) {
            return Product::with(['colors', 'colors.pictures', 'colors.sizes', 'supplier'])->orderBy('created_at')->paginate(50);
        }
        $length = $request->itemsPerPage;
        $sortBy = $request->sortBy;
        $sortDesc = $request->sortDesc;
        $query = null;
        $searchValue = $request->search;
        if ($sortBy && $sortDesc) {
            $query = Product::with(['colors.sizes', 'colors', 'colors.pictures', 'supplier'])->orderBy($sortBy[0], $sortDesc[0] == 'true' ? 'asc' : 'desc');
            if ($searchValue) {
                $query->where(function ($query) use ($searchValue) {
                    $query
                        ->where('product_name', 'like', '%' . $searchValue . '%')
                        ->orWhere('product_price', 'like', '%' . $searchValue . '%')
                        ->orWhere('id', 'like', '%' . $searchValue . '%');
                });
            }
            return new ProductCollection($query->paginate($length));
        }
        $id = Product::get()->pluck('id');
        $query = Product::with(['colors.sizes', 'colors', 'colors.pictures', 'supplier'])->orderBy('created_at', 'desc');
        if ($searchValue) {
            $query->where(function ($query) use ($searchValue) {
                $query->where('product_name', 'like', '%' . $searchValue . '%')
                    ->orWhere('product_price', 'like', '%' . $searchValue . '%')
                    ->orWhere('id', 'like', '%' . $searchValue . '%');
                // ->orWhere('supplier_name', 'like', '%' . $searchValue . '%');
            });
        }
        $products = $query->paginate($length);
        return new ProductCollection($products);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(\Illuminate\Http\Request $request)
    {
        if (Gate::denies("create_product")) return abort(401);
        $validateFields = [
            'product_name' => 'required|max:190',
            'product_price' => 'required|min:0',
            'product_description' => 'required',
            'color_name' => 'array|required',
            'supplier_name' => 'required',
            'cate_name' => 'array|required',
            'discount_available' => 'required|boolean',
            'product_available' => 'required|boolean'
        ];
        $credentials = $request->validate($validateFields);
        $masp = substr($request->masp, 0, 7);
        if ($request->autogenerate == 'true') {
            $masp = strtoupper(substr(md5(microtime()), rand(0, 26), 2)) . substr(md5(microtime()), rand(0, 26), 5);
        }
        $product = Product::create([
            'product_name' => $credentials['product_name'],
            'product_price' => $credentials['product_price'],
            'product_description' => $credentials['product_description'],
            'slug' => \Illuminate\Support\Str::slug($credentials['product_name']),
            'supplier_id' => $credentials['supplier_name']['id'],
            'discount' => $request->discount ? $request->discount : 0,
            'discount_available' => $credentials['discount_available'],
            'masp' => $masp,
            'product_available' => $credentials['product_available']
        ]);
        foreach ($credentials['color_name'] as $value) {
            ColorProduct::create(['name' => $value['name'], 'product_id' => $product->id]);
        }

        $cateID = [];
        foreach ($credentials['cate_name'] as $key => $value) {
            array_push($cateID, $value['id']);
        }
        $product->categories()->sync($cateID);
        return response()->json(['message' => "Successful create product."]);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Product $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        if (Gate::denies("view_product")) return abort(401);
        $product->load(['category', 'colors.sizes', 'categories', 'colors.pictures']);
        return new ProductResource($product);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Product $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        if (Gate::denies("edit_product")) return abort(401);

        $validateFields = [
            'product_name' => 'required|max:190',
            'product_price' => 'required|min:0',
            'product_description' => 'required',
            'color_name' => 'array|required',
            'cate_name' => 'array|required',
            'discount_available' => 'required|',
            'supplier_name' => 'required',
            'product_available' => 'required|boolean',
        ];
        $credentials = $request->validate($validateFields);
        $product->update([
            'product_name' => $credentials['product_name'],
            'product_price' => $credentials['product_price'],
            'product_description' => $credentials['product_description'],
            'slug' => \Illuminate\Support\Str::slug($credentials['product_name']),
            'supplier_id' => $credentials['supplier_name']['id'],
            'discount' => $request->discount ? $request->discount : 0,
            'discount_available' => $credentials['discount_available'],
            'product_available' => $credentials['product_available'],
        ]);

        $cateID = [];
        foreach ($credentials['cate_name'] as $key => $value) {
            array_push($cateID, $value['id']);
        }
        $product->categories()->sync($cateID);
        foreach ($credentials['color_name'] as $key => $value) {
            $c = ['name' => $value['name'], 'product_id' => $product->id];
            ColorProduct::updateOrCreate($c);
        }

        return response()->json(["message" => 'Successfully product updated.']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Product $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        if (Gate::denies("delete_product")) return abort(401);
        //     DB::delete("
        //     delete from color_product_pictures where color_product_pictures.color_id in
        //     (
        //     select c.id from colors as c
        //     join products as p on p.id = '" . $product['id'] . "'
        //     join color_product as cp on cp.product_id = p.id
        //     and cp.color_id = c.id
        //     ) and color_product_pictures.product_id = '" . $product->id . "'
        // ");
        if ($product->delete()) {
            $path = storage_path('app/public/products/' . $product->id);
            File::deleteDirectory($path);
        };

        return response()->json(['message' => 'Successfully product deleted.']);
    }

    public function deleteItems(Request $request)
    {
        $items = $request->validate(['items' => 'array|required']);
        $ids = [];
        foreach ($items['items'] as $key => $i) {
            array_push($ids, $i['id']);
        }
        Product::destroy($ids);
        return response()->json(['message' => 'Successfully delete items.']);
    }

    public function saveQuantity(Request $request, ColorSize $colorSize)
    {
        if (Gate::denies('edit_product')) abort(401);
        $colorSize->updateOrCreate(['color_id' => $request->color_id, 'name' => $request->name], ['quantity' => $request->quantity]);
        return response()->json(['message' => "Successfully update quantity!"]);
    }

    public function updateProdStatus(Request $request, Product $product)
    {
        if (Gate::denies('edit_product')) abort(401);
        $product->update(['product_available' => $request->product_available]);
        return response()->json(['message' => "Successfully update product status!"]);
    }
    //
}
