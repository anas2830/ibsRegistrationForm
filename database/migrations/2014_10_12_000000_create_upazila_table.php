<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUpazilaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('upazila', function (Blueprint $table) {
            $table->id();
            $table->integer('district_id');
            $table->string('upazila_name');
            $table->timestamps();
        });

        DB::table('upazila')->insert(array(
            array(
                'id'=> 1, 
                'district_id'=> 1, 
                'upazila_name'=> ' Bandar Upazila', 
                'created_at'=> '2020-10-14 17:38:27', 
                'updated_at'=> '2020-10-14 17:38:27'
            ),
            array(
                'id'=> 2, 
                'district_id'=> 1, 
                'upazila_name'=> 'Rupganj Upazila', 
                'created_at'=> '2020-10-14 17:38:27', 
                'updated_at'=> '2020-10-14 17:38:27'
            ),
            array(
                'id'=> 3, 
                'district_id'=> 2, 
                'upazila_name'=> 'Tongi town', 
                'created_at'=> '2020-10-14 17:38:27', 
                'updated_at'=> '2020-10-14 17:38:27'
            ),
            array(
                'id'=> 4, 
                'district_id'=> 2, 
                'upazila_name'=> 'Sripur Upazila', 
                'created_at'=> '2020-10-14 17:38:27', 
                'updated_at'=> '2020-10-14 17:38:27'
            ),
            array(
                'id'=> 5, 
                'district_id'=> 3, 
                'upazila_name'=> 'Sonagazi', 
                'created_at'=> '2020-10-14 17:38:27', 
                'updated_at'=> '2020-10-14 17:38:27'
            ),
            array(
                'id'=> 6, 
                'district_id'=> 3, 
                'upazila_name'=> 'Dagonbhuiyan', 
                'created_at'=> '2020-10-14 17:38:27', 
                'updated_at'=> '2020-10-14 17:38:27'
            ),
            array(
                'id'=> 7, 
                'district_id'=> 4, 
                'upazila_name'=> 'Laksham', 
                'created_at'=> '2020-10-14 17:38:27', 
                'updated_at'=> '2020-10-14 17:38:27'
            ),
            array(
                'id'=> 8, 
                'district_id'=> 4, 
                'upazila_name'=> 'Nangalkot', 
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
        Schema::dropIfExists('upazila');
    }
}
