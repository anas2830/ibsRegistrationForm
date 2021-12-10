<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDistrictTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('district', function (Blueprint $table) {
            $table->id();
            $table->integer('division_id');
            $table->string('district_name');
            $table->timestamps();
        });

        DB::table('district')->insert(array(
            array(
                'id'=> 1, 
                'division_id'=> 1, 
                'district_name'=> 'Narayangonj', 
                'created_at'=> '2020-10-14 17:38:27', 
                'updated_at'=> '2020-10-14 17:38:27'
            ),
            array(
                'id'=> 2, 
                'division_id'=> 1, 
                'district_name'=> 'Gazipur', 
                'created_at'=> '2020-10-14 17:38:27', 
                'updated_at'=> '2020-10-14 17:38:27'
            ),
            array(
                'id'=> 3, 
                'division_id'=> 2, 
                'district_name'=> 'Feni', 
                'created_at'=> '2020-10-14 17:38:27', 
                'updated_at'=> '2020-10-14 17:38:27'
            ),
            array(
                'id'=> 4, 
                'division_id'=> 2, 
                'district_name'=> 'Comilla', 
                'created_at'=> '2020-10-14 17:38:27', 
                'updated_at'=> '2020-10-14 17:38:27'
            ),
        ));
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('district');
    }
}
