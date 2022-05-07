<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    // nameはTask名のカラム
    protected $fillable = ['name'];

    /**
     * タスクを保持するユーザーの取得
     */

    // Taskモデルからユーザーのデータを取得する
    public function user()
    {
        // TaskはUserに所属するという意味でbelongsTo()を使う
        return $this->belongsTo(User::class);
    }
}
