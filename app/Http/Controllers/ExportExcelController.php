<?php

namespace App\Http\Controllers;



use App\Exports\ProductExport;
use Maatwebsite\Excel\Facades\Excel;

class ExportExcelController extends Controller
{
    public function export(): \Symfony\Component\HttpFoundation\BinaryFileResponse
    {
        return Excel::download(new ProductExport, 'products.csv', \Maatwebsite\Excel\Excel::CSV);
    }

}
