<?php

namespace App\Exports;

use App\Models\RejaBeshdarboyan;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class DengenKandidaExport implements FromView, WithEvents, ShouldAutoSize
{
    public function __construct($data)
    {
        $this->data = $data;
    }
    public function view(): View
    {
        //resources/views/admin/derencamenRejabeshdarboyans/export.blade.php
        return view('admin.webSiteViews.export', [
            'data' => $this->data,
        ]);


    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                // ... HERE YOU CAN DO ANY FORMATTING
                $event->sheet->getDelegate()->getStyle('A1:ZZ1')->getFont()->setSize(20);
                $event->sheet->getDelegate()->getStyle('A2:ZZ2')->getFont()->setSize(20);
                $event->sheet->getDelegate()->getStyle('A3:Z1000')->getFont()->setSize(20);
                //$event->sheet->getDelegate()->getRowDimension(2)->setRowHeight(60);
                $event->sheet->getDelegate()->setRightToLeft(true);

            },
        ];

    }
}
