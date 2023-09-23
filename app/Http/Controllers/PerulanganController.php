<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PerulanganController extends Controller
{
    public function index(){
        return view('perulangan');
    }

    public function cek(Request $request){
        $jumlahPerulangan = $request->bilangan;

        $hasil  = [];
        $bageConcat = 0;

        for ($i = 1; $i <= $jumlahPerulangan; $i++) {
            if($bageConcat == 2){
                if($i%3==0 && $i%5==0){
                    $hasil[]    = "Bage Concat";
                    $bageConcat = $bageConcat + 1;
                } elseif($i%3==0){
                    $hasil[] = "Concat";
                } elseif($i%5==0){
                    $hasil[] = "Bage";
                } else {
                    $hasil[] = $i;
                }
            } elseif ($bageConcat == 5){
                break;
            } else{
                if($i%3==0 && $i%5==0){
                    $hasil[]    = "Bage Concat";
                    $bageConcat = $bageConcat + 1;
                } elseif($i%3==0){
                    $hasil[] = "Bage";
                } elseif($i%5==0){
                    $hasil[] = "Concat";
                } else {
                    $hasil[] = $i;
                }
            }
        }

        return response()->json(['data' => $hasil]);
    }
}
