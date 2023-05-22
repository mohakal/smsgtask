<?php

use App\Models\SubsciptionType;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMoviesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('movies', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('release_year');
            $table->string('poster_link');
            $table->foreignIdFor(SubsciptionType::class);
            $table->integer("rent_period");
            $table->double("rent_price");
            $table->timestamp('license_start')->nullable();
            $table->timestamp('license_end')->nullable();
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
        Schema::dropIfExists('movies');
    }
}
