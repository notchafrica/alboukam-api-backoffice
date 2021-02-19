<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateParcelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('parcels', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->string('title')->nullable();
            $table->string('uid')->unique();
            $table->string('weight')->nullable();
            $table->string('height')->nullable();
            $table->string('length')->nullable();
            $table->string('width')->nullable();
            $table->enum('type', ['envelop', 'box', 'documents', 'pallet', 'mixed'])->nullable();
            $table->text('details')->nullable();
            $table->string('from')->nullable();
            $table->string('to')->nullable();
            $table->string('fee')->nullable();
            $table->timestamp('taken_at')->nullable();
            $table->enum('status', ['open', 'confirmed', 'draft'])->default('open');
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
        Schema::dropIfExists('parcels');
    }
}
