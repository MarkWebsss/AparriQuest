<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Users\products;
use DB;

class CTRLproducts extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
            
        $allproducts = products::paginate(1);

        return view('users.products.index')
        ->with('allproducts',$allproducts);
        


    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
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
    public function show(string $id)
    {
        //
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

    // my search function goes here 
    public function searchproducts(Request $request)
    {
        
           // return products::Where('pdesc','LIKE','%'.$request->input('keyword').'%');

           $searchresults = DB::table('products')
            ->select('*')
            ->where('pdesc','LIKE','%'.$request->input('keyword').'%')
            ->get();

            return view('users.products.searchresults')
            ->with('searchresults',$searchresults);

            
            return $request->input('keyword');
    }






}
