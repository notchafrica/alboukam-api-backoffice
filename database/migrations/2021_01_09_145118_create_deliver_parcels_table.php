<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDeliverParcelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('deliver_parcels', function (Blueprint $table) {
            $table->id();
            $table->foreignId('deliver_id')->nullable()->constrained();
            $table->foreignId('parcel_id')->nullable()->constrained();
            $table->dateTime('piked_at')->nullable();
            $table->dateTime('delivered_at')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('deliver_parcels');
    }
}
