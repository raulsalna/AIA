<?php


namespace App\Services\Consume;


use Illuminate\Support\Facades\Http;

class LocalApi
{
    private static function getToken()
    {
       return Http::asForm()->post('http://localhost:8000/api/login', [
            'email' => auth()->user()->email,
            'password' => 'admin',
        ])->json('token');
    }

    static function getMarcas(){
        return Http::withHeaders(['Access-Control-Allow-Credentials'=>'true'])
        ->withToken(self::getToken())
        ->get('http://localhost:8000/api/marca')
        ->json($key = null);
    }

    static function getModelos($marca){
        return Http::withHeaders(['Access-Control-Allow-Credentials'=>'true'])
        ->withToken(self::getToken())
        ->get('http://localhost:8000/api/modelo/'.$marca)
        ->json();
    }

    static function storeAutos($autos){
        dd($autos);
        return Http::withHeaders(['Access-Control-Allow-Credentials'=>'true'])
        ->withToken(self::getToken())
        ->post('http://localhost:8000/api/autos/', [
            'marca' => $autos['marca'],
            'modelo' =>  $autos['modelo'],
            'anio' =>  $autos['anio'],
            'precio' =>  $autos['precio'],
            'kilometraje' =>  $autos['kilometraje'],
            'color' =>  $autos['color'],
            'email' =>  $autos['email'],
            'telefono' =>  $autos['telefono']
            ])
        ->json();

       

    }
}
