<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\LazyCollection;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {

        $records = LazyCollection::make(function () {
            for ($i = 1; $i <= 1000000; $i++)
                yield [
                    'name' => Str::random(10),
                    'description' => Str::random(100)
                ];
        });
        $records->chunk(3300)->each(function (LazyCollection $chunk) {
            $records = $chunk->toArray();
            DB::table('products')->insert($records);
        });

        // $records->each(function ($line) {
        //     DB::table('products')->insert($line);
        // });
    }
}
