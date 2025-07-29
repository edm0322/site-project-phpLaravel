<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    // 사용자 리소스를 배열로 변환 (프론트로 나가는 데이터 형식 정의)
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id, // 사용자 ID
            'name' => $this->name, // 이름
            'email' => $this->email, // 이메일주소
            'create_at' => $this->created_at->toDateTimeString() //생성일

        ];
    }
}
