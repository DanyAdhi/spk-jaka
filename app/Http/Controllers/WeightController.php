<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ComparisonMatrix;
use App\Models\weight;
use Illuminate\Support\Facades\DB;

class WeightController extends Controller
{
    
  public function index(){
    $getWeight = Weight::get();
    $data = [
      'weights' => $getWeight
    ];

    return view('weight.index', $data);
  }

  public function processAhp(Request $request){
    $input = $request->input();
    
    if(count($input) === 1){ //view => display comparasion matrix
      $getComparisonMatrix = ComparisonMatrix::get()->toArray();
      // var_dump($getComparisonMatrix);die;
      $data = [
        'comparisons' => $getComparisonMatrix,
        'show'        => false
      ];
    }else{
      $this->storeComparisonMatrix($input);
      $comparisonMatrix         = $this->getComparisonMatrix();
      $normalizationMatrix      = $this->getNormalizationMatrix($comparisonMatrix);
      $eigenVectorNormalization = $this->getEigenVectorNormalization($normalizationMatrix);
      $this->storeWeight($eigenVectorNormalization);
      array_pop($comparisonMatrix); // delete end array

      $data = [
        'comparisons'             => $comparisonMatrix,
        'normalizationMatrix'     => $normalizationMatrix,
        'eigenVectorNormalization'=> $eigenVectorNormalization,
        'show'                    => true,
      ];
    }
    
    return view('weight.edit', $data);
  }

  // Save data to table comparison matrix
  private function storeComparisonMatrix($data){
    $all_id = array_keys($data); //all id in array [1,2,3]

    foreach ($all_id  as $id) {
      ComparisonMatrix::where('id', $id)->update([
        'kemuh'   => $data[$id][0],
        'imm'     => $data[$id][1],
        'tauhid'  => $data[$id][2],
        'ibadah'  => $data[$id][3],
        'bta'     => $data[$id][4],
      ]);
    };
  }

  // save data to table Weight
  private function storeWeight($data){
    foreach($data as $value){
      DB::table('weights')
          ->where('name',  $value['name'])
          ->update([
            'weight' => $value['eigen']
          ]);
    };
  }

  // get comparison matrix and total column
  private function getComparisonMatrix(){
    $getComparisonMatrix = ComparisonMatrix::get();

    $return = [];
    $totalKemuh   = 0;
    $totalImm     = 0;
    $totalTauhid  = 0;
    $totalIbadah  = 0;
    $totalBta     = 0;
    foreach($getComparisonMatrix as $data){
      $dataPush = [
        'id'      => $data['id'],
        'name'    => $data['name'],
        'kemuh'   => $data['kemuh'],
        'imm'     => $data['imm'],
        'tauhid'  => $data['tauhid'],
        'ibadah'  => $data['ibadah'],
        'bta'     => $data['bta'],
      ];
      array_push($return, $dataPush);
      $totalKemuh   += $data['kemuh'];
      $totalImm     += $data['imm'];
      $totalTauhid  += $data['tauhid'];
      $totalIbadah  += $data['ibadah'];
      $totalBta     += $data['bta'];
    }

    $total = [
      'id'      => 0,
      'name'    => 'Total',
      'kemuh'   => $totalKemuh,
      'imm'     => $totalImm,
      'tauhid'  => $totalTauhid,
      'ibadah'  => $totalIbadah,
      'bta'     => $totalBta,
    ];
    array_push($return, $total);

    return $return;
  }

  // Get Normalization matrix
  private function getNormalizationMatrix($comparisonMatrix){
    $total = end($comparisonMatrix);
    $return = [];
    foreach($comparisonMatrix as $data){
      $dataPush = [
        'id'      => $data['id'],
        'name'    => $data['name'],
        'kemuh'   => number_format($data['kemuh']/$total['kemuh'], 3, ',', ''),
        'imm'     => number_format($data['imm']/$total['imm'], 3, ',', ''),
        'tauhid'  => number_format($data['tauhid']/$total['tauhid'], 3, ',', ''),
        'ibadah'  => number_format($data['ibadah']/$total['ibadah'], 3, ',', ''),
        'bta'     => number_format($data['bta']/$total['bta'], 3, ',', ''),
      ];
      array_push($return, $dataPush);
    }

    // delete end array
    array_pop($return);

    return $return;
  }

  // Get Eigen Vector Normalization
  private function getEigenVectorNormalization($normalizationMatrix){
    $totalCriteria = count($normalizationMatrix);
    $return = [];
    foreach($normalizationMatrix as $data){
      $total = str_replace(',', '.', $data['kemuh']) + str_replace(',', '.', $data['imm']) + str_replace(',', '.', $data['tauhid']) + str_replace(',', '.', $data['ibadah']) + str_replace(',', '.', $data['bta']);
      $dataPush = [
        'id'      => $data['id'],
        'name'    => $data['name'],
        'total'   => $total,
        'eigen'   => $total / $totalCriteria,
      ];
      array_push($return, $dataPush);
    }

    return $return;
  }

}
