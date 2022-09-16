<?php

namespace App\Http\Controllers;

use App\Http\Resources\Product\Color\Picture\PictureCollection;
use App\Models\Color;
use App\Models\ColorProductPicture;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ProductColorPictureController extends Controller
{
    public function index(Product $product, Color $color) {
        $productPictures = \App\Models\ColorProductPicture::where('color_product_pictures.color_id', '=', $color->id)
            ->where('color_product_pictures.product_id', '=', $product->id)
            ->get();
        return new PictureCollection($productPictures);
    }

    public function store(Request $request,Product $product,Color $color)
    {
        $imageType = $request->imageType;
        if ($imageType == 'file') {
            $credentials = $this->validate($request, [
                'size' => 'array|required',
                'color_name' => 'required',
                'image' => 'array',
                'image.*' => 'required|mimes:jpg,jpeg,png,webp|max:20000',
            ]);

            foreach ($credentials['image'] as $key => $file) {
                $picture = new ColorProductPicture();
                $name = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
                $extension = $file->getClientOriginalExtension();
                $type = $picture->getType($extension);
                if (!File::exists($picture->getNameDir($product->id, $color->id, $type, $name, $extension))) {
                    $picture->storeFile($file, $product->id, $color->id, $type, $name, $extension);
                }
                $picture::updateOrCreate([
                    'name' => $name,
                    'src' => $name . '.' . $extension,
                    'type' => $type,
                    'extension' => $extension,
                    'color_id' => $color->id,
                    'product_id' => $product->id
                ]);
            }

            foreach ($credentials['size'] as $key => $size) {
                \App\Models\ColorSize::updateOrCreate([
                    'color_id' => $color->id, 'name' => $size['name'],
                ], ['color_id' => $color->id, 'name' => $size['name'], 'quantity' => 0]);
            }

            return response()->json(['message' => "Successful store image."]);
        } else if ($imageType == 'url') {
            $credentials = $this->validate($request, [
                'size' => 'array|required',
                'color_name' => 'required',
                'image' => 'string',
            ]);
            $images = explode(',', $credentials['image']);
            $images = implode('', $images);
            $images = explode('https', $images);
            foreach ($images as $img) {
                $temp = explode('.', $img);
                $ext = substr($temp[count($temp) - 1], 0, 3);
                $ext = $ext == 'jpe' ? 'jpeg' : ($ext == 'web' ? 'webp' : $ext);
                if (in_array($ext, ['jpg', 'jpe', 'png', 'gif', 'web'])) {
                    ColorProductPicture::updateOrCreate([
                        'name' => $img,
                        'src' => $img,
                        'extension' => $ext,
                        'type' => 'image',
                        'color_id' => $color->id,
                        'product_id' => $product->id
                    ]);
                }
                if (in_array($ext, ['mp4'])) {
                    ColorProductPicture::updateOrCreate([
                        'name' => $img,
                        'src' => $img,
                        'extension' => $ext,
                        'type' => 'video',
                        'color_id' => $color->id,
                        'product_id' => $product->id
                    ]);
                }
            }

            foreach ($credentials['size'] as $key => $value) {
                \App\Models\ColorSize::updateOrCreate(
                    ['name' => $value['name'], 'color_id' => $color->id],
                    ['name' => $value['name'], 'color_id' => $color->id, 'quantity' => 0]
                );
            }
            return response()->json(['message' => 'Successful store image!']);
        }
    }
}
