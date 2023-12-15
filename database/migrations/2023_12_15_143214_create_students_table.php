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
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('name',255);
            $table->string('email',255)->unique();
            $table->date('date_birth');
            $table->string('cpf',14)->unique();
            $table->string('contact',20);
            $table->unsignedInteger('user_id');
            $table->string('city',50);
            $table->string('neighborhood',50);
            $table->string('number',30);
            $table->string('street',30);
            $table->string('state',2);
            $table->string('cep',20);

            $table->foreign('user_id')->references('id')->on('users');
            $table->SoftDeletes();
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
