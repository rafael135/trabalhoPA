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
use Illuminate\Support\Facades\DB;

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

        for($i = 0; $i < $usersLength; $i++) {
            $userState = State::where("id", "=", $users[$i]->state_id)->first();
            $devices = Device::where("user_id", "=", $users[$i]->id)->get();
            //$devices = $users[$i]->devices()->getResults();
            $devicesLength = count($devices);

            $totalKwPerHour = 0.0;
            
            for($j = 0; $j < $devicesLength; $j++) {
                $currentDeviceCost = ($devices[$j]->consumptionPerHour * 4) * $userState->kiloWh_hour;
                $totalKwPerHour += $devices[$j]->consumptionPerHour;

                $now = Carbon::now();
                $from = $now;

                $now->addHours(4);
                $to = $now;

                DeviceCost::create([
                    "user_id" => $users[$i]->id,
                    "device_id" => $devices[$j]->id,
                    "kw_cost_per_hour" => $devices[$j]->consumptionPerHour,
                    "kw_cost" => $currentDeviceCost,
                    "from" => $from->toDateTimeString(),
                    "to" => $to->toDateTimeString()
                ]);
            }

            $totalKwPerFourHours = $totalKwPerHour * 4;

            $now = Carbon::now();
            $from = $now;

            $now->addHours(4);
            $to = $now;

            EnergyCost::create([
                "user_id" => $users[$i]->id,
                "kw_cost_per_hour" => $totalKwPerHour * $userState->kiloWh_hour,
                "kw_cost" => $totalKwPerFourHours * $userState->kiloWh_hour,
                "from" => $from->toDateTimeString(),
                "to" => $to->toDateTimeString()
            ]);
        }
    }
}
