<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home_index()
    {
        //return ['estado' => "ok", 'mensaje'=>'API Rest para AWS'];
        return response()->json(['estado' => "ok", 'mensaje'=>'API Rest para AWS'], 200);
    }
}
