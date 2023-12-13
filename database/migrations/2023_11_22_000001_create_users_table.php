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
        Schema::create('users', function (Blueprint $table) {
            $table->unsignedBigInteger('id')->autoIncrement();
            $table->timestamps(); //buat kolom created_at & updated_at	
            $table->string('email')->unique();
            $table->string('password');
            $table->string('username');
            $table->date('dob');
            $table->string('gender');
            $table->string('profilePhoto')->nullable();
            $table->boolean('isAdmin');

            //ketika menggunakan autoIncrement pada field unsignedBigInteger maka otomatis sekalian terset sebagai primary key
            // $table->primary('id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
