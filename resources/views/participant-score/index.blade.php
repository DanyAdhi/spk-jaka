@extends('layouts.admin')

@section('heading', 'Participant Score')


@section('content')

    <div class="card shadow mb-4">
        <div class="card-header py-3 d-sm-flex align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Overall Participant Score</h6>
        </div>
        <div class="card-body">

            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{session('success')}}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{session('error')}}
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
                            <th width="120px">Action</th>
                        </tr>
                    </thead>
                    
                    <tbody>
                        @foreach ($participantScores as $participantScore)
                            <tr>
                                <td>{{ $participantScore->year }}</td>
                                <td>{{ $participantScore->group }}</td>
                                <td>{{ $participantScore->npm }}</td>
                                <td>{{ $participantScore->name }}</td>
                                <td>{{ $participantScore->kemuhammadiyahan }}</td>
                                <td>{{ $participantScore->imm }}</td>
                                <td>{{ $participantScore->tauhid }}</td>
                                <td>{{ $participantScore->ibadah }}</td>
                                <td>{{ $participantScore->bta }}</td>
                                <td>
                                    <a href="{{url('admin/participant-score', [$participantScore->id]) }}" class="btn btn-sm btn-warning">Edit</a>
                                </td>
                            </tr>
                            
                        @endforeach
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>


    <!-- Logout Delete-->
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-danger text-light">
                    <h5 class="modal-title" id="exampleModalLabel">Delete data.</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Are you sure want to delete this data?</div>
                <div class="modal-footer">
                    <button class="btn btn-sm btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <form class="d-inline" method="POST" id="hapus" >
                        @method('delete')
                        @csrf   
                        <button class='btn btn-sm btn-danger' > Delete </button>    
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
<script>
    function deleteConfirm(url) {
        $('#hapus').attr('action',url);
    }
</script>
    
@endsection