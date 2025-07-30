<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    // 유효성 검사 규칙 정의
    public function rules(): array
    {
        return [
            'user_id' => 'required|exists:users,id', //존재하는 사용자 ID
            'title' => 'required|string|max:255', // 필수/문자열/255자까지
            'content' => 'required|string' //필수 / 문자열
        ];
    }
}
