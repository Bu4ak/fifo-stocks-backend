<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateEntriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'entries',
            function (Blueprint $table) {
                $table->uuid('id')->primary();
                $table->float('amount')->nullable(false);
                $table->integer('count')->default(1);

                $table->uuid('stock_id')->nullable(false);
                $table->foreign('stock_id')->references('id')->on('stocks');
                $table->timestamps();
            }
        );
        DB::statement('alter table entries alter column id set default uuid_generate_v4();');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public
    function down()
    {
        Schema::dropIfExists('entries');
    }
}
