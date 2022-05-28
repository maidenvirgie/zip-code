<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use App\Models\FederalEntity;
use App\Models\Locality;
use App\Models\Municipality;
use App\Models\Settlement;
use App\Models\ZipCode;




class TestImport implements ToCollection, WithHeadingRow
{
    /**
     * @param Collection $collection
     */
    public function collection(Collection $collection)
    {
        //dd($collection[0]);
        foreach ($collection as $key => $row) {

            $localityId;
            $municipalityId;
            $federalEntityId;

            $columnA = $row['d_codigo'];

            if($columnA == ''){
                break;
            }

            $localityName = $row['d_ciudad'];

            $localities = Locality::where('name', $localityName)->get();

            if($localities->isEmpty()){
                $localities = Locality::create([
                    'name' => $localityName,    
                ]);
            }

            $municipalityName = $row['d_mnpio'];
            $municipalityKey = $row['c_mnpio'];

            $municipalities = Municipality::where('name', $municipalityName)->where('key',$municipalityKey)->get();

            if($municipalities->isEmpty()){

                $municipalities =  Municipality::create([
                    'name' => $municipalityName,
                    'key' => $municipalityKey,    
                ]);
            }
          
            $federalEntityName = $row['d_estado'];
            $federalEntityKey = $row['c_estado'];
            $federalEntityCode = $row['c_cp'];

            $federalEntities = FederalEntity::where('key', $federalEntityKey)->get();

            if($federalEntities->isEmpty()){
                $federalEntities = FederalEntity::create([
                    'name' => $federalEntityName,
                    'key' => $federalEntityKey,
                    'code' => $federalEntityCode,
                ]);

                
            }
           
            $zipCode = $row['d_codigo'];

            $zipCodes = ZipCode::where('zip_code',$zipCode)->get();

            if($zipCodes->isEmpty()){
                $zipCodes = ZipCode::create([
                    'zip_code' => $zipCode,
                    'locality_id' => $localities->first()->id,
                    'federal_entity_id' => $federalEntities->first()->id,
                    'municipality_id' => $municipalities->first()->id,
                ]);
            };
            

            $settlementName = $row['d_asenta'];
            $settlementZoneType = $row['d_zona'];
            $settlementType = $row['d_tipo_asenta'];
            $settlementKey = $row['id_asenta_cpcons'];


            Settlement::create([
                'name' => $settlementName,
                'zone_type' => $settlementZoneType,
                'settlement_type' => $settlementType,
                'key' => $settlementKey,
                'zip_code' => $zipCodes->first()->id,
            ]);

        }
    }


    public function headingRow(): int
    {
        return 1;
    }

  
}
