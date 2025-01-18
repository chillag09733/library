<?php

use App\Models\Book;
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
        Schema::create('books', function (Blueprint $table) {
            $table->id('book_id');
            $table->string('author');
            $table->string('title');
            $table->integer('pieces')->default(100);
            $table->timestamps();
        });

        Book::create([
            'author' => 'Nádas Péter', 
            'title' => 'Rémtörténetek'
        ]);

        Book::create([
            'author' => 'Olga Tokarczuk', 
            'title' => 'Nyughatatlanok',
            'pieces' => 200
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
