@extends('layouts.admin')

@section('heading', 'Edit Participant')


@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">Edit Participant</h6>
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
          <form method="POST" action="{{url('admin/participant', [$participant->id])}}">
            @csrf
            @method('put')
            <div class="row">
              <div class="col">
                <div class="form-group">
                  <label class="text-dark font-weight-bold">Year</label>
                  <input type="number" class="form-control" placeholder="Enter year period" name="year" value="{{ $participant->year }}" readonly>
                  @error('year')
                    <span class="text-danger">{{ $errors->first('year') }}</span>                  
                  @enderror
                </div>
              </div>
              <div class="col">
                <div class="form-group">
                  <label class="text-dark font-weight-bold">Group</label>
                  <input type="number" class="form-control" placeholder="Enter group period" name="group" value="{{ $participant->group }}" readonly>
                  @error('group') 
                    <span class="text-danger">{{ $errors->first('group') }}</span>                  
                    @enderror
                </div>
              </div>
            </div>

            <div class="form-group">
              <label class="text-dark font-weight-bold">NPM</label>
              <input type="number" class="form-control" placeholder="Enter NPM..." name="npm" value="{{ old('npm', $participant->npm) }}">
              @error('npm')
                <span class="text-danger">{{ $errors->first('npm') }}</span>                  
              @enderror
            </div>
            <div class="form-group">
              <label class="text-dark font-weight-bold">Name</label>
              <input type="text" class="form-control" placeholder="Enter name..." name="name" value="{{ old('name', $participant->name) }}">
              @error('name')
                <span class="text-danger">{{ $errors->first('name') }}</span>                  
              @enderror
            </div>
            <div class="form-group row">
              <label class="text-dark col-md-3 font-weight-bold">Gender</label>
              <div class="col-md-12 ml-3">
                <div class="form-check">
                  <label class="form-check-label">
                    <input class="form-check-input" type="radio" name="gender" value="Laki-Laki" {{(old('gender') == 'Laki-Laki') ? 'checked' : ''}} {{ ($participant->gender == 'Laki-Laki') ? 'checked' : '' }}>Laki-Laki
                  </label>
                </div>
                <div class="form-check">
                  <label class="form-check-label">
                    <input class="form-check-input" type="radio" name="gender" value="Perempuan"  {{(old('gender') == 'Perempuan') ? 'checked' : ''}} {{ ($participant->gender == 'Perempuan') ? 'checked' : '' }} >Perempuan
                  </label>
                </div>
              </div>
            </div>
            <div class="form-group">
              <label class="text-dark font-weight-bold">Faculty</label>
              <select id="inputState" class="form-control col-xl-6" name="faculty">
                <option value="">--Choose--</option>
                @foreach ($faculties as $faculty)
                  <option 
                    {{ ($faculty->name == $participant->faculty) ? 'selected' : '' }}
                    {{ old('faculty') == $faculty->name ? "selected" : "" }} 
                    value="{{ $faculty->name }}" > 
                      {{ $faculty->name }}
                  </option>  
                @endforeach
              </select>
              @error('faculty')
                <span class="text-danger">{{ $errors->first('faculty') }}</span>                  
              @enderror
            </div>
            <div class="form-group">
              <label class="text-dark font-weight-bold">Handphone</label>
              <input type="number" class="form-control" placeholder="Enter hnandphone..." name="handphone" value="{{ old('handphone', $participant->handphone) }}">
              @error('handphone')
                <span class="text-danger">{{ $errors->first('handphone') }}</span>                  
              @enderror
            </div>
            <div class="form-group">
              <label for="exampleTextarea" class="text-dark font-weight-bold">Alamat</label>
              <textarea class="form-control " id="exampleTextarea" rows="4" name="address">{{ old('address', $participant->address) }}</textarea>
            </div>

            <a href="{{ url('admin/participant') }}" class="btn btn-secondary">Cancel</a>
            <button type="submit" class="btn btn-primary">Update</button>
          </form>
        </div>
    </div>
@endsection