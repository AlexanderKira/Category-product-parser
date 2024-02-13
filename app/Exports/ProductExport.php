<?php

namespace App\Exports;

use App\Models\Category;
use App\Models\Product;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ProductExport implements FromArray, WithHeadings
{

    public function array(): array
    {
        $products = Product::all();

        $array = [];

        foreach ($products as $product){
            $array[] = [
                $product->category_id,
                Category::getCategoryParents($product->category_id) . '/',
                $product->title,
                $product->price,
                $product->old_price,
                $product->currency_id,
                $product->available,
                $product->url,
                $product->picture,
                $product->vendor,
            ];
        }

        return $array;
    }

    public function headings(): array
    {
        return [
            'Category ID',
            'Category Parents',
            'Title',
            'Price',
            'Old Price',
            'Currency ID',
            'Available',
            'URL',
            'Picture',
            'Vendor',
        ];
    }
}

