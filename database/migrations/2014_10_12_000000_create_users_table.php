<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->id();
            $table->string('name');
            $table->string('address')->nullable();
            $table->string('language')->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('photo_name')->nullable();
            $table->string('photo_original_name')->nullable();
            $table->string('photo_size')->nullable();
            $table->string('photo_extention')->nullable();
            $table->string('attachment_name')->nullable();
            $table->string('attachment_original_name')->nullable();
            $table->string('attachment_size')->nullable();
            $table->string('attachment_extention')->nullable();
            $table->integer('division')->nullable()->comment = 'PK = division.id';
            $table->integer('district')->nullable()->comment = 'PK = district.id';
            $table->integer('upazila')->nullable()->comment = 'PK = upazila.id';
            $table->integer('is_training')->default(0);
            $table->tinyInteger('is_admin')->default('0')->comment = '1=Yes, 0=No';
            $table->rememberToken();
            $table->timestamps();
        });

        DB::table('users')->insert(
            array('id'=> 1, 'name'=> 'Admin', 'email'=> 'admin@gmail.com', 'email_verified_at'=> null, 'password'=> '$2y$10$bLp6tNqD5pFa78OnLPW1rua9wzGU8njGjjFVE9IyqTIth213pvMJK', 'is_admin' => 1, 'photo_name' => null, 'photo_original_name' => null, 'photo_size' => null, 'photo_extention' =>null, 'attachment_name' => null, 'attachment_original_name' => null, 'attachment_size' => null, 'attachment_extention' =>null, 'division' => null, 'district' => null, 'upazila' => null, 'is_training' => 0, 'remember_token'=> null, 'created_at'=> '2020-10-14 17:38:27', 'updated_at'=> '2020-10-14 17:38:27')
        );
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
