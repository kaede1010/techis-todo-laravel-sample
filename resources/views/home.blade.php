@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('ユーザーの履歴') }}</div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    <dl class="list-unstyled">
                        @if($tasks->isEmpty())
                        <p class="font-weight-bold text-center">現在追加されているTaskはありません</p>
                        @endif
                        @foreach($tasks as $task)
                        <dt>{{ $task->created_at }}</dt>
                        <dd class="mb-4">「{{ $task->name }}」が追加されました！</dd>
                        @endforeach
                        <dt>{{ Auth::user()->created_at }}</dt>
                        <dd>{{ Auth::user()->name }}でアカウント登録しました。</dd>
                    </dl>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection