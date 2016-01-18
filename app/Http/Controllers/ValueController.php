<?php

namespace App\Http\Controllers;

use App\Device;
use App\Value;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class ValueController extends Controller
{
    public function store($MAC,$temp,$humi)
    {
        $device = Device::where('MAC',$MAC)->first();
        if(!$device)
        {
            $device = new Device();
            $device->MAC = $MAC;
            $device->Name = 'new Device';
            $device->save();
        }
        $value = new Value();
        $value->temperature = $temp;
        $value->humidity = $humi;
        $value->did = $device->id;
        $value->save();

        return $device->with('values')->get();
    }
}
