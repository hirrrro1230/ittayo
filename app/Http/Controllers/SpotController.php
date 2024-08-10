<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Spot;
use App\Providers\RouteServiceProvider;

class SpotController extends Controller
{
    // spotの登録
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => ['required', 'int'],
            'spot_name' => ['required', 'string'],
            'zip_code' =>['string'],
            'address' => ['required', 'string'],
            'memo' => ['text']
        ]);

        $spot = Spot::create([
            'user_id' => $request->user_id,
            'spot_name' => $request->spot_name,
            'zip_code' => $request->zip_code,
            'address' => $request->address,
            'memo' => $request->memo
        ]);

        return redirect(RouteServiceProvider::HOME);
    }
}
