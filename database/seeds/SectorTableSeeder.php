<?php

use Illuminate\Database\Seeder;

class SectorTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=1; $i <= 30 ; $i++) { 
            DB::table('sector')->insert([
                'sector_code' => 'A',
                'seat' => 'A'.$i
            ]);
        }

        for ($i=1; $i <= 30 ; $i++) { 
            DB::table('sector')->insert([
                'sector_code' => 'B',
                'seat' => 'B'.$i
            ]);
        }

        for ($i=1; $i <= 60 ; $i++) { 
            DB::table('sector')->insert([
                'sector_code' => 'C',
                'seat' => 'C'.$i
            ]);
        }
    }
}
