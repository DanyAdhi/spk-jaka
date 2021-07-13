<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Period;
use App\Models\Participant;
use Illuminate\Support\Facades\DB;

class RankingController extends Controller
{
    public function rankingSaw(){
        
        $getPeriod = Period::where('status', 'Active')->first();
        
        if($getPeriod == null){
            $data = [
              'period'        => [],
              'participants'  => [],
              'error'         => 'Period not active',
              'success'       => ''
            ];
            return view('ranking-saw.index', $data);
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

        return view('ranking-saw.index', $data);
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
            return view('ranking-saw.index', $data);
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

        return view('ranking-saw.process', $data);
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

}
