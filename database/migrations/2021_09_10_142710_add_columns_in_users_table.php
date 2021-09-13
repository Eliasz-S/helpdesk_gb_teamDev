<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsInUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('first_name',191)->nullable();
            $table->string('last_name',191)->nullable();
            $table->longText('profile_image')->nullable();
            $table->boolean('is_enabled')->default(false);
            $table->foreignId('user_role_id')->nullable()->constrained('user_roles');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(
                'first_name'
                , 'last_name'
                , 'profile_image'
                , 'is_enabled'
                , 'user_role_id'
            );
        });
    }
}
