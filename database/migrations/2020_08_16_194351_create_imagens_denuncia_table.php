<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImagensDenunciaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('imagens_denuncia', function (Blueprint $table) {
            $table->id();
            $table->string('nome');

            $table->bigInteger("denuncias_id");
            $table->foreign("denuncias_id")->references("id")->on("denuncias");
            
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
        Schema::dropIfExists('imagens_denuncia');
    }
}
