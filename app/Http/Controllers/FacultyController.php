<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Faculty;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;

class FacultyController extends Controller
{
    public function index(){
        $data = Faculty::orderBy('id', "DESC")->get();
        return view('faculty.index', ['faculties' => $data]);
    }

    public function show($id){
        $data = Faculty::findOrFail($id);
        return $data;
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'name'  => 'required|string|unique:faculties'
        ]);
        if ($validator->fails()) {
            $message = $validator->errors()->first();
            return redirect()->back()->with('error', $message)->withInput($request->all());
        }

        Faculty::create([
            'name' => $request->input('name')
        ]);
        return Redirect::to('admin/faculty')->with('success', 'Success create faculty');
    }

    public function update(Request $request, $id){
        $validator = Validator::make($request->all(), [
            'name'  => 'required|string|unique:faculties'
        ]);
        if ($validator->fails()) {
            $message = $validator->errors()->first();
            return redirect()->back()->with('error', $message)->withInput($request->all());
        }

        Faculty::where('id', $id)->update([
            'name' => $request->input('name')
        ]);
        return Redirect::to('admin/faculty')->with('success', 'Success update faculty');
    }

    public function destroy($id){
        Faculty::where('id', $id)->delete();
        return Redirect::to('admin/faculty')->with('success', 'Success delete faculty');
    }
}
