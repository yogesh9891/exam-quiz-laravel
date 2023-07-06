<?php

namespace App\Exports\Reports;

use Maatwebsite\Excel\Concerns\FromCollection;

class PaperExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        //
    }
}
