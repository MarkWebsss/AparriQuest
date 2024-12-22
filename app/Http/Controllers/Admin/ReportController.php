<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin\businesses;
use App\Models\Owners\OwnerProduct;
use App\Models\User;
use App\Models\Role;
use App\Exports\BusinessReportExport;
use Maatwebsite\Excel\Facades\Excel;

class ReportController extends Controller
{
        /**
     * Export the business report as a CSV or Excel file.
     *
     * @return \Illuminate\Http\Response
     */
    public function export()
    {
        return Excel::download(new BusinessReportExport, 'business_report.csv'); // You can change to 'xlsx' for Excel format
    }

    public function generateReport(Request $request)
    {
        // Query the necessary data
        $businesses = businesses::all();  // Get all businesses
        $products = OwnerProduct::all();      // Get all products

        // Pass data to the report view
        return view('admin.reports.index', compact('businesses', 'products'));
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
}
