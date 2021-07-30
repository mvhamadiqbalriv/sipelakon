<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Village;

class DirectoryController extends Controller
{
    public function village(Request $request)
    {
        $desa = Village::where('district_id', $request->get('id'))
            ->pluck('name', 'id');
    
        return response()->json($desa);
    }
}
