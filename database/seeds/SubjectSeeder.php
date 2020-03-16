<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubjectSeeder extends Seeder
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
                'name' => 'Algebra lineal',
                'description' => Str::random(150)
            ],
            [
                'name' => 'Estadística',
                'description' => Str::random(150)
            ],
            [
                'name' => 'Física',
                'description' => Str::random(150)
            ],
            [
                'name' => 'Programación en tiempo real',
                'description' => Str::random(150)
            ]
        ];
        foreach ($Arr as $data) {
            $data['teacher_id'] = $this->getRandomTeacherId();
            DB::table('subjects')->insert($data);
        }
    }

    private function getRandomTeacherId() {
        $teacher = \App\Teacher::inRandomOrder()->first();
        return $teacher->id;
    }
}
