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
    public function up()
    {
        Schema::create('funcionarios', function (Blueprint $table) {
            $table->id();
            $table->string("nome");
            $table->date("dataNasc")->nullable();;
            $table->string("telefone")->nullable();
            $table->string("email")->nullable();

            $table->unsignedBigInteger("departamento_id")->nullable();
            $table->foreign("departamento_id")
                            ->references("id")
                            ->on("departamentos")
                            ->onUpdate('cascade')
                            ->onDelete("cascade")
                            ->nullable();

            $table->unsignedBigInteger("empresa_id")->nullable();
            $table->foreign("empresa_id")
                            ->references("id")
                            ->on("empresas")
                            ->onUpdate('cascade')
                            ->onDelete("cascade")
                            ->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('funcionarios');
    }
};
