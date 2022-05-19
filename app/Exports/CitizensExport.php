<?php

namespace App\Exports;

use App\Models\Citizen;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;


class CitizensExport implements FromCollection, WithHeadings, WithEvents
{
    public function collection(){

        return Citizen::select('first_name', 'middle_name', 'last_name', 'email')->where('barangay_id', auth()->user()->barangay_id)->get();
    }
    public function headings() :array
    {
        return [
            'First Name',
            'Middle Name',
            'Last Name',
            'Email',
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function(AfterSheet $event) {
                // bg-color
                $event->sheet->getDelegate()->getStyle('A1:D1')->getFill()
                    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                    ->getStartColor()
                    ->setARGB('215476');

                // font-color
                $event->sheet->getDelegate()->getStyle('A1:D1')
                    ->getFont()
                    ->getColor()
                    ->setARGB('FFFFFF');

                // font-weight
                $event->sheet->getDelegate()->getStyle('A1:D1')
                    ->getFont()->setBold(true);

                //align-center
                $event->sheet->getDelegate()->getStyle('A1:D1')
                    ->getAlignment()
                    ->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);

                //row-height
                $event->sheet->getDelegate()->getRowDimension('1')->setRowHeight(20);

                //cell-width
                $event->sheet->getDelegate()->getColumnDimension('A')->setWidth(20);
                $event->sheet->getDelegate()->getColumnDimension('B')->setWidth(20);
                $event->sheet->getDelegate()->getColumnDimension('C')->setWidth(20);
                $event->sheet->getDelegate()->getColumnDimension('D')->setWidth(30);
                $event->sheet->getDelegate()->getColumnDimension('E')->setWidth(20);
            },
        ];
    }
}


