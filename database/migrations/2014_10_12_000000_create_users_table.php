<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table -> increments('id');
            $table -> string('username') -> unique();
            $table -> string('password') -> nullable();

            $table -> string('last_name') -> default('');
            $table -> string('first_name') -> default('');
            $table -> string('email') -> unique() -> nullable();

            $table -> boolean('must_change_password_at_logon') -> default(0);
            $table -> boolean('is_acct_registered') -> default(0);
            $table -> boolean('is_acct_confirmed') -> default(0);

            $table -> rememberToken();

            $table -> integer('logins') -> default(0);
            $table -> dateTime('last_login_at') -> nullable();

            $table -> dateTime('created_at') -> nullable();
            $table -> dateTime('updated_at') -> nullable() -> useCurrent();
            $table -> dateTime('deleted_at') -> nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
