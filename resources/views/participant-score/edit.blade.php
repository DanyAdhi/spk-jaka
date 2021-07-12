@extends('layouts.admin')

@section('heading', 'Edit Participant Score')


@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">Edit Participant Score</h6>
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

          <form method="POST" action="{{url('admin/participant-score', [$participantScore->id])}}">
            @csrf
            <div class="row">
              <div class="col">
                <div class="form-group">
                  <label class="text-dark font-weight-bold">Year</label>
                  <input type="number" class="form-control" placeholder="Enter year period" name="year" value="{{ $participantScore->year }}" readonly>
                </div>
              </div>
              <div class="col">
                <div class="form-group">
                  <label class="text-dark font-weight-bold">Group</label>
                  <input type="number" class="form-control" placeholder="Enter group period" name="group" value="{{ $participantScore->group }}" readonly>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col">
                <div class="form-group">
                  <label class="text-dark font-weight-bold">NPM</label>
                  <input type="number" class="form-control" placeholder="Enter NPM..." name="npm" value="{{ old('npm', $participantScore->npm) }}" readonly>
                </div>
              </div>
              <div class="col">
                <div class="form-group">
                  <label class="text-dark font-weight-bold">Name</label>
                  <input type="text" class="form-control" placeholder="Enter name..." name="name" value="{{ old('name', $participantScore->name) }}" readonly>
                </div>
              </div>
            </div>

            <div class="form-group">
              <label class="text-dark font-weight-bold">Kemuhammadiyahan</label>
              <input type="number" class="form-control" placeholder="Enter score kemuhammadiyahan..." name="kemuhammadiyahan" value="{{ old('kemuhammadiyahan', $participantScore->kemuhammadiyahan) }}">
              <span class="text-danger">{{ $errors->first('kemuhammadiyahan') }}</span>                  
            </div>
            <div class="form-group">
              <label class="text-dark font-weight-bold">Ke IMM an</label>
              <input type="number" class="form-control" placeholder="Enter score ke IMM an..." name="imm" value="{{ old('imm', $participantScore->imm) }}">
              <span class="text-danger">{{ $errors->first('imm') }}</span>                  
            </div>
            <div class="form-group">
              <label class="text-dark font-weight-bold">Tauhid</label>
              <input type="number" class="form-control" placeholder="Enter score tauhid..." name="tauhid" value="{{ old('tauhid', $participantScore->tauhid) }}">
              <span class="text-danger">{{ $errors->first('tauhid') }}</span>
            </div>
            <div class="form-group">
              <label class="text-dark font-weight-bold">Ibadah</label>
              <input type="number" class="form-control" placeholder="Enter score ibadah..." name="ibadah" value="{{ old('ibadah', $participantScore->ibadah) }}">
              <span class="text-danger">{{ $errors->first('ibadah') }}</span>
            </div>
            <div class="form-group">
              <label class="text-dark font-weight-bold">Baca Tulis Alquran</label>
              <input type="number" class="form-control" placeholder="Enter score baca tulis alquran..." name="bta" value="{{ old('bta', $participantScore->bta) }}">
              <span class="text-danger">{{ $errors->first('bta') }}</span>
            </div>


            <a href="{{ url('admin/participant-score') }}" class="btn btn-secondary">Cancel</a>
            <button type="submit" class="btn btn-primary">Update</button>
          </form>
        </div>
    </div>
@endsection