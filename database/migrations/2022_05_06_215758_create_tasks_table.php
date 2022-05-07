<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() // upメソッドは新しいテーブル,カラム,インデックスを追加する
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->increments('id'); // tasksテーブルのid
            $table->integer('user_id')->unsigned()->index(); // usersテーブルと紐づくuser_id
            $table->string('name'); // taskの名前
            $table->timestamps(); // 更新日時
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() // downメソッドはupメソッドの操作を元に戻すためのもの
    {
        Schema::dropIfExists('tasks');
    }
}
