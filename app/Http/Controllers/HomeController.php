<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

use App\Models\Task;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // 現在ログインしているユーザーのID取得
        $user_id = Auth::id();

        // tasksテーブルからログインしているユーザーのIDと紐づくデータを取ってくる
        $tasks = Task::where('user_id', '=', $user_id)->orderBy('created_at', 'desc')->get();

        return view('home')->with([
            'tasks' => $tasks,
        ]);
    }
}
