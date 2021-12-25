<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ParticipantScoresSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=0; $i < 1; $i++) { 
            DB::table('participant_scores')->insert([
                'participant_id'=> 2020,
                'kemuhammadiyahan'=> 1,
                'imm'=>  '1460100030',
                'bta' => 'Teknik',
                'tauhid' => 10,
                'ibadah' => 'Laki-Laki',
            ]);
        }
    }
}
