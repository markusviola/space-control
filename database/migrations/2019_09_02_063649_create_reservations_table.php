<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReservationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('form_id');
            $table->unsignedInteger('status_id')->default(1);
            $table->unsignedInteger('discovery_id')->default(1);
            $table->boolean('is_independent')->default(true);
            $table->string('corporate_name')->nullable();
            $table->datetime('visit_date')->nullable();
            $table->string('visit_place')->nullable();
            $table->boolean('will_noise')->default(false);
            $table->string('remarks')->nullable();
            $table->string('cancel_reason')->nullable();
            $table->integer('actual_hours')->nullable();
            $table->double('payment_cost', 8, 2)->default(0.00);
            $table->double('discounted_cost', 8, 2)->default(0.00);
            $table->boolean('invoice')->default(false);
            $table->date('paydate')->nullable();
            $table->date('actual_paydate')->nullable();
            $table->timestamps();
            $table->charset = 'utf8';
            $table->collation = 'utf8_bin';
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reservations');
    }
}
