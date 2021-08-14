@extends('layouts.admin')

@section('heading', 'Overview Weight')


@section('content')
  <div class="card shadow mb-4">
    <div class="card-header py-3 d-sm-flex align-items-center justify-content-between">
      <h6 class="m-0 font-weight-bold text-primary">Weight</h6>
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
        <table class="table table-bordered" >
          <thead>
            <tr>
              <th style="width: 10px" >No</th>
              <th class="col-3">Criteria</th>
              <th>Weight</th>
            </tr>
          </thead>
          
          <tbody>
            @foreach ($weights as $index=>$value )
              <tr>
                <td>{{ $index+1 }}</td>
                <td>{{ $value->name }}</td>
                <td>{{ $value->weight }}</td>
              </tr>
            @endforeach
                
          </tbody>
        </table>
          <form action="{{ url('admin/weight/process') }}" method="post">
            @csrf
            <button type="submit" class='btn btn-md btn-warning'>Edit Weight</button>
          </form>
      </div>
    </div>
  </div>
@endsection

@section('script')   
@endsection