<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Http\Resources\Product\Product as ProductResource;
use App\Http\Resources\Product\ProductCollection;
use App\Models\Product;
use Illuminate\Http\Request;

class FrontendProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getAllProducts(Request $request)
    {
        $length = $request->length;
        $category_name = $request->category_name;
        $type = $request->type;
        $cateParent = \App\Models\Category::where('name', $type)->first();
        $size = $request->size_name;
        $key = $request->key ? explode('__', $request->key) : ['id','desc']; //eg: price_asc
        $query = ['length' => $length, 'category_name' => $category_name, 'parentID' => $cateParent->id, 'size' => $size, 'key' => $key];
        $productsQuery = Product::select('products.*')
            ->join('product_category as pc', 'pc.product_id', '=', 'products.id')
            ->join('sub_categories as sc', 'pc.sub_category_id', '=', 'sc.id')
            ->where('sc.category_id', $cateParent->id)
            ->with(['categories', 'colors.sizes', 'colors.pictures', 'colors', 'supplier']);
        if ($category_name == 'all-products' || $category_name == 'view-all') {
            if ($size) {
                return new ProductCollection($this->filterProductsBySize($query));
            }
            return new ProductCollection(
                $productsQuery
                    ->paginate($length)
            );
        }
        if ($size) {
            return new ProductCollection($this->filterProductsBySize($query));
        }
        if ($key[0] === 'popular') {
            $productsQuery = $productsQuery->inRandomOrder();
        } else $productsQuery = $productsQuery->orderBy($key[0], $key[1]);
        $products =
            $productsQuery
            ->where('sc.slug', '=', $category_name)
            ->paginate($length);
        return new ProductCollection($products);
    }


    public function filterProductsBySize($query)
    {
        $products = Product::select('products.*')
            ->join('product_category as pc', 'pc.product_id', '=', 'products.id')
            ->leftJoin('sub_categories as sc', 'sc.id', '=', 'pc.sub_category_id')
            ->join('color_products as cp', 'cp.product_id', '=', 'products.id')
            ->leftJoin('color_sizes as cs', 'cs.color_id', '=', 'cp.id')
            ->where('cs.name', $query['size'])
            ->where('products.product_available', 1)
            ->where('sc.category_id', $query['parentID'])
            ->orderBy('cs.quantity', 'desc')
            ->with(['categories', 'colors.sizes', 'colors.pictures', 'colors', 'supplier'])
            ->paginate($query['length']);
        return $products;
    }
    public function fetchProdsByKey(Request $request)
    {
        $products = Product::where('masp', 'like', '%' . $request->key . '%')
            ->orWhere('product_name', 'like', '%' . $request->key . '%')
            ->where('products.product_available', 1)
            ->orWhere('product_price', 'like', '%' . $request->key . '%')
            ->paginate(50);
        $products->load(['colors', 'colors.pictures', 'supplier']);
        $response = [];
        foreach ($products as $key => $prod) {
            $data['cateName'] = $prod['categories'][0]['slug'];
            $data['masp'] = $prod['masp'];
            $data['discount'] = $prod['discount'];
            $data['discount_available'] = $prod['discount_available'];
            $data['prodName'] = $prod['product_name'];
            $data['cateParent'] = $prod['categories'][0]['parent']['slug'];
            $data['prodSlug'] = $prod['slug'];
            $data['supplier'] = $prod['supplier'];
            $data['color']['name'] = $prod->colors[0]->name;
            $data['color']['id'] = $prod->colors[0]->id;

            if ($prod->colors[0]->pictures) {
                foreach ($prod->colors[0]->pictures as $k => $v) {
                    if ($k == 0) {
                        if (strpos('//', $v->src) != -1) $data['img'] =  $v->src;
                        else $data['img'] =  $v->src;
                    }
                }
            }
            $data['sizes'] = $prod->colors[0]->sizes;
            $data['imgLink'] = asset('storage/products/' . $prod['id'] . '/');
            $data['prodPrice'] = $prod['product_price'];
            $data['prodID'] = $prod['id'];
            if ($prod['discount'] && $prod['discount_available']) {
                $data['prodPrice'] = $prod['product_price'] * ((100 - $prod['discount']) / 100);
            }
            array_push($response, $data);
        }
        return response()->json(['products' => $response]);
    }

    public function filterProductsBySize1(Request $request)
    {
        $length = $request->length;
        $category_name = $request->category_name;
        $type = $request->type;
        $cateParent = \App\Models\Category::where('name', $type)->first();
        $size = $request->size_name;
        $query = ['length' => $length, 'category_name' => $category_name, 'parentID' => $cateParent->id, 'size' => $size];

        $products = Product::select('products.*')
            ->join('product_category as pc', 'pc.product_id', '=', 'products.id')
            ->leftJoin('sub_categories as sc', 'sc.id', '=', 'pc.sub_category_id')
            ->join('color_products as cp', 'cp.product_id', '=', 'products.id')
            ->leftJoin('color_sizes as cs', 'cs.color_id', '=', 'cp.id')
            ->where('products.product_available', 1)
            ->where('sc.slug', $query['category_name'])
            ->where('cs.name', $query['size'])
            ->where('sc.category_id', $query['parentID'])
            ->orderBy('cs.quantity', 'desc')
            ->with(['categories', 'colors.sizes', 'colors.pictures', 'colors', 'supplier'])
            ->paginate($query['length']);
        return new ProductCollection($products);
    }

    public function getRelatedProducts(Product $product)
    {
        $product->load('categories');
        $cateIDs = [];
        $type = "";
        foreach ($product->categories as $key => $value) {
            array_push($cateIDs, $value['id']);
            $type = $value->parent->name;
        }
        $products = Product::select('products.*')
            ->join('product_category', 'product_category.product_id', '=', 'products.id')
            ->join('sub_categories', 'product_category.sub_category_id', '=', 'sub_categories.id')
            ->join('categories', 'categories.id', '=', 'sub_categories.category_id')
            ->where('categories.name', '=', $type)
            ->where('products.product_available', 1)
            ->whereIn('sub_categories.id', $cateIDs)
            ->with(['categories', 'colors.sizes', 'colors.pictures', 'colors', 'supplier'])
            ->limit(15)
            ->get();
        return new ProductCollection($products);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getProduct(Product $product)
    {
        $product->load('colors.pictures', 'colors.sizes', 'colors');
        return new ProductResource($product);
    }
}
