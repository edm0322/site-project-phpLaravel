<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
// MassAssignment 허용 -> tinker에 여러줄 명령어를 동시에 하기 위한 라이브러리
use Illuminate\Database\Eloquent\Factories\HasFactory;

use App\Models\User; // RelationShip Configuration



class Post extends Model
{
    use HasFactory;

    // massAssignment 허용 필드 정의
    protected $fillable = [
        'user_id',
        'title',
        'content'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
        // 게시글 작성 시 유저가 소유하도록
    }
}
