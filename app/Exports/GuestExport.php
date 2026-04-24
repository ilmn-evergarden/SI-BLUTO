<?php

namespace App\Exports;


use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class GuestExport implements FromCollection, WithHeadings
{
    protected $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function collection()
    {
        return $this->data->map(function ($item) {
            return [
                'Nama' => $item->name,
                'Instansi' => $item->institution,
                'Jenis Surat' => $item->letterType->name ?? $item->custom_letter_type,
                'Nomor Surat' => $item->letter_number,
                'Tujuan' => $item->purpose,
                'No HP' => $item->phone,
                'Tanggal' => $item->visit_date,
            ];
        });
    }

    public function headings(): array
    {
        return [
            'Nama',
            'Instansi',
            'Jenis Surat',
            'Nomor Surat',
            'Tujuan',
            'No HP',
            'Tanggal',
        ];
    }
}