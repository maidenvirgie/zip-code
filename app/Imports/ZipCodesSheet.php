<?php 

namespace App\Imports;

use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Maatwebsite\Excel\Concerns\WithChunkReading;


class ZipCodesSheet implements WithMultipleSheets, WithChunkReading
{
   
    public function sheets(): array
    {
        $sheet = [];

        $import = new TestImport();

        for ($i=0; $i < 31; $i++) { 
            array_push($sheet, $import);
        }
        return $sheet;
    }

    public function chunkSize(): int
    {
        return 1000;
    }
}