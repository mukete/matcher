<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    //  randomly set all propperty types to match at least one search profile

    foreach (\App\Models\SearchProfile::all() as $searchProfile) {
        // code...
        $searchProfile->propertyType = DB::table('properties')
                ->inRandomOrder()
                ->first()->propertyType;
                // $searchProfile->save();

    }

    $heating = array('gas', 'electric', 'coal','hydronic');

    for ($i=1; $i <26 ; $i++) { 
        // code...
        $property =\App\Models\Property::find($i);
        $property->fields = array(
            'heatingType' => $heating[array_rand($heating)],
            'rooms' => rand(2,10),
            'parking' => rand(true,false),
            'returnActual' => rand(10,20),
            'pool' => rand(true,false),
            'price' => rand(14000,250000),
            'yearOfConstruction' => rand(1990,2022),
            'area' => rand(180,2000),
        );
        // $property->save();
    }

    for ($i=126; $i <151 ; $i++) { 
        // code...
        $searchProfile =\App\Models\SearchProfile::find($i);
        $searchProfile->fields = array(
            'heatingType' => $heating[array_rand($heating)],
            'rooms' => [1,rand(2,10)],
            'returnActual' => [rand(3,14), null],
            'pool' => rand(true,false),
            'yearOfConstruction' => [null, rand(2012,2022)],
            'area' => [rand(550,800), null],
            'price' => [rand(9000,100000),265000],
        );
        // $searchProfile->save();
    }

    return 'matchr';

    return 'swapping done';
    return view('welcome');
});
