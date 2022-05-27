<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

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
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        echo('Hi!');
        return 0;
    }
}
