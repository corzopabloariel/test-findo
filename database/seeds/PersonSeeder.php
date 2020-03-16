<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PersonSeeder extends Seeder
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
                'id_number' => 3333,
                'name' => 'Juan',
                'last_name' => 'Perez',
                'date_birth' => "1980-03-10"
            ],
            [
                'id_number' => 4444,
                'name' => 'José',
                'last_name' => 'Juarez',
                'date_birth' => "1982-05-10"
            ],
            [
                'id_number' => 5555,
                'name' => 'Federico',
                'last_name' => 'Martinez',
                'date_birth' => "1955-08-22"
            ],
            [
                'id_number' => 9999,
                'name' => 'Ariel',
                'last_name' => 'Ramirez',
                'date_birth' => "1990-02-27"
            ],
            [
                'id_number' => 1111,
                'name' => 'Laura',
                'last_name' => 'Thompson',
                'date_birth' => "1991-07-10"
            ],
            [
                'id_number' => 2222,
                'name' => 'Camila',
                'last_name' => 'Sueiro',
                'date_birth' => "1992-09-18"
            ]
        ];
        foreach($Arr AS $data)
            DB::table('persons')->insert($data);

    }
}
