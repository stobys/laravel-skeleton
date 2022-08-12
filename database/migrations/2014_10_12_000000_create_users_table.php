<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    // -- Run the migrations.
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table -> id();
            $table -> foreignId('personal_no') -> nullable() -> description('numer personalny');
            $table -> foreignId('manager_id') -> nullable();
            $table -> string('username') -> unique();
            $table -> string('family_name')->nullable();
            $table -> string('given_name')->nullable();
            $table -> string('email')->nullable();
            $table -> timestamp('email_verified_at')->nullable();
            $table -> string('title')->nullable();
            $table -> string('mobile')->nullable();
            $table -> string('avatar')->nullable();
            $table -> string('password')->nullable();
            $table -> unsignedInteger('logins') -> default(0) -> comment('ilosc poprawnych logowac usera');
            $table -> rememberToken();
            $table -> timestamp('last_login_at') -> nullable();
            $table -> timestamp('last_seen_at') -> nullable();
            $table -> timestamps();
            $table -> softDeletes();
        });
    }

    // -- Reverse the migrations.
    public function down()
    {
        // -- We're not reversing any migrations.
    }
};
