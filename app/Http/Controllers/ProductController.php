<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Spatie\SimpleExcel\SimpleExcelWriter;

class ProductController extends Controller
{
    //

    public function export()
    {
    //    / $all = Product::limit(1000)->get();
        $writer = SimpleExcelWriter::create('productsChunked.csv');

        Product::query()->where('id', '>', 718000)->chunk(3000, function(Collection $smallList)  use ($writer){
            $smallList->each(function($p) use ($writer) {
                $writer->addRow([
                    'id' => $p->id,
                    'name' => $p->name,
                    'description' => $p->description
                ]);
            });
        });




    }


    public function import()
    {
    }
}
