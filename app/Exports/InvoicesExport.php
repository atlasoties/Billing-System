<?php

namespace App\Exports;

use App\Models\Invoice;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
class InvoicesExport implements FromCollection,WithEvents,WithHeadings,ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Invoice::where('status','PARTIAL')->select('invoice_number','status','paid','remaining','name','companyName')->get();
    }

    public function headings():array{
        return[
            '#INVOICE',
            'STATUS',
            'PAID AMOUNT',
            'REMAINING',
            'CUSTOMER NAME',
            'COMPANY NAME',
            '',
            '',
        ];
    }

    public function registerEvents():array{
        return[
            AfterSheet::class => function(AfterSheet $event){
                $cellRange = 'A1:'.$event->sheet->getDelegate()->getHighestColumn().'1';//all columns
                $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setSize(14);
            },
        ];
    }
}
