<?php

use App\Http\Resources\Category\CategoryCollection;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\Supplier;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/', function () {
    return view('welcome');
});

Route::get('/removeRole', function () {
    return Supplier::where('user_id', 141)->first()->user->removeRole('supplier');
});
Route::get('/product1', function () {
    return Product::find(727)->first()->supplier;
});

Route::get('/products/{product_id}/colors/{color_id}', 'ColorProductPictureController@show');

Route::get('/{product}', function (Product $product) {
    $product->load('categories');
    $ids = [];
    foreach ($product->categories as $v) {
        array_push($ids, $v['id']);
    }
    return Product::select('products.*')
        ->join('product_category', 'product_category.product_id', '=', 'products.id')
        ->join('sub_categories', 'product_category.sub_category_id', '=', 'sub_categories.id')
        ->whereIn('sub_categories.id', [3, 6, 4])
        ->with(['categories', 'colors.sizes', 'colors.pictures', 'colors', 'supplier'])
        ->limit(15)
        ->get();
    $products = Product::with(['colors' => function ($query) {
        $query->where('name', 'black');
    }, 'colors.pictures', 'colors.sizes', 'supplier', 'categories'])->get();
    return $products;
});

Route::get("suppliers/{supplier:supplier_code}", [\App\Http\Controllers\SupplierController::class,'show']);

Route::get('craw', function () {
    $url = 'https://www.gymshark.com/products/gymshark-premium-baselayer-shorts-light-grey';
    // $crawler = GoutteFacade::request('get', env('GYM_SHARK') . $url);
    $crawler = \Weidner\Goutte\GoutteFacade::request('get', $url);
    $name = $crawler->filter('.pdp  .pdp__content  .pdp__content__info.pinfo .pinfo__heading')
        ->each(function ($node) {
            return $node->text();
        });
    $pImages = $crawler->filter('.pdp  .pdp__content  .pdp__content__images  .pimages.pimages--6.preloader
        article.pimages__image.pimages__image--image')
        ->each(function ($node) {
            // print($node->text());
            return $node->attr('data-image');
        });
    $data = ['name' => $name, 'image' => implode(',', $pImages)];
});


Route::get('product/{product}', function ($product) {
    return Product::with('images')->select(['products.product_name', 'products.id'])->find($product);
});
