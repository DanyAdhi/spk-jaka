<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ParticipantScore;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;


class ParticipantScoreController extends Controller
{
    public function index(){
      $participantScores = DB::table('participants as p')
                          ->select( 'p.id', 'p.year', 'p.group', 'p.npm', 'p.name', 'ps.kemuhammadiyahan', 'ps.imm', 'ps.tauhid', 'ps.ibadah', 'ps.bta')
                          ->leftjoin('participant_scores as ps', 'p.id', '=', 'ps.participant_id')
                          ->orderBy('id', 'DESC')
                          ->get();
      
      return view('participant-score.index', ['participantScores' => $participantScores]);
    }

    public function edit($id){
        $participantScore = DB::table('participants as p')
                            ->select( 'ps.id', 'ps.participant_id', 'p.year', 'p.group', 'p.npm', 'p.name', 'ps.kemuhammadiyahan', 'ps.imm', 'ps.tauhid', 'ps.ibadah', 'ps.bta')
                            ->leftjoin('participant_scores as ps', 'p.id', '=', 'ps.participant_id')
                            ->where('p.id', '=', $id)
                            ->get();
        return view('participant-score.edit', ['participantScore' => $participantScore[0]]);
    }


    public function update(Request $request, $id){
        $validator = Validator::make($request->all(),[
            'kemuhammadiyahan'  => 'numeric|min:0|max:100',
            'imm'               => 'numeric|min:0|max:100',
            'tauhid'            => 'numeric|min:0|max:100',
            'ibadah'            => 'numeric|min:0|max:100',
            'bta'               => 'numeric|min:0|max:100'
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput($request->all());
        }

        $check = ParticipantScore::where('id', $id)->first();
        if($check === null){
            return redirect()->back()->with('error','Data not found')->withInput($request->all());
        }
        ParticipantScore::where('id', $id)->update([
            'kemuhammadiyahan'  => $request->input('kemuhammadiyahan'),
            'imm'               => $request->input('imm'),
            'tauhid'            => $request->input('tauhid'),
            'ibadah'            => $request->input('ibadah'),
            'bta'               => $request->input('bta'),
        ]);
        return Redirect::to('admin/participant-score')->with('success', 'Success update participant score');

    }

}
