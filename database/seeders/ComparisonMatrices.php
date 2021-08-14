<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ComparisonMatrices extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $name = ['kemuhamadiyahan', 'imm', 'tauhid', 'ibadah', 'bta'];
      for ($i=0; $i < 5; $i++) { 
        DB::table('comparison_matrices')->insert([
          'name'      => $name[$i],
          'kemuh'     => 1,
          'imm'       => 1,
          'tauhid'    => 1,
          'ibadah'    => 1,
          'bta'       => 1,
        ]);
      }
    }
}
