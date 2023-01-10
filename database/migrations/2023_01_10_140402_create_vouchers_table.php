<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVouchersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vouchers', function (Blueprint $table) {
            Schema::create('vouchers', function (Blueprint $table) {
                $table->id();
                $table->foreignId('prize_id');
                $table->string('phone', 10);
                $table->string('code', 10);
                $table->float('discount_amount', 10, 2);
                $table->timestamp('expired_at');
                $table->timestamp('used_at')->nullable();
                $table->timestamps();
                $table->softDeletes();
            });
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vouchers');
    }
}
