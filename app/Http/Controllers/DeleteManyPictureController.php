<?php

namespace App\Http\Controllers;

use App\Models\ColorProductPicture;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class DeleteManyPictureController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $ids = [];
        $data = $request->all();
        foreach ($data as $key => $value) {
            array_push($ids, $value['id']);
            $path = storage_path('app/public/products/' . $value['product_id']
                . '/colors/' . $value['color_id'] . '/' . $value['type'] . '/' . $value['src']);
            if (File::exists($path)) {
                File::delete($path);
            }
        }
        ColorProductPicture::destroy($ids);
        return response()->json(['message' => 'Your selected image has been deleted.']);
    }
}
