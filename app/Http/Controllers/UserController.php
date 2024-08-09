<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Log;

class UserController extends Controller
{
    // 登録画面を表示
    public function create()
    {
        return view('users.create');
    }

    public function store()
    {
        $inputs = \Request::all();
        if ($inputs['password'] === $inputs['password_confirmation']) {
            $inputs['password'] = Hash::make($inputs['password']);
            User::create($inputs);
            return redirect('login');
        } else {
            $passwordError = 'パスワードが一致していません。';
            return redirect('user.create');
        }
        
    }
}
