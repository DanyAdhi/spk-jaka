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

        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Matrik Awal</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Normalisasi Matrik</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Ranking</a>
            </li>
        </ul>

        <div class="tab-content" id="myTabContent">
            {{-- Matrik Awal --}}
            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                <div class="table-responsive mt-5">
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
            </div>
            {{-- End Matrik Awal --}}

            {{-- Matrik Normalisasi --}}
            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
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
                                <td>{{ floatval($data['kemuhammadiyahan']) }}</td>
                                <td>{{ floatval($data['imm']) }}</td>
                                <td>{{ floatval($data['tauhid']) }}</td>
                                <td>{{ floatval($data['ibadah']) }}</td>
                                <td>{{ floatval($data['bta']) }}</td>
                                </tr>
                            @endforeach
                            
                        </tbody>
                    </table>
                </div>
            </div>
            {{-- End Matrik Normalisasi --}}

            {{-- Peringkat --}}
            <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
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
            </div>
            {{-- End Peringkat --}}
        </div>


        </div>
    </div>
@endsection

@section('script')
<script>
</script>
    
@endsection