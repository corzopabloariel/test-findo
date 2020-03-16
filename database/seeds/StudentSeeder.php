<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StudentSeeder extends Seeder
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
                'docket' => '4'
            ],
            [
                'docket' => '5'
            ],
            [
                'docket' => '6'
            ]
        ];
        foreach ($Arr as $data) {
            $data['person_id'] = $data["docket"];
            DB::table('students')->insert($data);
        }
    }

    private function getRandomPersonId() {
        $person = \App\Person::inRandomOrder()->first();
        return $person->id;
    }
}
