<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    // 게시글 리소스를 배열로 변환
    public function toArray(Request $request): array
    {
        //return parent::toArray($request);
        return [
            'title' => $this->title, //게시글 제목
            'content' => $this->content, //게시글 내용
            '작성자' => $this->user->name ?? '알 수 없음', //관계된 사용자
            '작성일' => $this->create_at?->toDateTimeString() ?? '없음' //작성일 포맷
        ];
    }
}
