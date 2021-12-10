<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserEducationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('userEducation', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->comment = 'PK = users.id';
            $table->string('exam_name');
            $table->string('university');
            $table->string('board');
            $table->float('result', 10,2)->nullable();
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
        Schema::dropIfExists('userEducation');
    }
}
