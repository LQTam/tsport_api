<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Weidner\Goutte\GoutteFacade;

class CrawGymShark extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'craw:gymshark';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        // $url = env('GYM_SHARK');
        $url = env('GYM_SHARK') . '/collections/bottoms/mens';
        $crawler = GoutteFacade::request('get', $url);

        $linkToCate = $crawler->filter('.grid__item.medium-up--ten-twelfths
        .product-grid .grid__item.small--one-half.medium-up--one-third
        .prod-image-wrap a
        ')
            ->each(function ($node) {
                // return $node->outerHtml();
                return $node->attr('href');
            });
        // dump($linkToCate);
        // self::crawImageSpecificProduct($linkToCate[0]);
        foreach ($linkToCate as $key => $link) {
            self::demo($key);
            // self::crawImageSpecificProduct($link);
            //accessories
            // self::crawImageSpecificProduct($key);
            // self::crawSingle($link);
        }
    }
    public function demo($url)
    {
        $crawler = GoutteFacade::request('get', env('GYM_SHARK') . $url);
        $name = $crawler->filter('.pdp  .pdp__content  .pdp__content__info.pinfo .pinfo__heading')
            ->each(function ($node) {
                return $node->outerHtml();
            })[0];
        dump($name);
    }
    public function crawImageSpecificProduct($url)
    {
        // $url = 'https://www.gymshark.com/collections/base-layers/products/gymshark-element-baselayer-shorts-black-marl-white';
        $crawler = GoutteFacade::request('get', env('GYM_SHARK') . $url);
        // $crawler = \Weidner\Goutte\GoutteFacade::request('get', $url);
        $name = $crawler->filter('.pdp  .pdp__content  .pdp__content__info.pinfo .pinfo__heading')
            ->each(function ($node) {
                return $node->outerHtml();
            })[0];
        $pprice = $crawler->filter('.pdp  .pdp__content  .pdp__content__info.pinfo .pinfo__price .pinfo__price__total')
            ->each(function ($node) {
                return $node->text();
            })[0];
        $desc = $crawler->filter('.pdp  .pdp__content  .pdp__content__info.pinfo .pdp-accordion__body')
            ->each(function ($node) {
                return $node->outerHtml();
            })[0];

        $pImages = $crawler->filter('.pdp  .pdp__content  .pdp__content__images  .pimages.pimages--6.preloader
        article.pimages__image.pimages__image--image')
            ->each(function ($node) {
                // print($node->text());
                return $node->attr('data-image');
            });
        $color = $crawler->filter('.pdp  .pdp__content  .pdp__content__info.pinfo
        .pinfo__colour
        ')
            ->each(function ($node) {
                return $node->text();
            })[0];
        $size = $crawler->filter('.pdp  .pdp__content  .pdp__content__info.pinfo
        .pinfo__add .pinfo__add__sizes button
        ')
            ->each(function ($node) {
                return $node->text();
            });
        $cnames = \App\Models\SubCategory::with('parent')->get();
        $cnameslug = $cnames->pluck('slug');
        $category = explode('/', $url);
        $ids = [];
        foreach ($category as $v) {
            foreach ($cnames as $c) {
                if (array_search($v, $cnameslug->toArray()) && $c->slug == $v) {
                    array_push($ids, $c);
                }
            }
        }
        foreach (explode('-', $category[count($category) - 1]) as $v) {
            foreach ($cnames as $c) {
                if (array_search($v, $cnameslug->toArray()) && $c->slug == $v) {
                    array_push($ids, $c);
                }
            }
        }

        $idLast = [];
        foreach ($ids as $key => $value) {
            //mens
            // if ($value['id'] < 13) {
            //     array_push($idLast, $value->id);
            // }
            //womens
            // if ($value['id'] > 13) {
            //     array_push($idLast, $value->id);
            // }
            //acccessories
            if ($value['id'] > 24) {
                array_push($idLast, $value->id);
            }
        }
        // array_push($idLast, 23);

        $arr = explode('.', $pprice);
        $temp1 = implode('', $arr);
        $data = ['slug' => \Illuminate\Support\Str::slug($name), 'product_price' => explode('$', $arr[0])[1], 'product_name' => $name, 'product_description' => $desc];
        dump($data);
        // dump(['color' => implode(' ', explode('/', $color)), 'idLast' => $idLast]);
        // $product = \App\Models\Product::create($data);
        // $colorM = ColorProduct::create(['name' => implode(' ', explode('/', $color)), 'product_id' => $product->id]);

        // foreach ($size as $key => $value) {
        //     \App\Models\ColorSize::create(['name' => $value, 'color_id' => $colorM->id]);
        // }
        // $product->categories()->sync($idLast);
        // $images = implode(',', $pImages);
        // $images = explode('https', $images);
        // foreach ($images as $img) {
        //     $temp = explode('.', $img);
        //     $ext = substr($temp[count($temp) - 1], 0, 3);
        //     if (in_array($ext, ['jpg', 'jpe', 'png', 'gif', 'web'])) {
        //         if (strpos($img, ',')) {
        //             $z = explode(',', $img);
        //             array_pop($z);
        //             $img = $z[0];
        //         }
        //         $d = [
        //             'name' => $product->product_name,
        //             'src' => $img,
        //             'extension' => $ext == 'jpe' ? 'jpeg' : ($ext == 'web' ? 'webp' : $ext),
        //             'type' => 'image',
        //             'color_id' => $colorM->id,
        //             'product_id' => $product->id
        //         ];

        //         // Log::warning("SOMETHING", ['img' => $img]);
        //         \App\Models\ColorProductPicture::create($d);
        //         // delete from products where id BETWEEN 267 and 321
        //     }
        // }
    }

    public static function crawSingle($url)
    {
        $crawler = GoutteFacade::request('get', env('GYM_SHARK') . $url);
        $prodImgFirst = $crawler->filter('.grid__item.small--one-half .prod-image-wrap a img.first')->each(function ($node) {
            return $node->attr('src');
        });

        $prodImgSecond = $crawler->filter('.grid__item.small--one-half .prod-image-wrap a div.second.lazyload-img')->each(function ($node) {
            return $node->attr('style');
        });

        $prodTitle = $crawler->filter('.grid__item.small--one-half .prod-caption a span')->each(function ($node) {
            return $node->outerHtml();
        });

        // $prodPrice = $crawler->filter('.grid__item.small--one-half .prod-caption span.prod-price')->each(function ($node) {
        //     return $node->text();
        // });

        $arr = explode('/', $url);
        array_shift($arr);
        $cateName = $arr[1];
        $cateType = $arr[2];
        $categories = \Illuminate\Support\Facades\DB::select("
    select sc.id as sc_id,sc.name as sc_name, sc.category_id as sc_category_id,
    sc.slug as sc_slug,c.id as c_id,c.name as c_name
    from sub_categories as sc
    join categories as c on c.name = '" . $cateType . "' and
    sc.category_id = c.id
    ");

        foreach ($categories as $cate) {
            if ($cate->sc_slug == $cateName) {
                $cateID = $cate->sc_id;
            }
        }
        foreach ($prodTitle as $key => $title) {
            $imgTemp = explode('/', $prodImgSecond[$key]);
            array_shift($imgTemp);
            array_shift($imgTemp);
            $imgSecond = implode('/', $imgTemp);
            $data = [
                "product_name" => $prodTitle[$key],
                "product_price" => random_int(10, 50),
                "picture" => $prodImgFirst[$key],
                "second_image" => $imgSecond,
                'category_id' => $cateID,
                'slug' => \Illuminate\Support\Str::slug($prodTitle[$key]),
                // 'cate_name' => $cateName,
                // 'cate_type' => $cateType,
                // 'url' => env('GYM_SHARK') . $url
            ];
            // dump($data);
            \App\Models\Product::create($data);
        };
        // $data = [
        //     "product_name" => $prodTitle,
        //     "product_price" => random_int(10, 50),
        //     "picture" => $prodImgFirst,
        //     "second_image" => $prodImgSecond,
        //     'category_id' => $cateID,
        //     //     // 'url' => env('GYM_SHARK') . $url
        // ];
        // dump($data);
        // \App\Models\Product::create($data);
    }
}
