<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {

        /**eletrodomesticos**/
        if (!Schema::hasTable('eletrodomesticos')) {
            Schema::create('eletrodomesticos', function (Blueprint $table) {
                //ESTRUTURA TABELA
                $table->engine = 'InnoDB';
                $table->charset = 'utf8mb4';
                $table->collation = 'utf8mb4_general_ci';

                //COLUNAS
                $table->id();
                $table->string('nome', 100);
                $table->text('descricao');
                $table->integer('tensao');
                $table->unsignedBigInteger('marca_id', false);
            });
        }

        /**marcas**/
        if (!Schema::hasTable('marcas')) {
            Schema::create('marcas', function (Blueprint $table) {
                //ESTRUTURA TABELA
                $table->engine = 'InnoDB';
                $table->charset = 'utf8mb4';
                $table->collation = 'utf8mb4_general_ci';

                //COLUNAS
                $table->id();
                $table->string('nome')->unique();
            });
        }
    }

    public function down()
    {
        Schema::dropIfExists('eletrodomesticos');
        Schema::dropIfExists('marcas');
    }
};
