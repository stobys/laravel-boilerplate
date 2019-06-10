<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePermissionGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $config = config('permission.table_names');

        Schema::create($config['permissions'] .'_groups', function (Blueprint $table) {
            $table -> increments('id');
            $table -> string('code') -> unique();
            $table -> integer('position') -> nullable() -> unsigned() -> index();
            $table -> dateTime('created_at') -> nullable();
            $table -> dateTime('updated_at') -> nullable() -> useCurrent();
            $table -> dateTime('deleted_at') -> nullable();
        });

        Schema::table($config['permissions'], function (Blueprint $table) {
            $config = config('permission.table_names');

            $table -> integer('group_id') -> nullable() -> unsigned() -> after('id');

            $table -> foreign('group_id')
               -> references('id')
               -> on($config['permissions'] .'_groups')
               -> onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $config = config('permission.table_names');

        Schema::table($config['permissions'], function (Blueprint $table) {
            $table->dropColumn('group_id');
        });

        Schema::drop($config['permissions'] .'_groups');
    }
}
