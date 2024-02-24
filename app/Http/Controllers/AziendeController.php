<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AziendeController extends Controller
{
    function registrazione(Request $request){
        header('Access-Control-Allow-Origin: *');

        DB::beginTransaction();

        try {
            $idUtente = DB::table('utenti')->insertGetId([
                'email' => $request->email,
                'password' => bcrypt($request->password),
            ]);
            DB::table('aziende')->insert([
                'regioneSociale' => $request->regioneSociale,
                'partitaIva' => $request->partitaIva,
                'codiceFiscale' => $request->codiceFiscale,
                'indirizzo' =>  $request->indirizzo,
                'citta' => $request->citta,
                'cap' =>  $request->cap,
                'provincia' => $request->provincia,
                'telefono' => $request->telefono,
                'idUtente' => $idUtente,
            ]);

            DB::commit();

            return response()->json(['status' => 'ok']);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json(['status' => 'ko', 'error' => $e->getMessage()]);
        }
    }

    /*function login(Request $request){
        header('Access-Control-Allow-Origin: *');

        $utente = DB::table('utenti')->where('email', $request->email)->first();

        if ($utente && password_verify($request->password, $utente->password)) {
            return response()->json(['status' => 'ok', 'idUtente' => $utente->idUtente]);
        } else {
            return response()->json(['status' => 'ko']);
        }
    }*/
}
