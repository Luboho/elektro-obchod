<?php

namespace App;

use Laravel\Scout\Searchable;
use Illuminate\Database\Eloquent\Model;
use Nicolaslopezj\Searchable\SearchableTrait;
use TCG\Voyager\Traits\Translatable;

class Product extends Model
{
    // use Searchable, SearchableTrait;   // Algolia trait Searchable
    use SearchableTrait;
    use Translatable;

    protected $translatable = ['title', 'body'];

    protected $fillable = [
        'quantity',
    ];
    // protected $guarded = [];

    /**
     * Searchable rules.
     *
     * @var array
     */
    protected $searchable = [
        /**
         * Columns and their priority in search results.
         * Columns with higher values are more important.
         * Columns with equal values have equal importance.
         *
         * @var array
         */
        'columns' => [          // If Syntax error or access violation: 1055 Error appear change true to false in config.database 
            'products.name' => 10,
            'products.details' => 5,
            'products.description' => 2,
        ],
    ];

    public function categories()
    {
        return $this->belongsToMany('App\Category');
    }

    public function presentPrice()
    {
        return sprintf('€%01.2f', $this->price / 100);
    }

    public function scopeMightAlsoLike($query)
    {
        return $query->inRandomOrder()->take(4);
    }

    /**
     * Get the indexable data array for the model.
     *
     * @return array
     */
    public function toSearchableArray()
    {
        $array = $this->toArray();

        // + ecommerce:install command will add an additional field categories to Algolia. 
        $extraFields = [
            'categories' => $this->categories->pluck('name')->toArray()
        ];

        return array_merge($array, $extraFields);
    }
}
