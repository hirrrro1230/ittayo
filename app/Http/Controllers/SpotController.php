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
        $spot = Spot::create([
            'user_id' => $request->user_id,
            'spot_name' => $request->spot_name,
            'zip_code' => $request->zip_code,
            'address' => $request->address,
            'memo' => $request->memo
        ]);

        return redirect(RouteServiceProvider::HOME);
    }

    public function index() {
        // DBからログインしているユーザーのスポットを取得
        $spots = Spot::where('user_id', auth()->id())->get();
        // ダッシュボードに一覧表示させる
        return view('dashboard', compact('spots'));
    }

    public function update(Request $request, Spot $spot)
    {
        $request->validate([
            'spot_name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'memo' => 'nullable|string',
            'zip_code' => 'nullable|string|max:10',
        ]);

        $spot->update($request->all());

        return redirect()->route('dashboard')->with('success', 'スポット情報を更新しました。');
    } 
}
