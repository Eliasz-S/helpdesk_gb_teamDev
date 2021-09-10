<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->string('source',191);   //'откуда поступила заявка'
            $table->string('subject',191);
            $table->foreignId('status_id')->constrained('ticket_status');
            $table->foreignId('priority_id')->constrained('ticket_priority');
            $table->foreignId('type_id');
            $table->foreignId('customer_id')->constrained('users');   //пользователь, от чьего имени поступила заявка
            $table->foreignId('staff_id')->constrained('users')->nullable();   //пользователь поддержки
            $table->foreignId('team_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tickets');
    }
}
