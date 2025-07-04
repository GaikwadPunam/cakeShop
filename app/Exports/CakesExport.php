<?php

namespace App\Exports;

use App\Models\cake;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithColumnWidths;

class CakesExport implements FromCollection ,WithHeadings , WithColumnWidths
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Cake::select('id', 'name', 'description', 'price')->get();
    }

    // This sets the column titles in Excel
    public function headings(): array
    {
        return ['ID', 'Name', 'Description', 'Price'];
    }
     public function columnWidths(): array
    {
        return [
            'A' => 10,   // ID
            'B' => 20,   // Name
            'C' => 40,   // Description
            'D' => 15,   // Price
        ];
    }
}
