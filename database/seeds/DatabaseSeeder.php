<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0;');

        DB::table('type_qualifications')->truncate();
        DB::table('persons')->truncate();
        DB::table('students')->truncate();
        DB::table('teachers')->truncate();
        DB::table('subjects')->truncate();
        DB::table('student__subject')->truncate();

        DB::statement('SET FOREIGN_KEY_CHECKS = 1;');

        $this->call(TypeQualificationSeeder::class);
        $this->call(PersonSeeder::class);
        $this->call(StudentSeeder::class);
        $this->call(TeacherSeeder::class);
        $this->call(SubjectSeeder::class);
        $this->call(StudentSubjectSeeder::class);
    }
}
