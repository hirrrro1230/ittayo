<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    // 登録画面を表示
    public function create()
    {
        return view('users.create');
    }
}
