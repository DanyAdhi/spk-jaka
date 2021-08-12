@extends('layouts.admin')

@section('heading', 'Process Ranking SAW')


@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-sm-flex align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Overall Process Ranking SAW</h6>
        </div>
        <div class="card-body">

            @if (!empty($error))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{$error}}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            {{-- Matrik Awal --}}
            <div class="table-responsive">
                <h3 class="font-weight-bold text-dark pb-3">Matrik Awal</h3>
                <table class="table table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>NPM</th>
                            <th>Name</th>
                            <th>Kemuhammadiyahan</th>
                            <th>IMM</th>
                            <th>Tauhid</th>
                            <th>Ibadah</th>
                            <th>BTA</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    
                    <tbody>
                        @foreach ($participants as $participant)
                            @php
                                $total = $participant->kemuhammadiyahan + $participant->imm + $participant->tauhid + $participant->ibadah + $participant->bta;
                            @endphp
                            <tr>
                                <td>{{ $participant->npm }}</td>
                                <td>{{ $participant->name }}</td>
                                <td>{{ $participant->kemuhammadiyahan }}</td>
                                <td>{{ $participant->imm }}</td>
                                <td>{{ $participant->tauhid }}</td>
                                <td>{{ $participant->ibadah }}</td>
                                <td>{{ $participant->bta }}</td>
                                <td>{{ $total }} </td>
                            </tr>
                        @endforeach
                        
                    </tbody>
                </table>
            </div>
            {{-- End Matrik Awal --}}

            {{-- Matrik Normalisasi --}}
            <div class="table-responsive mt-5">
              <h3 class="font-weight-bold text-dark pb-3">Matrik Normalisasi</h3>
              <table class="table table-bordered" width="100%" cellspacing="0">
                  <thead>
                      <tr>
                          <th>Name</th>
                          <th>Kemuhammadiyahan</th>
                          <th>IMM</th>
                          <th>Tauhid</th>
                          <th>Ibadah</th>
                          <th>BTA</th>
                      </tr>
                  </thead>
                  
                  <tbody>
                      @foreach ($matrixNormalisasi as $data)
                          <tr>
                            <td>{{ $data['name'] }}</td>
                            <td>{{ $data['kemuhammadiyahan'] }}</td>
                            <td>{{ $data['imm'] }}</td>
                            <td>{{ $data['tauhid'] }}</td>
                            <td>{{ $data['ibadah'] }}</td>
                            <td>{{ $data['bta'] }}</td>
                          </tr>
                      @endforeach
                      
                  </tbody>
              </table>
            </div>
            {{-- End Matrik Normalisasi --}}

            {{-- Peringkat --}}
            <div class="table-responsive mt-5">
              <h3 class="font-weight-bold text-dark pb-3">Ranking</h3>
              <table class="table table-bordered" width="100%" cellspacing="0">
                  <thead>
                      <tr>
                          <th>Name</th>
                          <th>Poin SAW</th>
                      </tr>
                  </thead>
                  
                  <tbody>
                      @foreach ($rankingSaw as $data)
                          <tr>
                            <td>{{ $data['name'] }}</td>
                            <td>{{ $data['poin'] }}</td>
                          </tr>
                      @endforeach
                      
                  </tbody>
              </table>
            </div>
            {{-- End Peringkat --}}

        </div>
    </div>
@endsection

@section('script')
<script>
</script>
    
@endsection