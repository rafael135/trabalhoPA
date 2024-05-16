<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    function index(Request $request) {
        $loggedUser = Auth::user();

        $energyCosts = $loggedUser->energyCosts()->getResults();
        $latestData = $loggedUser->devices()->select(["created_at"])->orderBy("created_at", "DESC")->getResults();
        $userDevices = $loggedUser->devices()->getResults();
        $countDevices = count($userDevices);
        
        $deviceCosts = $loggedUser->deviceCosts()->orderBy("to", "DESC")->limit(count($userDevices))->getResults();


        

        $costLast30Days = $loggedUser->energyCosts()->orderBy("to", "DESC")->first();
        $costLast60Days = $loggedUser->energyCosts()->orderBy("to", "DESC")->getResults()[1] ?? null;

        $differenceInMonth = null;
        $differenceInMonthPercentage = null;

        if($costLast30Days != null && $costLast60Days != null) {
            $differenceInMonth = round($costLast30Days->total_kw_consumed - $costLast60Days->total_kw_consumed, 2);
            $differenceInMonthPercentage = round((($costLast30Days->total_kw_consumed / $costLast60Days->total_kw_consumed) - 1) * 100, 2);
        }

        $months = collect();

        for($i = 0; $i < count($energyCosts); $i++) {
            $months->push(Carbon::parse($energyCosts[$i]->from)->getTranslatedMonthName());
        }
        
        //dd($energyCosts);

        //dd($differenceInMonthPercentage);

        //ddd();

        return view("home", [
            "loggedUser" => $loggedUser,
            "energyConsumedMonth" => [
                "currentMonth" => round(($costLast30Days != null) ? $costLast30Days->total_kw_consumed : 0.0, 2),
                "currentMonthPrice" => round($costLast30Days->kw_cost, 2),
                "difference" => $differenceInMonth,
                "differencePercentage" => $differenceInMonthPercentage
            ],
            "energyConsumedMontly" => [
                "months" => $months,
                "monthsConsume" => $energyCosts
            ],
            "devices" => [
                "deviceCosts" => $deviceCosts,
                "devices" => $userDevices,
                "countDevices" => $countDevices
            ]

        ]);
    }
}
