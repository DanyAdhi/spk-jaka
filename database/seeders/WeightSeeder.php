<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WeightSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $name = ['kemuhamadiyahan', 'imm', 'tauhid', 'ibadah', 'bta'];
        foreach($name as $value){
            DB::table('weights')->insert([
                'name'      => $value,
                'weight'    => 1
            ]);
        }
    }
}
