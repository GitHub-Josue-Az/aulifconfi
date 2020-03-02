<?php

namespace App\Exports;

use App\Models\User;

use App\Models\Place;
use App\Models\Charge;
use App\Models\Mnagement;

use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;


class UserQuery implements FromQuery
{
     use Exportable;

     private $placesss;
     private $masss;
     private $chasss;


      public function __construct($management,$place,$charge)
    {
        $this->masss = $management;
        $this->placesss = $place;
        $this->chasss = $charge;
    }


		//public function forplace($place)
        //{
   		//	$placesss = $place;
      	//    return $placesss;
        //}

    	//public function forcharge($charge)
    	//{
    	//    $chasss = $charge;
    	//    return $chasss;
    	//}

    	//public function formanage($management)
    	//{
    	//    $masss = $management;
    	//    return $masss;
    	//}
     

    	public function query()
    		{

       		 return User::query()->when($this->placesss, function ($quer, $placesss){
                    return $quer->where('places_id', $placesss);
                })->when($this->masss, function ($quer, $masss) {
                    return $quer->where('managements_id', $masss);
                })->when($this->chasss, function ($quer, $chasss) {
                    return $quer->where('charges_id', $chasss);
                });
    }




}

