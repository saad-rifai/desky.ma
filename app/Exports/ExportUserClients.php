<?php

namespace App\Exports;

use App\desky_user_clients;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
class ExportUserClients implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
   /* public function  __construct($from,$to)
    {
        $this->from = $from;
        $this->to = $to;
    }*/
    public function headings():array {

        return[
            '#',
            'CID',
            'email',
            'Tel',
            'Nom',
            'ice',
            'Pays',
            'Ville',
            'adresse',
            'Date'


        ];
    }
    public function collection()
    {
        //$from = Carbon::parse($this->from)->format('Y-m-d')." 00:00:00";
        //$to    = Carbon::parse($this->to)->format('Y-m-d')." 23:59:59";
        //        ->whereBetween('created_at', [$from,$to])
        return desky_user_clients::select(['id','CID','from','c_phone','c_name','c_ice','country','city','adresse','created_at'])->where('from', Auth::user()->email)->paginate(100);
    }
}
