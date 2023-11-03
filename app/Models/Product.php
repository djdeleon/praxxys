<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'category_id',
        'date_time'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function dateTime(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $value,
            set: fn ($value) => Carbon::parse($value),
        );
    }

    public function scopeFilter($query)
    {
        if (request('category') && request('search')) {
            $category = Category::where('name', request('category'))->first();

            if ($category->products->isNotEmpty()) {
                return $category->products->filter(function ($product) {
                    if (stripos($product->name, request('search')) === 0 || stripos($product->description, request('search')) === 0) {
                        return $product;
                    }
                });
            }
        }

        if (request('category')) {
            $category = Category::where('name', request('category'))->first();
            return $category->products;
        }

        return $query->where('name', 'like', '%' . request('search') . '%')
                ->orWhere('description', 'like', '%' . request('search') . '%');

    }
}
