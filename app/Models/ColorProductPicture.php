<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class ColorProductPicture extends Model
{
    protected $fillable = ['name', 'src', 'type', 'extension', 'color_id', 'product_id'];
    public static $image_ext = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
    public static $video_ext = ['mp4', 'mpeg'];
    /**
     * Get maximum file size
     * @return int maximum file size in kilobites
     */
    public static function getMaxSize()
    {
        return (int) ini_get('upload_max_filesize') * 1000;
    }

    /**
     * Get directory for the specific product color
     * @return string Specific user directory
     */
    public function getProductColorDir($product_id,$color_id)
    {
        return 'products/'.$product_id.'/colors/'.$color_id.'/';
    }

    /**
     * Get all extensions
     * @return array Extensions of all file types
     */
    public static function getAllExtensions()
    {
        $merged_arr = array_merge(self::$image_ext,  self::$video_ext);
        return implode(',', $merged_arr);
    }

    /**
     * Get type by extension
     * @param  string $ext Specific extension
     * @return string      Type
     */
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
     * Get file name and path to the file
     * @param  string $type      File type
     * @param  string $name      File name
     * @param  string $extension File extension
     * @return string            File name with the path
     */
    public function getNameDir($product_id,$color_id,$type, $name, $extension)
    {
        return storage_path('app/public/'.$this->getProductColorDir($product_id,$color_id).'/'.$type.'/'.$name.'.'.$extension);
        // return '/public/' . $this->getProductColorDir() . '/' . $type . '/' . $name . '.' . $extension;
    }

    public function product()
    {
        return $this->belongsTo('App\Models\Product','product_id','id');
    }
    /**
     * Upload file to the server
     * @param  string $type      File type
     * @param  object $file      Uploaded file from request
     * @param  string $name      File name
     * @param  string $extension File extension
     * @return string|boolean    String if file successfully uploaded, otherwise - false
     */
    public function upload($type, $file, $name, $extension, $product)
    {
        $path = public_path('/storage/products/' . $product->id . '/' . $type . '/');
        $full_name = $name . '.' . $extension;

        return Storage::putFileAs($path, $file, $full_name);

    }
    public function storeFile($file,$product_id,$color_id,$type,$name,$extension)
    {
        $path = $this->getProductColorDir($product_id,$color_id).'/'.$type.'/';
        $full_name = $name . '.' . $extension;
        return Storage::putFileAs($path, $file, $full_name);
    }
}
