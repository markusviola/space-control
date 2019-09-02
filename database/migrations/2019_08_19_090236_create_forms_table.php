<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFormsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('forms', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('user_id')->default(0);
            $table->unsignedInteger('type_id');
            $table->string('name');
            $table->string('furigana');
            $table->boolean('gender');
            $table->date('birthday');
            $table->string('address');
            $table->string('phone');
            $table->string('email');
            $table->boolean('will_stay');
            $table->longText('reason');
            $table->integer('user_count')->default(1);
            $table->boolean('is_approved')->default(false);
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
        Schema::dropIfExists('forms');
    }
}
