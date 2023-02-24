<?php

namespace App\Console\Commands;

use App\Jobs\SaveRowsInCSVFile;
use App\Models\Product;
use Illuminate\Console\Command;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Log;

class FireProductExporting extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'export';

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
        Product::select(['id', 'name', 'description'])->chunk(5200, function (Collection $smallList, $i) {

            SaveRowsInCSVFile::dispatch($smallList->toArray());
            $this->info('Iteration : ' . $i);

            // $writer->addRows($smallList->toArray());
            // $smallList->each(function($p) use ($writer) {
            //     $writer->addRow($p->toArray());

            //     // $writer->addRow();
            // });
        });
    }
}
