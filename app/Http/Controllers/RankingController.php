<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Models\Period;
use Illuminate\Support\Facades\DB;
use App\Models\ComparisonMatrix;

class RankingController extends Controller
{


  // Start algorithm AHP
    public function comparisonMatrix(){ //matrik perbandingan berpasangan
      $getComparisonMatrix = ComparisonMatrix::get();

      $data = [
        'comparisons' => $getComparisonMatrix
      ];

      return view('weight.index', $data);
    }


    public function storeComparisonMatrix(Request $request){
      $data = $request->input();
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

      return Redirect::to('admin/ranking/weight-process');

    }

    public function viewComparisonMatrix(){
      $comparisonMatrix         = $this->getComparisonMatrix();

      $normalizationMatrix      = $this->getNormalizationMatrix($comparisonMatrix);
      $eigenVectorNormalization = $this->getEigenVectorNormalization($normalizationMatrix);
      $data = [
        'comparisonMatrix'        => $comparisonMatrix,
        'normalizationMatrix'     => $normalizationMatrix,
        'eigenVectorNormalization'=> $eigenVectorNormalization
      ];
      return view('weight.process', $data);
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


  // End algorithm AHP



  // start algorithm SAW
    public function rankingSaw(){
        
        $getPeriod = Period::where('status', 'Active')->first();
        
        if($getPeriod == null){
            $data = [
              'period'        => [],
              'participants'  => [],
              'error'         => 'Period not active',
              'success'       => ''
            ];
            return view('ranking.index', $data);
        }

        $getParticipants = DB::table('participants as p')
                            ->select( 'p.id', 'p.year', 'p.group', 'p.npm', 'p.name', 'ps.kemuhammadiyahan', 'ps.imm', 'ps.tauhid', 'ps.ibadah', 'ps.bta')
                            ->leftjoin('participant_scores as ps', 'p.id', '=', 'ps.participant_id')
                            ->where([ 
                                  'p.year' => $getPeriod->year,
                                  'p.group' => $getPeriod->group,
                                ])
                            ->get();

        $data = [
          'period'        => $getPeriod,
          'participants'  => $getParticipants
        ];

        return view('ranking.index', $data);
    }

    public function processSaw(){
        $getPeriod = Period::where('status', 'Active')->first();
        
        if($getPeriod == null){
            $data = [
              'period'        => [],
              'participants'  => [],
              'error'         => 'Period not active',
              'success'       => ''
            ];
            return view('ranking.index', $data);
        }
        
        $getParticipants = DB::table('participants as p')
                            ->select( 'p.id', 'p.year', 'p.group', 'p.npm', 'p.name', 'ps.kemuhammadiyahan', 'ps.imm', 'ps.tauhid', 'ps.ibadah', 'ps.bta')
                            ->leftjoin('participant_scores as ps', 'p.id', '=', 'ps.participant_id')
                            ->where([ 
                                  'p.year' => $getPeriod->year,
                                  'p.group' => $getPeriod->group,
                                ])
                            ->get();

        $maxScores = DB::table('participants as p')
                        ->select(DB::raw('MAX(kemuhammadiyahan) as kemuhammadiyahan, MAX(imm) as imm, MAX(tauhid) as tauhid, MAX(ibadah) as ibadah, MAX(bta) as bta'))
                        ->leftJoin('participant_scores as ps', 'p.id', '=', 'ps.participant_id')
                        ->where([ 
                            'p.year' => $getPeriod->year,
                            'p.group' => $getPeriod->group,
                        ])
                        ->get();

        $matrixNormalisasi = $this->matrixNormalisasi($getParticipants, $maxScores[0]);
        $rankingSaw = $this->algorithmSaw($matrixNormalisasi);
                        
        $data = [
          'period'            => $getPeriod,
          'participants'      => $getParticipants,
          'matrixNormalisasi' => $matrixNormalisasi,
          'rankingSaw'        => $rankingSaw
        ];

        return view('ranking.process', $data);
    }

    private function matrixNormalisasi($participants, $maxScore){
        $return = [];
        foreach($participants as $data){
            $normalisasi = [
                'name'              => $data->name,
                'kemuhammadiyahan'  => round($data->kemuhammadiyahan/$maxScore->kemuhammadiyahan, 2),
                'imm'               => round($data->imm/$maxScore->imm, 2),
                'tauhid'            => round($data->tauhid/$maxScore->tauhid, 2),
                'ibadah'            => round($data->ibadah/$maxScore->ibadah, 2),
                'bta'               => round($data->bta/$maxScore->bta, 2),
            ];
            array_push($return, $normalisasi);
        }
        return $return;
    }

    private function algorithmSaw($matrixNormalisasi){
        $bobot = [10,8,6,4,2];
        $return = [];

        // process algorithm saw
        foreach ($matrixNormalisasi as $data) {
            $sawPoin = ( 
                          ($data['kemuhammadiyahan'] * $bobot[0]) +
                          ($data['imm'] * $bobot[1]) +
                          ($data['tauhid'] * $bobot[2]) +
                          ($data['ibadah'] * $bobot[3]) +
                          ($data['bta'] * $bobot[4]) 
                        );
            $ranking = [
              'name'  => $data['name'],
              'poin'  => $sawPoin
            ];

            array_push($return, $ranking);
        }

        // short by poin saw
        usort($return, function($a, $b) {
            return $b['poin'] <=> $a['poin'];
        });

        return $return;
    }

  // end algorithm SAW 

}
