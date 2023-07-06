<?php

namespace App\Exports\Reports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;
class StudentExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
       protected $student;

		public function __construct($objects) {
		        $this->student = $objects;
		 }

    public function view(): View
    {
    	$data =     $this->student ;
    	// dd($data);
        return view('exports.reports.student',compact('data'));
    }
}
