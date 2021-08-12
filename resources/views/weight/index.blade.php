@extends('layouts.admin')

@section('heading', 'Setting Weight')


@section('content')
  <div class="card shadow mb-4">
    <div class="card-header py-3 d-sm-flex align-items-center justify-content-between">
      <h6 class="m-0 font-weight-bold text-primary">Comparison matrix AHP</h6>
    </div>
    <div class="card-body">
      @if (!empty($success))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
          {{$success}}
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
      @endif

      @if (!empty($error))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
          {{$error}}
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
      @endif

      <div class="table-responsive">
        <table class="table table-bordered" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th style="width: 100px">Criteria</th>
              <th style="width: 100px">Kemuhammadiyahan</th>
              <th style="width: 100px">IMM</th>
              <th style="width: 100px">Tauhid</th>
              <th style="width: 100px">Ibadah</th>
              <th style="width: 100px">BTA</th>
            </tr>
          </thead>
          
          <tbody>
            <form action="{{ url('admin/ranking/weight-process') }}" method="post">
            @csrf
            @foreach ($comparisons as $key=>$comparison )
              <tr>
                <td class="font-weight-bold">{{ $comparison->name }}</td>
                <td> 
                  <input type="number" name="{{ $comparison->id }}[]" value="{{ $comparison->kemuh }}" id="{{$key}}0" class="form-control" {{($key == 0) ? 'readonly' : ''}} min="0" max="9" step="any"> 
                </td>
                <td> 
                  <input type="number" name="{{ $comparison->id }}[]" value="{{ $comparison->imm }}" id="{{$key}}1" class="form-control" {{ ($key == 1) ? 'readonly' : '' }} min="0" max="9" step="any"> 
                </td>
                <td> 
                  <input type="number" name="{{ $comparison->id }}[]" value="{{ $comparison->tauhid }}" id="{{$key}}2" class="form-control" {{ ($key == 2) ? 'readonly' : '' }} min="0" max="9" step="any"> 
                </td>
                <td> 
                  <input type="number" name="{{ $comparison->id }}[]" value="{{ $comparison->ibadah }}" id="{{$key}}3" class="form-control" {{ ($key == 3) ? 'readonly' : '' }} min="0" max="9" step="any"> 
                </td>
                <td> 
                  <input type="number" name="{{ $comparison->id }}[]" value="{{ $comparison->bta }}" id="{{$key}}4" class="form-control" {{ ($key == 4) ? 'readonly' : '' }} min="0" max="9" step="any"> 
                </td>
              </tr>
            @endforeach
                
          </tbody>
        </table>
          <button type="submit" class='btn btn-md btn-danger'>Save Data</button>
        </form>
      </div>
    </div>
  </div>
@endsection

@section('script')
  <script>
    $(document).ready(function(){
      $('input').on('change', function() {
        const value = $(this).val();
        const id = $(this).attr("id");
        const idChange = id.split('').reverse().join('');
        const valueChange = 1/value;

        $(`#${idChange}`).val(valueChange);

      });
    });
  </script>
    
@endsection