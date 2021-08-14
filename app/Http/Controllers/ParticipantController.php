<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use App\Models\Participant;
use App\Models\ParticipantScore;
use App\Models\Period;
use App\Models\Faculty;

class ParticipantController extends Controller
{
    public function index(){
      $data = Participant::orderBy('id', 'DESC')->get();
      return view('participant.index', ['participants' => $data]);
    }

    public function create(){
        $period = Period::where('status', 'Active')->first();
        $faculty = Faculty::orderBy('id', 'DESC')->get();

        $data = [
            'period'    => $period,
            'faculties'   => $faculty
        ];
        return view('participant.create', $data);
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(),[
            'year'      => 'required|numeric',
            'group'     => 'required|numeric',
            'npm'       => 'required|numeric|digits_between:10,12',
            'name'      => 'required|string',
            'gender'    => 'required|string|in:Laki-Laki,Perempuan',
            'faculty'   => 'required|string',
            'handphone' => 'required',
            'address'   => 'string|nullable'
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput($request->all());
        }

        // validation participant is exist
        $payloadCheck = [
            'year'  => $request->input('year'),
            'group' => $request->input('group'),
            'npm'   => $request->input('npm'),
        ];

        $checkParticipant =  Participant::where($payloadCheck)->first();
        if($checkParticipant !== null){
            return redirect()->back()->with('error', "Participant alredy exists")->withInput($request->all());
        }

        $saveParticipant = Participant::create([
            'year'      => $request->input('year'),
            'group'     => $request->input('group'),
            'npm'       => $request->input('npm'),
            'name'      => $request->input('name'),
            'gender'    => $request->input('gender'),
            'faculty'   => $request->input('faculty'),
            'handphone' => $request->input('handphone'),
            'address'   => $request->input('address'),
        ]);

        ParticipantScore::create([
            'participant_id'    => $saveParticipant->id,
            'kemuhammadiyahan'  => 0,
            'imm'               => 0,
            'tauhid'            => 0,
            'ibadah'            => 0,
            'bta'               => 0,
        ]);


        return Redirect::to('admin/participant')->with('success', 'Success create participant');
    }

    public function edit($id){
        $participant = Participant::where('id', $id)->firstOrFail();
        $faculties = Faculty::orderBy('id', 'DESC')->get();
        $data = [
            'participant'   => $participant,
            'faculties'       => $faculties
        ];
        return view('participant.edit', $data);
    }

    public function update(Request $request, $id){

        $validator = Validator::make($request->all(),[
            'year'      => 'required|numeric',
            'group'     => 'required|numeric',
            'npm'       => 'required|numeric|digits_between:10,12',
            'name'      => 'required|string',
            'gender'    => 'required|string|in:Laki-Laki,Perempuan',
            'faculty'   => 'required|string',
            'handphone' => 'required',
            'address'   => 'string|nullable'
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput($request->all());
        }

        // validation participant is exist
        $payloadCheck = [
            'year'  => $request->input('year'),
            'group' => $request->input('group'),
            'npm'   => $request->input('npm'),
        ];
        $checkParticipant =  Participant::where($payloadCheck)->first();
        if($checkParticipant === null || $checkParticipant->id ==  $id){
            Participant::where('id', $id)->update([
                'year'      => $request->input('year'),
                'group'     => $request->input('group'),
                'npm'       => $request->input('npm'),
                'name'      => $request->input('name'),
                'gender'    => $request->input('gender'),
                'faculty'   => $request->input('faculty'),
                'handphone' => $request->input('handphone'),
                'address'   => $request->input('address'),
            ]);
            return Redirect::to('admin/participant')->with('success', 'Success update participant');
        }

        return redirect()->back()->with('error', 'Participant alredy exists')->withInput($request->all());
    }

    public function destroy($id){
        Participant::where('id', $id)->delete();
        ParticipantScore::where('participant_id', $id)->delete();
        return Redirect::to('admin/participant')->with('success', 'Success delete participant');
    }

}
