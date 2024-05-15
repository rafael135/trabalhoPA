<?php

namespace App\Jobs;

use App\Models\Device;
use App\Models\DeviceCost;
use App\Models\EnergyCost;
use App\Models\State;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class CalculateResults implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $users = User::all();
        $usersLength = count($users);

        $nowGlobal = Carbon::now();

        $hoursToCalculate = $nowGlobal->daysInMonth() * 24;
        $daysInMonth = $nowGlobal->daysInMonth();

        for($i = 0; $i < $usersLength; $i++) {
            $userState = State::where("id", "=", $users[$i]->state_id)->first();
            $devices = Device::where("user_id", "=", $users[$i]->id)->get();
            //$devices = $users[$i]->devices()->getResults();
            $devicesLength = count($devices);

            $totalKwPerHour = 0;
            
            for($j = 0; $j < $devicesLength; $j++) {
                $currentDeviceCost = ($devices[$j]->consumption_per_hour / 1000.0) * $userState->kiloWh_hour;
                $currentDeviceTotalCost = (($devices[$j]->consumption_per_hour * $hoursToCalculate) / 1000.0) * $userState->kiloWh_hour;
                $currentDeviceTotalKwConsumed = (($devices[$i]->consumption_per_hour * $hoursToCalculate) / 1000.0);
                $totalKwPerHour += $devices[$j]->consumption_per_hour;

                $now = Carbon::parse($nowGlobal->toDateTimeString());
                $now = $now->subDays($daysInMonth);
                $from = $now->toDateTimeString();

                $now = $now->addDays($daysInMonth);
                $to = $now->toDateTimeString();

                DeviceCost::create([
                    "user_id" => $users[$i]->id,
                    "device_id" => $devices[$j]->id,
                    "kw_cost_per_hour" => $currentDeviceCost,
                    "kw_cost" => $currentDeviceTotalCost,
                    'total_kw_consumed' => $currentDeviceTotalKwConsumed,
                    "from" => $from,
                    "to" => $to
                ]);
            }

            $totalKwCostPerMonth = (($totalKwPerHour * $hoursToCalculate) / 1000.0) * $userState->kiloWh_hour;
            $totalKwConsumedPerMonth = (($totalKwPerHour * $hoursToCalculate) / 1000.0);
            $kwCost = ($totalKwPerHour / 1000.0) * $userState->kiloWh_hour;


            $now = Carbon::parse($nowGlobal->toDateTimeString());
            $now = $now->subHours(4);
            $from = $now->toDateTimeString();

            $now = $now->addHours(4);
            $to = $now->toDateTimeString();

            EnergyCost::create([
                "user_id" => $users[$i]->id,
                "kw_cost_per_hour" => $kwCost,
                "kw_cost" => $totalKwCostPerMonth,
                'total_kw_consumed' => $totalKwConsumedPerMonth,
                "from" => $from,
                "to" => $to
            ]);
        }
    }
}
