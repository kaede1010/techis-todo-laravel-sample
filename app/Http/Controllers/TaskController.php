<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Task;

use App\Repositories\TaskRepository;

class TaskController extends Controller
{
    /**
     * タスクリポジトリ
     * 
     * @var TaskRepository
     */
    protected $tasks;
    
    /**
     * コンストラクタ (自動的に呼び出される初期化処理用のメソッド)
     * 
     * @return void
     */

    //  認証機能をTaskControllerで有効にする
    public function __construct(TaskRepository $tasks)
    {
        $this->middleware('auth');

        $this->tasks = $tasks;
    }
    
    /**
     * タスク一覧
     * 
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        // Task::とget()でDBからTask一覧の取得を行っている
        // $tasks = Task::orderBy('created_at', 'asc')->get();

        // $request->user()で認証済みのユーザーを取得し,tasks()->get()でそのユーザーが保持するタスク一覧を取得する
        // $tasks = $request->user()->tasks()->get();

        // view()の引数のtasks.indexはtasksフォルダのindexというビューを使用するという意味
        return view('tasks.index', [
            'tasks' => $this->tasks->forUser($request->user()),
        ]);
    }

    /**
     * タスク登録
     * 
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        // validate()はパラメータが有効かどうかのバリデーション(入力チェック)をしている
        $this->validate($request, [          // $requestは入力データ
            'name' => 'required|max:50',   // nameパラメータはrequired(入力必須)でmax:50(文字数は50以下)であるというルール
        ]);

        // タスク作成
        // Task::create([
        //     'user_id' => 0,
        //     'name' => $request->name
        // ]);
        $request->user()->tasks()->create([
            'name' => $request->name,
        ]);

        return redirect('/tasks')->with('flash_register_message', 'Taskが追加されました !');
    }

    /**
     * タスク削除
     * 
     * @param Request $request
     * @param Task $task
     * @return Response
     */
    public function destroy(Request $request, Task $task)
    {
        // ユーザー自身のタスクしか削除できなくなる
        // ユーザーごとにタスク管理が可能になる
        $this->authorize('destroy', $task);

        $task->delete();
        return redirect('/tasks')->with('flash_delete_message', 'Taskが削除されました !');
    }
}
