<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePostRequest;
use App\Http\Resources\PostResource;
use Illuminate\Http\Request;

use App\Models\Post;
use App\Models\User;

class PostController extends Controller
{
    /*
    // 특정 사용자의 글 목록을 JSON으로 변환
    public function indexByUser($userId)
    {
        $user = User::findOrFail($userId); //사용자 조회
        $posts = $user->posts; // 관계를 통해 게시글 조회

        return response()->json($posts);
    }
    */
    //20250730 리소스 관리 php를 이용해서 깔끔한 응답을 받도록 하기
    public function indexByUser($userId)
    {
        $user = User::findOrFail($userId);

        //게시글 목록을 사용자 정보와 함께 가져오기
        $posts = $user->posts()->with('user')->get();
        // 관계를 eager load

        return PostResource::collection($posts);
        // Resource 컬렉션으로 포맷팅
    }

    // 저장함수 (store)
    public function store(StorePostRequest $request)
    {
        //유효성 검사 통과 데이터
        $validated = $request->validated();

        //게시글 작성
        $post = Post::create($validated);

        //게시글 조회 (DB 로딩)
        $post = Post::find($post->id);

        //생성한 게시글을 Resource로 포맷
        return new PostResource(($post)->fresh());
    }
}
