<?php

namespace App\Console\Commands;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Console\Command;

class XmlDocParser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:xml-doc-parser';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {

        $xml = simplexml_load_file('https://quarta-hunt.ru/bitrix/catalog_export/export_Ngq.xml');

        if ($xml === false) {
            return;
        }

        $categoriesXml = $xml->shop->categories->category;

        foreach ($categoriesXml as $categoryValue) {

            Category::create([
                'id' => (string)$categoryValue['id'],
                'parent_id' => isset($categoryValue['parentId']) ? (string)$categoryValue['parentId'] : null,
                'title' => (string)$categoryValue
            ]);
        }

        $productXml = $xml->shop->offers->offer;

        foreach ($productXml as $productValue) {

            Product::create([
                'url' => (string)$productValue->url,
                'available' => isset($productValue['available']) ? (string) $productValue['available'] : null,
                'title' => (string)$productValue->name,
                'price' => (string)$productValue->price,
                'old_price' => (string)$productValue->oldprice,
                'currency_id' => (string)$productValue->currencyId,
                'picture' => (string)$productValue->picture,
                'vendor' => (string)$productValue->vendor,
                'category_id' => (string)$productValue->categoryId,
            ]);
        }

    }
}

