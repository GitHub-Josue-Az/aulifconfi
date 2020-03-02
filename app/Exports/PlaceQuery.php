<?php

namespace App\Exports;


use App\Models\Place;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;

class PlaceQuery implements FromQuery
{
     use Exportable;

     private $ids;


      public function forId(int $ids)
    {
        $this->ids = $ids;
        
        return $this;
    }


    public function query()
    {
        return Place::query()->where('id', $this->ids);
    }
}
