<?php

namespace App\Exports;

use App\Models\Admin\businesses;
use App\Models\Owners\ClaimRequest;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Support\Facades\DB;

class BusinessReportExport implements FromCollection, WithHeadings
{
    /**
     * Return the collection of businesses to export.
     *
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        // Join claim_requests and users to get the admin who approved the claim
        return ClaimRequest::select(
            'businesses.businessName', 
            'businesses.tin_number', 
            'businesses.fullName', 
            'claim_requests.status', 
            'claim_requests.created_at', 
            DB::raw('users.name as admin_name') // Get the name of the admin who approved the claim
        )
        ->leftJoin('businesses', 'businesses.id', '=', 'claim_requests.business_id')
        ->leftJoin('users', 'users.id', '=', 'claim_requests.approved_by') // Join with users table to get admin details
        ->get();
    }

    /**
     * Define the headings for the export.
     *
     * @return array
     */
    public function headings(): array
    {
        return [
            'Business Name',
            'TIN Number',
            'Owner Name',
            'Status',
            'Created At',
            'Admin Approved By', // Add the admin approved by in the headings
        ];
    }
}
