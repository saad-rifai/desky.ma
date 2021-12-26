<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Orders as AppOrders;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class Orders extends Controller
{
    public function PendingOrdersJson()
    {
        $CountPendingOrders = AppOrders::where('status', 0)->orderBy('created_at', 'ASC')->count();
        $data = AppOrders::where('status', 0)->orderBy('created_at', 'ASC')->paginate(10);
        for ($i = 0; $i < count($data); $i++) {
            if($data[$i]->files != null){
                $data[$i]->files = json_decode($data[$i]->files, true);
            }
            $data[$i]->date =  date('Y/m/d H:i:s', strtotime($data[$i]->created_at));

            $data[$i]->user = $data[$i]->user;
            $data[$i]->user_fullname = Str::ucfirst($data[$i]->user->frist_name) . ' ' . Str::ucfirst($data[$i]->user->last_name);
            /* Add Keywords to array */
            if ($data[$i]->keywords != null && $data[$i]->keywords != "") {
                $data[$i]->keywords = explode(",", $data[$i]->keywords);
            } else {
                $data[$i]->keywords = null;
            }
            /* Add Keywords to array */

            /* Get Activite And Sector NAme */
            $Activites = $data[$i]->activite;
            $sector = $data[$i]->sector;
            if (is_int($Activites) && $Activites >= 0) {
                if ($sector == 1) {
                    $listActivites = file_get_contents('data/json/activite-ae-2.json');
                    $listActivitesdata = json_decode($listActivites, true);
                } elseif ($sector == 2 || $sector == 3 || $sector == 4) {
                    $listActivites = file_get_contents('data/json/activite-ae-1.json');
                    $listActivitesdata = json_decode($listActivites, true);
                }
                $activite = $listActivitesdata[$Activites];
                $data[$i]->activite_name = $activite;
            } else {
                $data[$i]->activite_name = "undefined";
            }
            /* Set Sector Name */
            if ($sector == 1) {
                $sectorName = "الخدمات";
            } elseif ($sector == 2) {
                $sectorName = "التجارة";
            } elseif ($sector == 3) {
                $sectorName = "الصناعة";
            } elseif ($sector == 4) {
                $sectorName = "الحرفية";
            } else {
                $sectorName = "undefined";
            }
            $data[$i]->sector_name = $sectorName;
            $data[$i]->budget = number_format((float)$data[$i]->budget, 2, '.', '');
        }

        return response()->json(['data' => $data, 'CountPendingOrders' => $CountPendingOrders], 200);
    }
}
