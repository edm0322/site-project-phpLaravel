<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User; //여기에 어떤 모델을 사용해야하는지 입력해야한다

class UserController extends Controller
{

    public function index()
    {
        /*
        // 사용자 정보를 DB에서 가져와 JSON 형식으로 응답
        return response()->json(User::all());
        */
        // 사용자 리스트를 Resource로 포장해서 반환
        return UserResource::collection(User::all());
    }

    public function show($id)
    {
        /*
        // 전달받은 ID로 사용자 정보를 찾고, 없으면 404
        return response()->json(User::findorFail($id));
        */
        $user = User::findOrFail($id);
        return new UserResource($user);
    }

    public function store(StoreUserRequest $request)
    {
        // 유효성 검사를 위 네임스페이스에서 진행
        $validated = $request->validated();

        // 비밀번호 암호화
        $validated['password'] = bcrypt($validated[
        'password']);

        $user = User::create($validated);

        // 생성된 사용자 응답 포맷도 통일
        return new UserResource($user);

        // 사용자 생성
        //return response()->json(User::create($validated));
        /*
        $validate = $request->validate([
            'name' => 'required', //이름
            'email' => 'required|mail', //이메일
            'password' => 'required' // 비밀번호
        ]);

        //비밀번호 bcrypt 해시 함수로 암호화
        $validate['password'] = bcrypt($validate['password']);

        return response()->json(User::create($validated));
        */
    }

    public function update(UpdateUserRequest $request, $id)
    {
        // ID로 사용자 조회 (없으면 404 리턴)
        $user = User::findorFail($id);

        // 유효성 검사
        $validated = $request->validated();

        /*
        // 유효성 검사 (필드가 있는 경우만 검사)
        $validated = $request->vaildate([
            'name' => 'sometimes|required', // name이 있으면 필수
            'email' => 'sometimes|required|mail', //email이 있으면 필수
            'password' => 'sometimes|required', //password가 있으면 필수
        ]);
        */

        // 비밀번호가 있으면 암호화
        if(isset($validated['password'])) {
            $validated['password'] = bcrypt($validated['password']);
        }

        // 사용자 정보 업데이트
        $user->update($validated);

        // 수정된 사용자 정보 변환
        return response()->json($user);
    }

    public function destroy($id)
    {
        // 사용자 조회 (없으면 예외)
        $user = User::findOrFail($id);

        // 사용자 삭제
        $user->delete();

        // 성공 메시지 변환
        return response()->json(['message' => '사용자가 삭제되었습니다'], 200, ['Content-Type' => 'application/json; charset=UTF-8']);
    }
}
