<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Kalnoy\Nestedset\NodeTrait;

class Category extends Model
{
    use NodeTrait;
    protected $table = 'categories';
    protected  $fillable = ['name', 'description', 'slug'];
    private $CATEGORIES = [
        [
            'name' => 'mens',
            'children' => [
                [
                    'name' => 'shop by category',
                    'children' => [
                        [
                            'name' => 'All Products',
                            'category_id' => 1
                        ],
                        [
                            'name' => 'Base Layers',
                            'category_id' => 1
                        ],
                        [
                            'name' => 'Pants',
                            'category_id' => 1
                        ],
                        [
                            'name' => 'Hoodies & Jackets',
                            'category_id' => 1
                        ],
                        [
                            'name' => 'Shorts',
                            'category_id' => 1
                        ],
                        [
                            'name' => 'T-Shirts & Tops',
                            'category_id' => 1
                        ],
                    ],
                    'category_id' => 1,
                ],
                [
                    'name' => 'shop by collection',
                    'children' => [
                        [
                            'name' => 'Arrival',
                            'category_id' => 1
                        ],
                        [
                            'name' => 'Legacy',
                            'category_id' => 1
                        ],
                        [
                            'name' => 'Seamless',
                            'category_id' => 1
                        ],
                        [
                            'name' => 'Speed',
                            'category_id' => 1
                        ],
                    ],
                    'category_id' => 1
                ],
            ]
        ],
        [
            'name' => 'womens',
            'children' => [
                [
                    'name' => 'shop by category',
                    'children' => [
                        ['name' => 'All Products', 'category_id' => 2],
                        ['name' => 'Pants & Leggings', 'category_id' => 2],
                        ['name' => 'Crop Tops', 'category_id' => 2],
                        ['name' => 'Hoodies & Jackets', 'category_id' => 2],
                        ['name' => 'Shorts', 'category_id' => 2],
                        ['name' => 'Swimmwear', 'category_id' => 2],
                    ], 'category_id' => 2
                ],
                [
                    'name' => 'shop by collection',
                    'children' => [
                        ['name' => 'Camo', 'category_id' => 2],
                        ['name' => 'Energy', 'category_id' => 2],
                        ['name' => 'Fit', 'category_id' => 2],
                        ['name' => 'Flex', 'category_id' => 2],
                    ], 'category_id' => 2
                ],
            ]
        ],
        [
            'name' => 'accessories',
            'children' => [
                ['name' => 'Bags', 'category_id' => 3],
                ['name' => 'Bottles', 'category_id' => 3],
                ['name' => 'Equipment', 'category_id' => 3],
                ['name' => 'Headwear', 'category_id' => 3],
                ['name' => 'View All', 'category_id' => 3],
            ], 'category_id' => 3
        ]
    ];

    public function cateChildren()
    {
        return $this->hasMany('App\Models\SubCategory');
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    public function product()
    {
        return $this->hasOneThrough('App\Models\Product', 'App\Models\SubCategory');
    }
}
