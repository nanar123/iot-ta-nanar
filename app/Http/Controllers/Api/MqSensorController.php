<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\MqSensor;
use Illuminate\Http\Request;

class MqSensorController extends Controller
{
    function index()
    {
        $sensorsData = MqSensor::orderBy('created_at', 'desc')
            ->limit(20)
            ->get();

        return response()
            ->json($sensorsData, 200);
    }

    function show($id)
    {
        $sensorsData = MqSensor::find($id);
        if ($sensorsData) {
            return response()
                ->json($sensorsData, 200);
        } else {
            return response()
                ->json(['message' => 'Data not found'], 404);
        }
    }

    function store(Request $request)
    {
        $request->validate([
            'value' => [
                'required',
                'numeric',
            ]
        ]);

        $sensorsData = MqSensor::create($request->all());
        return response()
            ->json($sensorsData, 201);
    }
}
