<?php

namespace App\Http\Controllers\Owners;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Imports\BusinessesImport;
use Maatwebsite\Excel\Facades\Excel;

class CTRLimport extends Controller
{
    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv|max:2048',
        ]);
    
        $file = $request->file('file');
    
        Excel::import(new BusinessesImport, $file);
    
        return redirect()->back()->with('status', 'Data imported successfully!');
    }


}

