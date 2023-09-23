<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Province;
use App\Models\City;
use App\Models\Courier;
use Kavist\RajaOngkir\Facades\RajaOngkir;

class CekOngkirController extends Controller
{
    public function index(){
        $provinces = Province::pluck('name', 'province_id');
        return view('cekOngkir', compact('provinces'));
    }

    public function getCities($id){
        $city = City::where('province_id', $id)->pluck('name', 'city_id');
        return response()->json($city);
    }

    public function checkOngkir(Request $request){
        $data = RajaOngkir::ongkosKirim([
            'origin'        => $request->kotaAsal, 
            'destination'   => $request->kotaTujuan, 
            'weight'        => $request->weight, 
            'courier'       => $request->kurir
        ])->get();

        return response()->json($data);
    }
}
