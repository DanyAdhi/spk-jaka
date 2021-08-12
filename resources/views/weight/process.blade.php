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

            {{-- Decimal Comparison Matrix --}}
            <div class="table-responsive">
                <h3 class="font-weight-bold text-dark pb-3">Decimal Comparison Matrix</h3>
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
                        @foreach ($comparisonMatrix as $data)
                        <tr>
                            <td class="font-weight-bold">{{ $data['name'] }}</td>
                            <td>{{ $data['kemuh'] }}</td>
                            <td>{{ $data['imm'] }}</td>
                            <td>{{ $data['tauhid'] }}</td>
                            <td>{{ $data['ibadah'] }}</td>
                            <td>{{ $data['bta'] }}</td>
                        </tr>
                        @endforeach
                    </tbody>

                </table>
            </div>
            {{-- End Decimal Comparison Matrix --}}


            {{-- Matrix Normalization --}}
            <div class="table-responsive mt-5">
                <h3 class="font-weight-bold text-dark pb-3">Matrix Normalization </h3>
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
                        @foreach ($normalizationMatrix as $data)
                        <tr>
                            <td class="font-weight-bold">{{ $data['name'] }}</td>
                            <td>{{ $data['kemuh'] }}</td>
                            <td>{{ $data['imm'] }}</td>
                            <td>{{ $data['tauhid'] }}</td>
                            <td>{{ $data['ibadah'] }}</td>
                            <td>{{ $data['bta'] }}</td>
                        </tr>
                        @endforeach
                    </tbody>

                </table>
            </div>
            {{-- End Matrix Normalization --}}


            {{-- Eigen Vector Normalization --}}
            <div class="table-responsive mt-5">
                <h3 class="font-weight-bold text-dark pb-3">Eigen Vector Normalization </h3>
                <table class="table table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th style="width: 100px">Criteria</th>
                            <th style="width: 100px">Total</th>
                            <th style="width: 100px">Eigen</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($eigenVectorNormalization as $data)
                        <tr>
                            <td class="font-weight-bold">{{ $data['name'] }}</td>
                            <td>{{ $data['total'] }}</td>
                            <td>{{ $data['eigen'] }}</td>
                        </tr>
                        @endforeach
                    </tbody>

                </table>
            </div>
            {{-- End Eigen Vector Normalization --}}


            {{-- Final Weight --}}
            <div class="table-responsive mt-5">
                <h3 class="font-weight-bold text-dark pb-3">Final Weight</h3>
                <table class="table table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th style="width: 100px">Criteria</th>
                            <th style="width: 100px">Weight</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($eigenVectorNormalization as $data)
                        <tr>
                            <td class="font-weight-bold">{{ $data['name'] }}</td>
                            <td>{{ $data['eigen'] }}</td>
                        </tr>
                        @endforeach
                    </tbody>

                </table>
            </div>
            {{-- End Final Weight --}}
            <button type="submit" class='btn btn-md btn-danger'>Save Data</button>

        </div>
    </div>
@endsection

@section('script')
<script>
</script>
    
@endsection