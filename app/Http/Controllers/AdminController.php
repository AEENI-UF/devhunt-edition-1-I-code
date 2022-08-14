<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Configuration;
use Illuminate\Http\JsonResponse;

class AdminController extends Controller
{
    public function getLimitation(Request $request) :  JsonResponse{
        $configuration = Configuration::first();

        if(!$configuration){
            return response()->json([
                "debit" => 0,
                'heure' => 0,
                "min" => 0,
                "sec" => 0
            ]);
        }
        $heure = (int) ($configuration->temps / 3600);
        $min = (($configuration->temps / 3600) - $heure) * 60;

        return response()->json([
            "debit" => $configuration->debit,
            'heure' => $heure,
            "min" => $min,
            "sec" => 0
        ]);
    }

    public function saveLimitation(Request $request) :  JsonResponse{
        $this->validate($request, [
            'debit' => 'required|numeric',
            'heure' => 'required|numeric',
            'min' => 'required|numeric',
            'sec' => 'required|numeric',
        ]);

        $heureToSec = $request->input("heure") * 3600;
        $minToSec = $request->input("min") *60;

        $temps = $heureToSec + $minToSec + $request->input("sec");

        $configuration = Configuration::first();

        if(!$configuration){
            Configuration::create([
                "debit" => $request->input("debit"),
                "temps" => $temps
            ]);    
        }

        else{
            $configuration->update([
                "debit" => $request->input("debit"),
                "temps" => $temps
            ]);
        }
        return response()->json([
            "response" => "validate"
        ]);
    }
    
}
