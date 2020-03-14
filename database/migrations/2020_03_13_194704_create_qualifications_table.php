<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQualificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('qualifications', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger( 'studentsubject_id' )->nullable()->default( NULL );
            $table->unsignedBigInteger( 'type_id' )->nullable()->default( NULL );
            $table->date('date')->nullable()->default(NULL);
            $table->float('note')->nullable()->default(NULL);

            $table->foreign( 'studentsubject_id' )->references( 'id' )->on( 'student__subject' )->onDelete( 'cascade' );
            $table->foreign( 'type_id' )->references( 'id' )->on( 'type_qualifications' )->onDelete( 'set null' );
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
        Schema::dropIfExists('qualifications');
    }
}
