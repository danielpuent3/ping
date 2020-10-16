<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWorkspacesTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'workspaces',
            function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->unsignedBigInteger('creator_id');
                $table->timestamps();

                $table->foreign('creator_id')->references('id')->on('users');
            }
        );

        Schema::table('users', function (Blueprint $table) {
            $table->unsignedBigInteger('current_workspace_id')->after('password')->nullable();

            $table->foreign('current_workspace_id')->references('id')->on('workspaces');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('workspaces');
    }
}
