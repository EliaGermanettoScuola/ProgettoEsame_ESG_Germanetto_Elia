<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class SessionController extends Controller
{
    public function getSession(Request $request){
        
        try {
            if (Session::has('Users')) {
                return response()->json(['status' => 'success', 'data' => Session::get('Users')]);
            } else {
                return response()->json(['status' => 'error', 'message' => 'No data in the session']);
            }
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }

    public function CreateSession(Request $request){
        Session::put($request->type, $request->id);
        return response()->json(['status' => 'success', 'data' => Session::get($request->type)]);
    }

    public function destroySession(Request $request){
        if(Session::has($request->type)){
            Session::forget($request->type);
            return response()->json(['status' => 'success', 'message' => 'Session data deleted successfully']);
        }else{
            return "No data found in the session";
        }
        
    }

    public function getSessionInfo(Request $request){
        $sessionData = $request->session()->all();
        return response()->json(['sessionData' => $sessionData]);
    }
}
