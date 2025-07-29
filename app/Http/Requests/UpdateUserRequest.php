<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    // 인증된 사용자만 허용할지 여부
    public function authorize(): bool
    {
        return true; // true일 경우 모두 혀용
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    // 유호성 검사 규칙 정의
    public function rules(): array
    {
        // 값이 있을 경우에만 검사. (PUT / PATCH )
        return [
            'name' => 'sometimes|required',
            'email' => 'sometimes|required|email',
            'password' => 'sometimes|required'
        ];
    }
}
