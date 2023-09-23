<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Province;
use App\Models\City;
use Kavist\RajaOngkir\Facades\RajaOngkir;

class LocationsSeeder extends Seeder
{
    public function run(): void
    {
        $daftarProvinsi = RajaOngkir::provinsi()->all();
        foreach ($daftarProvinsi as $provinceRow) {
            Province::create([
                'province_id' => $provinceRow['province_id'],
                'name'        => $provinceRow['province'],
            ]);
            $daftarKota = RajaOngkir::kota()->dariProvinsi($provinceRow['province_id'])->get();
            foreach ($daftarKota as $cityRow) {
                City::create([
                    'province_id'   => $provinceRow['province_id'],
                    'city_id'       => $cityRow['city_id'],
                    'name'          => $cityRow['city_name'],
                ]);
            }
        }
    }
}
