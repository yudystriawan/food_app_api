<?php

use App\Models\Food;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFoodTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('food', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->softDeletes();

            $table->string('name');
            $table->text('description');
            $table->text('ingredients');
            $table->integer('price')->unsigned();
            $table->double('rate')->unsigned();
            $table->string('status')->default(Food::UNAVAILABLE);
            $table->string('image');

            $table->bigInteger('resto_id')->unsigned();
            $table->foreign('resto_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('food');
    }
}
