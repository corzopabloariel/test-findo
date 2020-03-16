<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StudentSubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $Arr = [
            [
                'student_id' => $this->getRandomStudentId(),
                'subject_id' => $this->getRandomSubjectId()
            ],
            [
                'student_id' => $this->getRandomStudentId(),
                'subject_id' => $this->getRandomSubjectId()
            ],
            [
                'student_id' => $this->getRandomStudentId(),
                'subject_id' => $this->getRandomSubjectId()
            ]
        ];
        foreach ($Arr as $data)
            DB::table('student__subject')->insert($data);
        /*$elements = factory(\App\Student_Subject::class, 3)->create([
            'student_id' => $this->getRandomStudentId(),
            'subject_id' => $this->getRandomSubjectId()
        ]);*/
    }

    private function getRandomStudentId() {
        return rand(1,3);
    }

    private function getRandomSubjectId() {
        //$subject = \App\Subject::inRandomOrder()->first();
        return rand(1,4);
    }
}
