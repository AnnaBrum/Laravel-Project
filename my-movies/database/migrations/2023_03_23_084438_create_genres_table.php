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
        Schema::create('genres', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('genre_title');
        });

        App\Models\Genre::create(['genre_title' => 'comedy']);
        App\Models\Genre::create(['genre_title' => 'action']);
        App\Models\Genre::create(['genre_title' => 'thriller']);
        App\Models\Genre::create(['genre_title' => 'horror']);
        App\Models\Genre::create(['genre_title' => 'romance']);
        App\Models\Genre::create(['genre_title' => 'drama']);
        App\Models\Genre::create(['genre_title' => 'sci-fi']);
        App\Models\Genre::create(['genre_title' => 'adventure']);
        App\Models\Genre::create(['genre_title' => 'other']);


    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('genres');
    }
};
