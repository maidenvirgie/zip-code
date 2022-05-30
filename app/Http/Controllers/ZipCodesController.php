<?php

namespace App\Http\Controllers;

use App\Http\Requests\ZipCodesRequest;
use Illuminate\Http\Request;
use App\Repositories\ObtainInfoByZipCode;
use Illuminate\Support\Str;



class ZipCodesController extends Controller
{

    private function textTransform($text)
    {
        $textTransformU = Str::upper($text);
        $textTransform =  Str::of($textTransformU)->ascii();
        return $textTransform->value;

    }

    public function show($zipCode)
    {  
       
        $zipCodesInfo = new ObtainInfoByZipCode();
        $queryZipCodesResult = $zipCodesInfo->get($zipCode);
        //dd($queryZipCodesResult);

        if( !is_numeric($zipCode) ){
            return response()->json([
                'message' => 'request error zipcode should be numeric'
            ], 400);
        }


        if(count($queryZipCodesResult) == 0){
            return response()->json([
                'message' => 'zip code not found'
            ], 404);
        }

        $response = [
            'zip_code' => '',
            'locality' => '',
            'federal_entity' => [
                'key' => '',
                'name' => '',
                'code' => ''
            ],
            'settlements' => [],
            'municipality' => [
                'key' => '',
                'name' => ''
            ]
        ];

        $settlement = [
            'key' => '',
            'name' => '',
            'zone_type' => '',
            'settlement_type' => [
                'name' => ''
            ]
        ];

        foreach ($queryZipCodesResult as $key => $row) {
            
            $response['zip_code'] = $row->zip_code;
            $response['locality'] = $this->textTransform($row->Locality);
            $response['federal_entity']['key'] = intval($row->FederalEntityKey);
            $response['federal_entity']['name'] = $this->textTransform($row->FederalEntityName);
            $response['federal_entity']['code'] = $row->FederalEntityCode;
            $response['municipality']['key'] = intval($row->MunicipalityKey);
            $response['municipality']['name'] = $row->MunicipalityName;

            $settlement['name'] = $this->textTransform($row->SettlementName);
            $settlement['key'] = intval($row->SettlementKey);
            $settlement['zone_type'] = $row->SettlementZoneType;
            $settlement['settlement_type']['name'] = $row->SettlementType;

            array_push($response['settlements'], $settlement);
           
        }

        return response()->json($response, 200);


    }

   
}
