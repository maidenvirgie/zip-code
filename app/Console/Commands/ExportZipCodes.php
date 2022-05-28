<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Imports\ZipCodesSheet;
use Maatwebsite\Excel\Facades\Excel;

class ExportZipCodes extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'export:zipcodes';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command imports data from a file excel';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        Excel::import(new ZipCodesSheet, 'CPdescarga.xlsx');

        $this->info("succesfull");

        return 0;
    }
}
