<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStartRow;

class UsersExport implements FromCollection, WithHeadings, WithStartRow
{
    protected $data;

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function collection()
    {
        return collect($this->data);
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function headings(): array
    {
        
        return [
            'Authors',
            'Title',
            'Year',
            'Source title',
            'Volume',
            'Issue',
            'Page start',
            'Page end',
            'Cited by',
            'DOI',
            'Document Type'
        ];
    }

    public function startRow(): int
    {
        return 10;
    }
}
