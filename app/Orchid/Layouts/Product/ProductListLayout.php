<?php

namespace App\Orchid\Layouts\Product;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\DropDown;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class ProductListLayout extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'products';

    /**
     * Get the table cells to be displayed.
     *
     * @return TD[]
     */
    protected function columns(): iterable
    {
        return [
            TD::make('id', __('ID'))
                ->sort(),
            TD::make('category_id', __('Category'))
                ->filter(
                    Select::make()
                        ->empty('(no selected)')
                        ->fromModel(Category::class, 'title')
                )
                ->render(function (Product $product) {

                    $parents = Category::getCategoryParents($product->category->id);

                    return $parents . '/' . $product->category->title ?? '-';
                }),
            TD::make('title', __('Name'))
                ->filter(Input::make())
                ->render(function (Product $product) {
                    return $product->title;
                }),
            TD::make('price', __('Price')),
            TD::make('currency_id', __('Currency')),
        ];
    }
}


