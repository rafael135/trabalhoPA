<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateDeviceRequest;
use App\Models\Device;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DeviceController extends Controller
{
    //

    function index(Request $request) {
        $loggedUser = Auth::user();


        $devices = Device::select()->where("user_id", "=", $loggedUser->id)->get();

        return view("eletronicos", [
            "loggedUser" => $loggedUser,
            "devices" => $devices
        ]);
    }


    function createDevice(CreateDeviceRequest $request) {
        $rememberToken = $request->header("Authorization", null);

        if($rememberToken == null) {
            return response()->json([
                "status" => 403
            ], 403);
        }

        $loggedUser = User::where("remember_token", "=", $rememberToken)->first();

        if($loggedUser == null) {
            return response()->json([
                "status" => 403
            ], 403);
        }

        $consumption_per_hour = $request->input("consumptionPerHour", null);
        $hours_per_day = $request->input("hoursPerDay", null);
        $brand = $request->input("brand", null);
        $name = $request->input("name", null);

        if($consumption_per_hour == null || $hours_per_day == null || $brand == null || $name == null) {
            return response()->json([
                "status" => 400
            ], 400);
        }

        $hours_per_day = ($hours_per_day == 0) ? null : $hours_per_day;

        $device = Device::create([
            "user_id" => $loggedUser->id,
            "consumption_per_hour" => $consumption_per_hour,
            "hours_per_day" => $hours_per_day,
            "brand" => $brand,
            "name"=> $name
        ]);

        return response()->json([
            "device" => $device,
            "status" => 201
        ], 201);

    }

    function getDevices(Request $request) {
        $rememberToken = $request->header("Authorization", null);

        if($rememberToken == null) {
            return response()->json([
                "status" => 403
            ], 403);
        }

        $loggedUser = User::where("remember_token", "=", $rememberToken)->first();

        if($loggedUser == null) {
            return response()->json([
                "status" => 403
            ], 403);
        }

        $searchTerm = $request->query("searchTerm", null);
        $page = $request->query("page", 1);
        $itemsPerPage = $request->query("itemsPerPage",10);

        $devicesCount = Device::select()->where("user_id", "=", $loggedUser->id)->count();
        $pages = ceil(($devicesCount / $itemsPerPage));

        $devices = collect();

        if($searchTerm != null) {
            $devices = Device::select()->where("user_id", "=", $loggedUser->id)->whereAny(["brand", "name"], "like", $searchTerm)->skip(($page - 1) * $itemsPerPage)->take($itemsPerPage)->get();
        } else {
            $devices = Device::select()->where("user_id", "=", $loggedUser->id)->skip(($page -1) * $itemsPerPage)->take($itemsPerPage)->get();
        }

        

        return response()->json([
            "devices" => $devices,
            "pages" => $pages,
            "status" => 200
        ], 200);
        
    }

    function getDevice(Request $request, int $id) {
        $rememberToken = $request->header("Authorization", null);

        if($rememberToken == null) {
            return response()->json([
                "status" => 403
            ], 403);
        }

        $loggedUser = User::where("remember_token", "=", $rememberToken)->first();

        if($loggedUser == null) {
            return response()->json([
                "status" => 403
            ], 403);
        }

        $device = Device::select()->where("user_id", "=", $loggedUser->id)->where("id", "=", $id)->first();

        return response()->json([
            "device" => $device,
            "status" => 200
        ], 200);
    }

    function updateDevice(Request $request, int $id) {
        $rememberToken = $request->header("Authorization", null);

        if($rememberToken == null) {
            return response()->json([
                "status" => 403
            ], 403);
        }

        $loggedUser = User::where("remember_token", "=", $rememberToken)->first();

        if($loggedUser == null) {
            return response()->json([
                "status" => 403
            ], 403);
        }

        $consumption_per_hour = $request->input("consumptionPerHour", null);
        $hours_per_day = $request->input("hoursPerDay", null);
        $brand = $request->input("brand", null);
        $name = $request->input("name", null);

        if($consumption_per_hour == null || $hours_per_day == null || $brand == null || $name == null) {
            return response()->json([
                "status"=> 400
            ], 400);
        }

        $device = Device::select()->where("user_id", "=", $loggedUser->id)->where("id", "=", $id)->first();

        $device->consumption_per_hour = $consumption_per_hour ?? $device->consumption_per_hour;
        $device->hours_per_day = $hours_per_day ?? $device->hours_per_day;
        $device->brand = $brand ?? $device->brand;
        $device->name = $name ?? $device->name;

        $device->save();

        return response()->json([
            "device" => $device,
            "status" => 200
        ], 200);
    }
}
