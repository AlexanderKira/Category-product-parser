<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Kalnoy\Nestedset\NodeTrait;

class Category extends Model
{
    use HasFactory;
    use NodeTrait;

    protected $fillable = [
        'id',
        'parent_id',
        'title'
    ];

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }

    public static function getCategoryParents($categoryId): string
    {
        $category = Category::find($categoryId);

        if ($category) {
            $ancestors = $category->ancestors()->get();

            $titles = [];
            foreach ($ancestors as $model) {
                $titles[] = $model->title;
            }

            $parents = implode('/', $titles);
        }

        return $parents;
    }
}
