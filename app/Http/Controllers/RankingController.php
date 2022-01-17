<?php

namespace App\Http\Controllers;

use App\Models\Period;
use App\Models\Weight;
use Illuminate\Support\Facades\DB;

class RankingController extends Controller
{

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
                'kemuhammadiyahan'  => $maxScore->kemuhammadiyahan === 0 ? 0 : ($data->kemuhammadiyahan/$maxScore->kemuhammadiyahan),
                'imm'               => $maxScore->imm === 0 ? 0: number_format($data->imm/$maxScore->imm, 2, '.', ''),
                'tauhid'            => $maxScore->tauhid === 0 ? 0: number_format($data->tauhid/$maxScore->tauhid, 2, '.', ''),
                'ibadah'            => $maxScore->ibadah === 0 ? 0: number_format($data->ibadah/$maxScore->ibadah, 2, '.', ''),
                'bta'               => $maxScore->bta === 0 ? 0: number_format($data->bta/$maxScore->bta, 2, '.', ''),
            ];
            array_push($return, $normalisasi);
        }
        return $return;
    }

    private function algorithmSaw($matrixNormalisasi){
        $weight = Weight::get()->pluck('weight')->toArray();
        $return = [];

        // process algorithm saw
        foreach ($matrixNormalisasi as $data) {
            $sawPoin = number_format(( 
              ($data['kemuhammadiyahan'] * $weight[0]) +
              ($data['imm'] * $weight[1]) +
              ($data['tauhid'] * $weight[2]) +
              ($data['ibadah'] * $weight[3]) +
              ($data['bta'] * $weight[4]) 
            ), 2, '.', '');
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
