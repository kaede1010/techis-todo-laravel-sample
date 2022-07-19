@extends('layouts.app')

@section('content')

<!-- タスク登録用パネル… -->
<div class="panel-body">
    <!-- バリデーションエラーの表示 -->
    @include('common.errors')

    <!-- フラッシュメッセージ 登録の場合 -->
    @if (session('flash_register_message'))
    <div class="flash_message bg-success text-center py-3 mb-3">
        <p class="text-white m-0">{{ session('flash_register_message') }}</p>
    </div>
    @endif

    <!-- フラッシュメッセージ 削除の場合 -->
    @if (session('flash_delete_message'))
    <div class="flash_message bg-danger text-center py-3 mb-3">
        <p class="text-white m-0">{{ session('flash_delete_message') }}</p>
    </div>
    @endif

    <!-- 新タスクフォーム -->
    <form action="{{ url('task') }}" method="POST" class="form-horizontal">
        {{ csrf_field() }}

        <!-- タスク名 -->
        <div class="form-group">
            <label for="task-name" class="col-sm-3 control-label">Task入力欄</label>

            <div class="col-sm-6">
                <input type="text" name="name" id="task-name" class="form-control" placeholder="Taskを入力してください（50文字以内）" maxlength="50" required>
            </div>
        </div>

        <!-- タスク追加ボタン -->
        <div class="form-group">
            <div class="col-sm-offset-3 col-sm-6">
                <button type="submit" class="btn btn-danger">
                    <i class="fa fa-plus"></i> Task追加
                </button>
            </div>
        </div>
    </form>
</div>

<!-- タスク一覧表示 -->
@if (count($tasks) > 0)
<div class="panel panel-default">
    <div class="panel-heading">
        現在のTask内容
    </div>

    <div class="panel-body">
        <table class="table table-striped task-table">

            <!-- テーブルヘッダ -->
            <thead>
                <th>Task一覧</th>
                <th>&nbsp;</th>
            </thead>

            <!-- テーブル本体 -->
            <tbody>
                @foreach ($tasks as $task)
                <tr>
                    <!-- タスク名 -->
                    <td class="table-text">
                        <div>{{ $task->name }}</div>
                    </td>

                    <td>
                        <!-- 削除ボタン -->
                        <form action="{{ url('task/'.$task->id) }}" method="POST">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}

                            <button type="submit" id="delete-task-{{ $task->id }}" class="btn btn-danger">
                                <i class="fa fa-btn fa-trash"></i>削除
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endif
@endsection