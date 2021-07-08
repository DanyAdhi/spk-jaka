<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Period;
use Illuminate\Support\Facades\Redirect;

class PeriodController extends Controller
{
    public function index(){
        $getAllPeriod = Period::orderBy('id', 'DESC')->get();
        return view('period.index', ['periods'=>$getAllPeriod]);
    }

    public function create(){
        return view('period.create');
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'year'  => 'required|numeric|digits_between:4,4',
            'group' => 'required|numeric|digits_between:1,2',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput($request->all());
        }

        $checkPeriod =  Period::where([
            'year' => $request->input('year'),
            'group' => $request->input('group')
            ])->first();
        
        if($checkPeriod !== null){
            return redirect()->back()->with('error', 'Period alredy exists')->withInput($request->all());
        }

        Period::create([
            'year'  => $request->input('year'),
            "group"  => $request->input('group'), 
            "status"  => 'Inactive',
        ]);
        return Redirect::to('admin/period')->with('success', 'Success create period');
        
    }

    public function edit($id){
        $period = Period::where('id', $id)->firstOrFail();
        return view('period.edit', ['period' => $period]);
    }

    public function update(Request $request,  $id){
        $validator = Validator::make($request->all(), [
            'year'  => 'required|numeric|digits_between:4,4',
            'group' => 'required|numeric|digits_between:1,2',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput($request->all());
        }
        
        $checkPeriod =  Period::where([
            'year' => $request->input('year'),
            'group' => $request->input('group')
            ])->first();
        if($checkPeriod === null){
            Period::where('id', $id)->update([
                'year'  => $request->input('year'),
                "group"  => $request->input('group'), 
            ]);
            return Redirect::to('admin/period')->with('success', 'Success update period');
        }
        if($checkPeriod->id == $id){
            return Redirect::to('admin/period')->with('success', 'Success update period');
        }
        return redirect()->back()->with('error', 'Period alredy exists')->withInput($request->all());
    }

    public function updateStatus($id){
        $checkPeriod = Period::where('status', 'Active')->first();
        if($checkPeriod === null){
            Period::where('id', $id)->update(['status'=> 'Active']);
            return Redirect::to('admin/period');
        }
        if($checkPeriod['id'] == $id){
            Period::where('id', $id)->update(['status'=> 'Inactive']);
            return Redirect::to('admin/period');
        }
        return Redirect::to('admin/period')->with('error', 'Period active is alredy exists');
    }

    public function deletePeriod($id){
        Period::where('id', $id)->delete();
        return Redirect::to('admin/period')->with('success', 'Success delete period');
    }

}
