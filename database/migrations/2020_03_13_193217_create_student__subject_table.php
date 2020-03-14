<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentSubjectTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student__subject', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger( 'student_id' )->nullable()->default( NULL );
            $table->unsignedBigInteger( 'subject_id' )->nullable()->default( NULL );

            $table->foreign( 'student_id' )->references( 'id' )->on( 'students' )->onDelete( 'cascade' );
            $table->foreign( 'subject_id' )->references( 'id' )->on( 'subjects' )->onDelete( 'cascade' );
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
        Schema::dropIfExists('student__subject');
    }
}
