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
        Schema::table('posts', function (Blueprint $table) {
            
            $table->string('title_slug')->nullable()->unique();
        });

    // $posts = \App\Models\Post::all();

    // foreach ($posts as $post) {
    //     $post->title_slug = \Illuminate\Support\Str::slug($post->title);
    //     $post->save();
    // }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('posts', function (Blueprint $table) {

            $table->dropColumn('title_slug');
        });
    }
};
