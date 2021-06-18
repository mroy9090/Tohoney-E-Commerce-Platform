<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCartordersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cartorders', function (Blueprint $table) {
            $table->id();
            $table->string('client_name');
            $table->string('client_email');
            $table->char('client_phone');
            $table->integer('client_country_name');
            $table->integer('client_city');
            $table->text('billing_address');
            $table->integer('billing_post_code');
            $table->text('massage');
            $table->float('subtotal');
            $table->integer('discount');
            $table->float('total');
            $table->integer('payment_option')->comment('1=credit card,2=cash on delivary');
            $table->integer('payment_status')->comment('1=pending,2=done');
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
        Schema::dropIfExists('cartorders');
    }
}
