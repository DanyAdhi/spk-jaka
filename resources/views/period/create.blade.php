@extends('layouts.admin')

@section('heading', 'Create New Period')


@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">Add Period</h6>
        </div>
        <div class="card-body">
          @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{session('error')}}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
          <form method="POST" action="{{url('admin/period')}}">
            @csrf
            <div class="form-group">
              <label for="year">Year</label>
              <input type="number" class="form-control" placeholder="Enter year period" name="year" value="{{ old('year') }}">
              @error('year')
                <span class="text-danger">{{ $errors->first('year') }}</span>                  
              @enderror
            </div>
            <div class="form-group">
              <label for="group">Group</label>
              <input type="number" class="form-control" placeholder="Enter group period" name="group" value="{{ old('group') }}">
              @error('group') 
                <span class="text-danger">{{ $errors->first('group') }}</span>                  
              @enderror
            </div>
            <button type="submit" class="btn btn-primary">Save</button>
          </form>
        </div>
    </div>
@endsection