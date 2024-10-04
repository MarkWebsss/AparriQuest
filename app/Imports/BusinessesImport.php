<?php

namespace App\Imports;

use App\Models\Admin\businesses;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\ToModel;

class BusinessesImport implements ToModel
{
    use Importable;

    public function model(array $row)
    {
        if (is_numeric($row[10])) { 
            $date = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[10])->format('Y-m-d');
        } else {
            $date = $row[10]; 
        }

        
        if (!\DateTime::createFromFormat('Y-m-d', $date)) {
            $date = now()->format('Y-m-d'); 
        }

        $fullName = trim($row[0] . ' ' . ($row[1] ?? '') . ' ' . $row[2]);

        return new businesses([
            'firstName' => $row[0],
            'middleName' => $row[1] ?? null,
            'lastName' => $row[2],
            'fullName' => $fullName,
            'fullAddress' => $row[4],
            'ownerHouseNo' => $row[5],
            'ownerStreetAddress' => $row[6],
            'ownerCity' => $row[7],
            'ownerEmail' => $row[8],
            'ownerPhone' => $row[9],
            'dateOfApplication' => $date,
            'businessName' => $row[11],
            'tinNumber' => $row[12],
            'businessNo' => $row[13],
            'BusStreetAddress' => $row[14],
            'businessCity' => $row[15],
            'businessEmail' => $row[16],
            'businessPhone' => $row[17],
        ]);
    } 
}