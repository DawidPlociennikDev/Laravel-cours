<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Tables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->engine = 'InnoDB';
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_unicode_ci';
        });
        Schema::create('authors', function (Blueprint $table) {
            $table->id();
            $table->engine = 'InnoDB';
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_unicode_ci';
        });
        Schema::table('authors', function (Blueprint $table) {
            $table->string('names');
            $table->string('lastname');
        });
        Schema::table('books', function (Blueprint $table) {
            $table->string('description');
            $table->date('publication');
            $table->bigInteger('rentals_counter');
            $table->decimal('price', 8, 2);
            $table->foreignId('author_id')->references('id')->on('authors')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('books');
        Schema::dropIfExists('authors');
    }
}
