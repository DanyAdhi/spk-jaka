@extends('layouts.admin')

@section('heading', 'Ranking SAW')


@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-sm-flex align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Overall Ranking SAW</h6>
        </div>
        <div class="card-body">
            <div class="mt-2 mb-5">
                <table>
                    <tr>
                        <td style="width: 60px" class="font-weight-bold">Year</td>
                        <td>:</td>
                        <td>{{ $period->year ?? '' }}</td>
                    </tr>
                    <tr>
                        <td class="font-weight-bold">Group</td>
                        <td>:</td>
                        <td>{{ $period->group ?? '' }}</td>
                    </tr>
                </table>
            </div>

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
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Year</th>
                            <th>Group</th>
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
                                <td>{{ $participant->year }}</td>
                                <td>{{ $participant->group }}</td>
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

            <div class="pt-4">
                @if (count($participants) != 0)
                    <a href="{{ url('admin/ranking/saw-process')  }}" class='btn btn-md btn-danger'>Process Data</a>
                @endif
            </div>

        </div>
    </div>
@endsection

@section('script')
<script>
</script>
    
@endsection