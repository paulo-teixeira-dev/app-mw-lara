<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {

        if (!Schema::hasTable('users')) {
            Schema::create('users', function (Blueprint $table) {
                //ESTRUTURA TABELA
                $table->engine = 'InnoDB';
                $table->charset = 'utf8mb4';
                $table->collation = 'utf8mb4_general_ci';

                //COLUNAS
                $table->id();
                $table->string('nome', 100);
                $table->string('sobrenome', 100);
                $table->string('email')->unique();
                $table->string('password');
                $table->rememberToken();
                $table->timestamps();
            });
        }

        if (!Schema::hasTable('produtos')) {
            Schema::create('produtos', function (Blueprint $table) {
                //ESTRUTURA TABELA
                $table->engine = 'InnoDB';
                $table->charset = 'utf8mb4';
                $table->collation = 'utf8mb4_general_ci';

                //COLUNAS
                $table->id();
                $table->string('nome', 100);
                $table->integer('preco');
                $table->integer('estoque');
                $table->timestamps();
            });
        }

        if (!Schema::hasTable('pedidos')) {
            Schema::create('pedidos', function (Blueprint $table) {
                //ESTRUTURA TABELA
                $table->engine = 'InnoDB';
                $table->charset = 'utf8mb4';
                $table->collation = 'utf8mb4_general_ci';

                //COLUNAS
                $table->id();
                $table->unsignedBigInteger('user_id');
                $table->boolean('status');
                $table->timestamps();
            });
        }

        if (!Schema::hasTable('pedido_produto')) {
            Schema::create('pedido_produto', function (Blueprint $table) {
                //ESTRUTURA TABELA
                $table->engine = 'InnoDB';
                $table->charset = 'utf8mb4';
                $table->collation = 'utf8mb4_general_ci';

                //COLUNAS
                $table->id();
                $table->unsignedSmallInteger('pedido_id');
                $table->unsignedSmallInteger('produto_id');
                $table->integer('quantidade');
            });
        }
    }

    public function down()
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('produtos');
        Schema::dropIfExists('pedidos');
        Schema::dropIfExists('pedido_produto');
    }
};
