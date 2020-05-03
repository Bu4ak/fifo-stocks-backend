<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateStocksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'stocks',
            function (Blueprint $table) {
                $table->uuid('id')->primary();
                $table->string('name')->nullable(false);
                $table->string('ticker')->nullable(true);
                $table->uuid('user_id')->nullable(false);
                $table->foreign('user_id')->references('id')->on('users');
                $table->timestamps();
            }
        );
        DB::statement('ALTER TABLE stocks ALTER COLUMN id SET DEFAULT uuid_generate_v4();');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
