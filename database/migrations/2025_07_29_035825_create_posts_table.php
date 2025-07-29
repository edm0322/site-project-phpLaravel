<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();                           // 기본 PK
            $table->unsignedBigInteger('user_id');  // 작성자 ID
            $table->string('title');                // 게시글 제목
            $table->text('content');                // 게시글 내용
            $table->timestamps();                   // create_at / update_at

            // FK 설정 (사용자 삭제 시 게시글도 삭제됨)
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
