<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TypeQualificationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('type_qualifications')->insert([
            'name' => 'Examen escrito',
        ]);
    }
}
