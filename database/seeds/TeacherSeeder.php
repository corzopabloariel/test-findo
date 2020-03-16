<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TeacherSeeder extends Seeder
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
                'docket' => '1',
                'date' => '2010-05-01'
            ],
            [
                'docket' => '2',
                'date' => '2010-05-01'
            ],
            [
                'docket' => '3',
                'date' => '2008-03-15'
            ]
        ];
        foreach ($Arr as $data) {
            $data['person_id'] = $data["docket"];
            DB::table('teachers')->insert($data);
        }
    }

    private function getRandomPersonId() {
        $person = \App\Person::inRandomOrder()->first();
        return $person->id;
    }
}
