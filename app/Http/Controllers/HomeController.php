<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    function index(Request $request) {
        $loggedUser = Auth::user();

        $deviceCosts = $loggedUser->deviceCosts()->getResults();
        $energyCosts = $loggedUser->energyCosts()->getResults();

        $costLast30Days = $loggedUser->energyCosts()->orderBy("to", "DESC")->first();
        $costLast60Days = $loggedUser->energyCosts()->orderBy("to", "DESC")->getResults()[1] ?? null;

        $differenceInMonth = null;
        $differenceInMonthPercentage = null;

        if($costLast30Days != null && $costLast60Days != null) {
            $differenceInMonth = round($costLast30Days->total_kw_consumed - $costLast60Days->total_kw_consumed, 2);
            $differenceInMonthPercentage = round((($costLast30Days->total_kw_consumed / $costLast60Days->total_kw_consumed) - 1) * 100, 2);
        }

        //dd($differenceInMonthPercentage);


        return view("home", [
            "loggedUser" => $loggedUser,
            "energyConsumedMonth" => [
                "currentMonth" => ($costLast30Days != null) ? $costLast30Days->total_kw_consumed : 0.0,
                "difference" => $differenceInMonth,
                "differencePercentage" => $differenceInMonthPercentage
            ],
            "energyConsumedMontly" => $energyCosts

        ]);
    }
}
