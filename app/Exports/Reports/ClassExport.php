<?php

namespace App\Exports\Reports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;

class ClassExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */

    protected $objects;

		public function __construct($objects) {
		        $this->objects = $objects;
		 }

    public function view(): View
    {
        return view('exports.reports.class', [
            'data' =>  $this->objects
        ]);
    }
}
