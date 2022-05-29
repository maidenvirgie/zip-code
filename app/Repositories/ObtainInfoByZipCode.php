<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;

class ObtainInfoByZipCode
{
    public function get($zipCode)
    {
        $zipCodes = DB::select('select settlements.name as SettlementName, settlements.zone_type as SettlementZoneType, settlements.settlement_type as SettlementType, settlements.zone_type as SettlementZoneType, settlements.key as SettlementKey,
                                zip_codes.zip_code,
                                localities.name as Locality,
                                municipalities.name as MunicipalityName, municipalities.key as MunicipalityKey,
                                federal_entities.name as FederalEntityName, federal_entities.key as FederalEntityKey, federal_entities.code as FederalEntityCode
                                FROM settlements INNER JOIN zip_codes 
                                ON settlements.zip_code = zip_codes.id 
                                INNER JOIN localities ON zip_codes.locality_id = localities.id
                                INNER JOIN municipalities ON zip_codes.municipality_id = municipalities.id 
                                INNER JOIN federal_entities ON zip_codes.federal_entity_id  = federal_entities.id 
                                WHERE zip_codes.zip_code=?', [$zipCode]);

       return $zipCodes;
    }
}
