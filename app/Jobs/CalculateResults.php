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

        //$nowGlobal->subDays(30);

        $nowGlobal = $nowGlobal->addMonths(2);

        $hoursToCalculate = $nowGlobal->daysInMonth() * 24;
        $daysInMonth = $nowGlobal->daysInMonth();

        for($i = 0; $i < $usersLength; $i++) {
            $userState = State::where("id", "=", $users[$i]->state_id)->first();
            $devices = Device::where("user_id", "=", $users[$i]->id)->get();
            //$devices = $users[$i]->devices()->getResults();
            $devicesLength = count($devices);

            $totalKwPerHour = 0;

            $deviceHours = collect();
            
            for($j = 0; $j < $devicesLength; $j++) {
                $currentDeviceCost = ($devices[$j]->consumption_per_hour / 1000.0) * $userState->kiloWh_hour;
                $currentDeviceTotalCost = (($devices[$j]->consumption_per_hour * $hoursToCalculate) / 1000.0) * $userState->kiloWh_hour;
                $currentDeviceTotalKwConsumed = ($devices[$j]->hours_per_day == null) ? (($devices[$j]->consumption_per_hour * $hoursToCalculate) / 1000.0) : (($devices[$j]->consumption_per_hour * ($devices[$j]->hours_per_day * $daysInMonth)) / 1000.0);

                
                $deviceHours->push($devices[$j]->hours_per_day ?? $hoursToCalculate);

                $totalKwPerHour += $devices[$j]->consumption_per_hour / 1000.0;

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

            $totalKwConsumption = 0;

            for($j = 0; $j < count($deviceHours); $j++) {
                $totalKwConsumption += (($devices[$j]->consumption_per_hour * $deviceHours[$j]) / 1000.0);
            }

            $totalKwCostPerMonth = $totalKwConsumption * $userState->kiloWh_hour;

            $totalKwConsumedPerMonth = $totalKwConsumption;
            $kwCost = $totalKwPerHour;


            $now = Carbon::parse($nowGlobal->toDateTimeString());
            $from = $now->toDateTimeString();

            $now = $now->addDays(30);
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
