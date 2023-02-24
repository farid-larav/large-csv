<?php

namespace App\Jobs;

use App\Models\Product;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Spatie\SimpleExcel\SimpleExcelWriter;
use League\Csv\Writer;
use League\Csv\Exception;

class SaveRowsInCSVFile implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $data = [];
    /**
     * Create a new job instance.
     */
    public function __construct(array $rows)
    {
        $this->data = $rows;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        // $writer = SimpleExcelWriter::create('productsRows.csv', shouldAddBom:true);
        // $test = $writer->addRows($this->data)->close();


        $filename = 'example.csv';
        $exists = file_exists($filename);

        try {
            $csv = Writer::createFromPath($filename, 'a+');
        } catch (Exception $e) {
            die($e->getMessage());
        }

        if (!$exists) {
            $csv->insertOne(['id', 'name', 'description']);
        }

        $csv->insertAll($this->data);
    }
}
