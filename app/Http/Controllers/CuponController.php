<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CuponModel;

class CuponController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
      
    }

    /**
     * Show the form for creating a new resource.
     */
    public function canje($codigo_cupon)
    {
        $cupon = CuponModel::where('codigo_cupon', $codigo_cupon) ->first();
        if (!$cupon) {
            return response()->json(['mensaje' => 'Cupón no encontrado'], 404);
        }
        if ($cupon->estado =='Canjeado') {
            return response()->json(['message' => 'El cupón ya ha sido canjeado'], 400);
        }
        if ($cupon->estado =='Vencido') {
            return response()->json(['message' => 'El cupón ha vencido'], 400);
        }
        if ($cupon->estado =='Disponible') {
            $cupon->estado = 'Canjeado';
            $cupon-> save();
            return response()->json(['message' => 'Cupón canjeado exitosamente'], 200);
        }
        
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $codigo_cupon)
    {
        $cupon = CuponModel::where('codigo_cupon', $codigo_cupon)->first();
        if(!$cupon) {
            return response()->json(['mensaje' => 'Cupón no encontrado'], 404);
        }
      return $cupon;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
