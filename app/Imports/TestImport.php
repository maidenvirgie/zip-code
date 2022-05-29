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
            $idLocality = '';

            if($localities->isEmpty()){
                $localities = Locality::create([
                    'name' => $localityName,    
                ]);
                $idLocality = $localities->id;
            }else{
                $idLocality = $localities->first()->id;
            }

            $municipalityName = $row['d_mnpio'];
            $municipalityKey = $row['c_mnpio'];
            $idMunucipality = '';

            $municipalities = Municipality::where('name', $municipalityName)->where('key',$municipalityKey)->get();

            if($municipalities->isEmpty()){

                $municipality =  Municipality::create([
                    'name' => $municipalityName,
                    'key' => $municipalityKey,    
                ]);

                $idMunucipality = $municipality->id;

            }else{
                $idMunucipality = $municipalities->first()->id;
            }
          
            $federalEntityName = $row['d_estado'];
            $federalEntityKey = $row['c_estado'];
            $federalEntityCode = $row['c_cp'];

            $idFederalEntity = "";

            $federalEntities = FederalEntity::where('key', $federalEntityKey)->get();

            if($federalEntities->isEmpty()){
                $federalEntity = FederalEntity::create([
                    'name' => $federalEntityName,
                    'key' => $federalEntityKey,
                    'code' => $federalEntityCode,
                ]);

                $idFederalEntity = $federalEntity->id;
            }else{
                $idFederalEntity = $federalEntities->first()->id;
            }
           
            $zipCode = $row['d_codigo'];
            $idZipcode = "";

            $zipCodeModel = ZipCode::where('zip_code',$zipCode)->get();

            if($zipCodeModel->isEmpty()){
                $zipCodeModel = ZipCode::create([
                    'zip_code' => $zipCode,
                    'locality_id' => $idLocality,
                    'federal_entity_id' => $idFederalEntity,
                    'municipality_id' => $idMunucipality,
                ]);

               $idZipcode = $zipCodeModel->id;
            }else{
               $idZipcode =  $zipCodeModel->first()->id;
            }
            
            $settlementName = $row['d_asenta'];
            $settlementZoneType = $row['d_zona'];
            $settlementType = $row['d_tipo_asenta'];
            $settlementKey = $row['id_asenta_cpcons'];

            Settlement::create([
                'name' => $settlementName,
                'zone_type' => $settlementZoneType,
                'settlement_type' => $settlementType,
                'key' => $settlementKey,
                'zip_code' => $idZipcode,
            ]);

        }
    }


    public function headingRow(): int
    {
        return 1;
    }

  
}
