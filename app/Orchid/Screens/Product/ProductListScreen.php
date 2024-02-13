<?php

namespace App\Orchid\Screens\Product;

use App\Exports\ProductExport;
use App\Models\Product;
use App\Orchid\Layouts\Product\ProductListLayout;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use Orchid\Screen\Action;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Layout;
use Orchid\Screen\Screen;

class ProductListScreen extends Screen
{
    /**
     * Query data.
     *
     * @return array
     */
    public function query(): iterable
    {
        return [
            'products' => Product::filters()->defaultSort('id', 'desc')->paginate()
        ];
    }

    /**
     * Display header name.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return __('Products');
    }

    /**
     * Button commands.
     *
     * @return Action[]
     */
    public function commandBar(): iterable
    {
        return [
            Link::make(__('Export Excel'))
                ->icon('list')
                ->route('platform.products.export')
//                ->method('export')
                ->canSee(Auth::user()->hasAccess('platform.products.write'))
        ];
    }

    public function permission(): ?iterable
    {
        return [
            'platform.products.read'
        ];
    }

    /**
     * Views.
     *
     * @return Layout[]|string[]
     */
    public function layout(): iterable
    {
        return [
            ProductListLayout::class
        ];
    }

//    public function export(): \Symfony\Component\HttpFoundation\BinaryFileResponse
//    {
//        return Excel::download(new ProductExport, 'products.csv', \Maatwebsite\Excel\Excel::CSV);
//    }

}


