<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::get('/match/{propertyId}', function (Request $request, $propertyId) {

    // return log(3 - 0, 2);

    $data = array();
    // getting property with propertyId
    $property = \App\Models\Property::find($propertyId);
    // hold property fields for checking
    $checkFields = json_decode($property->fields, true);
    ksort($checkFields);

    // search profiles with same property type uuid
    $searchProfileWithPropertyType = \App\Models\SearchProfile::where('propertyType','=',$property->propertyType)->get();

    foreach($searchProfileWithPropertyType as $selected) {

        $selectedFields = json_decode($selected->fields, true);
        ksort($selectedFields);

        // hold current profile data 
        $tempArray = array(
            'searchProfileId' => $selected->id,
            'score' => 0,
            'strictMatchesCount' => 0,
            'looseMatchesCount' => 0,
        );
        // Check for matches in here  looping property fields and check for match
        foreach ($checkFields as $key => $value) {
            // checking for array fields
            if(@is_array($selectedFields[$key])) {
                // Set strick match
                if(($value >= $selectedFields[$key][0]) && ($value <= $selectedFields[$key][1]) ) {
                    $tempArray['strictMatchesCount'] = $tempArray['strictMatchesCount']+1;
                    $tempArray['score'] = $tempArray['score']+3;
                } else {
                    // set loose matches
                    if(($value >= ($selectedFields[$key][0] - ((5/100)*$selectedFields[$key][0]))) && ($value <= ($selectedFields[$key][1] + ((5/100)*$selectedFields[$key][1]))) ) {
                        $tempArray['looseMatchesCount'] = $tempArray['looseMatchesCount']+1;
                        $tempArray['score'] = $tempArray['score']+1;
                    }
                }
            } else {
                // check for non array fields
                if($value == @$selectedFields[$key] ) {
                    $tempArray['strictMatchesCount'] = $tempArray['strictMatchesCount']+1;
                    $tempArray['score'] = $tempArray['score']+3;
                }
            }
        }
        // return $aa;
        array_push($data, $tempArray);
    }
    
    $score = array_column($data, 'score');
    array_multisort($score, SORT_DESC, $data);
    return ['data' => $data];

});
