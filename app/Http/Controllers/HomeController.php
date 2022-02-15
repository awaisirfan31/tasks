<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Task;
use Carbon\Carbon;
use Stevebauman\Location\Facades\Location;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
  

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $curl_handle = curl_init();

        $url = "http://ip-api.com/json/".\request()->ip();
        curl_setopt($curl_handle, CURLOPT_URL, $url);
        curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, true);
        $curl_data = curl_exec($curl_handle);
        curl_close($curl_handle);
        $ipInfo = json_decode($curl_data);
        $data = Task::all();
        return view('welcome',compact('data','ipInfo'));
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [ // <---
            'name' => 'required|max:255',
            'datetime' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()],422);
        }
     
        else
        {
            $tasks = new Task();           
            $tasks->name = $request->name;
            $tasks->datetime = Carbon::parse($request->datetime)->format('Y-m-d H:i:s');
            $tasks->save();
            return response()->json(['success'=>'Data has been saved successfully']);
        }

    }
   
}
