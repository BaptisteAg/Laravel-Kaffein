<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */

    // Create the database companies_details
    public function up()
    {
        Schema::create('companies_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('companies_id')->default(1)->constrained('companies');
            $table->string('website');
            $table->string('phone');
            $table->string('zipcode');
            $table->integer('nbemployees');
            $table->bigInteger('netsales');
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
        Schema::dropIfExists('companies_details');
    }
};
