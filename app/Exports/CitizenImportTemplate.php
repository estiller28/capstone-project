<?php

namespace App\Exports;

use App\Models\citizen;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Events\AfterSheet;

class CitizenImportTemplate implements WithHeadings, WithEvents
{

    public function headings() :array
    {
        return [
            'First Name',
            'Middle Name',
            'Last Name',
            'Date of Birth',
            'Purok ID',
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {
                // bg-color
                $event->sheet->getDelegate()->getStyle('A1:E1')->getFill()
                    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                    ->getStartColor()
                    ->setARGB('215476');

                // font-color
                $event->sheet->getDelegate()->getStyle('A1:E1')
                    ->getFont()
                    ->getColor()
                    ->setARGB('FFFFFF');

                // font-weight
                $event->sheet->getDelegate()->getStyle('A1:E1')
                    ->getFont()->setBold(true);

                // font-size
                $event->sheet->getDelegate()->getStyle('A1:E1')
                    ->getFont()->setSize(9);

                //align-center
                $event->sheet->getDelegate()->getStyle('A1:E1')
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


