<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subjects', function (Blueprint $table) {
            $table->id();
            $table->string('name',70)->nullable()->default(NULL);
            $table->text('description')->nullable()->default(NULL);
            $table->unsignedBigInteger( 'teacher_id' )->nullable()->default( NULL );

            $table->foreign( 'teacher_id' )->references( 'id' )->on( 'teachers' )->onDelete( 'set null' );
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
        Schema::dropIfExists('subjects');
    }
}
