<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;

class HouseApplicationExport implements FromView
{
    private $data;
    private $house;

    public function __construct($data, $house)
    {
        $this->data = $data;
        $this->house = $house;
    }
    public function view(): View
    {

        return view('reports.house_applications', [
            'applications'=>$this->data,
            'house'=>$this->house
        ]);
    }
}
