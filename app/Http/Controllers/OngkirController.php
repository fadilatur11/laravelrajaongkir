<?php

namespace App\Http\Controllers;
use App\Services\Api\RajaongkirService;
use Illuminate\Http\Request;

class OngkirController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getPorvinces()
    {
        $rajaongkir = RajaongkirService::daftarProvinsi('province');
        return response()->json([
            'status' => 200,
            'data' => $rajaongkir
        ]);
    }

    public function searchProvince(Request $request)
    {
        $rajaongkir = RajaongkirService::SearchProvince($request->input('searchKey'));
        if ($rajaongkir == NULL) {
            return response()->json([
                'status' => 404,
                'data' => $rajaongkir
            ]);
        }else{
            return response()->json([
                'status' => 200,
                'data' => $rajaongkir
            ]);
        }
    }

    public function getCities(Request $request)
    {
        if (empty($request->input('searchKey'))) {
            $rajaongkir = RajaongkirService::getCity();
            $status = 200;
        }else{
            $rajaongkir = RajaongkirService::searchCity($request->input('searchKey'));
                if ($rajaongkir == NULL) {
                    $status = 404;
                }else{
                   $status = 200;
                }
        }
        return response()->json([
            'status' => $status,
            'data' => $rajaongkir
        ]);
        
    }

}
