<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Post;
use App\Models\User;

class PostController extends Controller
{
    // 특정 사용자의 글 목록을 JSON으로 변환
    public function indexByUser($userId)
    {
        $user = User::findOrFail($userId); //사용자 조회
        $posts = $user->posts; // 관계를 통해 게시글 조회

        return response()->json($posts);
    }
}
