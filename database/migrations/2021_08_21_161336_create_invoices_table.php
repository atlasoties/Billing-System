<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
           $table->increments('id');
            $table->string('name');
            $table->string('invoice_number');
            $table->date('invoice_date');
            $table->date('due_date');         
       
            $table->string('email')->nullable();
            $table->string('companyName')->nullable();
            $table->string('tinNo')->nullable();
            $table->string('address')->nullable();
            $table->string('phone')->nullable(); 
            $table->string('status')->nullable();
            $table->integer('status_value')->nullable();
            $table->float('subtotal',8,2);
            $table->float('paid',8,2);
            $table->float('remaining',8,2);
            $table->float('total',8,2);
            $table->float('credit',8,2)->nullable();
            $table->float('incVat',8,2);
            $table->float('vat',8,2);
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
        Schema::dropIfExists('invoices');
    }
}
