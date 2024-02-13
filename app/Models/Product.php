<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Orchid\Filters\Filterable;
use Orchid\Screen\AsSource;


class Product extends Model
{
    use AsSource;
    use HasFactory;
    use Filterable;
    protected $fillable = [
        'id',
        'url',
        'available',
        'title',
        'price',
        'old_price',
        'currency_id',
        'category_id',
        'picture',
        'vendor'
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    protected $casts = [
        'available' => 'boolean',
    ];
}
