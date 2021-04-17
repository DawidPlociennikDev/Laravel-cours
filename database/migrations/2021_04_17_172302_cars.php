<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Cars extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Schema::create('cars2', function (Blueprint $table) {
        //     $table->id();
        //     $table->timestamps();
        //     $table->engine = 'InnoDB';
        //     $table->charset = 'utf8mb4';
        //     $table->collation = 'utf8mb4_unicode_ci';
        // });

        // if (Schema::hasTable('cars2')) {
        //     Schema::rename('cars2', 'cars');
        // }

        // if (!Schema::hasColumn('cars', 'email')) {
        //     Schema::table('cars', function (Blueprint $table) {
        //         $table->string('email');
        //     });
        // }

        // Schema::table('cars', function (Blueprint $table) {
        //     $table->string('description');
        //     $table->string('counter');
        //     $table->boolean('lpg');
        //     $table->char('name', 100)->default('samochód Janusza')->comment('nazwa samochodu Janusza');
        //     $table->date('purchased_on');
        //     $table->string('infos')->nullable()->storedAs('concat(`description`,`counter`)')->afrter('id');
        //     $table->integer('liczba');
        // });

        // Schema::table('cars', function (Blueprint $table) {
        //     $table->integer('liczba')->unsigned()->unique()->change();
        //     $table->renameColumn('purchased_on', 'pur_on');
        //     $table->string('name', 100)->first()->change();
        //     $table->dropColumn('lpg');
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cars');
        Schema::dropIfExists('cars2');
    }
}
