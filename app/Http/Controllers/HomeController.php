<?php

namespace App\Http\Controllers;

use App\Http\Resources\Product\Product as ProductResource;
use App\Http\Resources\Product\ProductCollection;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class HomeController extends Controller
{
    public function getProductsNewRelease(Request $request)
    {
        $products = Product::select('products.*')
            ->join('product_category as pc', 'pc.product_id', '=', 'products.id')
            ->join('sub_categories as sc', 'pc.sub_category_id', '=', 'sc.id')
            ->join('categories as c', 'c.id', '=', 'sc.category_id')
            ->where('c.slug', '=', 'mens')
            ->get();
        $products->load(['category', 'sizes', 'images', 'colors']);
        return new ProductCollection($products);
    }
    public function filterProductBySize(Request $request)
    {
        $length = $request->length;
        $sortKey = $request->sortKey;
        $order = $request->order;
        $current_page = $request->page - 1;
        $category_name = $request->category_name;
        $offset = ($current_page * $length);
        $category = DB::select("select sc.id,sc.name from sub_categories as sc where sc.slug = '" . $category_name . "' limit 1");
        $category = \App\Models\SubCategory::where('slug', $category_name)->first();

        $products = Product::select('products.*')
            ->join('product_category as pc', 'pc.product_id', '=', 'products.id')
            ->join('sub_categories as sc', 'pc.sub_category_id', '=', 'sc.id')
            ->join('categories as c', 'c.id', '=', 'sc.category_id')
            ->where('c.slug', '=', 'mens')
            ->get();
        $products->load(['category', 'sizes', 'images', 'colors']);
        return new ProductCollection($products);
    }
    public function getAllProducts(Request $request)
    {
        $length = $request->length;
        $sortKey = $request->sortKey;
        $order = $request->order;
        $current_page = $request->page - 1;
        $category_name = $request->category_name;
        $offset = ($current_page * $length);
        $category = DB::select("select sc.id,sc.name from sub_categories as sc where sc.slug = '" . $category_name . "' limit 1");
        if ($category_name == 'all-products' || $category_name == 'view-all') {
        Log::warning("asd",['run here']);
        $cateParent = Category::where('name', $request->type)->first();
            return new ProductCollection(
                Product::whereIn('products.category_id', function ($query) use ($cateParent) {
                    $query->select('sub_categories.id')
                        ->from('sub_categories as sub_categories')
                        ->where('sub_categories.category_id', $cateParent->id);
                })->with(['category', 'sizes', 'images', 'colors'])->paginate($length)
            );
        }
        Log::warning("asd",['run here1']);
        $products = DB::select("
            SELECT
            p.*,
                c.id as c_id,
                c.name as c_name,
                sc.id as sc_id,
                sc.name as sc_name,
                sc.category_id as sc_category_id,
            sc.slug as sc_slug
            from products as p
            left join categories as c on c.name = '" . $request->type . "'
            join sub_categories as sc on sc.id = p.category_id and sc.category_id = c.id and p.category_id = '" . $category->id . "'
            order by $sortKey $order
            limit $length offset $offset
        ");
        $total = count($products);
        return collect($products)->paginate($length, $total, $current_page);
    }
    public function getProduct(Product $product)
    {
        return new ProductResource(Product::findOrFail($product));
    }
}
